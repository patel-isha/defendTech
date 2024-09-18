<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location:logout.php");
    //exit();
}else{
    header("Location:dashboard.php");
}
?>
