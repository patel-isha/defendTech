<?php
include 'config/connection.php';

if(isset($_POST["type"]) && $_POST["type"] == "course-list") {
    $id = $_POST["id"];
    $sql = "DELETE from `course` WHERE course_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "course-category") {
    $id = $_POST["id"];
    $sql = "DELETE from `course_category` WHERE cc_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "course-review") {
    $id = $_POST["id"];
    $sql = "DELETE from `course_review` WHERE cr_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "course-content") {
    $id = $_POST["id"];
    $sql = "DELETE from `course_content` WHERE cct_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "blog-list") {
    $id = $_POST["id"];
    $sql = "DELETE from `blog` WHERE b_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "tutor-list") {
    $id = $_POST["id"];
    $sql = "DELETE from `users` WHERE user_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "car-owner") {
    $id = $_POST["id"];

    $editOwnerSql = "SELECT * FROM `owners` WHERE owner_id = '$id'";
    $editOwnerResult = $conn->query($editOwnerSql);
    $rowEditOwner = $editOwnerResult->fetch_assoc();
    $user_id = $rowEditOwner["user_id"];
    //Delete User details for Owner
    $sqlUser = "DELETE from `user_register` WHERE user_id = '$user_id'";
    $conn->query($sql);

    $sql = "DELETE from `owners` WHERE owner_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "car-driver") {
    $id = $_POST["id"];

    $editDriverSql = "SELECT * FROM `drivers` WHERE driver_id = '$id'";
    $editDriverResult = $conn->query($editDriverSql);
    $rowEditDriver = $editDriverResult->fetch_assoc();
    $user_id = $rowEditDriver["user_id"];
    //Delete User details for Driver
    $sqlUser = "DELETE from `user_register` WHERE user_id = '$user_id'";
    $conn->query($sql);

    $sql = "DELETE from `drivers` WHERE driver_id = '$id'";
}

//Execute the query
if ($conn->query($sql) === TRUE) {
    $response["status"] = true;
    $response["message"] = "Data successfully deleted";
} else {
    $response["status"] = false;
    $response["message"] = "Something went wrong";
}
echo json_encode($response);
?>
