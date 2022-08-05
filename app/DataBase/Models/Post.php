<?php

namespace Vktote\DataBase\Models;

use Vktote\DataBase\Database;

/**
 * Post class
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Post extends Database
{

    /**
     * @param string $tableName
     * @param string $idPost
     * @param string $groupId
     */
    public function __construct(
        private readonly string $tableName = 'post',
        private readonly string $idPost = 'id_post',
        private readonly string $groupId = 'group_id'

    ) {
        parent::__construct();
    }

    /**
     * Create function
     *
     * @param integer $postId
     * @param integer $groupId
     * @return void
     */
    public function create(int $postId, int $groupId): void
    {
        self::$pdo
            ->insert([$this->idPost, $this->groupId])
            ->into($this->tableName)
            ->values([$postId, $groupId])
            ->execute();
    }

    /**
     * Check function
     *
     * @param integer $postId
     * @param integer $groupId
     * @return integer
     */
    public function check(int $postId, int $groupId): int|bool
    {
        $ask = self::$pdo
            ->select([$this->idPost])
            ->from($this->tableName)
            ->where($this->idPost, '=', $postId)
            ->and($this->groupId, '=', $groupId)
            ->limit(1)
            ->execute()
            ->fetch();

        return  $ask ? $ask[$this->idPost] : false;
    }
}