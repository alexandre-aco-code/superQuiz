<?php

class Application {

    public static function process() {

        if (\Session::isConnected()) {
            $controllerName = "Main";
        } else {
            $controllerName = "Home";
        }

        $task = "index";
        // $topic = "1";
        // $indexQuestion = "1";


        if (!empty($_GET["controller"])) {

            

            $controllerName = htmlspecialchars(ucfirst($_GET["controller"]));

        }

        if (!empty($_GET["task"])) {

            $task = htmlspecialchars($_GET["task"]);

        }

        // construction du nom du controller


        $controllerName = "\Controllers\\".$controllerName;

        $controller = new $controllerName();

        $controller->$task();





    }
}