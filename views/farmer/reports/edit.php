<?php
require_once '../../../init.php';
$reportId = $_GET['id'];
$report = Database::connect()->table('reports')
    ->select('id,title,description')
    ->where('id', '=', $reportId)
    ->get()[0];

if (isset($_POST['update-button'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    Database::connect()->table('reports')
        ->where('id', '=', $reportId)
        ->update([
            'title' => $_POST['title'],
            'description' => $_POST['description']
        ]);

    header('Location: /views/farmer/reports/my-reports.php');

}

if(isset($_POST['delete-button'])){

        Database::connect()->table('reports')
            ->where('id', '=', $reportId)
            ->delete();

        header('Location: /views/farmer/reports/my-reports.php');

}


?>

<html lang="en">
<head>
    <title>
        Edit Report
    </title>
    <link rel="stylesheet" href="../../../assets/main.css">
</head>
<body>
<?php include "../../partials/navbar.php"; ?>
<div class="container">
    <form action="" method="post">
        <div class='card'>
            <form action="" method="post">
                <div class="card-header">
                    <h4>Edit Product</h4>
                    <button type="submit" name="delete-button">Delete</button>
                </div>
            </form>

            <div class="row">
                <div class="col">
                    <p>Title</p>
                    <input type='text' name='title' value="<?php echo $report->title ?>"/>
                </div>
                <div class="col">
                    <p>Description</p>
                    <textarea name="description"><?php echo $report->description ?></textarea>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="update-button">Update</button>
        </div>
    </form>
</div>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
