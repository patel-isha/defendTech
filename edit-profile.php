<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';
include 'include/session.php';

// Fetch user data based on session user id
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission and update the user profile
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    
    // Update user information in the database
    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_no = '$contact_no' WHERE user_id = '$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<h3>Profile Updated Successfully!</h3>";
        echo "<script>location.href='edit-profile.php';</script>"; // Redirect to the same page to see the updated data
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch the current user data
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User data found
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
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
      </svg>
    </div>
  </div>
  <!-- end cssload-loader -->

  <!-- ================================
    START DASHBOARD AREA
  ================================ -->
  <section class="dashboard-area">
    <?php
    include 'include/profile-sidebar.php';
    ?>
    <div class="dashboard-content-wrap">
      <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ms-3">
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
              <img class="me-3" src="assets/images/team11.jpg" alt="avatar image" />
            </div>
            <div class="media-body">
              <div class="file-upload-wrap file-upload-wrap-2">
                <input type="file" name="files[]" class="multi file-upload-input with-preview" multiple />
                <span class="file-upload-text"><i class="la la-photo me-2"></i>Upload a Photo</span>
              </div>
              <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg & .png</p>
            </div>
          </div>
          <!-- end media -->

          <!-- Form for editing profile -->
          <form method="post" class="row pt-40px">
            <div class="input-box col-lg-6">
              <label class="label-text">First Name</label>
              <div class="form-group">
                <input
                  class="form-control form--control"
                  type="text"
                  name="first_name"
                  value="<?php echo htmlspecialchars($user['first_name']); ?>" />
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
                  name="last_name"
                  value="<?php echo htmlspecialchars($user['last_name']); ?>" />
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
                  value="<?php echo htmlspecialchars($user['email']); ?>" />
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
                  name="contact_no"
                  value="<?php echo htmlspecialchars($user['contact_no']); ?>" />
                <span class="la la-phone input-icon"></span>
              </div>
            </div>
            <!-- end input-box -->
            <div class="input-box col-lg-12 py-2">
              <button class="btn theme-btn" type="submit">Save Changes</button>
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
  ================================ -->

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
