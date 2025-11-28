<?php

namespace Vktote\DataBase;

use Aidsoul\Pdo\Db;
use Vktote\Config\Db as Conf;

/**
 * Db function
 *
 * @author aidsoul <work-aidsoul@outlook.com>
 * @license MIT
 */
abstract class DataBase
{

    protected static Db $pdo;

    public function __construct()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        if (DB_COMMON === false) {
            $host = Conf::get()->host;
            $dbName = Conf::get()->dbName;
            $user = Conf::get()->user;
            $pass = Conf::get()->pass;
        }
        try {
            self::$pdo = new Db("mysql:host={$host};dbname={$dbName}", $user, $pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }

    /**
     * @return \Aidsoul\Pdo\Db
     */
    private function pdo(): Db
    {
        return self::$pdo;
    }
}
