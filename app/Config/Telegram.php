<?php

namespace Vktote\Config;

use Vktote\Config\ConfigInterface;

/**
 * Getting telegram configuration
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Telegram extends Config implements ConfigInterface
{
    use ActionConfig;

    /**
     * @var string
     */
    private string $botApiKey;

    /**
     * @var string
     */
    private string $botName;

    /**
     * @var integer
     */
    private int $chatId;

    /**
     * @var boolean
     */
    private bool $webHook;

    /**
     * @var string
     */
    private string $hookUrl;
}
