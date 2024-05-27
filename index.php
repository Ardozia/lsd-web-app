<?php
    session_start();

    // se o utilizador está autenticado
    if (isset($_SESSION["email"]))
        $loggedin = true;
    else
        $loggedin = false;

    if ($loggedin) {
        Header("location: main.php");
    } else {
        Header("location: login.php");
    }
?>