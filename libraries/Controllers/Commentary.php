<?php

namespace Controllers;

class Commentary extends Controller
{
    protected $modelName = \Models\Commentary::class;

    public function index()
    {


        

        //affichage

        \Renderer::show("commentaries", $this->tplVars);
    }
}
