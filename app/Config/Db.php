<?php

namespace Vktote\Config;

/**
 * Db class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Db extends Config
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
