<?php
include 'config/connection.php';

//Check if the form was submitted
if (isset($_POST['forgot_password'])) {
    $email = $_POST["email"];

    $sql = "SELECT * FROM `users` where email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the first (and only) row
        $row = $result->fetch_assoc();
        if ($row['designation'] == "admin") {
            echo "<script> location.href='reset-password.php?email=" . $email . "'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    } else {
        echo 'No records found';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon-dashboard.png">
    <!-- Page Title  -->
    <title>Dream Rent Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body">
                        <div class="brand-logo pb-4 text-center">
                            <a href="dashboard.php" class="logo-link">
                                <img class="logo-img" src="assets/images/logo-blue.png" alt="logo">
                            </a>
                        </div>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Forgot password</h5>
                                <div class="nk-block-des">
                                    <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <form method="post">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="default-01">Email</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg" id="default-01" name="email" placeholder="Enter your email address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="forgot_password" class="btn btn-lg btn-primary btn-block">Reset Password</button>
                            </div>
                        </form><!-- form -->
                        <div class="form-note-s2 pt-5">
                            <a href="sign-in.php"><strong>Return to login</strong></a>
                        </div>
                    </div><!-- .nk-block -->
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Conditions</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-start">
                                        <p class="text-soft">Copyright &copy;
                                            <script>
                                                document.write(new Date().getFullYear())
                                            </script> DefendTech. All Rights Reserved
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bundle.js?ver=3.2.2"></script>
    <script src="assets/js/scripts.js?ver=3.2.2"></script>
</body>

</html>