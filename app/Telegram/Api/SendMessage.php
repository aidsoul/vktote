<?php

namespace Vktote\Telegram\Api;

use Vktote\Config\Telegram as T;

/**
 * Send message
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class SendMessage implements SendMessageInterface
{
    /**
     * @param string $text
     * 
     * @return array
     */
    public function send(string $text): array
    {
        return [
            "chat_id" => T::get()->chatId,
            "text" => $text,
            "parse_mode" => "html",
            "disable_web_page_preview" => true
        ];
    }
}
