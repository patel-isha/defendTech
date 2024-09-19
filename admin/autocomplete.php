<?php
include 'config/connection.php';

$name=$_POST['name'];
# Prepare the SELECT Query
$sqlCities = "SELECT * FROM cities WHERE name LIKE '%$name%' LIMIT 5";
$result = $conn->query($sqlCities);
$names=array();
foreach($result as $row){
    $names[]=$row['name'];
}
echo json_encode($names);
?>
