<?php

namespace Controllers;

class Topic extends Controller
{
    protected $modelName = \Models\Topic::class;

    public function index()
    {

        \Session::redirectIfNotConnected();
        //controler que $_GET['id'] existe bien 
        if (isset($_GET['topic']) && ctype_digit($_GET['topic'])) {

            // On récupère tous les topics
            $topics = $this->model->findAll();
            $topicslength = count($topics);

            // On récupère les utilisateurs ici pour ensuite indiquer quel utilisateur a créé quel topic.
            $userModel = new \Models\User();
            $userList = [];

            // On récupère le nombre de questions par topic pour afficher le score pour chaque topic ensuite
            $questionList = new \Models\Question();
            $questionsCountByTopic = [];

            // AJOUT DU SCORE
            $scoresByTopic = [];

            $modelScore = new \Models\Score;
            if (\Session::isConnected()) {
                $id = \Session::getId();
            }

            foreach ($topics as $topic) {
                //pour chaque topic on push le pseudo du créateur
                array_push($userList, $userModel->getUser($topic['Created_by'])['Pseudo']);
                //pour chaque topic on push le nombre de question
                array_push($questionsCountByTopic, count($questionList->findAllQuestionsByTopic($topic['Id'])));
                // pour chaque topic on push le score de l'utilisateur
                array_push($scoresByTopic, $modelScore->getScoreByUserAndByTopic(\Session::getId(), $topic['Id']));
            }

            //rajout des infos dans $this->tplVars
            $this->tplVars = $this->tplVars + [
                'topicCreatedBy' => $userList,
                'questionsCountByTopic' => $questionsCountByTopic,
                'scoresByTopic' => $scoresByTopic,
            ];

            //affichage
            \Renderer::show("topic", $this->tplVars);
        } else {
            throw new \Exception('Impossible d\'afficher la page Topic !');
        }
    }
}
