<?php


//L'instance PDO qui sert partout ou y a besoin.

// Classe abstraite = peut pas etre instancié
// Function static = function dispo sans avoir besoin d'instancier la classe.



abstract class Database {

    private static $pdo;

    public static function getInstance(): PDO {

        if(empty(self::$pdo)) {
            $host = DB_HOST;
            $name = DB_NAME;
            $user = DB_USER;
            $password = DB_PASSWORD;

            self::$pdo = new PDO(
                "mysql:host=$host;dbname=$name;charset=utf8",
                $user,
                $password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

    return self::$pdo;

    }

}