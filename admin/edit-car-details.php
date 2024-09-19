<?php
include 'config/connection.php';

$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    //Retrieve form data
    $sideWindows = $_POST["sideWindows"];
    $color = $_POST["color"];
    $mileage = $_POST["mileage"];
    $alarmType = $_POST["alarmType"];
    $category = $_POST["category"];
    $noofseats = $_POST["noofseats"];
    $comments = $_POST["comments"];
    $fuelType = $_POST["fuelType"];
    $transmission = $_POST["transmission"];
    $perHourRate = $_POST["perHourRate"];
    $location = $_POST["location"];


    if ($_FILES["customFile"]["size"] > 0){
        $customFile = $_FILES["customFile"]["name"];
        $tempname = $_FILES["customFile"]["tmp_name"];
        $folder = "assets/images/car/".basename($_FILES["customFile"]["name"]);
        //SQL query to inser data into the database
        $sql = "UPDATE `car_details` SET side_windows='$sideWindows', color='$color', mileage='$mileage', 
    alarm_type='$alarmType', category_id='$category', noofseats='$noofseats', comments='$comments', `image` = '$customFile', `fuel_type` = '$fuelType' , `transmission` = '$transmission', `per_hour_rate` = '$perHourRate', `location` = '$location'
    WHERE car_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname,$folder)) {
            echo "<h3>  Car Added Successfully!</h3>";
            echo "<script> location.href='car-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    }else{
        //SQL query to inser data into the database
        $sql = "UPDATE `car_details` SET side_windows='$sideWindows', color='$color', mileage='$mileage', 
    alarm_type='$alarmType', category_id='$category', noofseats='$noofseats', comments='$comments', `fuel_type` = '$fuelType' , `transmission` = '$transmission', `per_hour_rate` = '$perHourRate', `location` = '$location' 
    WHERE car_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>  Car Added Successfully!</h3>";
            echo "<script> location.href='car-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
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
                                            <h3 class="nk-block-title page-title">Edit Car Details</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <?php
                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];

                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM `car_details` WHERE car_id = $id";
                                            $result = $conn->query($sql);
                                            # Execute the SELECT Query
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc()
                                        ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Registration No of Vehicle -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="regNo">Registration No of Vehicle</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="regNo" name="regNo" value="<?php echo $row['registeration_no']; ?>" placeholder="213121" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Car Brand -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="brand">Brand</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select js-select2" id="brand" name="brand" data-placeholder="Select a option" disabled>
                                                                        <?php
                                                                        # Prepare the SELECT Query
                                                                        $sql = "SELECT brand_id, brand_name FROM `car_brand`";
                                                                        $result = $conn->query($sql);

                                                                        if ($result->num_rows > 0) {
                                                                            while ($rowBrand = $result->fetch_assoc()) {
                                                                                ?>
                                                                                <option value="<?php echo $rowBrand["brand_id"]; ?>" <?php if ($rowBrand["brand_id"] == $row['brand_id']) { ?> selected <?php } ?>  ><?php echo $rowBrand["brand_name"]; ?></option>
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
                                                                <label class="form-label" for="vn">Car Name</label>
                                                                <div class="form-control-wrap ">
                                                                    <input class="form-control" id="vn" name="vn" placeholder="BMW" value="<?php echo $row['car_name']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Number Etched into side Windows -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="sideWindows">No. Etched into side Windows</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number" class="form-control" id="sideWindows" name="sideWindows" value="<?php echo $row['side_windows']; ?>" placeholder="21" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Chassis Number/Vehicle Identification Number -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="vin">Chassis Number</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="vin" name="vin" placeholder="23123123123123123" value="<?php echo $row['vehicle_idno']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Vehicle Year -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="vehicleYear">Vehicle Year</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="vehicleYear" name="vehicleYear" value="<?php echo $row['vehicle_year']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Vehicle Make -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="vehicleMake">Vehicle Make</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="vehicleMake" name="vehicleMake" placeholder="1999" value="<?php echo $row['vehicle_make']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Vehicle Model -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="vehicleModel">Vehicle Model</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="vehicleModel" name="vehicleModel" placeholder="2001" value="<?php echo $row['vehicle_model']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Color -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="color">Color</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="color" name="color" value="<?php echo $row['color']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Current Mileage -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="mileage">Current Mileage</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number" class="form-control" id="mileage" name="mileage" value="<?php echo $row['mileage']; ?>" required>
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
                                                                                <input type="radio" class="custom-control-input" name="transmission" value="auto" <?php if (isset($row['transmission']) && $row['transmission'] == 'auto' ) { ?> checked  <?php } else if ($row['transmission'] != 'manual'){ ?> checked <?php } ?> id="auto" required>
                                                                                <label class="custom-control-label" for="auto">Auto</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" class="custom-control-input" name="transmission" <?php if (isset($row['transmission']) && $row['transmission'] == 'manual' ) { ?> checked  <?php } ?> value="manual" id="manual" required>
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
                                                                                <input type="radio" class="custom-control-input" name="fuelType" value="petrol" id="petrol" <?php if (isset($row['fuel_type']) && $row['fuel_type'] == 'petrol' ) { ?> checked  <?php } else if ($row['fuel_type'] == ''){ ?> checked <?php } ?> required>
                                                                                <label class="custom-control-label" for="petrol">Petrol</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" class="custom-control-input" name="fuelType" value="diesel" id="diesel"  <?php if (isset($row['fuel_type']) && $row['fuel_type'] == 'diesel' ) { ?> checked  <?php }  ?> required>
                                                                                <label class="custom-control-label" for="diesel">Diesel</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" class="custom-control-input" name="fuelType" value="electric" id="electric" <?php if (isset($row['fuel_type']) && $row['fuel_type'] == 'electric' ) { ?> checked  <?php }  ?> required>
                                                                                <label class="custom-control-label" for="electric">Electric</label>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="custom-control custom-radio">
                                                                                <input type="radio" class="custom-control-input" name="fuelType" value="hybrid" id="hybrid" <?php if (isset($row['fuel_type']) && $row['fuel_type'] == 'hybrid' ) { ?> checked  <?php }  ?> required>
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
                                                                        <?php
                                                                        $sql = "SELECT * FROM `car_category`";
                                                                        $result = $conn->query($sql);

                                                                        if ($result->num_rows > 0) {
                                                                            while ($rowCategory = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <option value="<?php echo $rowCategory["category_id"]; ?>"
                                                                                <?php
                                                                                if($rowCategory["category_id"] == $row["category_id"]) { ?>
                                                                                selected
                                                                                <?php
                                                                                }
                                                                                ?>>
                                                                                    <?php echo $rowCategory["category_name"]; ?>
                                                                                </option>
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
                                                                    <input type="number" class="form-control" id="noofseats" name="noofseats" value="<?php echo $row['noofseats']; ?>" placeholder="5" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Location -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="location">Location</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['location']; ?>" placeholder="Romford" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Hourly Rate -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="perHourRate">Hourly Rate</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="number" class="form-control" id="perHourRate" name="perHourRate" value="<?php echo $row['per_hour_rate']; ?>" placeholder="5" required>
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
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="categoryImage"></label>
                                                                <div class="form-control-wrap">
                                                                    <img class="form-control w-70" src="assets/images/car/<?php echo $row['image']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Comments -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="comments">Comments</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="comments" name="comments" placeholder="Enter comments if any"><?php echo $row['comments']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                        <?php
                                            } else {
                                                $row = $conn->error;
                                            }
                                        } else {
                                            echo "Invalid request";
                                        }
                                        ?>
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
        $(document).on('keyup','#location',function(){
            $( "#location" ).autocomplete({
                source:function(request,response){
                    $.post("autocomplete.php",{'name':$( "#location" ).val()}).done(function(data, status){

                        response(JSON.parse(data));
                    });
                }
            });
        });

    </script>
</body>

</html>
