<?php 
    session_start();

      // If there is no session active redirects to login
    if (!isset($_SESSION["email"])){
      Header("Location: login.php");
    }
    // get id product from address bar , method get
    $id = $_GET["id"];
    
    require("connection.php");

    $query = "select idproduct,
	product.name name, 
    photos, 
    price, 
    FORMAT(price*1.23, 2) price_vat,
	category.name category,
    product.dt_created dt_created
    from product, category
    where category_idcategory = idcategory 
    and idproduct = $id";

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
            
        <?php
            $row = mysqli_fetch_assoc($results);

                $id =     $row["idproduct"];
                $name =   $row["name"];
                $image =  $row["photos"];
                $price =  $row["price"];
                $price_vat = $row["price_vat"];
                $category = $row["category"];
                $date      = $row["dt_created"];

                echo "<div>";
                echo "<p class='display-3'>$name</p>";
                echo "<p><img src='$image' /></p>";
                echo "<p>Price: $price € ($price_vat €)</p>";
                echo "<p class='badge bg-secondary'>$category</p>";
                echo "<p>$date</p>";
                echo "</div>";
            

        ?>


    </div>
    
    <?php
        require("footer.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>