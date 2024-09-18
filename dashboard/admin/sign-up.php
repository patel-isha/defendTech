<!DOCTYPE html>
<html>

<?php
include 'include/header-links.php';
include 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact_no = $_POST["phone"];
    $address = $_POST["address"];
    $zipcode = $_POST["code"];
    $gender = $_POST["gender"];
    $username = $_POST["uname"];
    $password = sha1($_POST["password"]);
    $role_type = 'owner';

    //SQL query to inser data into the database
    $sqlUser = "INSERT INTO `user_register`(`role_type`,`full_name`, `email`, `username`, `password`) 
        VALUES ('$role_type','$name', '$email', '$username', '$password')";

    //Execute the query
    if ($conn->query($sqlUser) === TRUE) {
        $last_id = mysqli_insert_id($conn);

        //SQL query to inser data into the database
        $sql = "INSERT INTO `owners`(`name`, `email`, `contact_no`, `address`, `zipcode`, `gender`, `user_id`) 
        VALUES ('$name', '$email', '$contact_no', '$address', '$zipcode', '$gender', '$last_id')";
        $conn->query($sql);

        echo "<h3>Car Owner Added Successfully!</h3>";
        echo "<script> location.href='sign-in.php'; </script>";
    } else {
        echo "Error: " . $sqlUser . "<br>" . $conn->error;
        die;
    }
}
?>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-sm">
                        <div class="brand-logo pb-4 text-center">
                            <a href="dashboard.php" class="logo-link">
                                <img class="logo-img" src="assets/images/logo-blue.png" alt="logo">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register</h4>
                                    </div>
                                </div>
                                <form method="post">
                                    <div class="row g-gs">
                                        <!-- Full name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Full Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Email -->
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Contact No.</label>
                                                <div class="form-control-wrap">
                                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="1234567890" pattern="[0-9]{10,11}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Zip code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="code">Zipcode</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter your zipcode" pattern="[a-zA-Z0-9\s]{6,7}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Address -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address">Address</label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-sm" id="address" name="address" placeholder="Enter your address here" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Gender -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="gender">Gender</label>
                                                <div class="form-control-wrap">
                                                    <ul class="custom-control-group">
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" required>
                                                                <label class="custom-control-label" for="sex-male">Male</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" checked required>
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
                                        <div class="form-group">
                                            <div class="custom-control custom-control-xs custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkbox">
                                                <label class="custom-control-label" for="checkbox">I agree to Dreams Rent <a href="#">Privacy Policy</a> &amp; <a href="#"> Terms.</a></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-primary btn-block" name="register">Register</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="sign-in.php"><strong>Sign in instead</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    include 'include/footer.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'include/footer-scripts.php';
    ?>
</body>

</html>
