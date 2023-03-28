<?php

namespace Vktote\Config;

/**
 * Telegram class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Telegram extends Config
{
    /**
     * Bot access key
     *
     * @var string
     */
    protected string $botApiKey;

    /**
     * Bot name
     *
     * @var string
     */
    protected string $botName;

    /**
     * Chat ID
     *
     * @var integer
     */
    protected int $chatId;
}
