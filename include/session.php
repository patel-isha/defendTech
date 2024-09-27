<?php
session_start();
$pages = [
    'quiz.php',
    'my-courses.php'
];
if (!isset($_SESSION['user_id']) && in_array($_SERVER['PHP_SELF'], $pages) )   {
    header("Location:logout.php");
}
?>
