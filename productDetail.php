<?php
  require "auth.php";

   $id = $_GET["id"];
    // Validações
    // se não vier nenhum id redirect to main.php
    if (!isset($id)) {
        Header("Location: main.php");
    }

    require "connection.php";

    // id do produto a consultar o detalhe
 

    $query = "select
    idproduct,
    p.name pname, 
    photos, 
    price, 
    price*1.23 price_vat, 
    c.name cname,
    p.dt_created pdt
    from 
      product p, category c
    where
      category_idcategory = idcategory
      and idproduct = $id";

    //    echo $query 
    $result = mysqli_query($connection, $query);
    
    // valida se id do produto existe em BD
    if (mysqli_num_rows($result) == 0) {
        echo "Produto não existe";
        exit;
    }
    
    // lê info do produto
    $product = mysqli_fetch_assoc($result);
    $id = $product["idproduct"];
    $name = $product["pname"];
    $photos = $product["photos"];
    $price = $product["price"];
    $price_vat = $product["price_vat"];
    $category = $product["cname"];
    $date = $product["pdt"];
?>




<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


  <title><?php echo $name; ?></title>

  <style type="text/css">
    .prod-img {
        background-image: url("<?php echo $photos; ?>");
        background-size: cover;
        background-position: center center;
        height: 200px;
    }
  </style>

</head>

<body>
  <?php include "header.php"; ?>
  
  <div class='container-fluid'>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="main.php">Main</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $name;?></li>
            </ol>
        </nav>
    </div>
    <div class="prod-img p-3">
        <p class="display-1 text-white"><?php echo $name; ?></p>
    </div>    
    <div class="container my-3">
        <div class="d-flex justify-content-end ">
            <p class="badge bg-secondary display-5 "><?php echo $category; ?></p>
        </div>
        <p class="fs-6">Preço: <span class="fw-bold"><?php echo $price_vat; ?>€ (<?php echo $price; ?>€)</span></p>
        <p class="fs-6">Data: <span><?php echo $date; ?></span></p>
        
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
          <div>
            <a class="link-offset-3" href="./upsertProduct.php?id=<?php echo $id;?>">Editar</a>
          </div>
        <?php } ?>
    </div>

</div>
    <!-- Footer -->
    <?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>