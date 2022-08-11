<?php

namespace Vktote\Telegram\Api;

use Vktote\Config\Telegram as T;

class SendMediaGroup implements SendMediaGroupInterface
{
    public function send(string $text, array $media): array
    {
        $media[0]["caption"] = $text;
        
        return [
            "chat_id" => T::get()->chatId,
            "media" => json_encode($media)
        ];
    }
}


