<?php

namespace Vktote;

use Vktote\Config\Config;
use Vktote\Telegram\Telegram;
use Vktote\Wall\Wall;

/**
 * Start parsing and sending data
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
    public static function start(string $сonfigPath): void
    {
        Config::set($сonfigPath);
        (new Telegram)->send(new Wall);
    }
}
