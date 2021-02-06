<?php

// require('libraries/views/layout.phtml');

// chemin vers le projet 

define('WWW_URL', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

// on prend les infos de configuration

require_once("libraries/inc/configuration.php");



try {


    require_once("libraries/autoload.php");

    \Application::process();






} catch (Exception $e) {

    \Renderer::showError([

        'code' => $e->getCode(),
        'message' => $e->getMessage()
        
    ]);




}