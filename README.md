# CLI

[![Build Status](https://travis-ci.org/Prowect/CLI.svg)](https://travis-ci.org/Prowect/CLI)
[![Code Climate](https://codeclimate.com/github/Prowect/CLI/badges/gpa.svg)](https://codeclimate.com/github/Prowect/CLI)
[![Test Coverage](https://codeclimate.com/github/Prowect/CLI/badges/coverage.svg)](https://codeclimate.com/github/Prowect/CLI/coverage)
[![Latest Release](https://img.shields.io/packagist/v/drips/cli.svg)](https://packagist.org/packages/drips/cli)

## Beschreibung

Dieses Library beinhaltet Klassen zur Interaktion mit der Konsole über PHP.

## Installation

1. Zuerst müssen alle Klassen des src-Verzeichnisses included werden. Dann sollten die Klassen unter der Verwendung des richtigen Namespaces verfügbar sein.

## Verwendung

### Console

#### Ausgabe auf der Konsole

Die Ausgabe auf der Konsole kann auf verschiedene Arten erfolgen. Die einfachste Möglichkeit ist einfach die Methode `writeln` zu verwenden.
Hierbei wird automatisch ein Zeilenumbruch an das Ende der Zeile angehängt.

```php
<?php
Console::writeln("Hello World");
```

Möchte man auf den Zeilenumbruch verzichten, so muss man die Methode `write` verwenden.

```php
<?php
Console::write("Hello World");
```

Außerdem können Fehler- und Erfolgsmeldungen generiert werden, welche farblich entsprechend hervorgehoben werden.

```php
<?php
Console::error("This is an error message");
Console::success("This is an success message");
```

#### Farben ändern

Die Schrift- und Hintergrundfarbe kann jederzeit geändert werden. Hierfür gibt es die Methoden `setColor` zum Ändern der Schriftfarbe und `setBgColor` zum Setzen der Hintergrundfarbe.

Mit der Methode `reset` werden die Farben zurückgesetzt.

```php
<?php
Console::setColor("blue");
Console::writeln("Blau");
Console::reset();
```

Folgende Farben stehen zur Verfügung:

**Schriftfarben:**

 - `black`
 - `dark_gray`
 - `blue`
 - `light_blue`
 - `green`
 - `light_green`
 - `cyan`
 - `light_cyan`
 - `red`
 - `light_red`
 - `purple`
 - `light_purple`
 - `brown`
 - `yellow`
 - `light_gray`
 - `white`
 - `black_u`
 - `red_u`
 - `green_u`
 - `yellow_u`
 - `blue_u`
 - `purple_u`
 - `cyan_u`
 - `white_u`

 **Hintergrundfarben**

 - `black`
 - `red`
 - `green`
 - `yellow`
 - `blue`
 - `magenta`
 - `cyan`
 - `light_gray`

### Kommandos

Außerdem gibt es die Möglichkeit benutzerdefinierte Kommandos für die Konsole zu erstellen.
Hierfür definiert man eine Klasse die das `ICommand`-Interface implementiert.

Anschließend kann das Kommando registriert werden.

```php
<?php
Command::register("mycmd", MyCommand::class);
```

Anschließend kann das Tool gestartet werden und versucht die übergebenen `$argv` auszuwerten.

```php
<?php
Command::execute($argv);
```

> `$argv` beinhaltet an erster Stelle den Namen der Datei, dieser wird sozusagen ignoriert. Das 2. Element wird als Kommando-Name aufgefasst unter welchem das Kommando registriert wurde. Das 3. Element stellt die Methode da, die von der Kommando-Klasse aufgerufen werden soll, während die restlichen Argumente als Parameter an die entsprechende Methode übergeben werden.

#### Beispiel

```php
<?php

abstract class MyCommand implements ICommand
{
    public static function exec($param = "")
    {
        Console::writeln("Führe exec mit $param aus.");
    }

    public static function help()
    {
        Console::writeln("Dies ist die Hilfe von MyCommand");
    }
}

Command::register("mycommand", MyCommand::class);
Command::execute($argv);
```

> In diesem Fall wird beim Aufruf des Scripts über die Konsole die `exec`-Methode der `MyCommand`-Klasse aufgerufen wenn das Script wie folgt aufgerufen wird. `php name_des_scripts.php mycommand exec 123` (123 wird als `$param` eingesetzt)
