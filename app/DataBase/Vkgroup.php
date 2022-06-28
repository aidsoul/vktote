<?php 

namespace Vktote\DataBase;

/**
 * Vkgroup class
 * 
 */
class Vkgroup extends Db
{

    use Help;

    private string $idGroup = 'id_group';
    private string $name = 'name';
    private string $password = 'password';

    public function create(string $nameGroup)
    {
        $query = "INSERT INTO {$this->tableName} ({$this->name}) VALUES (?)";
        $stmt = $this->query()->prepare($query);
        $stmt->execute([$nameGroup]);
    }
    
    public function check(string $nameGroup)
    {
        $query = "SELECT {$this->idGroup} FROM {$this->tableName} WHERE {$this->name} = ? LIMIT 1";
        $query = $this->query()->prepare($query);
        $query->execute([$nameGroup]);
        $ask = $query->fetch();
        return  $ask ? $ask[$this->idGroup]: false;
    }

    public function delete(string $idGroup)
    {
        $query = "DELETE FROM {$this->tableName} WHERE {$this->idGroup} = ?";
        $query = $this->query()->prepare($query);
        $query->execute([$idGroup]);
    }
}