<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';
include 'include/session.php';

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Fetch the user details as an associative array
  $user = $result->fetch_assoc();
} else {
  echo "No user found!";
  exit;
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
              <h2 class="section__title fs-30"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></h2>
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
              <span class="profile-name">Registration Date:</span><span class="profile-desc"><?php echo date("D d M Y, h:i:s A", strtotime($user['created_at'])); ?></span>
            </li>
            <li>
              <span class="profile-name">First Name:</span><span class="profile-desc"><?php echo $user['first_name']; ?></span>
            </li>
            <li>
              <span class="profile-name">Last Name:</span><span class="profile-desc"><?php echo $user['last_name']; ?></span>
            </li>
            <li>
              <span class="profile-name">Email:</span><span class="profile-desc"><?php echo $user['email']; ?></span>
            </li>
            <li>
              <span class="profile-name">Contact Number:</span><span class="profile-desc"><?php echo $user['contact_no']; ?></span>
            </li>
            <li>
              <span class="profile-name">Gender:</span><span class="profile-desc"><?php echo ucfirst($user['gender']); ?></span>
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
