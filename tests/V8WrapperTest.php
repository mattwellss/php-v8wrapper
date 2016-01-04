<?php

class V8WrapperTest extends PHPUnit_Framework_TestCase
{
    public function jsCodeFactory(string $code) : Mpw\V8\JsCode
    {
        return new class($code) implements Mpw\V8\JsCode {
            public function __construct($code)
            {
                $this->code = $code;
            }

            public function getSrc() : string
            {
                return $this->code;
            }
        };
    }

    public function testExecJs()
    {
        $v8Wrapper = new Mpw\V8\V8Wrapper;
        $jsCode = $this->jsCodeFactory('true');

        $this->assertTrue(
            $v8Wrapper->execJs($jsCode));
    }

    public function testLibrary()
    {
        $library = new Mpw\V8\JsLib(
            'test', 'var x = true;');
        $code = $this->jsCodeFactory('x;');

        $v8Wrapper = new Mpw\V8\V8Wrapper($library);

        // Assert that x == true (value set by library)
        $this->assertTrue(
            $v8Wrapper->execJs($code));
    }

    public function testLibraryWithDeps()
    {
        $lib1 = new Mpw\V8\JsLib('one', 'var a = b;');
        $lib2 = new Mpw\V8\JsLib('two', 'var b = true');
        $lib3 = new Mpw\V8\JsLib('three', 'var c = false');

        $lib1->addDep($lib2);
        $v8Wrapper = new Mpw\V8\V8Wrapper($lib1, $lib2, $lib3);

        $this->assertTrue(
            $v8Wrapper->execJs(
                $this->jsCodeFactory('a == b == true;')));
    }



}
