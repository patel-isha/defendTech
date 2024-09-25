<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location:logout.php");
    //exit();
}
?>
