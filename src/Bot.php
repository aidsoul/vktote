<?php

namespace Vktote;

use Vktote\Config\Config;
use Vktote\Wall\Wall;

/**
 * Parsing
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
final class Bot
{
    /**
     * Start function
     *
     * @return void
     */
    public static function start(array $config):void
    {
        Config::set($config);
        (new Wall)->collectAndPush();
    }
}
