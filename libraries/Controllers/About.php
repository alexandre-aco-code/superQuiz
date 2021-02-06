<?php

namespace Controllers;

class About extends Controller
{
    // protected $modelName = \Models\Commentary::class;

    public function index()
    {




        //affichage

        \Renderer::show("about", $this->tplVars);
    }
}
