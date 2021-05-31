<?php

session_start();

$_SESSION = [];

session_destroy();

//redirection
header('Location: ../index.php');