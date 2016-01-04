<?php
namespace Mpw\V8;

/**
 * A JS Lib will generally be used as an extension with V8.
 * $name needn't be used in code, but dependent libs will use it
 */
class JsLib implements JsCode
{
    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $deps = [];

    /**
     * @param string $name
     * @param string $src
     */
    public function __construct(string $name, string $src = ';')
    {
        $this->name = $name;
        $this->src = $src;
    }

    /**
     * {@inheritDoc}
     */
    public function getSrc() : string
    {
        return $this->src;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Add another lib as a dependency
     * @param JsLib $bundle
     */
    public function addDep(JsLib $bundle)
    {
        $this->deps[] = $bundle->getName();
    }

    /**
     * @return string[]
     */
    public function getDeps(): array
    {
        return $this->deps;
    }
}
