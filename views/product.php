<?php

require_once '../init.php';

//count is same as arr.length
$productId = $_GET['id'];
$alert = '';
$product = Database::connect()->table('products')
    ->select('products.id, products.name, products.image, products.description,
    products.price, users.name as username')
    ->join('users', 'users.id', 'products.user_id')
    ->where('products.id', '=', $productId)
    ->get()[0];

if (isset($_POST['submit'])) {

    Database::connect()->table('orders')
        ->insert([
            'product_id' => $product->id,
            'user_id' => Auth::getUser()->id,
        ]);
    $alert = 'Order Successfully Placed';
}


?>

<html lang="en">
<head>
    <title>
        Product
    </title>
    <link rel="stylesheet" href="../assets/main.css"/>
</head>
<body>
<?php require '../views/partials/navbar.php' ?>
<div class="container">

    <div class="alert">
        <?php echo $alert ?>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-3">
                <div>
                    <img class="product-image" src="<?php echo '/assets/images/' . $product->image ?>"/>
                </div>
            </div>
            <div class="col-9">
                <h4><?php echo $product->name ?></h4>
                <h5>BDT <?php echo $product->price ?></h5>
                <div>
                    <h5>Details</h5>
                    <p> <?php echo $product->description ?></p>
                </div>
                <a href="<?php echo '/views/order.php?id='.$product->id?>">Order Now</a>
                <!--<form method="post">
                    <button type="submit" name="submit">Order Now</button>
                </form>-->
            </div>
        </div>

    </div>

</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>