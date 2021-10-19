<?php

require_once '../init.php';

    if(Auth::isLoggedIn()){

        if(isset($_GET['id'])){
            $id = $_GET['id'];
           $user = Database::connect()->table('users')
               ->select()
               ->where('id', '=', $id)
               ->get()[0];
        }else{
            $user = Auth::getUser();

        }

    }else{
        header('Location: /index.php');
    }



?>


<html lang="en">
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../assets/main.css" />
    </head>
    <body>
        <?php include "./partials/navbar.php"; ?>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Profile Section</h3>
                </div>
                <div class="card-title">
                    <h4>Name: <?php echo $user->name ?></h4>
                    <h4>Role: <?php echo $user->role ?> </h4>
                </div>
            </div>
        </div>
    </body>
</html>
