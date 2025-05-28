<?php
require "./components/auth.php";
require "./components/connection.php";

$pageName = 'main';

$msg = "";
$msgType = "";

// if delete submit
if (isset($_POST["submit"])) {
  $id = $_POST["idToDelete"];

  $query = "update product set available = 0 where idproduct = $id";
  mysqli_query($connection, $query);

  if (mysqli_affected_rows($connection) == 1) {
    $msg = "Produto eliminado";
    $msgType = "warning";
  } else {
    $msg = "Erro ao eliminar produto";
    $msgType = "danger";
  }
}


$query = "select
    idproduct,
    p.name pname, 
    photos, 
    price, 
    price*1.23 price_vat, 
    c.name cname 
    from 
      product p, category c
    where
      available = 1 and
      category_idcategory = idcategory";

$result = mysqli_query($connection, $query);

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nexio product listing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/styles.css" >
</head>

<body>

  <?php include "./components/header.php"; ?>

  <div class="container">

    <div class="alert alert-<?php echo $msgType; ?>" role="alert">
      <?php echo $msg; ?>
    </div>

    <h1>Nexio Main Page</h1>
    <h3>Lista de Produtos</h3>

    <div class="row g-2 row-cols-1 row-cols-md-2 row-cols-xl-3">
      <!-- PHP para criar um ciclo de impressão de produtos -->
      <?php
      foreach ($result as $product) {

          if (substr($product["photos"], 0, 4) == 'http') {
            $targetDir = "";
          } else {
            $targetDir = "./images/products/";
          }

      ?>
        <div class="col">
          <div class="card" class="" style="">
            <img src="<?php echo $targetDir.$product["photos"]; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $product["pname"]; ?></h5>
              <p class="badge text-bg-secondary"><?php echo $product["cname"]; ?></p>
              <p class="card-text">Price:</p>
              <p class="card-text"><?php echo round($product["price_vat"], 2) . "€ (" . $product["price"] . "€)"; ?></p>

              <div class="d-flex">
                <div>
                  <a href="productDetail.php?id=<?php echo $product["idproduct"]; ?>" class="btn btn-primary">Detalhes</a>
                </div>
                <div class="mx-2">
                  <form method="post">
                    <input type="hidden" name="idToDelete" value="<?php echo $product["idproduct"]; ?>" />
                    <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
                      echo  '<button type="submit" name="submit" class="btn btn-outline-danger">Eliminar</button>';
                    }
                    ?>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      <?php
      }
      ?>


    </div>

  </div>
  <!-- Footer -->
  <?php include "./components/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>