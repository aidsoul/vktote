<?php

namespace Vktote;

use Vktote\Config\Config;
use Vktote\Lang\Lang;
use Vktote\Telegram\Telegram;
use Vktote\Vk\Wall\Wall;

/**
 * Start parsing and sending data
 * Entry point in programm
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
        Lang::set();
        (new Telegram)->send(new Wall);
    }
}
