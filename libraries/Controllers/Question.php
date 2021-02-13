<?php

namespace Controllers;

class Question extends Controller {

    protected $modelName = \Models\Question::class;

    public function index() {

        if (isset($_GET['indexQuestion']) && ctype_digit($_GET['indexQuestion'])) {

            $questionList = $this->model->findAllQuestionsByTopic(intval($_GET['topic']));

            // var_dump(count($questionList));

            if(!empty($questionList)) {


                $indexQuestion = intval($_GET['indexQuestion']) - 1;


                //On récupère les infos du topic pour les afficher ensuite.
                $topicList = new \Models\Topic();
                $topic = $topicList->find($_GET['topic']);


                // rajout du nom du topic et des questions dans TplVars.
                $this->tplVars = $this->tplVars + [
                    'indexQuestion' => $questionList[$indexQuestion]['IndexQuestion'],
                    'indexGoodAnswer' => intval($questionList[$indexQuestion]['IndexGoodAnswer']) - 1,
                    //on décale de -1 les valeurs de "indexGoodAnswer" car dans la table c'est de 1 a 4, et on va comparer a une clef qui prendra les valeurs de 0 a 3.
                    'question' => $questionList[$indexQuestion]['Question'],
                    'answers' => $questionList[$indexQuestion]['Answers'],
                    'image' => $questionList[$indexQuestion]['Image'],
                    'Topic_Id' => $questionList[$indexQuestion]['Topic_Id'],
                    'QuestionsCountInThisTopic' => count($questionList),
                    'topic' => $topic

                ];

                \Renderer::show("question", $this->tplVars);

            } else {
                throw new \Exception('Le topic n\'a pas encore de questions enregistrées.');
            }

        

        } 
        else {
            throw new \Exception('Impossible d\'afficher la page questions');
        }

    }

    public function endGame() {

        \Renderer::show("endGame", $this->tplVars);

    }

}