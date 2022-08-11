<?php

namespace Vktote\DataBase\Models;

interface PostInterface extends ModelInterface
{
    public function check(int $postId, int $groupId): int|bool;
    public function create(int $postId, int $groupId): void;
}
