<?php
if (isset($_SESSION["name"])) {
  $username = $_SESSION["name"];
  $avatar = $_SESSION["avatar"];
  $id = $_SESSION["id"];
  $role = $_SESSION["role"];
}

// Get the base URL dynamically
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
// If we're in a subdirectory like backoffice, go up one level
if (basename(dirname($_SERVER['SCRIPT_NAME'])) === 'backoffice') {
  $base_path = dirname($base_path);
}
?>

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="<?php echo $base_path; ?>/images/logo.jpg" alt="logo" style="height: 30px;" />
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
          <li class="nav-item">
            <a class="nav-link <?php if($pageName == 'main') echo 'menuSelected' ?>" aria-current="page" href="<?php echo $base_path; ?>/main.php">Lista</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($pageName == 'search') echo 'menuSelected' ?>  " href="<?php echo $base_path; ?>/search.php">Pesquisa</a>
          </li>
          <li class="nav-item me-auto">
            <a class="nav-link <?php if($pageName == 'category') echo 'menuSelected' ?> " href="<?php echo $base_path; ?>/category.php">Categorias</a>
          </li>
          <?php if (isset($role) && $role == "admin") { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="rounded-circle" style="object-fit: cover; width:30px; height:30px;" src="<?php echo $base_path.$avatar; ?>" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?php echo $base_path; ?>/backoffice/profile.php"><?php echo $username; ?></a></li>
                <li><a class="dropdown-item" href="<?php echo $base_path; ?>/backoffice/manage_products.php">Gerir Produtos</a></li>
                <li><a class="dropdown-item" href="<?php echo $base_path; ?>/backoffice/manage_categories.php">Gerir Categorias</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo $base_path; ?>/backoffice/logout.php">Logout <i class="bi bi-box-arrow-left"></i></a></li>
              </ul>
            </li>
          <?php }; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>