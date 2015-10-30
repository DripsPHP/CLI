<?php

namespace tests;

use Drips\CLI\Command;
use PHPUnit_Framework_TestCase;

require_once __DIR__.'/../src/console.php';
require_once __DIR__.'/../src/command.php';
require_once __DIR__.'/TestCommand.php';

class TestCommands extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider argsProvider
     */
    public function testCommands($args, $result)
    {
        Command::register("test", TestCommand::class);
        $this->assertEquals(Command::execute($args), $result);
    }

    public function testHelp()
    {
        Command::register("test1", TestCommand::class);
        Command::register("test2", TestCommand::class);
        Command::register("test3", TestCommand::class);
        Command::help();
    }

    public static function argsProvider()
    {
        return array(
            array(["your_file", "test", "help"], true),
            array(["your_file", "test"], false),
            array(["your_file", "doesNotExist", "help"], false),
            array(["my_file", "test", "command1"], true),
            array(["my_file", "test", "command1", "that_is_a_parameter"], true)
        );
    }
}
