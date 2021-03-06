<?php

namespace Controllers;

/*
 * LES PROPRIETES :
 * ---------------------
 * $model représente l'objet Model à utiliser pour nos requêtes
 * $modelName représente le nom de l'objet Model à créer avant toute action sur un controller
 * $tplVars représente la variable qui permet de stocker toutes les données nécessaires à afficher ensuite dans les templates phtml.
 *
 * LES METHODES :
 * ----------------------
 * - Le constructeur permet de mettre en place le model ou de faire une exception si on le model indiqué n'existe pas !
*/

abstract class Controller
{

    protected $model;

    protected $modelName;

    protected $tplVars = [];

    public function __construct()
    {

        //vérification que le model a bien été renseigné par le développeur.
        if (!empty($this->modelName)) {

            //Vérification que le model existe
            $path = str_replace("\\", "/", "libraries/{$this->modelName}.php");

            if (!file_exists($path)) {

                throw new \Exception("Le model défini dans " . get_called_class() . " ({$this->modelName}) n'existe pas, le fichier aurait du se trouver ici : $path ");
            }

            $this->model = new $this->modelName();
        }

        /** 
         * Initialisation des données par défaut, on incrémente les valeurs dans la variable $tplVars
         * */

        //chemin absolu du projet
        $this->tplVars = $this->tplVars + ['WWW_URL' => WWW_URL];

        // Ajout de la liste des Topics
        $topics = new \Models\Topic();
        $this->tplVars = $this->tplVars + ['topics' => $topics->findAll()];


        //Ajout des commentaires et de l'auteur du commentaire
        $commentariesModel = new \Models\Commentary();
        $commentaries = $commentariesModel->findAllAuthorizedCommentaries();
        $userModel = new \Models\User();
        $userList = [];
        foreach ($commentaries as $commentary) {
            array_push($userList, $userModel->getUser($commentary['User_Id'])['Pseudo']);
        }
        $this->tplVars = $this->tplVars + ['commentaryCreatedBy' => $userList];
        $this->tplVars = $this->tplVars + ['commentaries' => $commentaries];

        //Ajout du score de l'utilisateur
        $score = new \Models\Score();
        if (\Session::isConnected()) {
            $scoresOfUser = $score->findScoreByUser(\Session::getId());
        } else {
            $scoresOfUser = [];
        }
        $totalPoints = 0;
        foreach ($scoresOfUser as $score) {
            $totalPoints = $totalPoints + intval($score["ScoreByTopic"]);
        }
        $questionList = new \Models\Question();
        $numberOfQuestions = count($questionList->findAll());
        $progressionUser = number_format(($totalPoints / ($numberOfQuestions)) * 100);
        // Condition si le score dépasse 100% quelquesoit la raison, alors il reste à 100%.
        if ($progressionUser > 100) {
            $progressionUser = 100;
        }
        $this->tplVars = $this->tplVars + ['progressionUser' => $progressionUser];
    }
}
