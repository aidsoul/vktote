<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

/**
 * Getting user configuration
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */

class User extends Config implements ConfigInterface
{
    use ActionConfig;
    private string $password;
}
