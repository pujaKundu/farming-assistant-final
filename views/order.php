<?php

include '../init.php';

$orderPlaced = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $product = Database::connect()->table('products')
        ->select('products.id, products.name, products.image, products.price, users.name as username')
        ->join('users', 'users.id', 'products.user_id')
        ->where('products.id', '=', $id)
        ->get()[0];

}

if (isset($_POST['submit'])) {

    Database::connect()->table('orders')
        ->insert([
            'product_id' => $product->id,
            'user_id' => Auth::getUser()->id,
            'quantity' => $_POST['quantity']
        ]);

    $orderPlaced = true;

}


?>

<html lang="en">
<head>
    <title>Place Order</title>
    <link rel="stylesheet" href="../assets/main.css">

</head>
<body>
<?php require './partials/navbar.php' ?>
<div class="container">
    <?php if ($orderPlaced) { ?>
        <div class="card">
            <p>Order Successfully Placed</p>
            <a href="/views/products.php">View More Products</a>
        </div>
    <?php } ?>
    <form method="post" action="">
        <div class="card">
            <div class="card-header">
                <h3>Place Order</h3>
            </div>
            <div class="row">
                <table>
                    <tr>
                        <th>
                            Selected Product
                        </th>
                        <td>
                            <?php echo $product->name ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="align-left">
                            Unit Price
                        </th>
                        <td>
                            <?php echo $product->price ?>
                        </td>
                    </tr>
                </table>
                <div class="col">
                    <p>Quantity</p>
                    <input name="quantity" type="number"/>
                </div>
                <button type="submit" name="submit">Confirm Order</button>
            </div>
        </div>
    </form>


</div>
</body>
</html>
