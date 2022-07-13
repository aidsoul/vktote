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
class Db
{
    /**
     * Query function
     *
     * @return \PDO
     */
    protected function query(): PDO
    {
        if(!DB_COMMON){
            $host   = Conf::get()->host;
            $dbName = Conf::get()->dbName;
            $user   = Conf::get()->user;
            $pass   = Conf::get()->pass;
        }else{
            $host   = DB_HOST;
            $dbName = DB_NAME;
            $user   = DB_USER;
            $pass   = DB_PASS;
        }
        try {
            return new PDO("mysql:host={$host};dbname={$dbName}", $user, $pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }
}
