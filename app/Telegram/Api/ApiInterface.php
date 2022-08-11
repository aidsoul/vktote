<?php

namespace Vktote\Telegram\Api;

interface ApiInterface
{
    public function __construct();
    public function sendMediaGroup(string $text, array $media): void;
    public function sendMessage(string $text): void;
}