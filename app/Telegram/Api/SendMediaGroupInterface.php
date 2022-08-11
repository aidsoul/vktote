<?php

namespace Vktote\Telegram\Api;

interface SendMediaGroupInterface
{
    public function send(string $text, array $media): array;
}