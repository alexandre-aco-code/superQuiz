<?php

namespace Controllers;

/*
 * LES PROPRIETES :
 * ---------------------
 * $model représente l'objet Model à utiliser pour nos requêtes
 * $modelName représente le nom de l'objet Model à créer avant toute action sur un controller
 *
 * LES METHODES :
 * ----------------------
 * - Le constructeur permet de mettre en place le model ou de faire une exception si on le model indiqué n'existe pas !
 */


abstract class Controller {

    protected $model;

    protected $modelName;

    protected $tplVars = [];

    public function __construct() {

        //vérification qu'il existe, sinon erreur et on la throw

        if (!empty($this->modelName)) {

            $path = str_replace("\\","/","libraries/{$this->modelName}.php");

            if (!file_exists($path)){

                throw new \Exception("Le model défini dans " .get_called_class() . " ({$this->modelName}) n'existe pas, le fichier aurait du se trouver ici : $path ");

            }


            $this->model = new $this->modelName();

        }

    /** Initialisation des données par défaut */

    $topics = new \Models\Topic();

    $this->tplVars = $this->tplVars + ['topics' => $topics->findAll()];

    $this->tplVars = $this->tplVars + ['WWW_URL' => WWW_URL];










    //rajout des commentaries dans $this->tplVars

    $commentariesModel = new \Models\Commentary();
    $commentaries = $commentariesModel->findAll();
    $userModel = new \Models\User();
    $userList = [];

    foreach ($commentaries as $commentary) {
        array_push($userList, $userModel->getUser($commentary['User_Id'])['Pseudo']);
    }
    $this->tplVars = $this->tplVars + [
            'commentaryCreatedBy' => $userList
            // 'commentaryCreatedAt' => $commentaries
        ];
    $this->tplVars = $this->tplVars + ['commentaries' => $commentaries];


    




    // PARTIE POUR AJOUTER LAVANCEMENT EN % DANS LA ZONE PROFIL


    $score = new \Models\score();


    // mettre une condition si le score est NULL ??
    $scoresOfUser = $score->findScoreByUser(\Session::getId());



    $totalPoints = 0;
    foreach ($scoresOfUser as $score) {
        $totalPoints = $totalPoints + intval($score["ScoreByTopic"]);
    }

    $numberOfTopics = count($this->tplVars['topics']);

    $progressionUser = number_format(($totalPoints / ($numberOfTopics * 5))*100);


    $this->tplVars = $this->tplVars + ['progressionUser' => $progressionUser];








    

    // $this->tplVars = $this->tplVars + [
    //         'score' => $scoreByTopic,
    //         'avancementSite' => $avancementSite
    //     ];






    
    //topic 1 par défault :
    $topic['ID'] = 1;
    

    }



}