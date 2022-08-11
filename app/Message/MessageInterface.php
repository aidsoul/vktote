<?php

namespace Vktote\Message;

interface MessageInterface
{
    public function __construct();
    public function show(
        bool $type,
        string $className,
        string $messageName,
        string $messageAdd = ''
    ): void;

    public static function find(): Message;
}