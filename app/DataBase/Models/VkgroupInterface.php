<?php

namespace Vktote\DataBase\Models;

interface VkgroupInterface extends ModelInterface
{
    public function create(string $nameGroup): void;
    public function check(string $nameGroup): int|bool;
    public function remove(int|string $idGroup): void;
}
