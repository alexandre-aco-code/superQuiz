<?php

namespace Controllers;

class Score extends Controller 
{
    protected $modelName = \Models\Score::class;

    public function index() {
                
        //controler que $_GET['id'] existe bien 
        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {


            // recupération du titre du rayon
            $score = $this->model->findScoreByTopic(intval($_GET['id']));

            // $userModel = new \Models\User();

            // $userName = $userModel->findAll

            // var_dump($score);




            //rajout des topics dans $this->tplVars

            $this->tplVars = $this->tplVars + [
                'scoreByTopic' => $score
                // 'topicCreatedAt' => $topics
            ];
            
            
            //affichage
            \Renderer::show("score",$this->tplVars);
        }
        else {
            throw new \Exception('Impossible d\'afficher la page Score !');
        }

        
    }
}