<?php

namespace Models;

class Score extends Model {
    //pour utiliser Model, on doit définir une propriété protected $table
    //qui contient le nom de la table principale
    public $table = T_SCORE;




    // public function initialisationScores(int $id) {

    //     $sql = "UPDATE $this->table SET ScoreByTopic = '0' WHERE Id_User =:id ;

    //     -- // var_dump($sql);

    //     $query = $this->db->prepare($sql);

    //     $query->execute([':id' => $id]);

    //     -- // return $query->fetchAll(\PDO::FETCH_ASSOC);
    //     return true;

    // }


    // public function initialisationScores(int $id) {

    //     $sql = "INSERT INTO $this->table SET ScoreByTopic = '0' WHERE Id_User =: id";

    //     var_dump($sql);

    //     $query = $this->db->prepare($sql);

    //     $query->execute(['id' => $id]);

    //     return true;
        
    // }






    

    public function findScoreByTopic(int $id)
    {

        $query = $this->db->prepare("SELECT Id_User, ScoreByTopic FROM $this->table WHERE Id_Topic = :id");

        $query->execute([':id' => $id]);

        // var_dump($query->fetch(\PDO::FETCH_ASSOC));

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }




    public function findScoreByUser(int $id)
    {

        // requete qui marche -> SELECT * FROM `score` WHERE `Id_User` = 3
        // et ca donne un tableau

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id");

        $query->execute([':id' => $id]);

        // var_dump($query->fetch(\PDO::FETCH_ASSOC));

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }




    // //Ajout d'un score en fonction d'un topic et d'un user
    // public function addScore($Id_Topic, $Id_User, $ScoreByTopic): bool
    // {

    //     //trouver avec phpmyadmin la bonne requete à mettre en place
    //     //de type insert

    //     //préparer les différents champs de la table user
    //     /* 
    //     construire un tableau qui va contenir en clé les noms des champs 
    //     et en valeur, la valeur a insérer
    //     */
    //     $insertUser = [];

    //     $insertUser['Pseudo'] = $u['pseudo'];
    //     $insertUser['Password'] = $this->cryptPassword($u['password']); //crypter le mot de passe
    //     $insertUser['Email'] = $u['email'];
    //     // Choper que le numéro de l'avatar la ! je crois c'est bon
    //     $insertUser['Avatar_Id'] = intval($u['avatar']);


    //     //utiliser la méthode insert du model
    //     if ($this->insert($insertUser) > 0) {
    //         //l'insertion a fonctionné
    //         return true;
    //     } else {
    //         //on a eu une erreur
    //         return false;
    //     }
    // }


    public function updateScoreByTopic($data): int
    {


        // $scoreByUserAndByTopic = $scoreByUserAndByTopic + [
        //     'Id_Topic' => $_GET['topic'],
        //     'Id_User' => $_GET['id'],
        //     'ScoreByTopic' => $scoreOfTheTopic
        // ];

        // var_dump($data);
        // var_dump($data['Id_Topic']);
        // var_dump($data['Id_User']);
        // var_dump($data['ScoreByTopic']);

        $sql = "UPDATE $this->table SET ScoreByTopic = :score WHERE Id_User =:id AND Id_Topic = :topic";

        // var_dump($sql);

        $query = $this->db->prepare($sql);

        $query->execute([':score' => $data['ScoreByTopic'], ':id' => $data['Id_User'], ':topic' => $data['Id_Topic']]);

        // return $query->fetchAll(\PDO::FETCH_ASSOC);
        return true;
    }





    public function findScores(int $id, int $topic)
    {

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id AND Id_Topic = :topic");

        $query->execute([':id' => $id, ':topic' => $topic]);

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }





    
}

?>