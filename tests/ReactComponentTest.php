<?php

class ReactComponentTest extends PHPUnit_Framework_TestCase
{
    public function testGetSrc()
    {
        $data = ['x' => true];
        $component = new Mpw\V8\ReactComponent('test', $data);

        $dataJson = json_encode($data);
        $this->assertEquals(
            $component->getSrc(),
            <<<JS
ReactDOMServer.renderToStaticMarkup(
    React.createElement(
        Components.test, {$dataJson}));
JS
        );
    }

    public function testGetSrcWithPrefix()
    {
        $data = ['x' => true];
        $component = new Mpw\V8\ReactComponent('test', $data, 'test');
        $dataJson = json_encode($data);
        $this->assertEquals(
            $component->getSrc(),
            <<<JS
test.ReactDOMServer.renderToStaticMarkup(
    test.React.createElement(
        test.Components.test, {$dataJson}));
JS
        );
    }

    public function testGetSrcWithEmptyData()
    {
        $data = [];
        $component = new Mpw\V8\ReactComponent('test', $data, 'test');
        $dataJson = json_encode($data);
        $this->assertEquals(
            $component->getSrc(),
            <<<JS
test.ReactDOMServer.renderToStaticMarkup(
    test.React.createElement(
        test.Components.test, {$dataJson}));
JS
        );
    }
}
