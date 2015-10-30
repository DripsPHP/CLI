<?php

namespace tests;

use Drips\CLI\ICommand;

require_once __DIR__.'/../src/console.php';
require_once __DIR__.'/../src/command.php';
require_once __DIR__.'/../src/icommand.php';

abstract class TestCommand implements ICommand
{
    public static function command1($param = "")
    {
        echo "TestCommand: $param";
    }

    public static function help()
    {
        echo "TestCommand: HELP";
    }
}
