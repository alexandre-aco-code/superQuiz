<?php

namespace Models;

class User extends Model
{
    //pour utiliser Model, on doit définir une propriété protected $table
    //qui contient le nom de la table principale
    protected $table = T_USERS;
    
    //récupération specifique de champ de la table Users
    /*
    Id, Admin, FirstName et LastName
    */
    public function findAll_Id_Admin_Fn_Ln(): array
    {
        $query = $this->db->prepare("SELECT Id, LastName, FirstName, Admin FROM $this->table");
        
        $query->execute();
        

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    //renvoie le rôle d'un utilisateur
    public function getRole(int $id): int
    {
       $query = $this->db->prepare("SELECT Admin FROM $this->table WHERE Id = :id");
        
        $query->execute([
            ':id' => $id,
        ]);
        
        $infosUser = $query->fetch(\PDO::FETCH_ASSOC);
        
        return intval($infosUser['Admin']);
    }




    
    
    //renvoie les coordonnées de l'utilisateur
    public function getAddress(int $id): array
    {
        $query = $this->db->prepare("SELECT LastName, FirstName, Address, City, ZipCode FROM $this->table WHERE Id = :id");
        
        $query->execute([
            ':id' => $id,
        ]);
        
        return $query->fetch(\PDO::FETCH_ASSOC); 
    }





    //choper le nom de l'user a partir d'un ID 
    public function getUser(int $id)
    {
        $query = $this->db->prepare("SELECT Pseudo FROM $this->table WHERE Id LIKE :Id");
        $query->execute([
            ':Id' => $id,
        ]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    
    






    
    
    //tester si un email est déjà présent dans la table Users
    public function is_exist_user(string $email)
    {
        $query = $this->db->prepare("SELECT Id FROM $this->table WHERE Email LIKE :email");
        $query->execute([
            ':email' => $email,
        ]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    
    
    //méthode pour vérifier le mot de passe
    private function verifPassword($pass, $pass_hash) {
    //vérifier le mot de passe
    //https://www.php.net/manual/fr/function.openssl-decrypt


        if ($pass === openssl_decrypt($pass_hash, "AES-128-ECB", SECRETKEY)) {
            return true;
        }
        
        return false;

    }
    
    //crypt mot de passe
    private function cryptPassword($pass) {
        //hasher le mot de passe
        //https://www.php.net/manual/fr/function.openssl-encrypt
        
        return openssl_encrypt($pass, "AES-128-ECB", SECRETKEY);
    }
    
    //création d'un user
    public function create(array $u):bool
    {
        
        //trouver avec phpmyadmin la bonne requete à mettre en place
        //de type insert
        
        //préparer les différents champs de la table user
        /* 
        construire un tableau qui va contenir en clé les noms des champs 
        et en valeur, la valeur a insérer
        */
        $insertUser = [];
        
        $insertUser['Pseudo'] = $u['pseudo'];
        $insertUser['Password'] = $this->cryptPassword($u['password']); //crypter le mot de passe
        $insertUser['Email'] = $u['email'];
        // Choper que le numéro de l'avatar la ! je crois c'est bon
        $insertUser['Avatar_Id'] = intval($u['avatar']);
        
        
        //utiliser la méthode insert du model
        if ($this->insert($insertUser) >0) {

            
            return true;


            //l'insertion a fonctionné




            // var_dump('creation du user OK, maintenant on essaie de créer les scores');

            // $scoreModel = new \Models\Score;

            // if (null !== \Session::getId()) {
            //     $user = \Session::getId();

            //     var_dump($user);


            //     if ($scoreModel->initialisationScores($user) > 0) {

            //         var_dump('les scores ont bien été initialisés');

            //         // L'initiasation des scores à 0 a fonctionné
            //     } else {
            //         //on a eu une erreur
            //         return false;
            //     }
            // } else {
            //     var_dump('non identifié');
            //     //on a eu une erreur
            //     return false;
            // }
            
        }
        else {
            //on a eu une erreur
            return false;
        }
    }
    
    public function verifEmailPwd(string $email,string $pwd):bool
    {
        //récupérer l'enregistrement qui correspond au mail
        $query = $this->db->prepare("SELECT Id,Pseudo,Password,Admin,Avatar_Id FROM $this->table WHERE Email LIKE :email LIMIT 0,1");
        $query->execute([
            ':email' => $email,
        ]);

        //stockage du résultat dans une variable de travail
        $myUser = $query->fetch(\PDO::FETCH_ASSOC);
        
        if (!$myUser) {
            //la requete n'a rien donné, on met fin au programme, en renvoyant false
            return false;
        }
        
        //ici on a bien un email reconnu
        //il faut quand même tester le mot de passe
        if (!$this->verifPassword($pwd, $myUser['Password']))
        {
            //mauvais mot de passe;
            return false;
        }
        
        //mettre à jour la date de LastConnectedDate
        $sql = "UPDATE $this->table SET LastConnectedDate = NOW() WHERE Id= :Id";
        
        $query = $this->db->prepare($sql);

        $query->execute(['Id'=> $myUser['Id']]);



        // je vais chercher l'avatar de l'user
        $avatar = new Avatar();
        $avatarURL = $avatar->getAvatar($myUser['Avatar_Id']);
        
        
        //création d'un session utilisateur
        \Session::connect([
            'Id' => intval($myUser['Id']),
            'Pseudo' => htmlspecialchars($myUser['Pseudo']),
            'Admin' => intval($myUser['Admin']),
            'AvatarURL' => $avatarURL['Image'],
            ]);

    
        
        //identification réussie
        return true;
        
    }


    public function getGlobalRankings() {

        $query = $this->db->prepare(
            "SELECT *, SUM(s.ScoreByTopic) AS TotalScore 
            FROM $this->table AS u 
            LEFT JOIN score AS s ON u.Id = s.Id_User 
            INNER JOIN avatars AS a ON u.Avatar_Id = a.Id 
            GROUP BY u.Id
            ORDER BY TotalScore DESC, u.LastConnectedDate ASC"
            );

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }








}

?>