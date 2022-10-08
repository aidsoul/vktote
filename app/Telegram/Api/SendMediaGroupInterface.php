<?php

namespace Vktote\Telegram\Api;

/**
 * Send media group interface
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface SendMediaGroupInterface
{
    /**
     * @param string $text
     * @param array $media
     * 
     * @return array
     */
    public function send(string $text, array $media): array;
}