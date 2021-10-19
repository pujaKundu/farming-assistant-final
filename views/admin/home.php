<?php

include('../../init.php');

if(!Auth::hasRole('admin')){
    header('location: /views/login.php');
}

$users = Database::connect()->table('users')
    ->select()->get();

$products = Database::connect()->table('products')
    ->select('products.id, products.name, products.price, products.name as username')
    ->join('users', 'users.id', 'products.user_id')
    ->get();

$reports = Database::connect()
    ->table('reports')
    ->select('reports.id,reports.title, reports.description, users.name as username')
    ->join('users', 'users.id', 'reports.user_id')
    ->get();

//only farmer can visit this page



?>

<html lang="en">
<head>
    <title>Admin Home</title>
    <link rel="stylesheet" href="../../assets/main.css">
</head>
<body>
<?php  include '../partials/navbar.php' ?>
<div class="admin-header">
    <div class="header-content">
        <h1>Welcome Admin</h1>
    </div>
</div>
<div class="container">

    <div class="card">
        <div class="card-header">
            <h4>Users</h4>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Phone
                </th>
                <th>
                    Email
                </th>
                <th>
                    Role
                </th>
                <th>
                    Action
                </th>
            </tr>
            <?php foreach ($users as $user) { ?>

                <tr>
                    <td>
                        <?php echo $user->name ?>
                    </td>
                    <td>
                        <?php echo $user->phone ?>
                    </td>
                    <td>
                        <?php echo $user->email ?>
                    </td>
                    <td>
                        <?php echo $user->role ?>
                    </td>
                    <td>
                        <a href=<?php echo '/views/profile.php?id='.$user->id ?> >View</a>
                    </td>
                </tr>
            <?php } ?>

            </thead>
        </table>
    </div>

    <div class="card">
        <div class="card-header">
            Products Lists
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>
                    Price
                </th>
                <th>Posted by</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td>
                        <?php echo $product->name ?>
                    </td>
                    <td>
                        <?php echo $product->price ?>
                    </td>
                    <td>
                        <?php echo $product->username ?>
                    </td>
                    <td>
                        <a href=<?php echo '/views/product.php?id=' . $product->id ?>>View</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

    <div class="card">
        <div class="card-header">
            Reports
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Post by</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reports as $report) { ?>
                <tr>
                    <td>
                        <?php echo substr($report->title, 0, 50) ?>
                    </td>
                    <td>
                        <?php echo $report->username ?>
                    </td>
                    <td>
                        <a href= <?php echo '/views/report.php?id='.$report->id ?> >View</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>



</div>

</body>
</html>