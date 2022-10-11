<?php

namespace Vktote\Telegram\Api;

use Vktote\Config\Telegram as T;

/**
 * Send media group
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
class SendMediaGroup implements SendMediaGroupInterface
{
    /**
     * @param string $text
     * @param array $media
     * 
     * @return array
     */
    public function send(string $text, array $media): array
    {
        $media[0]['caption'] = $text;
        
        return [
            'chat_id' => T::get()->chatId,
            'media' => json_encode($media),
            'disable_web_page_preview' => true
        ];
    }
}


