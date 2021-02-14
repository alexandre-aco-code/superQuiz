<?php

session_start();

$_SESSION = [];

session_destroy();



// Je sais pas pourquoi ca marche pas ce truc en dessous 

// \Session::addFlash('success', 'déconnection réalisée ;) !');

//redirection
header('Location: ../index.php');
