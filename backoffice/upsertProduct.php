<?php
require "./components/auth.php";
require "./components/connection.php";

$targetDir = "./images/products/";
$idproduct = 0;

$name = "";
$price = "";
$category = "";
$image = "./images/default-image.jpg";

$msg = "";
$msgType = "";

$query =  "select idcategory, name from category";
$result = mysqli_query($connection, $query);

if (isset($_POST["submit"])) {

  $name = mysqli_real_escape_string($connection, $_POST["prodname"]);
  $price = mysqli_real_escape_string($connection, $_POST["prodprice"]);
  $category = mysqli_real_escape_string($connection, $_POST["prodcategory"]);
  $idproduct = mysqli_real_escape_string($connection, $_POST["prodid"]);
  $image = mysqli_real_escape_string($connection, $_POST["prodImageUpdate"]);

  // Ler product image
  if (isset($_FILES["prodimage"])) {
    if ($_FILES["prodimage"]["tmp_name"] !== "") {

      $target_file = $targetDir . $idproduct . "-" . basename($_FILES["prodimage"]["name"]);

      // check if uploaded file is an image
      $size = getimagesize($_FILES["prodimage"]["tmp_name"]);
      if (empty($size)) {
        $msgType = "danger";
        $msg = "Imagem de produto inválida";
      } else {

        // todo: check size of file

        // todo: change image resolution

        $check = move_uploaded_file($_FILES["prodimage"]["tmp_name"], $target_file);

        if ($check) {
          // upload ok
          $image = $target_file;
        } else {
          $msgType = "danger";
          $msg = "Erro ao carregar imagem";
        }
      }
    }
  }

  if ($msgType != "danger") {
    // se existe id vamos fazer update
    // mode update
    if ($idproduct > 0) {
      $query = "update product 
                set 
                name = '$name',
                price = $price,
                category_idcategory = $category,
                photos = '$image'
                where idproduct = $idproduct";

      mysqli_query($connection, $query);
      if (mysqli_affected_rows($connection) == 1) {
        // sucesso
        $msg = "Produto atualizado com sucesso";
        $msgType = "success";
      } else {
        // erro
        $msg = "Erro ao atualizar produto";
        $msgType = "danger";
      }
    }
    // modo de insert
    else {
      $query = "insert into product
    (name, price, category_idcategory, photos, dt_created)
    values
    ('$name', $price, $category, '$image', NOW())";

      mysqli_query($connection, $query);
      // obtem id do produto criado
      $idproduct = mysqli_insert_id($connection);

      if (mysqli_affected_rows($connection) == 1) {
        // sucesso
        $msg = "Produto criado com sucesso";
        $msgType = "success";
      } else {
        // erro
        $msg = "Erro ao criar produto";
        $msgType = "danger";
      }
    }
  }
}

// mode de edit from productDetail
if (isset($_GET["id"])) {

  $idproduct = $_GET["id"];
  // query db for product id
  $query = "select name, price, category_idcategory, photos
    from product where idproduct = $idproduct";
  $resultProduct = mysqli_query($connection, $query);
  $product = mysqli_fetch_assoc($resultProduct);
  $name = $product["name"];
  $price = $product["price"];
  $category = $product["category_idcategory"];
  $image = $product["photos"];
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Criar produto</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style type="text/css">
  </style>

</head>

<body>

  <?php include "./components/header.php"; ?>

  <div class='container'>

    <div class="alert alert-<?php echo $msgType; ?>" role="alert">
      <?php echo $msg; ?>
    </div>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="main.php">Main</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo produto</li>
      </ol>
    </nav>
    <form method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md">
          <div class="mb-3">
            <input type="hidden" id="prodid" name="prodid" class="form-control" required value="<?php echo $idproduct; ?>" />
            <label for="prodname" class="form-label">Nome do produto</label>
            <input type="text" id="prodname" name="prodname" class="form-control" required value="<?php echo $name; ?>" />
          </div>
          <div class="mb-3">
            <label for="prodprice" class="form-label">Preço</label>
            <input type="number" step="0.01" id="prodprice" name="prodprice" class="form-control" required value="<?php echo $price; ?>" />
          </div>
          <div class="mb-3">
            <label for="prodcategory" class="form-label">Categoria</label>
            <select class="form-select" name="prodcategory">
              <?php
              foreach ($result as $cat) {
                $idcat = $cat["idcategory"];
                $namecat = $cat["name"];
                if ($idcat == $category)
                  echo "<option selected value='$idcat'>$namecat</option>";
                else
                  echo "<option value='$idcat'>$namecat</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="col-md">
          <input type="hidden" name="prodImageUpdate" value="<?php echo $image; ?>" />
          <img class="prodimage img-fluid" src="<?php echo $image; ?>" />
          <input type="file" class="form-control" name="prodimage" onchange="readImage(this);" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">
        <?php
        if ($idproduct > 0)
          echo "Atualizar";
        else
          echo "Criar"; ?>
      </button>
    </form>
  </div>

  <!-- Footer -->
  <?php include "./components/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    function readImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        let image = document.querySelector(".prodimage");

        reader.onload = function(event) {
          image.src = event.target.result
        }
        reader.readAsDataURL(input.files[0])

      }
    }
  </script>
</body>

</html>