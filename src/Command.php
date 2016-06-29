<?php

/**
 * Created by Prowect
 * Author: Raffael Kessler
 * Date: 30.10.2015 - 17:00
 * Copyright: Prowect
 */

namespace Drips\CLI;

use ReflectionClass;

/**
 * Class Command
 *
 * Wird verwendet um selbsterstellte Kommandos, die das ICommand-Interface
 * implementieren automatisiert auszuführen.
 * Hierfür müssen die Kommandos registriert werden.
 */
abstract class Command
{
    /**
     * Beinhaltet alle registrierten Commandos
     *
     * @var array
     */
    protected static $commands = array();

    /**
     * Dient zum Registrieren von Kommandos.
     * Gibt zurück ob die Registrierung erfolgreich war.
     * Wird FALSE zurückgegeben, ist das Kommando bereits registriert, bzw.
     * der Name des Kommandos bereits vergeben.
     *
     * @param string $command Name des Kommandos, unter welchem es erreichbar sein soll
     * @param ICommand $class Klasse die die Kommandos beinhaltet
     *
     * @return bool
     */
    public static function register($command, $class)
    {
        // Überprüft ob das Kommando auch das ICommand-Interface implementiert
        $reflection = new ReflectionClass($class);
        $icmd = new ReflectionClass(ICommand::class);
        $interfaces = $reflection->getInterfaces();
        if(!in_array($icmd, $interfaces)){
            return false;
        }
        $command = strtolower($command);
        if(!isset(static::$commands[$command])){
            static::$commands[$command] = $class;
            return true;
        }
        return false;
    }

    /**
     * Führt automatisch das entsprechende Kommando aus, bzw. erzeugt eine
     * Fehlermeldung wenn ein Kommando nicht richtig aufgerufen wurde.
     * Gibt TRUE/FALSE zurück, je nachdem ob übergebene Methode der Klasse
     * aufgerufen werden konnte oder nicht.
     *
     * @param array $args Args die von PHP übergeben wurden
     *
     * @return bool
     */
    public static function execute(array $args)
    {
        if(count($args) > 1){
            $command = strtolower($args[1]);
            if(!isset(static::$commands[$command])){
                Console::error("Command ($command) not found!");
            } else {
                $commandClass = static::$commands[$command];
                if(count($args) >= 3){
                    $method = $args[2];
                    if(method_exists($commandClass, $method)){
                        $args = array_slice($args, 3);
                        call_user_func_array(array($commandClass, $method), $args);
                        return true;
                    }
                }
                $commandClass::help();
            }
        }
        return false;
    }

    /**
     * Entfernt ein registriertes Kommando
     * 
     * @param string $command Name des Kommandos, das entfernt werden soll
     */
    public static function unregister($command)
    {
        if(isset(static::$commands[$command])){
            unset(static::$commands[$command]);
        }
    }

    /**
     * Gibt eine Liste mit allen registrierten Kommandos und deren Funktionen aus.
     */
    public static function help()
    {
        Console::writeln();
        foreach(static::$commands as $command => $class){
            Console::writeln("[$command]");
            foreach(get_class_methods($class) as $method){
                Console::writeln(" - $method");
            }
        }
        Console::writeln();
    }
}
