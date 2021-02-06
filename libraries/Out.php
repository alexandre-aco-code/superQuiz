<?php

session_start();

$_SESSION = [];

session_destroy();




// \Session::addFlash('success', 'déconnection réalisée ;) !');

//redirection

header('Location: ../index.php');
