<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

class User extends Config implements ConfigInterface
{
    /**
     * @var string
     */
    protected string $password;
}
