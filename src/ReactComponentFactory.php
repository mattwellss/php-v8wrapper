<?php

namespace Mpw\V8;

class ReactComponentFactory
{
    /**
     * @var V8Wrapper
     */
    private $v8W;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param V8Wrapper $v8W
     * @param string    $prefix
     */
    public function __construct(V8Wrapper $v8W, string $prefix)
    {
        $this->v8W = $v8W;
        $this->prefix = $prefix;
    }

    /**
     * @param  string $name
     * @param  array  $data
     * @return mixed
     */
    public function renderComponent(string $name, array $data = [])
    {
        return $this->v8W->execJs(new ReactComponent(
            $name, $data, $this->prefix));
    }
}
