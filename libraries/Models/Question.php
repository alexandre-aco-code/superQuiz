<?php

namespace Models;

class Question extends Model {

    protected $table = T_QUESTIONS;

    public function findAllQuestionsByTopic(int $id) {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Topic_Id = :id");
        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    public function findAllQuestionsWithTopicName() {

        $query = $this->db->prepare("SELECT *
                                    FROM questions AS q
                                    INNER JOIN topics AS t ON q.Topic_Id = t.Id");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }

}