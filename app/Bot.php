<?php

namespace Vktote;

use Vktote\Lang\Lang;
use Vktote\Vk\Wall\Wall;
use Vktote\Config\Config;
use Vktote\Telegram\Telegram;

/**
 * Start parsing and sending data
 * Entry point in program
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
    public static function start(string $configPath = ''): void
    {
        Config::set($configPath);
        Lang::set();
        (new Telegram)->send(new Wall);
    }
}
