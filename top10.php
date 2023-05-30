<?php 
 session_start();

 // If there is no session active redirects to login
if (!isset($_SESSION["email"])){
 Header("Location: login.php");
}


require("connection.php");

$query = "select idproduct, p.name,
photos,
sum( quantity) qtd 
from user u, product p, purchase pu
where iduser = user_iduser and idproduct = product_idproduct
group by idproduct, p.name, photos
order by qtd desc
limit 10";

$results = mysqli_query($connection, $query);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Babs Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

    <?php
        require("header.php");
    ?>

    <div class="container">
        <h1 class="display-3">Os 10 mais vendidos</h1>

        <div class="row row-cols-1 ">
        <?php
            foreach($results as $row){
                $id =     $row["idproduct"];
                $name =   $row["name"];
                $image =  $row["photos"];

                echo "<div class='col'>";
                echo "  <p class='fs-6 my-0'><a href='productDetail.php?id=$id'>$name</a></p>";
                echo "  <img class='mb-3' src='$image' />";
                echo "</div>";
            }

        ?>
        </div>
    
    </div>
    
    <?php
        require("footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>