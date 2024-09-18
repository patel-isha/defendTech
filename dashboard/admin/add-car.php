<?php
include 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve form data
    $name = $_POST["name"];
    $regNo = $_POST["regNo"];
    $brand = $_POST["brand"];
    $carName = $_POST["carName"];
    $sideWindows = $_POST["sideWindows"];
    $vidno = $_POST["vidno"];
    $vehicleYear = $_POST["vehicleYear"];
    $vehicleMake = $_POST["vehicleMake"];
    $vehicleModel = $_POST["vehicleModel"];
    $color = $_POST["color"];
    $mileage = $_POST["mileage"];
    $transmission = $_POST["transmission"];
    $fuelType = $_POST["fuelType"];

    $perHourRate = $_POST["perHourRate"];
    $location = $_POST["location"];

    $alarmType = $_POST["alarmType"];
    $category = $_POST["category"];
    $noofseats = $_POST["noofseats"];
    $comments = $_POST["comments"];
    //File Upload
    $customFile = $_FILES["customFile"]["name"];
    $tempname = $_FILES["customFile"]["tmp_name"];
    $folder = "assets/images/car/" . basename($_FILES["customFile"]["name"]);

    //SQL query to inser data into the database
    $sql = "INSERT INTO `car_details`(`owner_id`, `registeration_no`, `car_name`,`brand_id`, `side_windows`, `vehicle_idno`, `vehicle_year`, `vehicle_make`, `vehicle_model`, `color`, `mileage`, `transmission`, `fuelType`, `alarm_type`, `category_id`, `noofseats`, `comments`,`image`,`per_hour_rate`,`location`) 
    VALUES ('$name', '$regNo', '$carName','$brand', '$sideWindows', '$vidno', '$vehicleYear', '$vehicleMake', '$vehicleModel', '$color','$mileage','$transmission','$fuelType','$alarmType','$category','$noofseats','$comments','$customFile','$perHourRate','$location')";

    //Execute the query
    if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
        echo "<h3>Car Added Successfully!</h3>";
        echo "<script> location.href='car-list.php'; </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?php
include 'include/header-links.php';
include 'include/session.php';
?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php
            include 'include/sidebar.php';
            ?>
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <?php
                include 'include/header.php';
                ?>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Car Details Form</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row g-gs">
                                                <!-- Full name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Car Owner's Name</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" id="name" name="name" data-placeholder="Select owner" required>
                                                                <option>Select Owner</option>
                                                                <?php
                                                                # Prepare the SELECT Query
                                                                $sql = "SELECT owner_id, name FROM `owners`";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                        <option value="<?php echo $row["owner_id"]; ?>"><?php echo $row["name"]; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Registration No of Vehicle -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="regNo">Registration No of Vehicle</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="regNo" name="regNo" placeholder="213121" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Car Brand -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="brand">Brand</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" id="brand" name="brand" data-placeholder="Select a option" required>
                                                                <?php
                                                                # Prepare the SELECT Query
                                                                $sql = "SELECT brand_id, brand_name FROM `car_brand`";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                        <option value="<?php echo $row["brand_id"]; ?>"><?php echo $row["brand_name"]; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Car Name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="carName">Car Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="carName" name="carName" placeholder="Etios" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Upload File -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="noofseats">Upload photo</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file" class="form-file-input" id="customFile" name="customFile" onchange="loadFile(event)">
                                                                <label class="form-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Number Etched into side Windows -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="sideWindows">No. Etched into side Windows</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="sideWindows" name="sideWindows" placeholder="21" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Chassis Number/Vehicle Identification Number -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="vidno">Chassis Number</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="vidno" name="vidno" pattern="[0-9]{17}" title="Enter 17 digits number" placeholder="23123123123123123" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Vehicle Year -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="vehicleYear">Vehicle Year</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="vehicleYear" name="vehicleYear" placeholder="2004" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Vehicle Make -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="vehicleMake">Vehicle Make</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="vehicleMake" name="vehicleMake" pattern="[0-9]{4}" title="Enter year" placeholder="1999" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Vehicle Model -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="vehicleModel">Vehicle Model</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="vehicleModel" name="vehicleModel" pattern="[0-9]{4}" title="Enter year" placeholder="2001" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Color -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="color">Color</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="color" name="color" placeholder="e.g., blue" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Current Mileage -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="mileage">Current Mileage</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="mileage" name="mileage" placeholder="30000" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Car Transmission -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="transmission">Transmission</label>
                                                        <div class="form-control-wrap">
                                                            <ul class="custom-control-group">
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="transmission" value="auto" id="auto" checked required>
                                                                        <label class="custom-control-label" for="auto">Auto</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="transmission" value="manual" id="manual" required>
                                                                        <label class="custom-control-label" for="manual">Manual</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fuel Type -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="fuelType">Fuel Type</label>
                                                        <div class="form-control-wrap">
                                                            <ul class="custom-control-group">
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="fuelType" value="petrol" id="petrol" checked required>
                                                                        <label class="custom-control-label" for="petrol">Petrol</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="fuelType" value="diesel" id="diesel" required>
                                                                        <label class="custom-control-label" for="diesel">Diesel</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="fuelType" value="electric" id="electric" required>
                                                                        <label class="custom-control-label" for="electric">Electric</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="fuelType" value="hybrid" id="hybrid" required>
                                                                        <label class="custom-control-label" for="hybrid">Hybrid</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Alarm Type -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="alarmType">Alarm Type</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="alarmType" name="alarmType" data-placeholder="Select a option" required>
                                                                <option value="Silent Alarm">Silent Alarm</option>
                                                                <option value="Passive Alarm">Passive Alarm</option>
                                                                <option value="Paging">Paging</option>
                                                                <option value="Motion Detector">Motion Detector</option>
                                                                <option value="Audible">Audible</option>
                                                                <option value="GPS Alarm">GPS Alarm</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Category -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="category">Category</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="category" name="category" data-placeholder="Select a option" required>
                                                                <option>Select Car Category</option>
                                                                <?php
                                                                $sql = "SELECT * FROM `car_category`";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                ?>
                                                                        <option value="<?php echo $row["category_id"]; ?>"><?php echo $row["category_name"]; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Number of seats -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="noofseats">Number of seats</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" id="noofseats" name="noofseats" placeholder="5" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Location -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="location">Location</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="location" name="location" placeholder="Romford" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Hourly Rate -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="perHourRate">Hourly Rate</label>
                                                        <div class="form-control-wrap">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">£</span>
                                                                </div>
                                                                <input type="number" class="form-control" id="perHourRate" name="perHourRate" placeholder="50" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Comments -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="comments">Comments</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control form-control-sm" id="comments" name="comments" placeholder="Enter comments if any"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-primary">Add Car</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <?php
                include 'include/dashboard-footer.php';
                ?>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <?php
    include 'include/footer-scripts.php';
    ?>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(document).on('keyup', '#location', function() {
            $("#location").autocomplete({
                source: function(request, response) {
                    $.post("autocomplete.php", {
                        'name': $("#location").val()
                    }).done(function(data, status) {

                        response(JSON.parse(data));
                    });
                }
            });
        });
    </script>
</body>

</html>
