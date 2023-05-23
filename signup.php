<?php


$msg_error = "";
$msg_success = "";
$src = "https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-Clipart.png";

//Check if there is a form submit
if (isset($_POST["submit"])){

    require("connection.php");



    $name = $_POST["name"];
    // salt fortalece passwords "fracas"
    $salt="#_123Abf%&"; // tem de ser usado no login
    $password = md5($salt.$_POST["password"]); // ALERTA não se guardam passwords NÃO encriptadas
    $email = $_POST["email"];
    $street = $_POST["street"];
    $streetnr = $_POST["streetnr"];
    $postal = $_POST["postal"];
    $country = $_POST["country"];
    $avatar = ""; // atualizado no upload do avatar
     
    // Check if email is already registered
    $query = "select email from user where email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // email already registered
        $msg_error = "<p class='alert alert-danger'>The email $email is already registered</p>";
    } else {

        // upload avatar
        $target_dir = "avatars/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);

        $avatar_upload = move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

        if ($avatar_upload) {
            $src = $target_file;
            $avatar = $target_file;
        }


        // create insert statement
        $insertQuery = "insert into user (name, password, email, address_name, address_nr, address_postal_code, address_country, avatar, dt_created) values ('$name', '$password', '$email','$street', '$streetnr','$postal', '$country', '$avatar', CURRENT_TIMESTAMP)";

        //echo $insertQuery;

        // execute query 
        try {
            $result = mysqli_query($connection, $insertQuery);
            if (!$result){
                echo mysqli_error($connection);
            }


        } catch (Exception $e) {
            //throw $th;
            echo "Error ".$e->getMessage();
        }

        
        $msg_success = '<div class="alert alert-success" role="alert">Hello '.$name.'. Welcome to Babs</div>';

    }




}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Babs site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    
<div class="row justify-content-center">
    <form method="post" enctype="multipart/form-data"  class="col-auto col-md-6">

        <h1 class="display-5">Create an account</h1>

        <?php
            echo $msg_success;
            echo $msg_error;    
        ?>

        <!-- Avatar -->
        <img class="w-25" src="<?php echo $src; ?>" class="img-thumbnail" alt="...">
        <div class="mb-3">
            <label for="formFile" class="form-label">Upload your avatar</label>
            <input class="form-control" type="file" id="avatar" name="avatar">
        </div>
        
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email"
            name="email"
            aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <!-- CPassword -->
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
        </div>
        <!-- Street -->
        <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="text" class="form-control" id="street" name="street">
        </div>
        <!-- Street Nr -->
        <div class="mb-3">
            <label for="streetnr" class="form-label">Street Nr</label>
            <input type="text" class="form-control" id="streetnr" name="streetnr">
        </div>
        <!-- Postal code -->
        <div class="mb-3">
            <label for="postal" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postal" name="postal">
        </div>

        <!-- Country -->
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Sign up</button>

    </form>
</div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>