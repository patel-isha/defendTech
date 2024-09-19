<?php
include 'config/connection.php';

// Fetch Car Category Details
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $editOwnerSql = "SELECT * FROM `owners` WHERE owner_id = '$id'";
    $editOwnerResult = $conn->query($editOwnerSql);
    if ($editOwnerResult->num_rows > 0) {
        $rowEditOwner = $editOwnerResult->fetch_assoc();
        $user_id = $rowEditOwner["user_id"];
        //User Details
        $editUserSql = "SELECT * FROM `user_register` WHERE user_id = '$user_id'";
        $editUserResult = $conn->query($editUserSql);
        $rowEditUser = $editUserResult->fetch_assoc();
    } else {
        echo "<h3>No Data Found!</h3>";
        die;
    }
}
//Execute the query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateOwner"])) {
        //Retrieve form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact_no = $_POST["phone"];
        $address = $_POST["address"];
        $zipcode = $_POST["code"];
        $gender = $_POST["gender"];
        $username = $_POST["uname"];
        $password = $_POST["password"];

        //SQL query to inser data into the database
        $sql = "UPDATE `owners` SET `name` = '$name',`email` = '$email',`contact_no` = '$contact_no',`address` = '$address',`zipcode` = '$zipcode',`gender` = '$gender' WHERE owner_id = '$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            $user_id = $rowEditOwner["user_id"];
            //SQL query to inser data into the database
            $sqlUser = "UPDATE `user_register` SET `fullname` = '$name',`email` = '$email' WHERE user_id = '$user_id'";
            $conn->query($sqlUser);
            echo "<h3>Owner Updated Successfully!</h3>";
            echo "<script> location.href='owner-list.php'; </script>";
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
                                            <?php if ($_SESSION['roletype'] == 'owner') { ?>
                                                <h3 class="nk-block-title page-title">Edit Profile Details</h3>
                                            <?php } ?>
                                            <?php if ($_SESSION['roletype'] == 'admin') { ?>
                                                <h3 class="nk-block-title page-title">Edit Owner Details</h3>
                                            <?php } ?>
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
                                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rowEditOwner['name'] ?>" placeholder="name" required>
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
                                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $rowEditOwner['email'] ?>" placeholder="email" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Contact no. -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone">Contact No.</label>
                                                        <div class="form-control-wrap">
                                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $rowEditOwner['contact_no'] ?>" pattern="[0-9]{10,11}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Zip code -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="code">Zipcode</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="code" name="code" value="<?php echo $rowEditOwner['zipcode'] ?>" placeholder="zipcode" pattern="[a-zA-Z0-9\s]{6,7}" required>
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
                                                            <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $rowEditUser['username'] ?>" placeholder="abc001" disabled>
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
                                                                        <input type="radio" class="custom-control-input" name="gender" value="male" id="sex-male" <?php if ($rowEditOwner['gender'] == "male") { ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-male">Male</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="female" id="sex-female" <?php if ($rowEditOwner['gender'] == "female") { ?> checked <?php } ?> required>
                                                                        <label class="custom-control-label" for="sex-female">Female</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="gender" value="other" id="sex-other" <?php if ($rowEditOwner['gender'] == "other") { ?> checked <?php } ?> required>
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
                                                            <textarea class="form-control form-control-sm" id="address" name="address" placeholder="address" required><?php echo $rowEditOwner['address'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateOwner" class="btn btn-lg btn-primary">Update</button>
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