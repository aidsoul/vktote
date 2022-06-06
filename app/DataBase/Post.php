<?php

namespace Vktote\DataBase;

/**
 * Post class
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class Post extends Db
{

    use Help;

    /**
     * @var string
     */
    private string $idPost = 'id_post';

    /**
     * @var string
     */
    private string $groupId = 'group_id';

    /**
     * Create function
     *
     * @param integer $postId
     * @param integer $groupId
     * @return void
     */
    public function create(int $postId, int $groupId):void
    {
        $query = "INSERT INTO {$this->tableName} VALUES (?,?)";
        $stmt = $this->query()->prepare($query);
        $stmt->execute([$postId,$groupId]);
    }

    /**
     * Check function
     *
     * @param integer $postId
     * @param integer $groupId
     * @return integer
     */
    public function check(int $postId, int $groupId): int
    {
        $query = "SELECT {$this->idPost} FROM {$this->tableName} WHERE {$this->idPost} = ? AND {$this->groupId} = ? LIMIT 1";
        $query = $this->query()->prepare($query);
        $query->execute([$postId,$groupId]);
        $ask = $query->fetch();
        return  $ask ? $ask[$this->idPost]: false;
    }

}
