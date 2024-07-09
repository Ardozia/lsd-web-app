<?php
require "connection.php";

$noresults = false;
$msgType = "";

if (isset($_GET["categoryId"])) {

    $id = $_GET["categoryId"];

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
        category_idcategory = idcategory and idcategory = $id ";

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

<?php
foreach ($result as $product) {

?>
    <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card ">
            <img src="<?php echo $product["photos"]; ?>" class="card-img-top" alt="...">
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