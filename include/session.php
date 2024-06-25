<?php
session_start();

if (!isset($_SESSION['username']) && basename($_SERVER['PHP_SELF']) === "booking.php") {
    header("Location:logout.php");
    //exit();
}
?>
