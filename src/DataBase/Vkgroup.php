<?php 

namespace Vktote\DataBase;


class Vkgroup extends Db{

    use Help;

    private string $idGroup = 'id_group';
    private string $name = 'name';

    public function create(string $nameGroup){
        $query = "INSERT INTO {$this->tableName} ({$this->name}) VALUES (?)";
        $stmt = Db::query()->prepare($query);
        $stmt->execute([$nameGroup]);
    }
    

    public function check(string $nameGroup){

        $query = "SELECT {$this->idGroup} FROM {$this->tableName} WHERE {$this->name} = ? LIMIT 1";
        $query = Db::query()->prepare($query);
        $query->execute([$nameGroup]);
        $ask = $query->fetch();
        return  $ask ? $ask[$this->idGroup]: false;
    }

}