<?php

// Inialize session
session_start();

// Delete certain session
unset($_SESSION['user_id']);
unset($_SESSION['email']);
unset($_SESSION['first_name']);
//   unset($_SESSION['owner_email']);
// Delete all session variables

session_destroy();

// Jump to login page
header('Location: index.php');
