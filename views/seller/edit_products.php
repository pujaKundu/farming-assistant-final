<?php

require_once '../../init.php';

//count is same as arr.length
$productId = $_GET['id']; //$parsed[count($parsed) - 1];
//get single product
$product = Database::connect()->table('products')
    ->select('products.name, products.image,  products.price, users.name as username')
    ->join('users', 'users.id', 'products.user_id')
    ->where('products.id', '=', $productId)
    ->get()[0];

if (isset($_POST['update-button'])) {

    Database::connect()->table('products')
        ->where('id', '=', $productId)
        ->update([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
        ]);

    header('Location: /views/seller/my_products.php');

}

if(isset($_POST['delete-button'])){
    Database::connect()
        ->table('products')
        ->where('id', '=', $productId)
        ->delete();
    header('Location: /views/seller/my_products.php');
}

?>

<html lang="en">
<head>
    <title>
        Product
    </title>
    <link rel="stylesheet" href="../../assets/main.css"/>
</head>
<body>
<?php require '../partials/navbar.php' ?>
<div class="container">
    <div class="card">
        <form action="" method="post">
            <div class="card-header">
                <h5>Update Product</h5>
                <button type="submit" name="delete-button">Delete Product</button>
            </div>
        </form>

        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <p>Product Name</p>
                    <input name="name" type="text" value="<?php echo $product->name ?> "/>
                </div>
                <div class="col">
                    <p>Price</p>
                    <input name="price" type="number" value="<?php echo $product->price ?>"/>
                </div>
                <button type="submit" name="update-button">Update</button>
            </div>

        </form>

    </div>

</div>
<script>

</script>
</body>
</html>