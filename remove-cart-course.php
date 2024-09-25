<?php
session_start();
include 'config/connection.php';


// Get the data from the AJAX request
if (isset($_POST['course_id'])) {
    // Function to find the course by course_id
    $selected_course = null;
    foreach ($_SESSION['cart'] as $index => $session) {
        if ($session['course_id'] == $_POST['course_id']) {
            unset($_SESSION['cart'][$index]);
            break; // Exit loop once the course is found
        }
    }

    // Return the updated cart count as a JSON response
    echo json_encode(['success' => true]);
}
