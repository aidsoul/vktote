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
    public static function start(string $сonfigPath):void
    {
        Config::set($сonfigPath);
        (new Wall)->collectAndPush();
    }
}
