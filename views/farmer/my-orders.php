<?php
    require_once '../../init.php';
    $orders = Database::connect()->table('orders')
                ->select('products.id, products.name, orders.quantity, products.price, users.name as username')
                ->join('products', 'products.id', 'orders.product_id')
                ->join('users', 'users.id', 'orders.user_id')
                ->get();
?>

<html lang="en">
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="../../assets/main.css">
</head>
<body>

<div>
    <?php include '../partials/navbar.php' ?>
    <h2>My orders</h2>
    <table class="table">
        <thead>
            <tr>
                <th>
                    Product Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) { ?>
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
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
