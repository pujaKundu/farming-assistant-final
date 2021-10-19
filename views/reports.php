<?php

include('../init.php');

$reports = Database::connect()
    ->table('reports')
    ->select('reports.id,reports.title, reports.description, users.name')->join('users', 'users.id', 'reports.user_id')
    ->get();

?>


<html lang="bn">
<head>
    <meta charset="utf-8">
    <title>
        Reports
    </title>
    <link rel="stylesheet" href="../assets/main.css">
</head>
<body>
<?php include '../views/partials/navbar.php' ?>
<div class="container">
    <div>
        <h2>Reports</h2>
        <?php if (Auth::hasRole('farmer')) { ?>
            <a href="/views/farmer/reports/add_report.php">Add Report</a>
        <?php } ?>
    </div>
    <?php foreach ($reports as $report) { ?>
        <div class='card'>
            <div class='card-title'>
                <a class='link' href= <?php echo '/views/report.php?id=' . $report->id ?>>
                    <?php echo $report->title ?>
                </a>
            </div>
            <h5>Asked by <a class="link" href="x"> <?php echo $report->name ?> </a></h5>
            <div class="card-content">
                <p> <?php echo substr($report->description, 0, 300) . '....' ?></p>
            </div>
        </div>
    <?php } ?>


</div>
</body>

</html>
