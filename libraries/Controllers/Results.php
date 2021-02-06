<?php

namespace Controllers;

class Results extends Controller
{
    protected $modelName = \Models\Score::class;

    public function index()
    {

        //controler que $_GET['id'] existe bien 
        if(isset($_GET['id']) && ctype_digit($_GET['id']) &&
            isset($_GET['topic']) && ctype_digit($_GET['topic'])) {


            if (!isset($_GET['s']) || $_GET['s'] == 'null') {

                $scoreOfTheTopic = 0;

            } else {

                if (isset($_GET['s']) && ctype_digit($_GET['s'])) {

                    $scoreOfTheTopic = $_GET['s'];

                } else {
                    // var_dump($_GET['s']);
                    throw new \Exception('triche sur le score?');
                }

            }

            // var_dump($_GET['topic']);
            // var_dump($_GET['id']);
            // var_dump($scoreOfTheTopic);

            // préparation du $data à envoyer dans model->insert
            $scoreByUserAndByTopic = [];

            $scoreByUserAndByTopic = $scoreByUserAndByTopic + [
                'Id_Topic' => $_GET['topic'],
                'Id_User' => $_GET['id'],
                'ScoreByTopic' => $scoreOfTheTopic
            ];


            // var_dump($scoreByUserAndByTopic);


            // On vérifie que la table n'est pas déjà remplie
            // Si elle est remplie on UPDATE, sinon on INSERT.



            //LA COMMANDE SQL 

            $this->model->insert($scoreByUserAndByTopic);


            $this->tplVars = $this->tplVars + [
                'scoreByTopic' => $scoreOfTheTopic
                // 'topicCreatedAt' => $topics
            ];

            // var_dump($this->tplVars);





            


            //affichage
            \Renderer::show("results", $this->tplVars);

        } else {

            throw new \Exception('Impossible d\'afficher la page Resultats ! Etes vous bien loggé ?');
        }
    }
}
