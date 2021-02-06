<?php

namespace Models;

class Commentary extends Model
{

    protected $table = T_COMMENTARIES;

    // public function findAllQuestionsByTopic(int $id)
    // {

    //     $query = $this->db->prepare("SELECT * FROM $this->table WHERE Topic_Id = :id");
    //     $query->execute([
    //         ':id' => $id,
    //     ]);

    //     return $query->fetchAll(\PDO::FETCH_ASSOC);
    // }

    
}
