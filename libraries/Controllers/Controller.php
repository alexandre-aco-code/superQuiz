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


    

    //rajout des scores principaux dans $this->tplVars

    $score = new \Models\score();


    // ICI JE BLOQUE
    //mettre le user id a la place de 3
    $scoreList = $score->findScoreByUser(3);

    // var_dump($scoreList);
    $scoreByTopic = [];




    // $this->tplVars = $this->tplVars + [
    //         'score' => $scoreByTopic,
    //         'avancementSite' => $avancementSite
    //     ];






    
    //topic 1 par défault :
    $topic['ID'] = 1;
    

    }



}