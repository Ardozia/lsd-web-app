<?php
require("auth.php");
require("config.php");

$role = $_SESSION["role"];
if (isset($_GET["id"]) && $role == "admin") {
    // se id estiver definido e user é admin
    // elimina produto
    $id = $_GET["id"];
    $query = "UPDATE product SET available = 0 WHERE idproduct = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        Header("Location: manage_products.php");
    }
}
