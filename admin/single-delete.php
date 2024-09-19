<?php
include 'config/connection.php';

if(isset($_POST["type"]) && $_POST["type"] == "car-list") {
    $id = $_POST["id"];
    $sql = "DELETE from `car_details` WHERE car_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "car-brand") {
    $id = $_POST["id"];
    $sql = "DELETE from `car_brand` WHERE brand_id = '$id'";
}

if(isset($_POST["type"]) && $_POST["type"] == "car-category") {
    $id = $_POST["id"];
    $sql = "DELETE from `car_category` WHERE category_id = '$id'";
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
