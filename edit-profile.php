<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';
include 'include/session.php';
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
        <circle
          class="path"
          cx="25"
          cy="25"
          r="20"
          fill="none"
          stroke-width="5"></circle>
      </svg>
    </div>
  </div>
  <!-- end cssload-loader -->

  <!-- ================================
    START DASHBOARD AREA
================================= -->
  <section class="dashboard-area">
    <?php
    include 'include/profile-sidebar.php';
    ?>
    <div class="dashboard-content-wrap">
      <div
        class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
        <i class="la la-bars me-1"></i> Dashboard Nav
      </div>
      <div class="container-fluid">
        <div class="section-block mb-5"></div>
        <div class="dashboard-heading mb-5">
          <h3 class="fs-22 font-weight-semi-bold">Edit Profile</h3>
        </div>
        <div class="setting-body">
          <div class="media media-card align-items-center">
            <div class="media-img media-img-lg me-4 bg-gray">
              <img
                class="me-3"
                src="assets/images/team11.jpg"
                alt="avatar image" />
            </div>
            <div class="media-body">
              <div class="file-upload-wrap file-upload-wrap-2">
                <input
                  type="file"
                  name="files[]"
                  class="multi file-upload-input with-preview"
                  multiple />
                <span class="file-upload-text"><i class="la la-photo me-2"></i>Upload a Photo</span>
              </div>
              <!-- file-upload-wrap -->
              <p class="fs-14">
                Max file size is 5MB, Minimum dimension: 200x200 And
                Suitable files are .jpg & .png
              </p>
            </div>
          </div>
          <!-- end media -->
          <form method="post" class="row pt-40px">
            <div class="input-box col-lg-6">
              <label class="label-text">First Name</label>
              <div class="form-group">
                <input
                  class="form-control form--control"
                  type="text"
                  name="text"
                  value="Alex" />
                <span class="la la-user input-icon"></span>
              </div>
            </div>
            <!-- end input-box -->
            <div class="input-box col-lg-6">
              <label class="label-text">Last Name</label>
              <div class="form-group">
                <input
                  class="form-control form--control"
                  type="text"
                  name="text"
                  value="Smith" />
                <span class="la la-user input-icon"></span>
              </div>
            </div>
            <!-- end input-box -->
            <div class="input-box col-lg-6">
              <label class="label-text">Email Address</label>
              <div class="form-group">
                <input
                  class="form-control form--control"
                  type="email"
                  name="email"
                  value="alexsmith@gmail.com" />
                <span class="la la-envelope input-icon"></span>
              </div>
            </div>
            <!-- end input-box -->
            <div class="input-box col-lg-6">
              <label class="label-text">Contact Number</label>
              <div class="form-group">
                <input
                  class="form-control form--control"
                  type="text"
                  name="text"
                  value="(91) 7547 622250" />
                <span class="la la-phone input-icon"></span>
              </div>
            </div>
            <!-- end input-box -->
            <div class="input-box col-lg-12 py-2">
              <button class="btn theme-btn">Save Changes</button>
            </div>
            <!-- end input-box -->
          </form>
        </div>
        <!-- end setting-body -->
        <?php
        include 'include/profile-footer.php';
        ?>
        <!-- end row -->
      </div>
      <!-- end container-fluid -->
    </div>
    <!-- end dashboard-content-wrap -->
  </section>
  <!-- end dashboard-area -->
  <!-- ================================
    END DASHBOARD AREA
================================= -->

  <!-- start scroll top -->
  <div id="scroll-top">
    <i class="la la-arrow-up" title="Go top"></i>
  </div>
  <!-- end scroll top -->

  <!-- Modal -->
  <div
    class="modal fade modal-container"
    id="deleteModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="deleteModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <span class="la la-exclamation-circle fs-60 text-warning"></span>
          <h4 class="modal-title fs-19 font-weight-semi-bold pt-2 pb-1">
            Your account will be deleted permanently!
          </h4>
          <p>Are you sure you want to delete your account?</p>
          <div class="btn-box pt-4">
            <button
              type="button"
              class="btn font-weight-medium me-3"
              data-bs-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">
              Ok, Delete
            </button>
          </div>
        </div>
        <!-- end modal-body -->
      </div>
      <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
  </div>
  <!-- end modal -->

  <?php
  include 'include/footer-scripts.php';
  ?>
</body>

</html>