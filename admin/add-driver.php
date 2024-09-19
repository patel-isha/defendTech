<?php
include 'config/connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact_no = $_POST["phone"];
    $address = $_POST["address"];
    $zipcode = $_POST["code"];
    $driving_license_no = $_POST["dlno"];
    $gender = $_POST["gender"];
    $username = $_POST["uname"];
    $password = sha1($_POST["password"]);
    $role_type = 'driver';

    //SQL query to inser data into the database
    $sqlUser = "INSERT INTO `user_register`(`role_type`,`full_name`, `email`, `username`, `password`) 
        VALUES ('$role_type','$name', '$email', '$username', '$password')";

    //Execute the query
    if ($conn->query($sqlUser) === TRUE) {
        $last_id = mysqli_insert_id($conn);

        //SQL query to insert data into the database
        $sql = "INSERT INTO `drivers`(`name`, `email`, `contact_no`, `address`, `zipcode`, `driving_license_no`, `gender`,`user_id`) 
        VALUES ('$name', '$email', '$contact_no', '$address', '$zipcode', '$driving_license_no', '$gender','$last_id')";
        $conn->query($sql);

        echo "<h3>Driver Added Successfully!</h3>";
        echo "<script> location.href='driver-list.php'; </script>";
    } else {
        echo "Error: " . $sqlUser . "<br>" . $conn->error;
        die;
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
                                            <h3 class="nk-block-title page-title">Add Driver</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form method="post">
                                            <div class="row g-gs">
                                                <!-- Full name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">Full Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Email -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Email address</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-right">
                                                                <em class="icon ni ni-mail"></em>
                                                            </div>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Contact no. -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">Contact No.</label>
                                                        <div class="form-control-wrap">
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="1234567890" pattern="[0-9]{10,11}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Zip code -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="code">Zipcode</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter your zipcode" pattern="[a-zA-Z0-9\s]{6,7}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Driving License Number -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="dlno">Driving License Number</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="dlno" name="dlno" placeholder="Enter your driving license number" pattern="[A-Z]{5}[0-9]{6}[A-Z]{2}[0-9]{1}[A-Z]{2}\s[0-9]{2}" required>
                                                            <span class="f-12">e.g. FARME100165AB5EW </span>
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
                                                                        <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" checked required>
                                                                        <label class="custom-control-label" for="sex-male">Male</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" required>
                                                                        <label class="custom-control-label" for="sex-female">Female</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="other" id="sex-other" required>
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
                                                            <textarea class="form-control form-control-sm" id="address" name="address" placeholder="Enter your address here" required></textarea>
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
                                                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your username" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Password -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="form-control-wrap">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Confirm Password -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="conpassword">Confirm Password</label>
                                                        <div class="form-control-wrap">
                                                            <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Re-enter your password" required title="Both password should match" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
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
