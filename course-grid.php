<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';
session_start();

# Prepare the SELECT Query
$sqlCourseCount = "SELECT COUNT(course_id) as course_count FROM course";
$resultCourseCount = $conn->query($sqlCourseCount);
$countCount = $resultCourseCount->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'include/header-links.php';
?>

<body>
  <!--   start cssload-loader -->
  <div class="preloader">
    <div class="loader">
      <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
      </svg>
    </div>
  </div>
  <!--   end cssload-loader -->

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
          <h2 class="section__title text-white">Courses</h2>
        </div>
        <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
          <li><a href="index.php">Home</a></li>
          <li>Courses</li>
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

  <!--======================================
        START COURSE AREA
======================================-->
  <section class="course-area section--padding">
    <div class="container">
      <div class="filter-bar mb-4">
        <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
          <p class="fs-14">
            We found <span class="text-black"><?php echo $countCount['course_count']; ?></span> courses available for
            you
          </p>
          <div class="d-flex flex-wrap align-items-center">
            <ul class="filter-nav me-3">
              <li>
                <a href="course-grid.php" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><span class="la la-th-large"></span></a>
              </li>
              <li>
                <a href="course-list.php" data-toggle="tooltip" data-placement="top" title="List View"><span class="la la-list"></span></a>
              </li>
            </ul>
          </div>
        </div>
        <!-- end filter-bar-inner -->
      </div>
      <!-- end filter-bar -->
      <div class="row">
        <div class="col-lg-4">
          <div class="sidebar mb-5">
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Search Field</h3>
                <div class="divider"><span></span></div>
                <form method="post">
                  <div class="form-group mb-0">
                    <input class="form-control form--control ps-3" type="text" name="search" id="searchCourse" placeholder="Search courses" />
                    <span class="la la-search search-icon"></span>
                  </div>
                </form>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Ratings</h3>
                <?php
                # Prepare the SELECT Query
                $sqlRatingCount = "SELECT SUM(rating = 5) as five, SUM(rating >= 4.5 && rating < 5 ) as four_half_up, SUM(rating >= 3.0 && rating < 4.5 ) as three_up, SUM(rating >= 2.0 && rating < 3.0 ) as two_up, SUM(rating >= 1.0 && rating < 2.0 ) as one_up FROM course_review";
                $result = $conn->query($sqlRatingCount);
                $ratingCount = $result->fetch_assoc();
                ?>
                <div class="divider"><span></span></div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="common_selector rating custom-control-input" id="fiveStarRating" value="5" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="fiveStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">5.0</span>(<?php echo $ratingCount['five']; ?>)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="common_selector rating custom-control-input" id="fourStarRating" value="4" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="fourStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">4.5 & up</span>(<?php echo $ratingCount['four_half_up']; ?>)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="common_selector rating custom-control-input" id="threeStarRating" value="3" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="threeStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">3.0 & up</span>(<?php echo $ratingCount['three_up']; ?>)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="common_selector rating custom-control-input" id="twoStarRating" value="2" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="twoStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">2.0 & up</span>(<?php echo $ratingCount['two_up']; ?>)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="common_selector rating custom-control-input" id="oneStarRating" value="1" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="oneStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">1.0 & up</span>(<?php echo $ratingCount['one_up']; ?>)</span>
                    </span>
                  </label>
                </div>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Categories</h3>
                <div class="divider"><span></span></div>
                <?php
                # Prepare the SELECT Query
                $sqlCategory = "SELECT cc_name,cc_id,(SELECT COUNT(course_id) FROM course where course.cc_id = course_category.cc_id) as category_count FROM course_category";
                $result = $conn->query($sqlCategory);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="common_selector category custom-control-input" id="catCheckbox_<?php echo $row['cc_id']; ?>" value="<?php echo $row['cc_id']; ?>" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox_<?php echo $row['cc_id']; ?>">
                      <?php echo $row['cc_name']; ?><span class="ms-1 text-gray">(<?php echo $row['category_count']; ?>)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                <?php } ?>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Level</h3>
                <div class="divider"><span></span></div>
                <?php
                # Prepare the SELECT Query
                $sqlLevelCount = "SELECT SUM(course_level = 'Beginner') as beginner, SUM(course_level = 'Intermediate') as intermediate, SUM(course_level = 'Expert') as expert, SUM(course_level = 'All Levels') as allLevels, COUNT(course_id) as total FROM course";
                $resultLevelCount = $conn->query($sqlLevelCount);
                $levelCount = $resultLevelCount->fetch_assoc();
                ?>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector level custom-control-input" value="Beginner" id="levelCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox2">
                    Beginner<span class="ms-1 text-gray">(<?php echo $levelCount['beginner']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector level custom-control-input" value="Intermediate" id="levelCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox3">
                    Intermediate<span class="ms-1 text-gray">(<?php echo $levelCount['intermediate']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector level custom-control-input" value="Expert" id="levelCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox4">
                    Expert<span class="ms-1 text-gray">(<?php echo $levelCount['expert']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector level custom-control-input" value="AllLevels" id="levelCheckbox5" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox5">
                    All Levels<span class="ms-1 text-gray">(<?php echo $levelCount['allLevels']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">By Cost</h3>
                <div class="divider"><span></span></div>
                <?php
                # Prepare the SELECT Query
                $sqlPriceCount = "SELECT SUM(course_cost > 0) as paid, SUM(course_cost = 0) as free, COUNT(*) as total FROM course";
                $result = $conn->query($sqlPriceCount);
                $priceCount = $result->fetch_assoc();
                ?>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector cost custom-control-input" value="paid" id="priceCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="priceCheckbox">
                    Paid<span class="ms-1 text-gray">(<?php echo $priceCount['paid']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="common_selector cost custom-control-input" value="free" id="priceCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="priceCheckbox2">
                    Free<span class="ms-1 text-gray">(<?php echo $priceCount['free']; ?>)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-8">
          <div class="row filter_data">
          </div>
          <!-- end row -->

        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end courses-area -->
  <!--======================================
        END COURSE AREA
======================================-->

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
      function addToCart(course_id) {
          $.ajax({
              url: 'add_to_cart.php', // The PHP file that processes the cart
              method: 'POST',
              data: {
                  course_id: course_id,
              },
              success: function(response) {
                  // Update the cart count (or other UI elements) dynamically
                  var cart = JSON.parse(response);
                  $('.product-count').text(cart.cart_count);
              },
              error: function(xhr, status, error) {
                  console.error('AJAX Error:', status, error);
              }
          });
      }
    $(document).ready(function() {

      filter_data();

      function filter_data() {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var type = 'grid';
        var search = $('#searchCourse').val();
        var cost = get_filter('cost');
        var rating = get_filter('rating');
        var category = get_filter('category');
        var tutor = get_filter('tutor');
        var level = get_filter('level');
        $.ajax({
          url: "fetch-filter-course.php",
          method: "POST",
          data: {
            action: action,
            type: type,
            cost: cost,
            rating: rating,
            category: category,
            tutor: tutor,
            search: search,
            level: level,
          },
          success: function(data) {
            $('.filter_data').html(data);
          }
        });
      }

      function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
          filter.push($(this).val());
        });
        return filter;
      }

      $('.common_selector').click(function() {
        filter_data();
      });

      $('#searchCourse').keyup(function() {
        filter_data();
      });
    });
  </script>
</body>

</html>
