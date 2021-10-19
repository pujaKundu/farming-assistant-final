<?php

require_once '../../init.php';



$rules = [
    'password' => 'required',
    'phone' => 'required',
];

$loginErr = "";
$errors = [];

if (isset($_POST['submit'])) {

    $errors = Form::validate($rules);

    if (count($errors) === 0) {
        $data = Database::connect()->table('users')->select()
            ->where('phone', '=', $_POST['phone'])
            ->where('password', '=', $_POST['password'])
            ->where('role', '=', 'seller')
            ->get();

        //   print_r($data);

        if (count($data)) {
            echo 'Login Successful';
            Auth::storeLogin($data);
             header('Location: /views/seller/home.php');
        } else {
            $loginErr = "Invalid credentials";
        }

    }
}

?>

<html lang="en">
<head>
    <title>Login | Seller</title>
    <link rel="stylesheet" href="../../assets/main.css"/>
</head>
<body  style="background-color:lightgray">
<div class="login-container"  style="margin-top:150px">
    <div class="card">

        <div class="card-header">
            <h2>Seller Login</h2>
        </div>
        <p class="text-error">
            <?php echo $loginErr ?>
        </p>

        <form method="post">
            <div class="row">
                <div class="col">
                    <p>Phone</p>
                    <input type="text" name="phone" />
                    <small class="text-error">
                        <?php echo array_key_exists('phone', $errors) ? $errors['phone'] : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Password</p>
                    <input type="text" name="password" />
                    <small class="text-error">
                        <?php echo array_key_exists('password', $errors)? $errors['password'] : '' ?>
                    </small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <p class="mt-1">
            Don't have an Account <a href="/views/seller/registration.php">Register</a>
        </p>


    </div>

</div>


</body>
</html>
