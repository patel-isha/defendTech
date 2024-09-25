<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config/connection.php';
// Initialize the cart array if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to add products to the cart
function addToCart($course_id, $course_title, $course_cost, $course_image, $course_author) {
    $item_exists = false;

    // Loop through the cart to see if the item is already there
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['course_id'] == $course_id) {
            // Update the quantity if the item exists
            $item_exists = true;
            break;
        }
    }

    // If the item doesn't exist, add a new one
    if (!$item_exists) {
        $new_item = [
            'course_id' => $course_id,
            'course_title' => $course_title,
            'course_cost' => $course_cost,
            'course_image' => $course_image,
            'course_author' => $course_author
        ];
        $_SESSION['cart'][] = $new_item;
    }
}

// Get the data from the AJAX request
if (isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];
    $sqlCourse = "SELECT course_title, course_cost, course_image, course_author  FROM course WHERE course_id = '$course_id'";
    $resultCourse = $conn->query($sqlCourse);
    $course = $resultCourse->fetch_assoc();

    // Add the product to the cart
    addToCart($course_id,$course['course_title'],$course['course_cost'],$course['course_image'],$course['course_author']);

    // Calculate total items in the cart (for response)
    $total_items = count($_SESSION['cart']);

    // Return the updated cart count as a JSON response
    echo json_encode(['cart_count' => $total_items]);
}
