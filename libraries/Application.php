<?php

class Application
{
    public static function process()
    {

        //valeurs par défault du controller et de la task
        if (\Session::isConnected()) {
            $controllerName = "Main";
        } else {
            $controllerName = "Home";
        }

        $task = "index";

        if (!empty($_GET["controller"])) {
            $controllerName = htmlspecialchars(ucfirst($_GET["controller"]));
        }

        if (!empty($_GET["task"])) {
            $task = htmlspecialchars($_GET["task"]);
        }

        // construction du nom du controller
        $controllerName = "\Controllers\\" . $controllerName;

        // création de l'instance
        $controller = new $controllerName();

        // appel de la méthode
        $controller->$task();
    }
}
