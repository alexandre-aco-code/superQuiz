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

            $scoreByUserAndByTopic = [];

            $scoreByUserAndByTopic = $scoreByUserAndByTopic + [
                'Id_Topic' => $_GET['topic'],
                'Id_User' => $_GET['id'],
                'ScoreByTopic' => $scoreOfTheTopic
            ];



            //LA COMMANDE SQL 
            $scoreExistence = [];


            // var_dump($scoreExistence);

            $scoreExistence = $this->model->findScores($_GET['id'],$_GET['topic']);

            // var_dump('$scoreExistence');
            // var_dump($scoreExistence);
            
            // var_dump('$scoreByUserAndByTopic');
            // var_dump($scoreByUserAndByTopic);

            $scoreStateMessage = '';

            if ($scoreExistence == []) {

                $this->model->insert($scoreByUserAndByTopic);

                $scoreStateMessage = 'Votre score a bien été sauvegardé';

            } else {

                $this->model->updateScoreByTopic($scoreByUserAndByTopic);

                $scoreStateMessage = 'Votre score a bien été mis à jour!';

            }



            $this->tplVars = $this->tplVars + [
                'scoreByTopic' => $scoreOfTheTopic,
                'scoreStateMessage' => $scoreStateMessage
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
