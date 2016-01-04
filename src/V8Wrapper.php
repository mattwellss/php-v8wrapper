<?php
declare(strict_types=1);

namespace Mpw\V8;

use Mpw\V8\Exception\ExtensionRegistrationException;
use V8Js;

class V8Wrapper
{
    /**
     * @var V8Js
     */
    private $v8;

    /**
     * @param JsLib[] $libraries
     */
    public function __construct(JsLib ...$libraries)
    {

        $regExts = array_filter($libraries, function (JsLib $lib) {
            return V8Js::registerExtension(
                $lib->getName(),
                $lib->getSrc(),
                $lib->getDeps()
            );
        });

        if (count($regExts) !== count($libraries)) {
            throw new ExtensionRegistrationException('Extension registration failure!');
        }

        $this->v8 = new V8Js('PHP', [], array_keys(V8Js::getExtensions()));
    }

    /**
     * @param  JsCode $code
     * @return mixed
     */
    public function execJs(JsCode $code)
    {
        return $this->v8->executeString($code->getSrc());
    }
}
