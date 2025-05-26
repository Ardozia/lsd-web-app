<?php
session_start();

// reset $_SESSION
$_SESSION = array();

// destroi sessao em PHP
session_destroy();

// redirect to login
Header("Location: ../main.php");
