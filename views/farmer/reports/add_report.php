<?php

require_once('../../../init.php');

if(!Auth::hasRole('farmer')){
    header('Location: /views/403.php');
}

$rules = [
    'title' => 'required',
    'description' => 'required',
];

$errors = [];

if (isset($_POST['submit'])) {

    $errors = Form::validate($rules);

    if (count($errors) === 0) {
        Database::connect()->table('reports')->insert([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'user_id' => Auth::getUser()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        header("location: /views/farmer/reports/my-reports.php");
    }
}

?>

<html lang="en">
<head>
    <title>
        Add Report
    </title>
    <link rel="stylesheet" href="../../../assets/main.css">
</head>
<body>
<div>
    <?php include '../../partials/navbar.php' ?>
</div>
<div class="container">
    <div class="card">
        <h3>Provide Report Information</h3>
        <form method="post" action="">
            <div class="row">
                <div class="col">
                    <p>Report Title*</p>
                    <input type="text" name="title"/>
                    <small class="text-error">
                        <?php echo array_key_exists('title', $errors) ? "This Field is Required" : '' ?>
                    </small>
                </div>
                <div class="col">
                    <p>Description* </p>
                    <textarea name="description"></textarea>
                    <small class="text-error">
                        <?php echo array_key_exists('description', $errors)? 'This Field is Required': '' ?>
                    </small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Report</button>
            </div>
        </form>
    </div>

</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
