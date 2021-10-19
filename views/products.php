<?php
require_once '../init.php';

$products = Database::connect()
    ->table('products')
    ->join('users', 'users.id', 'products.user_id')
    ->select('products.id, products.name, users.name as username, products.image, products.price')
    ->get();
?>

<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../assets/main.css"/>
</head>
<body>
<?php require '../views/partials/navbar.php' ?>
<div class="container">
    <div>
        <h3> Product lists </h3>
        <?php if (Auth::hasRole('seller')) { ?>
            <a href="/views/seller/add_products.php">Add Product</a>
        <?php } ?>
    </div>

    <?php
    foreach ($products as $product) {
        echo "<div class='card'>
                <div class='display-flex'>
                    <div class='product-image-container'>
                    <img class='product-image' src=/assets/images/{$product->image}  alt={$product->name} />
                    </div>
                    <div>
                        <a class='link' href=../views/product.php?id={$product->id}> {$product->name} </a> 
                        <h6>BDT {$product->price}</h6>
                    </div>
                     
                </div>
                
                </div>";
    }

    ?>
</div>
</body>
</html>
