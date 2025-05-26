<?php
require("./components/auth.php");
require("./components/connection.php");

$query = "select
  idcategory,
  name 
    from 
  category";

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    // no results
    $noresults = true;
    $msgType = "info";
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
    <style>
        .catdiv {
            background-image: url(images/categories/default-category-image.jpg);
            background-size: cover;
        }
    </style>
</head>

<body class="vh-100 d-flex flex-column">

    <?php include "./components/header.php"; ?>

    <div class="container-fluid flex-grow-1 p-0">
        <div class="catdiv position-fixed p-3 z-3 bg-body-secondary w-100 s-0" style="clip-path: polygon(0 0, 100% 0%, 100% 80%, 0% 100%);">
            <h1>Nexio - Categorias</h1>
            <h3>Lista de Produtos</h3>
            <form class="w-25">
                <select id="selectedCategory" class="form-select" aria-label="Default select example">
                    <option selected>Escolha uma categoria</option>
                    <?php
                    foreach ($result as $category) {
                        $id = $category["idcategory"];
                        $name = $category["name"];
                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
                <!-- <button type="submit" class="btn btn-primary" name="submit">Pesquisar</button> -->
            </form>
        </div>
        <div class="container">
            <div style="height: 200px;"></div>
            <div id="list" class="row g-2 row-cols-1 row-cols-md-2 row-cols-xl-3">

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "./components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Masonry plugin -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
    <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.min.js"></script>
    <script>
        $(document).ready(function() {

            var msnry;

            $('#selectedCategory').on("change", function(e) {

                $.get('categoryProducts.php', {
                    categoryId: e.target.value
                }, function(data) {
                    $('#list').html(data)

                    msnry = new Masonry('#list', {
                        itemSelector: '.col',
                        percentPosition: true
                    });

                    // Refresh after images load
                    imagesLoaded('#list', function() {
                        msnry.layout();
                    });

                })

            })

        });
    </script>
</body>

</html>