<?php 

class Renderer {

    public static function show(string $template, array $tplVars = []) {

        ob_start();

        require("libraries/views/templates/$template.phtml");
        $pageContent = ob_get_clean();

        require('libraries/views/layout.phtml');


    }


    public static function showAdmin(string $template, array $tplVars = []) {

        ob_start();

        require("libraries/views/templates/admin/$template.phtml");
        $pageContent = ob_get_clean();

        require("libraries/views/layoutAdmin.phtml");
        
    }

/**
     * La fonction showError() permet d'afficher une exception
     *
     * @param array $variables Le tableau associatif contenant les variables utilisées dans le template PHTML
     * @return void
     */
    public static function showError(array $tplVars = [])
    {

        require("libraries/views/templates/error.phtml");

    }


}