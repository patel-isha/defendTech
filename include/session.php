<?php
session_start();

if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) === "quiz.php") {
    header("Location:logout.php");
}
?>