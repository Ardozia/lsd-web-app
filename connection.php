<?php 
$server = "localhost";
$schema = "store";
$user = "root";
$pwd = "root";

$connection = mysqli_connect($server, $user, $pwd, $schema);

if (!$connection) {
  die("Error connection db ...");
};

//print_r($connection);
?>