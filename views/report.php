<?php

require_once '../init.php';

$reportId = (int)$_GET['id']; // $parsed[count($parsed)-1];

$report = Database::connect()->table('reports')
    ->select('reports.title, reports.description, users.name')
    ->join('users', 'users.id', 'reports.user_id')
    ->where('reports.id', '=', $reportId)
    ->get()[0];

$comments = Database::connect()->table('comments')
    ->select('comments.content, users.name, users.id as userId, comments.created_at')
    ->join('users', 'users.id', 'comments.user_id')
    ->where('comments.report_id', '=', $reportId)
    ->orderByDesc('comments.created_at')
    ->get();

Auth::isLoggedIn();

//post comment

if (isset($_POST['submit'])) {

    Database::connect()->table('comments')->insert([
        'content' => $_POST['content'],
        'user_id' =>  Auth::getUser()->id,
        'report_id' => $reportId,
        'created_at' => date('Y-m-d H:i:s')
    ]);

    $comments = Database::connect()->table('comments')
        ->select('comments.content, users.name, users.id as userId, comments.created_at')
        ->join('users', 'users.id', 'comments.user_id')
        ->where('comments.report_id', '=', $reportId)
        ->orderByDesc('comments.created_at')
        ->get();
}

//    print_r($report);

?>


<html lang="en">
<head>
    <title>
        Report
    </title>
    <link rel="stylesheet" href="../assets/main.css">
</head>
<body>
<div>
    <?php include '../views/partials/navbar.php' ?>
</div>
<div class="container">
    <div>
        <?php
        echo "<div class='card'> <div class='card-title'>
             <div class='card-title'>
                <h4>{$report->title}</h4>
              </div> 
            </div>
            <h5>Asked by {$report->name}</h5>
            <p>{$report->description}</p>
            </div>";
        ?>
    </div>
    <form method="post">
        <textarea name="content"></textarea>
        <button type="submit" name="submit">
            Do Comment
        </button>
    </form>

    <div>
        <?php foreach ($comments as $com) { ?>
            <div class='card'>
                <div class="content">
                    <a href=<?php echo '/views/profile.php?id' . $com->userId ?> >
                        <?php echo $com->name ?> </a>
                    <p><?php echo date("d-m-Y H:m", strtotime($com->created_at));  ?></p>
                    <p><?php echo $com->content ?> </p>
                </div>
            </div>
        <?php } ?>
    </div>

</div>
<script>
    //stop resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
