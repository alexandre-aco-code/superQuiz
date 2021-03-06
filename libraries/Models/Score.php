<?php

namespace Models;

class Score extends Model
{
    //pour utiliser Model, on définit une propriété protected $table qui contient le nom de la table principale
    public $table = T_SCORE;

    public function findScoreByTopic(int $id)
    {

        $query = $this->db->prepare("SELECT Id_User, ScoreByTopic FROM $this->table WHERE Id_Topic = :id");

        $query->execute([':id' => $id]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findScoreByUser(int $id)
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id");

        $query->execute([':id' => $id]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateScoreByTopic($data)
    {

        $sql = "UPDATE $this->table SET ScoreByTopic = :score WHERE Id_User =:id AND Id_Topic = :topic";

        $query = $this->db->prepare($sql);

        $query->execute([':score' => $data['ScoreByTopic'], ':id' => $data['Id_User'], ':topic' => $data['Id_Topic']]);

        return true;
    }

    public function getScoreByUserAndByTopic(int $id, int $topic)
    {

        $query = $this->db->prepare("SELECT ScoreByTopic FROM $this->table WHERE Id_User = :id AND Id_Topic = :topic");

        $query->execute([':id' => $id, ':topic' => $topic]);

        $score = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$score) {
            return null;
        } else {
            return intval($score["ScoreByTopic"]);
        }
    }

    public function findScores(int $id, int $topic)
    {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id AND Id_Topic = :topic");

        $query->execute([':id' => $id, ':topic' => $topic]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
