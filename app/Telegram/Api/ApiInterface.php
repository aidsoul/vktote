<?php

namespace Vktote\Telegram\Api;

/**
 * Telegram Api interface
 * 
 * @license MIT
 * @author aidsoul <work-aidsoul@outlook.com>
 */
interface ApiInterface
{
    public function __construct();

    /**
     * @param string $text
     * @param array $media
     * 
     * @return void
     */
    public function sendMediaGroup(
        string $text,
        array $media,
        SendMediaGroupInterface $mediaGroup
        ): void;

    /**
     * @param string $text
     * 
     * @return void
     */
    public function sendMessage(
        string $text,
        SendMessageInterface $message
        ): void;
}