<?php
require_once 'init.php';


?>

<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="./assets/main.css"/>
</head>
<body>
<?php require './views/partials/navbar.php' ?>
<div class="container-fluid">
    <div class="header">
        <div class="header-content">
            <h1 class="header-title fs-1" style="padding:10px;font-size:40px">Welcome to Farming Assistant</h1>
        </div>
    </div>

    <div class="row " style="margin-left:155px;font-weight:bolder;margin-top:100px">
        <div class="col-4" >
            <a class="section-button w-100" style="border:1px solid gray;border-radius:5px"href="/views/admin/home.php">Admin Section</a>
        </div>
        <div class="col-4">
            <a class="section-button" style="border:1px solid gray;border-radius:5px" href="/views/seller/home.php">Seller Section</a>
        </div>
        <div class="col-4">
            <a class="section-button" style="border:1px solid gray;border-radius:5px" href="/views/farmer/home.php">Farmer Section</a>
        </div>

    </div>

</div>


</body>
</html>






