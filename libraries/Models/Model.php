<?php

namespace Models;

abstract class Model {

    protected $db;

    protected $table;

    public function __construct() {
        if (empty($this->table)) {
            throw new \Exception('Vous devez specifier une propriété <em>protected $table</em> dans votre class' .get_called_class() . 'qui hérite de model et qui contient le nom de la table à attaquer');
        }

        $this->db = \Database::getInstance();
    }


    public function find(int $id) {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id = :id");

        $query->execute([':id' => $id]);

        return $query->fetch(\PDO::FETCH_ASSOC);

    }


    

    public function findAll(): array {

        $query = $this->db->prepare("SELECT * FROM $this->table");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }




    
    // public function insert(array $data): int
    // {
    //     $sql = "INSERT INTO $this->table SET ";

    //     $columns = array_keys($data);
    //     $sqlColumns = [];

    //     foreach ($columns as $column) {
    //         $sqlColumns[] = "$column = :$column";
    //     }

    //     $sql .= implode(",", $sqlColumns);


    //     var_dump($sql);
    //     // die();

    //     $query = $this->db->prepare($sql);

    //     $query->execute($data);

    //     return $this->db->lastInsertId();
    // }

    public function insert(array $data): int
    {
        $sql = "INSERT INTO $this->table VALUES ";

        $columns = array_keys($data);
        $sqlColumns = [];

        foreach ($columns as $column) {
            $sqlColumns[] = "$column = :$column";
        }

        $sql .= "ON DUPLICATE KEY UPDATE";
        $sql .= implode(",", $sqlColumns);


        var_dump($sql);
        // die();

        $query = $this->db->prepare($sql);

        $query->execute($data);

        return $this->db->lastInsertId();
    }




}