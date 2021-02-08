<?php

namespace Models;

class Commentary extends Model
{

    protected $table = T_COMMENTARIES;



    public function findAllAuthorizedCommentaries(): array
    {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE `Status` = 1");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    
}
