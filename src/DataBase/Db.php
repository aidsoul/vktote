<?php

namespace Vktote\DataBase;

use PDO;
use Vktote\Config\Db as Conf;

/**
 * Db class
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class Db
{

    /**
     * Query function
     *
     * @return \PDO
     */
    public static function query():PDO
    {
        $host = Conf::get()->host;
        $dbName = Conf::get()->dbName;
        try {
            return new PDO("{$host};dbname={$dbName}", Conf::get()->user, Conf::get()->pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }
}
