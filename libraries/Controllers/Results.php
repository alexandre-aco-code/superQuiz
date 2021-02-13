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


            // SCORE
            // On récupère le score du topic tout en sécurisant
            if (!isset($_GET['s']) || $_GET['s'] == 'null') {
                $scoreOfTheTopic = 0;
            } else {
                if (isset($_GET['s']) && ctype_digit($_GET['s'])) {
                    $scoreOfTheTopic = $_GET['s'];
                } else {
                    throw new \Exception('triche sur le score?');
                }
            }
            $scoreByUserAndByTopic = [];
            $scoreByUserAndByTopic = $scoreByUserAndByTopic + [
                'Id_Topic' => $_GET['topic'],
                'Id_User' => $_GET['id'],
                'ScoreByTopic' => $scoreOfTheTopic
            ];
            //si le score existe, on met à jour, sinon on le crée
            $scoreExistence = [];
            $scoreExistence = $this->model->findScores($_GET['id'],$_GET['topic']);
            $scoreStateMessage = '';
            if ($scoreExistence == []) {
                $this->model->insert($scoreByUserAndByTopic);
                $scoreStateMessage = 'Votre score a bien été sauvegardé';
            } else {
                $this->model->updateScoreByTopic($scoreByUserAndByTopic);
                $scoreStateMessage = 'Votre score a bien été mis à jour!';
            }



            //Permet de compter le nombre de questions dans ce topic
            $questionList = new \Models\Question();
            $allQuestionsInTheTopic = $questionList->findAllQuestionsByTopic($_GET['topic']);




            //On récupère les infos du topic pour les afficher ensuite.
            $topicList = new \Models\Topic();
            $topic = $topicList->find($_GET['topic']);




            $this->tplVars = $this->tplVars + [
                'scoreByTopic' => $scoreOfTheTopic,
                'scoreStateMessage' => $scoreStateMessage,
                'allQuestionsInTheTopic' => $allQuestionsInTheTopic,
                'topic' => $topic
            ];


            //affichage
            \Renderer::show("results", $this->tplVars);

        } else {

            throw new \Exception('Impossible d\'afficher la page Resultats ! Etes vous bien loggé ?');
        }
    }
}
