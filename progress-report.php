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
          <h3 class="fs-22 font-weight-semi-bold">Quiz Attempts</h3>
        </div>
        <div class="table-responsive pb-4">
          <table class="table generic-table">
            <thead>
              <tr>
                <th scope="col">Course Title</th>
                <th scope="col">Questions</th>
                <th scope="col">Total Marks</th>
                <th scope="col">Earned Marks</th>
                <th scope="col">Pass Marks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
                  <ul class="generic-list-item">
                    <li>
                      <span class="badge bg-success text-white p-1">Passed</span>
                      <span>September 27, 2024</span>
                    </li>
                    <li>
                      <a href="course-details.php" class="text-black">Cybersecurity Basics</a>
                    </li>
                  </ul>
                </th>
                <td>
                  <ul class="generic-list-item">
                    <li>6</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>30</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>25</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>20</li>
                  </ul>
                </td>
              </tr>
              <tr>
                <th scope="row">
                  <ul class="generic-list-item">
                    <li>
                      <span class="badge bg-danger text-white p-1">Failed</span>
                      <span>September 26, 2024</span>
                    </li>
                    <li>
                      <a href="course-details.php" class="text-black">Cybersecurity Basics</a>
                    </li>
                  </ul>
                </th>
                <td>
                  <ul class="generic-list-item">
                    <li>6</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>30</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>5</li>
                  </ul>
                </td>
                <td>
                  <ul class="generic-list-item">
                    <li>20</li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
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