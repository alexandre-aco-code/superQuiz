<?php

namespace Controllers\Admin;

class Commentary extends \Controllers\Admin
{
    protected $modelName = \Models\Commentary::class;

    protected $nameCrud = "Commentary";

    protected $pageTitle = "Gestion des commentaires";
    
    public function index()
    {

        //titre de la page
        $this->tplVars = $this->tplVars + [
            'page_title' => $this->pageTitle
        ];

        //liste des données
        $this->tplVars = $this->tplVars + [
            'list' => $this->model->findAllByAuthor()
        ];

        //afficher la liste 
        \Renderer::showAdmin(strtolower($this->nameCrud) . "/list", $this->tplVars);
    }


    public function updateCommentStatus(array $data = [])
    {
        var_dump($data);

        //controler que $_GET['id'] existe bien 
        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

            //récupérer le rôle existant
            if ($this->model->getStatus(intval($_GET['id'])) == 1) {
                $data['Status'] = NULL;
            } else {
                $data['Status'] = 1;
            }

            $data['Id'] = intval($_GET['id']);



            parent::update($data);
        } else {
            throw new \Exception('Impossible de changer le rôle !');
        }
    }
}
