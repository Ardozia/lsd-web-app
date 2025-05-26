<?php
require("../components/auth.php");
require("../components/connection.php");

$query = "select idcategory, name from category";

$result = mysqli_query($connection, $query);

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Users</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style type="text/css">
    .card-img-top {
      object-fit: cover;
      width: 200px;
      height: 200px;

    }
  </style>

</head>

<body>
  <?php include "../components/header.php"; ?>

  <div class='container'>
    <div class="row">
      <div class="col-12 col-lg-6">
        <h2>Lista de categorias </h2>
        <div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // create link for users
              foreach ($result as $cat) {
                $idcat = $cat["idcategory"];
                $name = $cat["name"];

                echo "<tr>";
                echo "  <td>$name</td>";
                echo "  <td><a href='./upsertCategory.php?id=$idcat'>Editar</a> <a href='./upsertCategory.php?id=$idcat'>Eliminar</a></td>";
                //echo "  <td>$depart</td>";
                echo "</tr>";
              };
              ?>
            </tbody>
          </table>
        </div>

      </div>
      <div class="col"></div>

    </div>
  </div>

  <!-- Footer -->
  <?php include "../components/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>