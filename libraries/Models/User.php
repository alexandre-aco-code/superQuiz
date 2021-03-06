<?php

namespace Models;

class User extends Model
{
    //pour utiliser Model, on définit une propriété protected $table qui contient le nom de la table principale
    protected $table = T_USERS;

    //récupération specifique de champ de la table Users
    /*
    Id, Admin, FirstName et LastName
    */
    public function findAll_Id_Admin(): array
    {
        $query = $this->db->prepare("SELECT Id, Pseudo, Email, Admin FROM $this->table");

        $query->execute();


        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    //renvoie le rôle d'un utilisateur pour le backOffice
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
    public function getAllInfoOfAnUser(int $id): array
    {
        $query = $this->db->prepare("SELECT * FROM $this->table WHERE Id = :id");

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
    private function verifPassword($pass, $pass_hash)
    {
        //vérifier le mot de passe
        //https://www.php.net/manual/fr/function.openssl-decrypt

        if ($pass === openssl_decrypt($pass_hash, "AES-128-ECB", SECRETKEY)) {
            return true;
        }

        return false;
    }

    //crypt mot de passe
    private function cryptPassword($pass)
    {
        //hasher le mot de passe
        //https://www.php.net/manual/fr/function.openssl-encrypt

        return openssl_encrypt($pass, "AES-128-ECB", SECRETKEY);
    }

    //création d'un user
    public function create(array $u): bool
    {

        $insertUser = [];

        $insertUser['Pseudo'] = $u['pseudo'];
        $insertUser['Password'] = $this->cryptPassword($u['password']); //crypter le mot de passe
        $insertUser['Email'] = $u['email'];
        // Récupérer que le numéro de l'avatar 
        $insertUser['Avatar_Id'] = intval($u['avatar']);


        //utiliser la méthode insert du model
        if ($this->insert($insertUser) > 0) {

            return true;
        } else {
            //on a eu une erreur
            return false;
        }
    }

    // Mettre à jour un user
    public function updateUser(array $u): bool
    {
        $updateUser = [];
        $updateUser['Id'] = \Session::getId();
        $updateUser['Pseudo'] = $u['pseudo'];
        $updateUser['Email'] = $u['email'];
        $updateUser['Avatar_Id'] = intval($u['avatar']);

        // utilise la méthode UPDATE du model
        if ($this->update($updateUser)) {

            // je vais chercher l'avatar de l'user
            $avatar = new Avatar();
            $avatarURL = $avatar->getAvatar($updateUser['Avatar_Id']);

            //création d'un session utilisateur
            \Session::connect([
                'Id' => intval($updateUser['Id']),
                'Pseudo' => htmlspecialchars($updateUser['Pseudo']),
                'Admin' => intval($updateUser['Admin']),
                'AvatarURL' => $avatarURL['Image'],
            ]);

            return true;
        } else {
            //on a eu une erreur
            return false;
        }
    }

    public function verifEmailPwd(string $email, string $pwd): bool
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
        if (!$this->verifPassword($pwd, $myUser['Password'])) {
            //mauvais mot de passe;
            return false;
        }

        //mettre à jour la date de LastConnectedDate
        $sql = "UPDATE $this->table SET LastConnectedDate = NOW() WHERE Id= :Id";

        $query = $this->db->prepare($sql);

        $query->execute(['Id' => $myUser['Id']]);


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


    public function getGlobalRankings()
    {

        $query = $this->db->prepare(
            "SELECT *, SUM(s.ScoreByTopic) AS TotalScore 
            FROM $this->table AS u 
            LEFT JOIN score AS s ON u.Id = s.Id_User 
            INNER JOIN avatars AS a ON u.Avatar_Id = a.Id 
            GROUP BY u.Id
            ORDER BY TotalScore DESC, u.LastConnectedDate DESC"
        );

        $query->execute();

        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}
