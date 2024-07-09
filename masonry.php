<?php
require "auth.php";
require "connection.php";

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
    <<<<<<< HEAD <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>Masonry example · Bootstrap v5.0</title>

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <meta name="theme-color" content="#7952b3">


        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>


</head>

<body>

    <main class="container py-5">
        <h1>Bootstrap and Masonry</h1>
        <p class="lead">Integrate <a href="https://masonry.desandro.com/">Masonry</a> with the Bootstrap grid system and cards component.</p>

        <p>Masonry is not included in Bootstrap. Add it by including the JavaScript plugin manually, or using a CDN like so:</p>

        <pre><code>
&lt;script src=&quot;https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js&quot; integrity=&quot;sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D&quot; crossorigin=&quot;anonymous&quot; async&gt;&lt;/script&gt;
  </code></pre>

        <p>By adding <code>data-masonry='{"percentPosition": true }'</code> to the <code>.row</code> wrapper, we can combine the powers of Bootstrap's responsive grid and Masonry's positioning.</p>

        <hr class="my-5">

        <div class="row" data-masonry='{"percentPosition": true }'>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                    </svg>

                    <div class="card-body">
                        <h5 class="card-title">Card title that wraps to a new line</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card p-3">
                    <figure class="p-3 mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                    </svg>

                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card bg-primary text-white text-center p-3">
                    <figure class="mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-white">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has a regular title and short paragraph of text below it.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <svg class="bd-placeholder-img card-img" width="100%" height="260" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Card image" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Card image</text>
                    </svg>

                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card p-3 text-end">
                    <figure class="mb-0">
                        <blockquote class="blockquote">
                            <p>A well-known quote, contained in a blockquote element.</p>
                        </blockquote>
                        <figcaption class="blockquote-footer mb-0 text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous"></script>
    =======
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* .card img {
            height: 100px;
        } */
    </style>
    </head>

    <body class="vh-100 d-flex flex-column">

        <?php include "header.php"; ?>

        <div class="container-fluid flex-grow-1 p-0">
            <div class="position-fixed p-3 z-3 bg-body-secondary w-100 s-0" style="clip-path: polygon(0 0, 100% 0%, 100% 80%, 0% 100%);">
                <h1>Nexio - Categorias</h1>
                <h3>Lista de Produtos - masonry</h3>
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

                <div id="list" class="row" data-masonry='{"percentPosition": true }'>

                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/243x100.png/cc0000/ffffff" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">RE NUTRIV RADIANT UV BASE</h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">624.19€ (507.47€)</p>

                                <a href="productDetail.php?id=1" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/199x100.png/dddddd/000000" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Topcare childrens pain and fever</h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">671.51€ (545.94€)</p>

                                <a href="productDetail.php?id=2" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/113x100.png/dddddd/000000" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Givenchy Fluid Foundation Airy-light Mat Radiance SPF 20 Tint 8
                                </h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">15.23€ (12.38€)</p>

                                <a href="productDetail.php?id=10" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/121x100.png/ff4444/ffffff" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">INDOMETHACIN</h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">589.49€ (479.26€)</p>

                                <a href="productDetail.php?id=12" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/228x100.png/cc0000/ffffff" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Pioglitazone Hydrochloride and Metformin Hydrochloride</h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">1082.3€ (879.92€)</p>

                                <a href="productDetail.php?id=14" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-4">
                        <div class="card ">
                            <img src="http://dummyimage.com/199x100.png/ff4444/ffffff" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Gabapentin</h5>
                                <p class="badge text-bg-secondary">Naproxen</p>
                                <p class="card-text">Price:</p>
                                <p class="card-text">851.47€ (692.25€)</p>

                                <a href="productDetail.php?id=21" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include "footer.php"; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- Masonry plugin -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
        <script>
            // $('#list').masonry({
            //     // options
            //     itemSelector: '.card',
            //     columnWidth: 200
            // });

            $('#selectedCategory').on("change", function(e) {

                $.get('categoryProducts.php', {
                    categoryId: e.target.value
                }, function(data) {
                    $('#list').html(data)
                    $('#list').masonry()
                    // $('#list').masonry('layout')
                    $('#list').masonry('reloadItems')
                    $('#list').masonry('layout')


                })

            })
        </script>
        >>>>>>> ed30097f4a3781fb395cf5be9750b1320d742453
    </body>

</html>