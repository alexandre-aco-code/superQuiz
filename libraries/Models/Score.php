<?php

namespace Models;

class Score extends Model {
    //pour utiliser Model, on doit définir une propriété protected $table
    //qui contient le nom de la table principale
    protected $table = T_SCORE;

    public function findScoreByTopic(int $id)
    {

        $query = $this->db->prepare("SELECT Id_User, ScoreByTopic FROM $this->table WHERE Id_Topic = :id");

        $query->execute([':id' => $id]);

        // var_dump($query->fetch(\PDO::FETCH_ASSOC));

        return $query->fetch(\PDO::FETCH_ASSOC);
    }




    public function findScoreByUser(int $id)
    {

        // requete qui marche -> SELECT * FROM `score` WHERE `Id_User` = 3
        // et ca donne un tableau

        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id_User = :id");

        $query->execute([':id' => $id]);

        // var_dump($query->fetch(\PDO::FETCH_ASSOC));

        return $query->fetch(\PDO::FETCH_ASSOC);
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


    
}

?>