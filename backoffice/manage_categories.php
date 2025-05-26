<?php
require("../components/auth.php");
require("../components/connection.php");

$msg = "";
$msgType = "";

if (isset($_GET["msg"])) {
  $msg = $_GET["msg"];
  $msgType = $_GET["type"];
}

$query = "select idcategory, name from category";
$result = mysqli_query($connection, $query);

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestão Categorias</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style type="text/css">
    .card-img-top {
      object-fit: cover;
      width: 200px;
      height: 200px;

    }
  </style>

</head>

<body>
  <?php include "../components/header.php"; ?>

  <div class='container'>
    <div class="alert alert-<?php echo $msgType; ?>" role="alert">
      <?php echo $msg; ?>
    </div>
    <div class="row">
      <div class="col-12 col-lg-6">
        <h2>Lista de categorias </h2>
        <p class="fs-6">Para eliminar uma categoria, ela não poderá conter produtos</p>
        <div>
          <a href="./upsertCategory.php" class="btn btn-primary mb-3"><i class="bi bi-plus-circle"></i>Nova</a>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // create link for users
              foreach ($result as $cat) {
                $idcat = $cat["idcategory"];
                $name = $cat["name"];

                echo "<tr>";
                echo "  <td>$name</td>";
                echo "  <td><a class='me-1 btn btn-outline-primary' href='./upsertCategory.php?id=$idcat'><i class='bi bi-pencil-square'></i></a> ";
                echo " <button type='button' class='btn btn-outline-danger' data-bs-toggle='popover' data-bs-title='Eliminar categoria?' data-bs-html='true' data-bs-content=\"<a href='#' class='btn btn-secondary btn-sm me-2 popover-cancel'>Cancelar</a><a href='./deleteCategory.php?id=$idcat' class='btn btn-danger btn-sm'>Eliminar</a>\"><i class='bi bi-trash'></i></button></td>";

                echo "</tr>";
              };
              ?>
            </tbody>
          </table>
        </div>

      </div>
      <div class="col"></div>

    </div>
  </div>

  <!-- Footer -->
  <?php include "../components/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    // Initialize popover
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

    // Delegate click for cancel button inside popover
    document.body.addEventListener('click', function(e) {
      if (e.target.classList.contains('popover-cancel')) {
        // Find the open popover and hide it
        popoverList.forEach(pop => pop.hide());
        e.preventDefault();
      }
    });
  </script>
</body>

</html>