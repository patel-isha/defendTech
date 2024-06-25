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
              <p class="fs-15 lh-24 pb-3">
                Enter the email of your account to reset password. Then you
                will receive a link to email to reset the password.If you have
                any issue about reset password
                <a href="contact.php" class="text-color hover-underline">contact us</a>
              </p>
              <div class="section-block"></div>
              <form method="post" class="pt-4">
                <div class="input-box">
                  <label class="label-text">Email Address</label>
                  <div class="form-group">
                    <input class="form-control form--control" type="text" name="name" placeholder="Enter email Address" />
                    <span class="la la-user input-icon"></span>
                  </div>
                </div>
                <!-- end input-box -->
                <div class="btn-box">
                  <button class="btn theme-btn" type="submit">
                    Reset Password <i class="la la-arrow-right icon ms-1"></i>
                  </button>
                  <div class="d-flex align-items-center justify-content-between fs-14 pt-2">
                    <a href="login.php" class="text-color hover-underline">Login</a>
                    <p>
                      Not a member?
                      <a href="sign-up.php" class="text-color hover-underline">Register</a>
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
</body>

</html>