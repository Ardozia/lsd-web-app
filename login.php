<?php 
  // Initializer for sessions on php
  session_start();

  $msg_error = "";
  if (isset($_POST["submit"])) {

    require("connection.php");

    $email =  $_POST["email"];
    $pwd =    $_POST["password"];  
  
    // 1º consulta da pwd associado ao email 
    $query = "select email, password from user where email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0){
      // obteve password da db para o $email
      // validar se password == password introduzida no form login
      $salt="#_123Abf%&";
      $encryptedPwd = md5($salt.$pwd);

      // get first row from select results
      $row = mysqli_fetch_assoc($result);
      $dbpassword = $row["password"];

      //echo "$dbpassword|$encryptedPwd";

      if ($dbpassword == $encryptedPwd) {
        // success on login
        // save user email on session
        $_SESSION["email"] = $email;
        Header("Location: main.php");

      } else {
        // error on login
        $msg_error = "<p class='alert alert-danger'>User ou password inválidos</p>";
      }


    } else {
      $msg_error = "<p class='alert alert-danger'>User ou password inválidos</p>";
    }


  }


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <h1 class="display-3">Welcome to Babs</h1>
    
    <?php
      echo  $msg_error;
    ?>
    
    <form method="post" class="w-50">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email"
            name="email"
            aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit" >Login</button>

        <div id="emailHelp" class="form-text">Don't have an account? Create one <a href="signup.php">here</a></div>
    </form>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>