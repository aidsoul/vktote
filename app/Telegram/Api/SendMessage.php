<?php

namespace Vktote\Telegram\Api;

use Vktote\Config\Telegram as T;

class SendMessage implements SendMessageInterface
{
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
