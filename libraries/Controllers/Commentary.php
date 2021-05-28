<?php

namespace Controllers;

class Commentary extends Controller
{
    protected $modelName = \Models\Commentary::class;

    public function index()
    {

        \Session::redirectIfNotConnected();

        //affichage
        \Renderer::show("commentaries", $this->tplVars);
    }


    public function commentarySent()
    {

        \Session::redirectIfNotConnected();

        if (isset($_POST['commentary']) && !empty($_POST['commentary'])) {

            $messageCommentarySentOrNot =
                htmlspecialchars($_POST['commentary'], ENT_QUOTES);

            $data = [
                'User_Id' => \Session::getId(),
                'Content' => $messageCommentarySentOrNot
            ];

            $this->model->insert($data);
        } else {
            $messageCommentarySentOrNot = "Commentaire Vide, il ne sera pas sauvegardé.";
        }


        $this->tplVars = $this->tplVars + ['messageCommentarySentOrNot' => $messageCommentarySentOrNot];

        \Renderer::show("commentarysent", $this->tplVars);
    }
}
