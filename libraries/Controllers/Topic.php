<?php

namespace Controllers;

class Topic extends Controller 
{
    protected $modelName = \Models\Topic::class;
    
    public function index() {
                
        //controler que $_GET['id'] existe bien 
        if (isset($_GET['topic']) && ctype_digit($_GET['topic'])) {
                
        
                //recupération du titre du topic
                $topics = $this->model->findAll();

                // var_dump($topics['Created_by']);

                

            //récupération de la liste des topics 
            /*
                - mettre en place un nouveau model
                - d'une methode pour faire une requete
                
                $topicModel = new \Models\topic();
                
                aprés récupérer le resultat de la requete
                
                
                // */

                $userModel = new \Models\User();
                $userList = [];


                foreach ($topics as $topic) {

                    array_push($userList, $userModel->getUser($topic['Created_by'])['Pseudo']);


                }


                
                //rajout des topics dans $this->tplVars
                
                $this->tplVars = $this->tplVars + [
                    'topicCreatedBy' => $userList
                    // 'topicCreatedAt' => $topics
                ];
                
                //affichage
                \Renderer::show("topic",$this->tplVars);
        }
        else {
            throw new \Exception('Impossible d\'afficher la page Topic !');
        }

        
    }
}