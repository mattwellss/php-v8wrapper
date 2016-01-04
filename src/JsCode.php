<?php

namespace Mpw\V8;

/**
 * Interface for executable JavaScript code
 */
interface JsCode
{
    /**
     * Get executable source code
     * @return string
     */
    public function getSrc() : string;
}
