<?php
include 'config/connection.php';

//Check if the form was submitted
if (isset($_POST['recover_password'])) {
    $email = $_GET["email"];
    $oldPassword = SHA1($_POST["password"]);
    $password = SHA1($_POST["new_password"]);

    $checkEmail = "SELECT * FROM `users` where email = '$email' AND password = '$oldPassword' AND designation !='admin' ";
    $resultEmail = $conn->query($checkEmail);
    if ($resultEmail->num_rows > 0) {
        $sqlUser = "UPDATE `users` SET `password` = '$password' WHERE email = '$email'";
        $conn->query($sqlUser);
        echo "<script> location.href='recover-password-success.php'; </script>";
    }else{
        $error = "Email or Password is Incorrect!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'include/header-links.php';
?>

<body>
  <!-- start cssload-loader -->
  <div class="preloader">
    <div class="loader">
      <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
      </svg>
    </div>
  </div>
  <!-- end cssload-loader -->

  <?php
  include 'include/header.php';
  ?>

  <!-- ================================
    START BREADCRUMB AREA
================================= -->
  <section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
      <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
        <div class="section-heading">
          <h2 class="section__title text-white">Recover Password</h2>
        </div>
        <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
          <li><a href="index.php">Home</a></li>
          <li><a href="login.php">Login</a></li>
          <li>Recover Password</li>
        </ul>
      </div>
      <!-- end breadcrumb-content -->
    </div>
    <!-- end container -->
  </section>
  <!-- end breadcrumb-area -->
  <!-- ================================
    END BREADCRUMB AREA
================================= -->

  <!-- ================================
       START CONTACT AREA
================================= -->
  <section class="contact-area section--padding position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto">
          <div class="card card-item">
            <div class="card-body">
              <h3 class="card-title fs-24 lh-35 pb-2">Reset Password!</h3>
              <div class="section-block"></div>
              <form method="post" class="pt-4">
                  <?php
                  if (isset($error) && $error != "") {
                      echo "<div class='alert alert-danger'>".$error."</div>";
                  }
                  ?>
                <div class="input-box">
                  <label class="label-text">Old Password</label>
                  <div class="form-group">
                    <input class="form-control form--control" type="password" name="password" id="password" placeholder="Enter old Password" required />
                    <span class="la la-user input-icon"></span>
                  </div>
                </div>
                <!-- end input-box -->
                  <div class="input-box">
                      <label class="label-text">New Password</label>
                      <div class="form-group">
                          <input class="form-control form--control" type="password" name="new_password" id="new_password" placeholder="Enter New Password" required />
                          <span class="la la-user input-icon"></span>
                      </div>
                  </div>
                  <!-- end input-box -->
                  <div class="input-box">
                      <label class="label-text">Confirm Password</label>
                      <div class="form-group">
                          <input class="form-control form--control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter Confirm Password" required />
                          <span class="la la-user input-icon"></span>
                      </div>
                  </div>
                  <!-- end input-box -->
                <div class="btn-box">
                  <button class="btn theme-btn" name="recover_password" type="submit">
                    Reset Password <i class="la la-arrow-right icon ms-1"></i>
                  </button>
                  <div class="d-flex align-items-center justify-content-between fs-14 pt-2">
                    <a href="login.php" class="text-color hover-underline">Login</a>
                    <p>
                      Not a member?
                      <a href="register.php" class="text-color hover-underline">Register</a>
                    </p>
                  </div>
                </div>
                <!-- end btn-box -->
              </form>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
        </div>
        <!-- end col-lg-7 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end contact-area -->
  <!-- ================================
       END CONTACT AREA
================================= -->
  <?php
  include 'include/footer.php';
  ?>

  <!-- start scroll top -->
  <div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
  </div>
  <!-- end scroll top -->
  <?php
  include 'include/footer-scripts.php';
  ?>
  <script>
      var new_password = document.getElementById("new_password")
          , confirm_password = document.getElementById("confirm_password");

      function validatePassword(){
          if(new_password.value != confirm_password.value) {
              confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
              confirm_password.setCustomValidity('');
          }
      }

      new_password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
  </script>
</body>

</html>
