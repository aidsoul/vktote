<?php 
namespace Vktote\Config;

interface ConfigInterface {
    public function __get(string $property);
}