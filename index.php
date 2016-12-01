<?php
include 'config/config.php';
include 'inc/_header.inc.php';
include 'inc/functions.php';
    $con=mysqli_connect($ip,$user,$pw,$db);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  if(isset($dashboard)) {
        include 'inc/dashboard.php';
    } elseif(isset($table)) {
        include 'inc/table.php';
    } elseif(isset($player) OR isset($search) ) {
        include 'inc/player.php';
    } else {
        include 'inc/dashboard.php';
    }
require 'inc/_footer.php';   
?>

