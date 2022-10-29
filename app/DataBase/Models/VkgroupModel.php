<?php

namespace Vktote\DataBase\Models;

use Vktote\DataBase\Database;

/**
 * Vkgroup class
 * 
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
class VkgroupModel extends Database
{
    /**
     * @param string $tableName
     * @param string $idGroup
     * @param string $name
     */
    public function __construct(
        private readonly string $tableName = 'vkgroup',
        private readonly string $idGroup = 'id_group',
        private readonly string $name = 'name'

    ) {
        parent::__construct();
    }

    /**
     * @param string $nameGroup
     * 
     * @return void
     */
    public function create(string $nameGroup): void
    {
        self::$pdo
            ->insert([$this->name])
            ->into($this->tableName)
            ->values([$nameGroup])
            ->execute();
    }

    /**
     * @param string $nameGroup
     * 
     * @return integer|boolean
     */
    public function check(string $nameGroup): int|bool
    {
        $ask = self::$pdo
            ->select([$this->idGroup])
            ->from($this->tableName)
            ->where($this->name, '=', $nameGroup)
            ->limit(1)
            ->execute()
            ->fetch();

        return  $ask ? $ask[$this->idGroup] : false;
    }

    /**
     * @param integer|string $idGroup
     * 
     * @return void
     */
    public function remove(int|string $idGroup): void
    {
        self::$pdo
            ->delete()
            ->from($this->tableName)
            ->where($this->idGroup, '=', $idGroup)
            ->execute();
    }
}
