<?php

namespace tests;

use Drips\CLI\Console;
use PHPUnit_Framework_TestCase;

require_once __DIR__.'/../vendor/autoload.php';

class TestConsole extends PHPUnit_Framework_TestCase
{
    public function testConsoleOutput()
    {
        $str = "Hello World";
        ob_start();
        Console::write($str);
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($str, $content);
    }

    public function testConsoleNlOutput()
    {
        $str = "Hello World";
        ob_start();
        Console::writeln($str);
        $content = ob_get_contents();
        ob_end_clean();
        $this->assertEquals($str."\n\r", $content);
    }

    public function testBgColor()
    {
        Console::setBgColor("red");
        Console::writeln("Rot");
        Console::reset();
    }

    public function testSuccessOutput()
    {
        Console::success("Success");
    }

    public function testErrorOutput()
    {
        Console::error("Error");
    }
}
