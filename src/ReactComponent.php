<?php
declare(strict_types=1);

namespace Mpw\V8;

/**
 * Representation of a react component
 * Used for server-side rendering of react components
 */
class ReactComponent implements JsCode
{
    /**
     * Component name
     * @var string
     */
    private $name;

    /**
     * Data hash for component
     * @var array
     */
    private $data;

    /**
     * Prefix for library access
     * @var string
     */
    private $prefix;

    /**
     * Initialize a new React component
     * @param string $name      Component name
     * @param array  $data      Data hash for component
     * @param string $prefix    Prefix used in JS to access libraries
     */
    public function __construct(string $name, array $data = [], string $prefix = '')
    {
        $this->name = $name;
        $this->data = $data;
        $this->prefix = $prefix?
            $prefix . '.':
            '';
    }

    /**
     * @inheritdoc
     */
    public function getSrc() : string
    {
        $dataJson = json_encode($this->data);
        return <<<JS
{$this->prefix}ReactDOMServer.renderToStaticMarkup(
    {$this->prefix}React.createElement(
        {$this->prefix}Components.{$this->name}, {$dataJson}));
JS;
    }
}
