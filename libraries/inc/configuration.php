<?php


session_start();

/**
 * IDENTIFIANTS BDD
 */

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_NAME = "quiz";

/**
 * CLEF MOTS DE PASSE
 */

const SECRETKEY = 'mysecretkey1234';

/**
 * LISTE DES TABLES de LA BDD
 */


const T_AVATARS = "avatars";
const T_COMMENTARIES = "commentary";
const T_QUESTIONS = "questions";
const T_SCORE = "score";
const T_TOPICS = "topics";
const T_USERS = "users";


// je change ce fichier


// try catch qui marche -> 

// $host = DB_HOST;
// $name = DB_NAME;
// $user = DB_USER;
// $password = DB_PASSWORD;

// try{
//                 $dbco = new PDO("mysql:host=$host;dbname=$name", $user, $password);
//                 $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
//                 /*Sélectionne les valeurs dans les colonnes prenom et mail de la table
//                  *users pour chaque entrée de la table*/
//                 $sth = $dbco->prepare("SELECT * FROM Question");
//                 $sth->execute();
                
//                 /*Retourne un tableau associatif pour chaque entrée de notre table
//                  *avec le nom des colonnes sélectionnées en clefs*/
//                 $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
                
//                 /*print_r permet un affichage lisible des résultats,
//                  *<pre> rend le tout un peu plus lisible*/
//                 echo '<pre>';
//                 print_r($resultat);
//                 echo '</pre>';
//             }

//             catch(PDOException $e){
//                 echo "Erreur : " . $e->getMessage();
//             }