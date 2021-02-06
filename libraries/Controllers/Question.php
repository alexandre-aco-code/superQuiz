<?php

namespace Controllers;

class Question extends Controller {

    protected $modelName = \Models\Question::class;

    public function index() {

        if (isset($_GET['indexQuestion']) && ctype_digit($_GET['indexQuestion'])) {


            $topic = $this->model->find(intval($_GET['topic']));

            // var_dump("le Topic est");
            // var_dump($_GET['topic']);

            // $questionModel = new \Models\Question();


            $questionList = $this->model->findAllQuestionsByTopic(intval($_GET['topic']));

        
            $indexQuestion = intval($_GET['indexQuestion']) - 1;
            // var_dump($indexQuestion);
            

            // var_dump($questionList[$_GET['topic']]);
            // var_dump($questionList[$_GET['topic']]);



            // rajout du nom du topic et des questions dans TplVars.

            $this->tplVars = $this->tplVars + [
                'indexQuestion' => $questionList[$indexQuestion]['IndexQuestion'],
                //on décale de -1 les valeurs de "indexGoodAnswer" car dans la table c'est de 1 a 4, et on va comparer a une clef qui prendra les valeurs de 0 a 3.
                'indexGoodAnswer' => intval($questionList[$indexQuestion]['IndexGoodAnswer'])-1,
                'question' => $questionList[$indexQuestion]['Question'],
                'answers' => $questionList[$indexQuestion]['Answers'],
                'image' => $questionList[$indexQuestion]['Image'],
                'Topic_Id' => $questionList[$indexQuestion]['Topic_Id']

            ];

            \Renderer::show("question", $this->tplVars);

        } 
        else {
            throw new \Exception('Impossible d\'afficher la page questions');
        }

    }
}