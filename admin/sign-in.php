<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';

// Check if user is logged in
if (isset($_SESSION['username']) != "") {
    header("Location:dashboard.php");
}

//Check if the form was submitted
if (isset($_POST['login'])) {
    $username = $_POST["uname"];
    $password = SHA1($_POST["password"]);

    $sql = "SELECT * FROM `users` where email = '$username' and password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the first (and only) row
        $row = $result->fetch_assoc();
        if ($row['designation'] == "admin" || $row['designation'] == "tutor") {
            $_SESSION['designation'] = $row['designation'];
            $_SESSION['fullname'] = $row['first_name']." ".$row['last_name'];

            if ($row['designation'] == 'tutor') {
                $user_id = $row['user_id'];
                $sqlTutor = "SELECT * FROM `users` where user_id = '$user_id'";
                $resultTutor = $conn->query($sqlTutor);
                $rowTutor = $resultTutor->fetch_assoc();
            }
            //Get Tutor Details
            $_SESSION['admin_id'] = $row['user_id'];
            header("Location:course-list.php");
        } else if ($row['designation'] == "student"){
            $error = 'No records found!';
        }
    } else {
        $error = 'No records found!';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Page Title  -->
    <title>DefendTech Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="assets/css/dashlite.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="assets/css/theme.css?ver=3.2.2">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/fontawesome-icons.css">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="dashboard.php" class="logo-link">
                                <img class="w-45" src="assets/images/logo-png.png" alt="logo">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>
                                    </div>
                                </div>
                                <form method="post">
                                    <?php
                                    if (isset($error) && $error != "") {
                                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                                    }
                                    ?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="uname">Username</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="uname" name="uname" placeholder="Enter your username" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            <a class="link link-primary link-sm" href="forgot-password.php">Forgot Password?</a>
                                        </div>
                                        <div class="form-control-wrap pass-group">
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your password" required>
                                            <div class="form-icon form-icon-right toggle-password"><span class="fas fa-eye"></span></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block" name="login">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="nk-footer">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="col-lg-6 order-lg-last">
                        <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a class="nav-link" href="../../terms-and-conditions.php">Terms & Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../privacy-policy.php">Privacy Policy</a>
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
        </footer>
    </div>
    <script>
        var passwordInput = document.getElementById('password');
        var togglePassword = document.querySelector('.toggle-password');

        togglePassword.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePassword.innerHTML = '<span class="fas fa-eye-slash"></span>';
            } else {
                passwordInput.type = 'password';
                togglePassword.innerHTML = '<span class="fas fa-eye"></span>';
            }
        });
    </script>
    <script src="assets/js/bundle.js?ver=3.2.2"></script>
    <script src="assets/js/scripts.js?ver=3.2.2"></script>
</body>

</html>
