<?php
require_once '../init.php';
//check user already logged in then redirect

if (Auth::isLoggedIn()) {
    header('location:' . '/views/admin/home.php');
}

//for login
$rules = [
    'password' => 'required',
    'phone' => 'required',
];

$errors = [];

$loginErr = "";

if (isset($_POST['submit'])) {

    $errors = Form::validate($rules);

    if (count($errors) === 0) {
        $data = Database::connect()->table('users')->select()
            ->where('phone', '=', $_POST['phone'])
            ->where('password', '=', $_POST['password'])
            ->where('role', '=', 'admin')
            ->get();

        // print_r($data);

        if (count($data)) {
            echo 'Login Successful';
            Auth::storeLogin($data);
            header('Location:' . '/views/admin/home.php');
        } else {
            $loginErr = "invalid credentials";
        }

    }
}

?>

<html lang="en">
<head>
    <title>Login | Admin</title>
    <link rel="stylesheet" href="../assets/main.css"/>
</head>
<body  style="background-color:lightgray">
<div class="login-container"  style="margin-top:100px">
    <div class="card">

        <div class="card-header">
            <h2>Admin Login</h2>
        </div>
        <p class="text-error">
            <?php echo $loginErr ?>
        </p>

        <form method="post">
            <div class="row">
                <div class="col">
                    <p>Phone</p>
                    <input type="text" name="phone"/>
                    <small class="text-error">
                        <?php echo array_key_exists('phone', $errors) ? $errors['phone'] : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Password</p>
                    <input type="text" name="password"/>
                    <small class="text-error">
                        <?php echo array_key_exists('password', $errors) ? $errors['password'] : '' ?>
                    </small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

    </div>


</div>


</body>
</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
