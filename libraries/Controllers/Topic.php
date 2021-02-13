<?php

namespace Controllers;

class Topic extends Controller 
{
    protected $modelName = \Models\Topic::class;
    
    public function index() {
                
        //controler que $_GET['id'] existe bien 
        if (isset($_GET['topic']) && ctype_digit($_GET['topic'])) {
                
            $topics = $this->model->findAll();

            $userModel = new \Models\User();
            $userList = [];

            // Pour compter le nombre de questions par topic pour afficher le score pour chaque
            $questionList = new \Models\Question();
            $questionsCountByTopic = [];


            foreach ($topics as $topic) {
                
                //chope l'utilisateur qui a créé le topic
                array_push($userList, $userModel->getUser($topic['Created_by'])['Pseudo']);

                //Chope le nombre de question pour chaque topic
                array_push($questionsCountByTopic, count($questionList->findAllQuestionsByTopic($topic['Id'])));

            }

            // AJOUT DU SCORE
            $modelName = new \Models\Score;
            $id = \Session::getId();
            $scoresByTopic = $modelName->findScoreByUser($id);
                

            //rajout des infos dans $this->tplVars
            $this->tplVars = $this->tplVars + [
                'topicCreatedBy' => $userList,
                'scoresByTopic' => $scoresByTopic,
                'questionsCountByTopic' => $questionsCountByTopic
            ];
            
            //affichage
            \Renderer::show("topic",$this->tplVars);
        }
        else {
            throw new \Exception('Impossible d\'afficher la page Topic !');
        }

        
    }
}