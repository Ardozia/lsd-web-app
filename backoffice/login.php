<?php
session_start();

$email = "";
$pwd = "";
$msg = "";
$msgType = "";

if (isset($_POST["submit"])) {

  require("../components/connection.php");

  $email = $_POST["useremail"];
  $pwd = $_POST["userpwd"];

  $query = "select iduser, role, name, avatar, password 
    from user
    where email = '$email'";

  // debug
  //echo $query;

  $result = mysqli_query($connection, $query);

  // ler pwd do $result

  // valida se email existe
  if (mysqli_num_rows($result) == 0) {
    $msg = "Email ou password inválidos";
    $msgType = "danger";
  } else {
    $row = mysqli_fetch_assoc($result);
    $pwd_bd = $row["password"];
    $name = $row["name"];
    $avatar = $row["avatar"];
    $iduser = $row["iduser"];
    $role = $row["role"];

    //encripta pwd do form
    $salt = "$#_23!az";

    $encryptedPwd = hash("sha256", $pwd . $salt);

    if ($pwd_bd == $encryptedPwd) {
      // login com suceso
      //echo "Login com sucesso";

      // cria informação de sessão
      $_SESSION["name"] = $name;
      $_SESSION["email"] = $email;
      $_SESSION["avatar"] = $avatar;
      $_SESSION["id"] = $iduser;
      $_SESSION["role"] = $role;

      Header("Location: ../main.php");
    } else {
      // login sem sucesso
      //echo "Erro no login";
      $msg = "Email ou password inválidas";
      $msgType = "danger";
    }
  }
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Login User</title>

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

        <div class="card p-3">

          <div class="alert alert-<?php echo $msgType; ?>" role="alert">
            <?php echo $msg; ?>
          </div>
          <div>
            <p class="fs-1">Welcome to Nexio Backoffice</p>
            <p class="fs-6">Please login</p>
          </div>
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" name="useremail" id="useremail" aria-describedby="emailHelp" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name="userpwd" id="userpwd" value="<?php echo $pwd; ?>">

            </div>
            <div id="emailHelp" class="form-text">Don't have an account? Create one <a href="signup.php">here</a></div>

            <button name="submit" type="submit" class="btn btn-primary my-3">Submit</button>
          </form>

        </div>

      </div>
      <div class="col"></div>

    </div>
  </div>






  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>