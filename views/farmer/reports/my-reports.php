<?php

include('../../../init.php');

$user = Auth::getUser();

$reports = Database::connect()
    ->table('reports')
    ->select('reports.id, reports.title, reports.description, users.name')->join('users', 'users.id', 'reports.user_id')
    ->where('users.id', '=', $user->id)
    ->get();

if(isset($_POST['btn-delete'])){

    Database::connect()->table('reports')
        ->where('id', '=', $report->id)
        ->delete();

}

?>


<html lang="en">
<head>
    <title>
        Reports
    </title>
    <link rel="stylesheet" href="../../../assets/main.css">
</head>
<body>
<?php include '../../partials/navbar.php' ?>
<div class="container">
    <div>
        <a href="add_report.php">Add report</a>
    </div>
    <h4>My reports</h4>
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
                    <a class="btn-small" href=<?php echo '/views/farmer/reports/edit.php?id='.$report->id ?> >edit</a>
                    <a id="btnModal" href="javascript:void()" class="btn-small">delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- The Modal -->
    <div id="modal" class="modal">

        <!-- Modal content -->
        <form action="" method="post">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Do you want to Delete this item?</h2>
                <button type="submit" name="btn-delete">Delete</button>
            </div>
        </form>


    </div>

</div>

<script type="text/javascript" src="../../../assets/js/modal.js"></script>

</body>

</html>
