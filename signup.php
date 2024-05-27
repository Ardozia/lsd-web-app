<?php

$msgType = "";
$msg = "";
$targetDir = "./images/avatars/";
$image = "./images/default-avatar-icon.jpg";
$name = "";
$email = "";
$pwd = "";
$street = "";
$nr = "";
$postal = "";
$country = "";

// apenas para segundo momento - form submit
if (isset($_POST["submit"])) {

  require("connection.php");

  // protected againts code injection
  $name = mysqli_real_escape_string($connection, $_POST["username"]);
  $email = $_POST["useremail"];
  // encript user pwd with md5 algorithm
  $pwd = md5($_POST["pwd"]);
  $street = $_POST["street"];
  $nr = $_POST["nr"];
  $postal = $_POST["postal"];
  $country = $_POST["country"];

  // check if email is already registered
  $query = "
    select email 
    from user 
    where email = '$email'
  ";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
    $msgType = "danger";
    $msg = "Email já se encontra registado";
  } else {

    // check user image avatar
    if (
      isset($_FILES["image"]) &&
      $_FILES["image"]["tmp_name"] !== ""
    ) {

      $target_file = $targetDir . basename($_FILES["image"]["name"]);

      // check if uploaded file is an image
      $size = getimagesize($_FILES["image"]["tmp_name"]);
      if ($size === false) {
        $msgType = "danger";
        $msg = "Imagem de perfil inválida";
      } else {

        // todo: check size of file

        // todo: change image resolution

        $check = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        if ($check) {
          // upload ok
          $image = $target_file;
        } else {
          $msgType = "danger";
          $msg = "Erro ao carregar avatar";
        }
      }
    }


    // insert into db
    $query = "insert into store.user
    (name, email, password, address_name, address_nr, address_postal_code, address_country, avatar) values ('$name', '$email','$pwd','$street','$nr','$postal','$country', '$image')";

    //echo $query;

    $result = mysqli_query($connection, $query);
    if (!$result) {
      $msgType = "danger";
      $msg = "Erro ao criar user";
    } else {
      $msgType = "success";
      $msg = "User criado";
    }
  }
  //print_r($connection);
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signup User</title>

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
  <div class='container'>
    <div class="row">
      <div class="col"></div>
      <div class="col-12 col-lg-6">

        <div class="card text-center p-3">

          <div class="alert alert-<?php echo $msgType; ?>" role="alert">
            <?php echo $msg; ?>
          </div>

          <form method="post" enctype="multipart/form-data">
            <div>
              <img class="img-thumbnail rounded-circle" src="<?php echo $image; ?>" />
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="image">Avatar</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Nome</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="name of user" placeholder="Escreva aqui o seu nome ..." value="<?php echo $name; ?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" name="useremail" id="useremail" aria-describedby="emailHelp" value="<?php echo $email; ?>">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name="pwd" id="pwd" value="<?php echo $pwd; ?>">

            </div>
            <div>
              <p class="fs-5">Morada</p>
            </div>
            <div class="d-flex">
              <div class="mb-3">
                <label for="name" class="form-label">Rua</label>
                <input type="text" class="form-control" id="street" name="street" aria-describedby="street" placeholder="Rua ..." value="<?php echo $street; ?>">
              </div>
              <div class="mb-3">
                <label for="nr" class="form-label">Nr</label>
                <input type="text" class="form-control" id="nr" name="nr" aria-describedby="nr" placeholder="Nr ..." value="<?php echo $nr; ?>">
              </div>
            </div>
            <div class="d-flex">
              <div class="mb-3">
                <label for="name" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="postal" name="postal" aria-describedby="postal" placeholder="Codigo Postal ..." value="<?php echo $postal; ?>">
              </div>
              <div class="mb-3">
                <label for="nr" class="form-label">País</label>
                <input type="text" class="form-control" id="country" name="country" aria-describedby="country" placeholder="País ..." value="<?php echo $country; ?>">
              </div>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>

      </div>
      <div class="col"></div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>