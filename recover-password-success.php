<?php
include 'config/connection.php';
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
              <h3 class="card-title fs-24 lh-35 pb-2">Reset Password</h3>
              <div class="section-block"></div>
              <form method="post" class="pt-4">
                  <div class='alert alert-success'>Password has been reset successfully</div>
                <div class="btn-box">
                  <div class="d-flex align-items-center justify-content-between fs-14 pt-2">
                    <a href="login.php" class="text-color hover-underline">Login</a>
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
