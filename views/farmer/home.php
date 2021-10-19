<?php

    include ('../../init.php');
    //only farmer can visit this pag
if(!Auth::hasRole('farmer')){
    header('Location: /views/farmer/login.php');
}

$user = Auth::getUser();

$reports = Database::connect()
    ->table('reports')
    ->select('reports.id, reports.title, reports.description, users.name')->join('users', 'users.id', 'reports.user_id')
    ->where('users.id', '=', $user->id)
    ->orderByDesc('reports.created_at')
    ->limit(5);

$orders = Database::connect()->table('orders')
    ->select('products.id, products.name,orders.quantity, products.price, users.name as username')
    ->join('products', 'products.id', 'orders.product_id')
    ->join('users', 'users.id', 'orders.user_id')
    ->get();

?>


<html lang="en">
    <head>
        <title>Farmer</title>
        <link rel="stylesheet" href="../../assets/main.css" />
    </head>
    <body>

        <div class="farmer-header">
            <?php include '../partials/navbar.php' ?>
            <div class="header-content">
                <h1>
                    Welcome to Farmer Section
                </h1>
            </div>

        </div>
        <div class="container">
            <!---My REcent REports -->
            <div class="card">
                <div class="card-header">
                    <h4>My Recent Reports</h4>
                    <a href="/views/farmer/reports/add_report.php">Add Report</a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            Title
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($reports as $report) { ?>
                        <tr>
                            <td>
                                <?php echo $report->title ?>
                            </td>
                            <td>
                                <?php echo $report->description ?>
                            </td>
                            <td>
                                <a class="btn-small" href=<?php echo '/views/farmer/reports/edit.php?id='.$report->id ?> >Edit/Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>My Recent Orders</h3>
                </div>
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

        </div>
    </body>



</html>
