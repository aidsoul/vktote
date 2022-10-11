<?php

namespace Vktote\Telegram\Api;

/**
 * Send message
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface SendMessageInterface
{
    /**
     * @param string $text
     * 
     * @return array
     */
    public function send(string $text): array;
}