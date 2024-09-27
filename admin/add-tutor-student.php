<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';

function sanitize_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve form data
    // Retrieve and sanitize form data
    $fname = sanitize_input($_POST["fname"]);
    $lname = sanitize_input($_POST["lname"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $contact_no = sanitize_input($_POST["phone"]);
    $designation = sanitize_input($_POST["designation"]);
    $gender = sanitize_input($_POST["gender"]);
    $password = SHA1($_POST["password"]);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email formats!';
    }

    // Check if email exist
    $sqlEmail = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($sqlEmail);

    if ($result->num_rows > 0) {
        $error = 'Email already exists!';
    }

    // Validate phone number (optional: add more specific validation if needed)
    if (!preg_match('/^[0-9]{10,11}$/', $contact_no)) {
        $error = 'Invalid phone number format!';
    }

    if (empty($error)) {
        //SQL query to insert data into the database
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `contact_no`, `designation`, `gender`, `password`) 
VALUES ('$fname', '$lname', '$email', '$contact_no', '$designation', '$gender', '$password')";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            $last_id = mysqli_insert_id($conn);

            // Redirect based on designation
            if ($designation === 'tutor') {
                echo "<h3>Tutor Added Successfully!</h3>";
                echo "<script> location.href='tutor-list.php'; </script>";
            } else {
                echo "<h3>Student/Learner Added Successfully!</h3>";
                echo "<script> location.href='student-list.php'; </script>";
            }
        } else {
            $error = 'Something went wrong!';
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
                                            <h3 class="nk-block-title page-title">Add Tutor/Student</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form method="post">
                                            <?php
                                            if (isset($error) && $error != "") {
                                                echo "<div class='alert alert-danger'>" . $error . "</div>";
                                            }
                                            ?>
                                            <div class="row g-gs">
                                                <!-- Full name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label-text">First Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="label-text">Last Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" required>
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
                                                <!-- Designation -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="designation">Designation</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="designation" name="designation" data-placeholder="Select a option" required>
                                                                <option value="">Select designation</option>
                                                                <option value="student">Student/Learner</option>
                                                                <option value="tutor">Tutor</option>
                                                            </select>
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
                                                <!-- Password -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="form-control-wrap">
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" name="addTutor" class="btn btn-lg btn-primary">Submit</button>
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

    <script>
        $(document).ready(function() {
            $("#registerForm").validate({
                rules: {
                    fname: "required",
                    lname: "required",
                    password: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                },
                messages: {
                    fname: "Enter your firstname",
                    lname: "Enter your lastname",
                    password: {
                        required: "Provide a password",
                        minlength: "Enter at least  characters"
                    },
                    email: {
                        required: "Please enter a valid email address",
                        minlength: "Please enter a valid email address",
                    },
                },
            });
        });
    </script>
</body>

</html>