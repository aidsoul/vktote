<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

/**
 * Getting database configuration
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Db extends Config implements ConfigInterface
{
    use ActionConfig;

    /**
     * @var string
     */
    private string $host;

    /**
     * @var string
     */
    private string $dbName;

    /**
     * @var string
     */
    private string $user;

    /**
     * @var string
     */
    private string $pass;
}
