<?php
  session_start();

    // If there is no session active redirects to login
  if (!isset($_SESSION["email"])){
    Header("Location: login.php");
  }



  if (isset($_GET["submit"])){

    require ("connection.php");

    $searchTerm = $_GET["searchTerm"];
    $query = "select 
    product.name name, 
      photos, 
      price, 
      FORMAT(price*1.23, 2) price_vat,
    category.name category
  from product, category
  where category_idcategory = idcategory and product.name like '%$searchTerm%'";

    $results = mysqli_query($connection, $query);

  }


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
        <h1 class="display-3">Pesquisa de produtos</h1>
    
        <form>
        <div class="mb-3">
        
            <input type="text" class="form-control" id="searchTerm"
            name="searchTerm"
            aria-describedby="emailHelp">
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Search</button>
    </form>

    <?php
      if (isset($_GET["submit"])){
        echo "<p class='display-5'>Resultados da pesquisa por <span class='fw-bold'>'$searchTerm'</span></p>";
      }
    ?>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
        <?php
         if (isset($_GET["submit"])){
            foreach($results as $row){
                $name =   $row["name"];
                $image =  $row["photos"];
                $price =  $row["price"];
                $price_vat = $row["price_vat"];
                $category = $row["category"];

                echo "<div class='col'>";
                echo "  <p class='fs-6'>$name</p>";
                echo "  <img src='$image' />";
                echo "  <p>$price € ($price_vat €)</p>";
                echo "  <p class='badge bg-secondary'>$category</p>";
                echo "</div>";
            }
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