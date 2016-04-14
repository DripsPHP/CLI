<?php

/**
 * Created by Prowect
 * Author: Raffael Kessler
 * Date: 30.10.2015 - 16:30
 * Copyright: Prowect
 */

namespace Drips\CLI;

/**
 * Class Console
 *
 * Dient als Schnittstelle zwischen PHP und der Konsole.
 * Kann zum Einlesen und Ausgeben auf die Konsole verwendet werden.
 */
abstract class Console
{
    /**
     * Beinhaltet die Farbcodes der Schriftfarben
     *
     * @var array
     */
    private static $fgColors = array(
       'black' => '0;30',
       'dark_gray' => '1;30',
       'blue' => '0;34',
       'light_blue' => '1;34',
       'green' => '0;32',
       'light_green' => '1;32',
       'cyan' => '0;36',
       'light_cyan' => '1;36',
       'red' => '0;31',
       'light_red' => '1;31',
       'purple' => '0;35',
       'light_purple' => '1;35',
       'brown' => '0;33',
       'yellow' => '1;33',
       'light_gray' => '0;37',
       'white' => '1;37',
       'black_u' => '4;30',
       'red_u' => '4;31',
       'green_u' => '4;32',
       'yellow_u' => '4;33',
       'blue_u' => '4;34',
       'purple_u' => '4;35',
       'cyan_u' => '4;36',
       'white_u' => '4;37',
   );

   /**
    * Beinhaltet die Farbcodes der Hintergrundfarben
    *
    * @var array
    */
   private static $bgColors = array(
       'black' => '40',
       'red' => '41',
       'green' => '42',
       'yellow' => '43',
       'blue' => '44',
       'magenta' => '45',
       'cyan' => '46',
       'light_gray' => '47',
   );

   /**
    * Setzt die aktuelle Farbe (auf die Standardfarbe) zurück
    */
   public static function reset()
   {
       echo "\033[0m";
   }

   /**
    * Setzt die Schriftfarbe auf die übergebene Farbe. Gültige Farben befinden
    * sich in der $fgColors
    *
    * @param string $color Die Schriftfarbe die verwendet werden soll
    */
   public static function setColor($color)
   {
       if (isset(self::$fgColors[$color])) {
           echo "\033[".self::$fgColors[$color].'m';
       }
   }

   /**
    * Setzt die Hintergrundfarbe die verwendet werden soll. Gültige Farben befinden
    * sich in der $bgColors
    *
    * @param string $color Die Hintergrundfarbe die verwendet werden soll
    */
   public static function setBgColor($color)
   {
       if (isset(self::$bgColors[$color])) {
           echo "\033[".self::$bgColors[$color].'m';
       }
   }

   /**
    * Gibt einen übergebenen String mit einem echo auf der Konsole aus.
    *
    * @param string $str Der String der ausgegeben werden soll
    * @param bool $newLine Erzeugt einen Zeilenumbruch wenn TRUE
    */
   public static function write($str = "", $newLine = false)
   {
       echo $str;
       echo $newLine ? PHP_EOL : '';
   }

   /**
    * Gibt einen übergebenen String mit einem echo auf der Konsole aus.
    * Ruft prinzipiell die write-Methode auf und erzeugt zusätzlich einen
    * Zeilenumbruch.
    *
    * @param  [type] $str [description]
    */
   public static function writeln($str = "")
   {
       self::write($str, true);
   }

   /**
    * Liest von der Konsole
    *
    * @return string
    */
   public static function read()
   {
       $stream = fopen('php://stdin', 'r');

       return fgets($stream);
   }

   /**
    * Gibt einen Fehler auf der Konsole aus. Hierbei wird lediglich ein writeln
    * durchgeführt, vordem die Schriftfarbe rot gesetzt wird. Anschließend wird
    * die Farbe wieder zurückgesetzt!
    *
    * @param string $str Die Fehlermeldung die ausgegeben werden soll
    */
   public static function error($str)
   {
       self::setColor('red');
       self::writeln($str);
       self::reset();
   }

   /**
    * Gibt eine Erfolgsmeldung auf der Konsole aus. Hierbei wird lediglich ein
    * writeln durchgeführt, vordem die Schriftfarbe grün gesetzt wird.
    * Anschließend wird die Farbe wieder zurückgesetzt.
    *
    * @param string $str Die Erfolgsmeldung die ausgegeben werden soll
    */
   public static function success($str)
   {
       self::setColor('green');
       self::writeln($str);
       self::reset();
   }
}
