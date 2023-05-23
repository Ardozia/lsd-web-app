<?php 
    
    session_start();

      // If there is no session active redirects to login
    if (!isset($_SESSION["email"])){
      Header("Location: login.php");
    }
  
    
    require("connection.php");

    $query = "select idproduct,
	product.name name, 
    photos, 
    price, 
    FORMAT(price*1.23, 2) price_vat,
	category.name category
from product, category
where category_idcategory = idcategory";

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
        <h1 class="display-3">Lista de produtos</h1>
    
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php
            foreach($results as $row){
                $id =     $row["idproduct"];
                $name =   $row["name"];
                $image =  $row["photos"];
                $price =  $row["price"];
                $price_vat = $row["price_vat"];
                $category = $row["category"];

                echo "<div class='col'>";
                echo "  <p class='fs-6'><a href='productDetail.php?id=$id'>$name</a></p>";
                echo "  <img src='$image' />";
                echo "  <p>$price € ($price_vat €)</p>";
                echo "  <p class='badge bg-secondary'>$category</p>";
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