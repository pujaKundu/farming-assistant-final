<?php

require_once '../../init.php';

$errors = [];
//validation rules
$rules = [
    'name' => 'required',
    'email' => 'required|email',
    'password' => 'required',
    'phone' => 'required|unique',
];


if (isset($_POST['submit'])) {

    $errors = Form::validate($rules);

    if (count($errors) === 0) {

        Database::connect()->table('users')
            ->insert([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'role' => 'seller',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        header('Location: /views/seller/login.php');

    }
}

?>

<html lang="en">
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="../../assets/main.css"/>
</head>
<body  style="background-color:lightgray">
<div class="login-container" style="margin-top:150px">
    <div class="card">
        <div class="card-header">
            <h4>Seller Registration</h4>
        </div>
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <p>Name</p>
                    <input name="name" type="text"/>
                    <small class="text-error">
                        <?php echo array_key_exists('name', $errors) ? 'This Field is required' : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Email</p>
                    <input name="email" type="text"/>
                    <small class="text-error">
                        <?php echo array_key_exists('email', $errors) ? $errors['email'] : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Password</p>
                    <input name="password" type="text"/>
                    <small class="text-error">
                        <?php echo array_key_exists('password', $errors) ? 'This Field is required' : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Phone</p>
                    <input name="phone" type="text"/>
                    <small class="text-error">
                        <?php echo array_key_exists('phone', $errors) ? $errors['phone'] : '' ?>
                    </small>
                </div>
            </div>
            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
        </form>
        <p class="mt-1">Already have an account?
            <a href="/views/seller/login.php">Login</a>
        </p>
    </div>

</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>