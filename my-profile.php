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
        <div
          class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-5">
          <div class="media media-card align-items-center">
            <div class="media-img media--img media-img-md rounded-full">
              <img
                class="rounded-full"
                src="assets/images/small-avatar-1.jpg"
                alt="Student thumbnail image" />
            </div>
            <div class="media-body">
              <h2 class="section__title fs-30">Howdy, Tim Buchalka</h2>
            </div>
            <!-- end media-body -->
          </div>
          <!-- end media -->
        </div>
        <!-- end breadcrumb-content -->
        <div class="section-block mb-5"></div>
        <div class="dashboard-heading mb-5">
          <h3 class="fs-22 font-weight-semi-bold">My Profile</h3>
        </div>
        <div class="profile-detail mb-5">
          <ul class="generic-list-item generic-list-item-flash">
            <li>
              <span class="profile-name">Registration Date:</span><span class="profile-desc">Sat 20 Apr 2019, 03:50:30 AM</span>
            </li>
            <li>
              <span class="profile-name">First Name:</span><span class="profile-desc">Alex</span>
            </li>
            <li>
              <span class="profile-name">Last Name:</span><span class="profile-desc">Smith</span>
            </li>
            <li>
              <span class="profile-name">Email:</span><span class="profile-desc">alexsmith@gmail.com</span>
            </li>
            <li>
              <span class="profile-name">Contact Number:</span><span class="profile-desc">(91) 7547 622250</span>
            </li>
            <li>
              <span class="profile-name">Gender:</span><span class="profile-desc">Male</span>
            </li>
          </ul>
        </div>
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