<?php



// PAGE INUTILE ??? 


namespace Controllers;

class Score extends Controller
{
    protected $modelName = \Models\Score::class;

    public function index()
    {

        //controler que $_GET['id'] existe bien 
        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

            // recupération du titre du topic
            $score = $this->model->findScoreByTopic(intval($_GET['id']));

            //rajout des topics dans $this->tplVars
            $this->tplVars = $this->tplVars + [
                'scoreByTopic' => $score
            ];

            //affichage
            \Renderer::show("score", $this->tplVars);
        } else {
            throw new \Exception('Impossible d\'afficher la page Score !');
        }
    }
}
