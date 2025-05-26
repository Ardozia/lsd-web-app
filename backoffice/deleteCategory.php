<?php
require("../components/auth.php");
require("../components/connection.php");

$role = $_SESSION["role"];
if (isset($_GET["id"]) && $role == "admin") {
    // se id estiver definido e user é admin
    // elimina categoria
    $id = $_GET["id"];

    // Check if category has products
    $check = mysqli_query($connection, "SELECT COUNT(*) as total FROM product WHERE category_idcategory = $id");
    $row = mysqli_fetch_assoc($check);

    if ($row['total'] > 0) {
        Header("Location: manage_categories.php?msg=Categoria contém produtos&type=danger");
        exit;
    }

    $query = "DELETE FROM category WHERE idcategory = $id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        Header("Location: manage_categories.php?msg=Categoria eliminada com sucesso&type=success");
    } else {
        Header("Location: manage_categories.php?msg=Erro ao eliminar categoria&type=danger");
    }
}
