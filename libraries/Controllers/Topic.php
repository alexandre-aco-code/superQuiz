<?php

namespace Controllers;

use Session;

class Topic extends Controller
{
    protected $modelName = \Models\Topic::class;

    public function index()
    {
        if (!\Session::getId()) {

            // throw new \Exception('Utilisateur non enregistré !');

            //l'email n'est pas au bon format
            \Session::addFlash('error', 'Pour accéder aux topics merci de vous enregistrer !');
            //rediriger l'utilisateur vers le formulaire
            \Http::redirectBack();
        }
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
            // $scoresByTopic = array_fill(0, $topicslength, null);

            $modelScore = new \Models\Score;
            if (\Session::isConnected()) {
                $id = \Session::getId();
                // $scoresByTopic = $modelScore->findScoreByUser($id);
                // var_dump($scoresByTopic);
            }

            // var_dump($scoresByTopic);

            foreach ($topics as $topic) 
            {

                // echo "<pre>";
                // var_dump($topic);
                // echo "</pre>";

                //pour chaque topic on push le pseudo du créateur
                array_push($userList, $userModel->getUser($topic['Created_by'])['Pseudo']);

                //pour chaque topic on push le nombre de question
                array_push($questionsCountByTopic, count($questionList->findAllQuestionsByTopic($topic['Id'])));

                // pour chaque topic on push le score de l'utilisateur
                array_push($scoresByTopic, $modelScore->getScoreByUserAndByTopic(\Session::getId(),$topic['Id'] ));

            }

            //rajout des infos dans $this->tplVars
            $this->tplVars = $this->tplVars + [
                'topicCreatedBy' => $userList,
                'scoresByTopic' => $scoresByTopic,
                'questionsCountByTopic' => $questionsCountByTopic
            ];

            //affichage
            \Renderer::show("topic", $this->tplVars);
        } else {
            throw new \Exception('Impossible d\'afficher la page Topic !');
        }
    }
}
