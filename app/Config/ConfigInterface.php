<?php

namespace Vktote\Config;

/**
 * Config interface
 */
interface ConfigInterface
{
    public function __get(string $property);
}
