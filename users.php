<?php
require "auth.php";

require("connection.php");

$query = "select iduser, name, email from store.user";

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
  <?php include "header.php"; ?>

  <div class='container'>
    <div class="row">
      <div class="col-12 col-lg-6">
        <h2>Lista de users </h2>
        <div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // create link for users
              foreach ($result as $user) {
                $name = $user["name"];
                $email = $user["email"];

                $id = $user["iduser"];
                echo "<tr>";
                echo "  <td><a href='./profile.php?id=$id'>$name</a></td>";
                echo "  <td>$email</td>";
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
  <?php include "footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>