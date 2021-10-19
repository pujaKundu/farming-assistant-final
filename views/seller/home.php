<?php

include ('../../init.php');
//only farmer can visit this page

if(!Auth::hasRole('seller')){
    header('Location: /views/seller/login.php');
}

$products = Database::connect()
    ->table('products')
    ->join('users', 'users.id', 'products.user_id')
    ->select('products.id, products.name, users.name as username, products.image, products.price')
    ->where('users.id', '=',Auth::getUser()->id )
    ->get();

$orders = Database::connect()->table('orders')
    ->select('products.id, products.name, 
    products.price, users.name as username, orders.quantity')
    ->join('products', 'products.id', 'orders.product_id')
    ->join('users', 'users.id', 'orders.user_id')
    ->where('products.user_id', '=', Auth::getUser()->id)
    ->get();



?>


<html lang="en">
    <head>
        <title>Home | Seller</title>
        <link rel="stylesheet" href="../../assets/main.css" />
    </head>
    <body>
        <div>
            <?php include '../partials/navbar.php'?>
        </div>
        <div class="seller-header">
            <div class="header-content">
                <h2>Welcome to Seller Section</h2>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>My Recent Products</h4>
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

                    foreach ($products as $product){ ?>
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
                            <a href="<?php echo '/views/seller/edit_products.php?id='.$product->id?>">Edit/Delete</a>
                        </td>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Products Order</h4>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Ordered by
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($orders as $order){ ?>
                    <tr>
                        <td>
                            <?php echo $order->name ?>
                        </td>
                        <td>
                            <?php echo $order->price ?>
                        </td>
                        <td>
                            <?php echo $order->quantity ?>
                        </td>
                        <td>
                            <a href=""
                            <?php echo $order->username ?>
                        </td>

                        <?php } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </body>
</html>