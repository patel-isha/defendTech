<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include 'config/connection.php';

// Fetch Car Category Details
$id = "";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $editDriverSql = "SELECT * FROM `drivers` WHERE driver_id = '$id'";
    $editDriverResult = $conn->query($editDriverSql);
    if ($editDriverResult->num_rows > 0) {
        $rowEditDriver = $editDriverResult->fetch_assoc();
        $user_id = $rowEditDriver["user_id"];
        //User Details
        $editUserSql = "SELECT * FROM `user_register` WHERE user_id = '$user_id'";
        $editUserResult = $conn->query($editUserSql);
        $rowEditUser = $editUserResult->fetch_assoc();
    }else{
        echo "<h3>No Data Found!</h3>";
        die;
    }
}
//Execute the query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateDriver"])) {
        //Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact_no = $_POST["phone"];
        $address = $_POST["address"];
        $zipcode = $_POST["code"];
        $gender = $_POST["gender"];
        $username = $_POST["uname"];
        $drivingLicenseNo = $_POST["dlno"];

        //SQL query to inser data into the database
        $sql = "UPDATE `drivers` SET `name` = '$name',`email` = '$email',`contact_no` = '$contact_no',`address` = '$address',`zipcode` = '$zipcode',`gender` = '$gender',`driving_license_no` = '$drivingLicenseNo' WHERE driver_id = '$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            $user_id = $rowEditDriver["user_id"];
            //SQL query to inser data into the database
            $sqlUser = "UPDATE `user_registration` SET `fullname` = '$name',`email` = '$email' WHERE user_id = '$user_id'";
            $conn->query($sqlUser);

            echo "<h3>Driver Updated Successfully!</h3>";
            echo "<script> location.href='driver-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    }
}
?>
<!DOCTYPE html>
<html>

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
                                            <h3 class="nk-block-title page-title">Edit Driver Details</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form method="post">
                                            <div class="row g-gs">
                                                <!-- Full name -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Full Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rowEditDriver['name']; ?>" placeholder="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Email -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email address</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-mail"></em>
                                                            </div>
                                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $rowEditDriver['email']; ?>" placeholder="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Contact no. -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">Contact No.</label>
                                                        <div class="form-control-wrap">
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $rowEditDriver['contact_no']; ?>" pattern="[0-9]{10,11}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Zip code -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="code">Zipcode</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="code" name="code" placeholder="zipcode" value="<?php echo $rowEditDriver['zipcode']; ?>" pattern="[a-zA-Z0-9\s]{6,7}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Driving License Number -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="dlno">Driving License Number</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="dlno" name="dlno" placeholder="driving license number" value="<?php echo $rowEditDriver['driving_license_no']; ?>" pattern="[A-Z]{5}[0-9]{6}[A-Z]{2}[0-9]{1}[A-Z]{2}\s[0-9]{2}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Username -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="uname">Username</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-user"></em>
                                                            </div>
                                                            <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $rowEditUser['username']; ?>" placeholder="abc001" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Gender -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="gender">Gender</label>
                                                        <div class="form-control-wrap">
                                                            <ul class="custom-control-group">
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" <?php if($rowEditDriver['gender'] == "male"){ ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-male">Male</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" <?php if($rowEditDriver['gender'] == "female"){ ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-female">Female</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="other" id="sex-other" <?php if($rowEditDriver['gender'] == "other"){ ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-other">Others</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Address -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="address">Address</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control form-control-sm" id="address" name="address" placeholder="address" required><?php echo $rowEditDriver['address']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateDriver" class="btn btn-lg btn-primary">Update</button>
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
</body>

</html>
