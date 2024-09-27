<?php
include 'config/connection.php';

// Fetch Tutor Details
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $editTutorSql = "SELECT * FROM `users` WHERE user_id = '$id'";
    $editTutorResult = $conn->query($editTutorSql);
    if ($editTutorResult->num_rows > 0) {
        $rowEditTutor = $editTutorResult->fetch_assoc();
    } else {
        echo "<h3>No Data Found!</h3>";
        die;
    }
}

function sanitize_input($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

//Execute the query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateTutor"])) {
        //Retrieve form data
        $fname = sanitize_input($_POST["first_name"]);
        $lname = sanitize_input($_POST["last_name"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $contact_no = sanitize_input($_POST["phone"]);
        $designation = sanitize_input($_POST["designation"]);
        $gender = sanitize_input($_POST["gender"]);

        //SQL query to inser data into the database
        $sql = "UPDATE `users` SET `first_name` = '$fname',`last_name` = '$lname',`email` = '$email',`contact_no` = '$contact_no',`designation` = '$designation',`gender` = '$gender' WHERE user_id = '$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            $last_id = mysqli_insert_id($conn);
            // Redirect based on designation
            if ($designation === 'tutor') {
                echo "<h3>Tutor Updated Successfully!</h3>";
                echo "<script> location.href='tutor-list.php'; </script>";
            } else {
                echo "<h3>Student/Learner Updated Successfully!</h3>";
                echo "<script> location.href='student-list.php'; </script>";
            }
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
                                            <h3 class="nk-block-title page-title">
                                                <?php if ($_SESSION['designation'] == 'tutor') { ?>
                                                    Edit Profile Details
                                                <?php } else if ($_SESSION['designation'] == 'admin') { ?>
                                                    Edit Tutor/Student Details
                                                <?php } ?>
                                            </h3>
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
                                                        <label class="form-label" for="fname">First Name</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" id="fname" name="first_name" value="<?php echo $rowEditTutor['first_name'] ?>" placeholder="First Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="lname">Last Name</label>
                                                        <div class="form-control-wrap">
                                                            <input class="form-control" id="lname" name="last_name" value="<?php echo $rowEditTutor['last_name'] ?>" placeholder="Last Name" required>
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
                                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $rowEditTutor['email'] ?>" placeholder="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Contact no. -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">Contact No.</label>
                                                        <div class="form-control-wrap">
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $rowEditTutor['contact_no'] ?>" pattern="[0-9]{10,11}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Designation -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="designation">Designation</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="designation" name="designation" data-placeholder="Select a option" required disabled>
                                                                <option value="">Select designation</option>
                                                                <option value="student" <?php echo (isset($rowEditTutor['designation']) && $rowEditTutor['designation'] === 'student') ? 'selected' : ''; ?>>Student/Learner</option>
                                                                <option value="tutor" <?php echo (isset($rowEditTutor['designation']) && $rowEditTutor['designation'] === 'tutor') ? 'selected' : ''; ?>>Tutor</option>
                                                            </select>
                                                            <input type="hidden" name="designation" value="<?php echo isset($rowEditTutor['designation']) ? $rowEditTutor['designation'] : ''; ?>">
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
                                                                        <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" <?php if ($rowEditTutor['gender'] == "male") { ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-male">Male</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" <?php if ($rowEditTutor['gender'] == "female") { ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-female">Female</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="other" id="sex-other" <?php if ($rowEditTutor['gender'] == "other") { ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-other">Others</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateTutor" class="btn btn-lg btn-primary">Update</button>
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