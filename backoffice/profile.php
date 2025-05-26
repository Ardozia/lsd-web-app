<?php
require("../components/auth.php");
require("../components/connection.php");

//mysqli_close($connection);

if (isset($_SESSION["id"])) {
  // sanitizing
  $userid = mysqli_real_escape_string($connection, $_SESSION["id"]);
} else {

  // redireccionar para pagina de erro
  Header("location: error.php");
}

$query = "SELECT iduser, name, email, avatar, address_name, address_nr, address_postal_code, address_country FROM store.user where iduser = $userid";

$result = mysqli_query($connection, $query);

// check if query returns data
if (mysqli_num_rows($result) == 0) {
  echo "User id não existe";
  exit;
};


$user = mysqli_fetch_assoc($result);

//print_r($user);

?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Profile</title>

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
      <div class="col"></div>
      <div class="col-12 col-lg-6">

        <div class="card text-center">
          <img src="<?php echo $user["avatar"]; ?>" class="card-img-top mx-auto img-thumbnail rounded-circle " alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $user["name"]; ?></h5>
            <p class="card-text"><?php echo $user["email"]; ?></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php
                                        echo $user["address_name"];
                                        echo ", ";
                                        echo $user["address_nr"];
                                        ?></li>
            <li class="list-group-item"><?php
                                        echo $user["address_postal_code"];
                                        echo " ";
                                        echo $user["address_country"];
                                        ?></li>
          </ul>
          <div class="card-body">
            <a href="#" class="card-link">Close</a>
            <a href="#" class="card-link">Edit</a>
          </div>
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