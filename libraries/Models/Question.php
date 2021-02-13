<?php

namespace Models;

class Question extends Model {

    protected $table = T_QUESTIONS;

    public function findQuestionById(int $id) {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id = :id");
        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    public function findAllQuestionsByTopic(int $id) {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Topic_Id = :id");
        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }


    // Give all the questions and the topic fullname associated ( for BackOffice mostly )
    public function findAllQuestionsWithTopicName() {

        $query = $this->db->prepare("SELECT *, q.Id
                                    FROM questions AS q
                                    INNER JOIN topics AS t ON q.Topic_Id = t.Id
                                    ORDER BY t.Name, q.IndexQuestion");
        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    // Give the question with the indexQuestion of the topic ( for BackOffice mostly )
    public function findQuestionsWithTopicIdAndIndexQuestion(int $topic_id, int $indexQuestion) {

        $query = $this->db->prepare("SELECT * 
                                    FROM questions
                                    WHERE Topic_Id = :topic AND IndexQuestion = :indexQuestion");
        $query->execute([':topic' => $topic_id, ':indexQuestion' => $indexQuestion]);

        return $query->fetch(\PDO::FETCH_ASSOC);
        
    }

    // public function findScores(int $id, int $topic)
    // {

    //     $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id AND Id_Topic = :topic");

    //     $query->execute([':id' => $id, ':topic' => $topic]);

    //     return $query->fetchAll(\PDO::FETCH_ASSOC);
    // }

}