<?php

namespace Controllers;

class Main extends Controller
{

    public function index()
    {
        //affichage
        \Renderer::show("main", $this->tplVars);
    }
}
