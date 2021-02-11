<?php

namespace Controllers\Admin;

class Topic extends \Controllers\Admin
{
    protected $modelName = \Models\Topic::class;

    protected $nameCrud = "Topic";

    protected $pageTitle = "Gestion des topics";

    public function create(array $data = [])
    {
        //tester les champs
        if (empty($_POST['name'])) {
            //au moins un des 2 champs est vide
            \Session::addFlash('error', 'champ(s) obligatoire(s) non rempli(s) !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }

        //traiter le formulaire
        //preparation un tableau
        $data['Name'] = $_POST['name'];
        //si on arrive ici on va pouvoir insérer 
        parent::create($data);
    }

    public function newForm()
    {
        //titre de la page
        $this->pageTitle = "Création d'un topic";

        parent::newForm();
    }

    public function editForm()
    {
        //titre de la page
        $this->pageTitle = "Edition d'un topic";

        parent::editForm();
    }

    public function updateTopic(array $data = [])
    {

        var_dump("hellototo");
        //tester les champs
        if (empty($_POST['name']) || empty($_POST['id'])) {
            //au moins un des 3 champs est vide
            \Session::addFlash('error', 'champ(s) obligatoire(s) non rempli(s) !');
            //rediriger l'utilisateur vers le formulaire 
            \Http::redirectBack();
        }

        //traiter le formulaire
        //preparation un tableau

        $data['Name'] = $_POST['name'];
        $data['Id'] = intval($_GET['id']);

        var_dump($data);
        die();
        //si on arrive ici on va pouvoir insérer notre nouveau rayon
        parent::update($data);
    }
}
