<?php

namespace Vktote\Telegram\Api;

interface SendMessageInterface
{
    public function send(string $text): array;
}