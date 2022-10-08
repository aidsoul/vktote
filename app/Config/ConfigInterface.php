<?php

namespace Vktote\Config;

/**
 * Config interface
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface ConfigInterface
{
    /**
     * @param string $property
     * @return void
     */
    public function __get(string $property);
}
