<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

class User extends Config implements ConfigInterface
{
    use ActionConfig;
    private string $password;
}
