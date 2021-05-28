<?php

namespace Models;

class Commentary extends Model
{
    protected $table = T_COMMENTARIES;

    public function findAllByAuthor(): array
    {
        $query = $this->db->prepare("SELECT c.Id, u.Pseudo, c.Content, c.Created_at, c.Status
                                    FROM `commentary` AS c
                                    INNER JOIN users AS u ON u.Id = c.User_Id
                                    ORDER BY c.Id
                                    ");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    //renvoie le status d'un commentaire
    public function getStatus(int $id): int
    {
        $query = $this->db->prepare("SELECT Status FROM $this->table WHERE Id = :id");

        $query->execute([
            ':id' => $id,
        ]);

        $infosCommentary = $query->fetch(\PDO::FETCH_ASSOC);

        return intval($infosCommentary['Status']);
    }

    public function findAllAuthorizedCommentaries(): array
    {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE `Status` = 1");

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
