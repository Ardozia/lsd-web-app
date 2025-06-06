<?php
require "./components/auth.php";
require "./components/connection.php";

$pageName = 'search';

$noresults = false;
$msgType = "";

// check if user is searching
if (isset($_GET["submit"])) {

  $searchString = $_GET["searchString"];

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
        category_idcategory = idcategory and p.name like '%$searchString%' ";

  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) == 0) {
    // no results
    $noresults = true;
    $msgType = "info";
  }
} else {
  $result = [];
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="css/styles.css" >  
</head>

<body class="vh-100 d-flex flex-column justify-content-between">

  <?php include "./components/header.php"; ?>

  <div class="container">
    <h1>Nexio Search Page</h1>
    <h3>Pesquisa de Produtos</h3>
    <form>
      <input class="form-control" name="searchString" placeholder="Pesquise aqui ..." value="<?php
                                                                                              if (isset($searchString))
                                                                                                echo $searchString;
                                                                                              ?>" />
      <button type="submit" class="btn btn-primary" name="submit">Pesquisar</button>
    </form>

    <div class="alert alert-<?php echo $msgType; ?>">
      <?php
      if ($noresults)
        echo "Sem resultados";
      ?>
    </div>

    <div id="list" class="row g-2 row-cols-1 row-cols-md-2 row-cols-xl-3">


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
          <div class="card" style="">
            <img src="<?php echo $targetDir.$product["photos"]; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $product["pname"]; ?></h5>
              <p class="badge text-bg-secondary"><?php echo $product["cname"]; ?></p>
              <p class="card-text">Price:</p>
              <p class="card-text"><?php echo round($product["price_vat"], 2) . "€ (" . $product["price"] . "€)"; ?></p>

              <a href="productDetail.php?id=<?php echo $product["idproduct"]; ?>" class="btn btn-primary">Detalhes</a>
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
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
  <script>
    // Initialize Masonry
    var msnry;
    document.addEventListener("DOMContentLoaded", function() {
      msnry = new Masonry('#list', {
        itemSelector: '.col',
        percentPosition: true
      });

      // Refresh after images load
      imagesLoaded('#list', function() {
        msnry.layout();
      });

      window.msnry = msnry;
    });

    // Refresh function
    // function refreshMasonry() {
    //   if (msnry) {
    //     msnry.reloadItems();
    //     msnry.layout();
    //   }
    // }
  </script>
</body>

</html>