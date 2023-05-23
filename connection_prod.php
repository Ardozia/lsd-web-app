<?php 

    // especificar ligação a BD produção
    // Ver na empresa de alojamento
    $user = 'root';
    $pwd = '';
    $server = 'localhost';
    $bdschema = 'gamedb';



    $connection = mysqli_connect($server, $user, $pwd, $bdschema);

    if (mysqli_connect_error()){
        echo "Error connecting to db ...";
        exit;
    }

    mysqli_set_charset($connection, "utf8");

    print_r($connection);
?>