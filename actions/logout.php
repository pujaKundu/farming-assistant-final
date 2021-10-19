<?php

require_once '../init.php';
Auth::removeLogin();
header('Location: /index.php');

?>