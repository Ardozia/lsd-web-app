<?php 
    session_start();

    $_SESSION = [];

    session_destroy();

    Header("Location: login.php");

?>