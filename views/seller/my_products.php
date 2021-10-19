<?php
require_once '../../init.php';

if (!Auth::hasRole('seller')) {
    header("Location: /views/403.php");
}

$user = Auth::getUser();

$products = Database::connect()
    ->table('products')
    ->join('users', 'users.id', 'products.user_id')
    ->select('products.id, products.name, users.name as username, products.image, products.price')
    ->where('users.id', '=', $user->id)
    ->get();

?>

<html lang="en">
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../../assets/main.css"/>
</head>
<body>
<?php require '../partials/navbar.php' ?>
<div class="container">
    <div>
        <h3> Product lists </h3>
        <a href="/views/seller/add_products.php">Add Product</a>
    </div>


    <table class="table">
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Image
            </th>
            <th>
                Price
            </th>
            <th>
                Actions
            </th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($products

        as $product){ ?>
        <tr>
            <td>
                <?php echo $product->name ?>
            </td>
            <td>
                <?php echo $product->image ?>
            </td>
            <td>
                <?php echo $product->price ?>
            </td>
            <td>
                <a href="<?php echo '/views/seller/edit_products.php?id=' . $product->id ?>">Edit/Delete</a>
            </td>
            <?php } ?>

        </tbody>
    </table>


</div>
</body>
</html>
