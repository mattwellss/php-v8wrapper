<?php

class JsLibTest extends PHPUnit_Framework_TestCase
{
    public function testGetSrc()
    {
        $lib = new Mpw\V8\JsLib('test', 'true;');
        $this->assertEquals(
            $lib->getSrc(), 'true;');
    }

    public function testGetName()
    {
        $lib = new Mpw\V8\JsLib('test', 'true;');
        $this->assertEquals(
            $lib->getName(), 'test');
    }

    public function testDep()
    {
        $lib = new Mpw\V8\JsLib('test', 'true;');
        $lib->addDep(new Mpw\V8\JsLib('test2', 'false;'));

        $this->assertEquals(
            $lib->getDeps(), ['test2']);
    }
}
