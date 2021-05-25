<?php 

class Renderer {

    /**
     * Permet d'afficher les pages du Site
     * 
     * @param string 
     * @param array
     * @return void
     */
    public static function show(string $template, array $tplVars = []) {

        ob_start();

        require("libraries/Views/templates/$template.phtml");
        $pageContent = ob_get_clean();

        require('libraries/Views/layout.phtml');
    }

    /**
     * Permet d'afficher les pages Admin
     * 
     * @param string 
     * @param array
     * @return void
     */
    public static function showAdmin(string $template, array $tplVars = []) {

        ob_start();

        require("libraries/Views/templates/admin/$template.phtml");
        $pageContent = ob_get_clean();

        require("libraries/Views/layoutAdmin.phtml");
        
    }

    /**
     * La fonction showError() permet d'afficher une exception
     *
     * @param array $variables Le tableau associatif contenant les variables utilisées dans le template PHTML
     * @return void
     */
    public static function showError(array $tplVars = [])
    {

        require("libraries/Views/templates/error.phtml");

    }
}