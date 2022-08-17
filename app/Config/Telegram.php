<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

/**
 * Telegram class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Telegram extends Config implements ConfigInterface
{
    /**
     * @var string
     */
    protected string $botApiKey;

    /**
     * @var string
     */
    protected string $botName;

    /**
     * @var integer
     */
    protected int $chatId;

    /**
     * @var boolean
     */
    protected bool $webHook;

    /**
     * @var string
     */
    protected string $hookUrl;
}
