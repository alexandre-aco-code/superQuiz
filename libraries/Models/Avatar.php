<?php

namespace Models;

class Avatar extends Model
{
    //pour utiliser Model, on définit une propriété protected $table qui contient le nom de la table principale
    protected $table = T_AVATARS;

    //renvoie l'avatar de l'utilisateur
    public function getAvatar(int $id): array
    {
        $query = $this->db->prepare("SELECT Image FROM $this->table WHERE Id = :id");

        $query->execute([
            ':id' => $id,
        ]);

        return $query->fetch(\PDO::FETCH_ASSOC);
    }
}
