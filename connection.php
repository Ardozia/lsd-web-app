<?php 

    // especificar ligação a BD
    $user = 'root';
    $pwd = 'root';
    $server = 'localhost';
    $bdschema = 'store';



    $connection = mysqli_connect($server, $user, $pwd, $bdschema);

    if (mysqli_connect_error()){
        echo "Error connecting to db ...";
        exit;
    }

    mysqli_set_charset($connection, "utf8");

    //print_r($connection);
?>