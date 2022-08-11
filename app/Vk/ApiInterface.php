<?php

namespace Vktote\Vk;

interface ApiInterface
{
    public function __construct(string $token, string|int $idGroup, int $count);
    public static function get(): array;
}
