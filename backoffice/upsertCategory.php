<?php
require "../components/auth.php";
require "../components/connection.php";

$targetDir = "../images/categories/";

$idcategory = 0;
$name = "";
$description = "";
$image = "default-category-image.jpg";

$msg = "";
$msgType = "";

if (isset($_POST["submit"])) {

  $name = mysqli_real_escape_string($connection, $_POST["name"]);
  $description = mysqli_real_escape_string($connection, $_POST["description"]);
  $idcategory = mysqli_real_escape_string($connection, $_POST["idcategory"]);
  $image = mysqli_real_escape_string($connection, $_POST["currentImage"]);

  // process image
  if (isset($_FILES["image"])) {
    if ($_FILES["image"]["tmp_name"] !== "") {

      $target_file = $targetDir . $idcategory . "-" . basename($_FILES["image"]["name"]);
      $target_filename = $idcategory . "-" . basename($_FILES["image"]["name"]);

      // check if uploaded file is an image
      $size = getimagesize($_FILES["image"]["tmp_name"]);
      if (empty($size)) {
        $msgType = "danger";
        $msg = "Imagem inválida";
      } else {

        // todo: check size of file

        // todo: change image resolution

        $check = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        if ($check) {
          // upload ok
          $image = $target_filename;
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
    if ($idcategory > 0) {
      $query = "update category 
                set 
                name = '$name',
                description = '$description',
                image = '$image'
                where idcategory = $idcategory";

      mysqli_query($connection, $query);
      if (mysqli_affected_rows($connection) == 1) {
        // sucesso
        $msg = "Atualizado com sucesso";
        $msgType = "success";
      } else {
        // erro
        $msg = "Erro ao atualizar";
        $msgType = "danger";
      }
    }
    // modo de insert
    else {
      $query = "insert into category
    (name, description, image, dt_created)
    values
    ('$name', '$description', '$image', NOW())";

      mysqli_query($connection, $query);
      // obtem id do produto criado
      $idcategory = mysqli_insert_id($connection);

      if (mysqli_affected_rows($connection) == 1) {
        // sucesso
        $msg = "Criado com sucesso";
        $msgType = "success";
      } else {
        // erro
        $msg = "Erro ao criar";
        $msgType = "danger";
      }
    }
  }
}

// mode de edit from productDetail
if (isset($_GET["id"])) {

  $idcategory = $_GET["id"];
  // query db for product id
  $query = "select name, description, image
    from category where idcategory = $idcategory";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  $name = $row["name"];
  $description = $row["description"];
  $image = $row["image"];
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gerir categoria</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style type="text/css">
  </style>

</head>

<body>

  <?php include "../components/header.php"; ?>

  <div class='container'>

    <div class="alert alert-<?php echo $msgType; ?>" role="alert">
      <?php echo $msg; ?>
    </div>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="manage_categories.php">Categorias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar categoria</li>
      </ol>
    </nav>
    <form method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md">
          <div class="mb-3">
            <input type="hidden" id="idcategory" name="idcategory" class="form-control" required value="<?php echo $idcategory; ?>" />
            <label for="prodname" class="form-label">Nome da categoria</label>
            <input type="text" id="name" name="name" class="form-control" required value="<?php echo $name; ?>" />
          </div>
          <div class="mb-3">
            <div class="form-floating">
              <textarea class="form-control" placeholder="Breve descrição" id="description" name="description" style="height: 100px"><?php echo $description; ?></textarea>
              <label for="floatingTextarea2">Descrição</label>
            </div>
          </div>
        </div>
        <div class="col-md">
          <input type="hidden" name="currentImage" value="<?php echo $image; ?>" />
          <img class="image img-fluid" src="../images/categories/<?php echo $image; ?>" />
          <input type="file" class="form-control" name="image" onchange="readImage(this);" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">
        <?php
        if ($idcategory > 0)
          echo "Atualizar";
        else
          echo "Criar"; ?>
      </button>
    </form>
  </div>

  <!-- Footer -->
  <?php include "../components/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    function readImage(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        let image = document.querySelector(".image");

        reader.onload = function(event) {
          image.src = event.target.result
        }
        reader.readAsDataURL(input.files[0])
      }
    }
  </script>
</body>

</html>