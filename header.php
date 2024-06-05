<?php
if (isset($_SESSION["name"])) {
  $username = $_SESSION["name"];
  $avatar = $_SESSION["avatar"];
  $id = $_SESSION["id"];
}
?>

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="./images/logo.jpg" alt="logo" style="height: 30px;" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./main.php">Lista</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./search.php">Pesquisa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./category.php">Categorias</a>
          </li>

          <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") { ?>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
          <?php } ?>

          <li class="nav-item d-flex ms-auto">
            <a class="nav-link" href="profile.php?id=<?php echo $id; ?>"><?php echo $username; ?></a>
            <a class="nav-link" href="logout.php">
              <i class="bi bi-box-arrow-right"></i>
            </a>
            <img class="rounded-circle" style="object-fit: cover; width:30px; height:30px;" src="<?php echo $avatar; ?>" />
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>