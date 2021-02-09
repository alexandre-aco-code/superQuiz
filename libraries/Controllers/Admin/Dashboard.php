<?php

namespace Controllers\Admin;

class Dashboard extends \Controllers\Admin
{
    protected $pageTitle = "Menu Administrateur";

    public function index()
    {

        //titre de la page
        $this->tplVars = $this->tplVars + [
            'page_title' => $this->pageTitle
        ];

        //affichage
        \Renderer::showAdmin("dashboard", $this->tplVars);
    }
}
