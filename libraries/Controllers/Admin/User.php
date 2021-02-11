<?php

namespace Controllers\Admin;

class User extends \Controllers\Admin
{
    protected $modelName = \Models\User::class;

    protected $nameCrud = "User";

    protected $pageTitle = "Gestion des rôles";

    public function index()
    {

        //titre de la page
        $this->tplVars = $this->tplVars + [
            'page_title' => $this->pageTitle
        ];

        //liste des données
        $this->tplVars = $this->tplVars + [
            'list' => $this->model->findAll_Id_Admin()
        ];

        //afficher la liste 
        \Renderer::showAdmin(strtolower($this->nameCrud) . "/list", $this->tplVars);
    }


    public function updateAdminRole(array $data = [])
    {
        //controler que $_GET['id'] existe bien 
        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
            //récupérer le rôle existant
            if ($this->model->getRole(intval($_GET['id'])) == 1) {
                $data['Admin'] = NULL;
            } else {
                $data['Admin'] = 1;
            }

            $data['Id'] = intval($_GET['id']);

            



            parent::update($data);
        } else {
            throw new \Exception('Impossible de changer le rôle !');
        }
    }
}
