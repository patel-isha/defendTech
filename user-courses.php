<?php
include 'config/connection.php';
include 'include/session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $courseId = sanitize_input($_POST["course_id"]);
    $user_id = $_SESSION['user_id'];

    // Check if already enrolled
    $sqlUserCourse = "SELECT * FROM user_courses WHERE course_id = '$courseId' AND user_id = '$user_id' and status = 0";

    $result = $conn->query($sqlUserCourse);

    if ($result->num_rows > 0) {
        $error = 'Course Already Enrolled!';
    }

    //SQL query to insert data into the database
    $sql = "INSERT INTO `user_courses`(`course_id`, `user_id`, `status`) 
  VALUES ('$courseId', '$user_id', '0')";

    //Execute the query
    if ($conn->query($sql) === TRUE) {
        $last_id = mysqli_insert_id($conn);

        $message = 'Course Enrolled successfully!';
        echo "<script> location.href='course-details.php?id='".$last_id."; </script>";
    } else {
        $error = 'Course enrolment failed!';
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
          <h2 class="section__title text-white">Course List</h2>
        </div>
        <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
          <li><a href="index.php">Home</a></li>
          <li>Courses</li>
          <li>Course List</li>
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
  <section class="course-area section-padding">
    <div class="container">
      <div class="filter-bar mb-4">
        <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
          <p class="fs-14">
            We found <span class="text-black">56</span> courses available for
            you
          </p>
          <div class="d-flex flex-wrap align-items-center">
            <ul class="filter-nav me-3">
              <li>
                <a href="course-grid.php" data-toggle="tooltip" data-placement="top" title="Grid View"><span class="la la-th-large"></span></a>
              </li>
              <li>
                <a href="course-list.php" data-toggle="tooltip" data-placement="top" title="List View" class="active"><span class="la la-list"></span></a>
              </li>
            </ul>
            <div class="select-container select--container me-3">
              <select class="select-container-select">
                <option value="all-category">All Category</option>
                <option value="newest">Newest courses</option>
                <option value="oldest">Oldest courses</option>
                <option value="high-rated">Highest rated</option>
                <option value="popular-courses">Popular courses</option>
                <option value="high-to-low">Price: high to low</option>
                <option value="low-to-high">Price: low to high</option>
              </select>
            </div>
            <a class="btn theme-btn theme-btn-sm theme-btn-white lh-28 collapse-btn py-1" data-bs-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
              Filters <i class="la la-angle-down ms-1 collapse-btn-hide"></i>
              <i class="la la-angle-up ms-1 collapse-btn-show"></i>
            </a>
          </div>
        </div>
        <!-- end filter-bar-inner -->
        <div class="collapse pt-4" id="collapseFilter">
          <div class="row">
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Ratings</h3>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="custom-control-input" id="fiveStarRating" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="fiveStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">5.0</span>(20,230)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="custom-control-input" id="fourStarRating" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="fourStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">4.5 & up</span>(10,230)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="custom-control-input" id="threeStarRating" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="threeStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">3.0 & up</span>(7,230)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="custom-control-input" id="twoStarRating" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="twoStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">2.0 & up</span>(5,230)</span>
                    </span>
                  </label>
                </div>
                <div class="custom-control custom-radio mb-1 fs-15">
                  <input type="radio" class="custom-control-input" id="oneStarRating" name="radio-stacked" required />
                  <label class="custom-control-label custom--control-label" for="oneStarRating">
                    <span class="rating-wrap d-flex align-items-center">
                      <span class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </span>
                      <span class="rating-total ps-1"><span class="me-1 text-black">1.0 & up</span>(3,230)</span>
                    </span>
                  </label>
                </div>
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Categories</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="catCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="catCheckbox">
                    Business<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="catCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="catCheckbox2">
                    UI & UX<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="catCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="catCheckbox3">
                    Animation<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="catCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="catCheckbox4">
                    Game Design<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="collapse" id="collapseMore">
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox5" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox5">
                      Graphic Design<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox6" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox6">
                      Typography<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox7" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox7">
                      Web Development<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox8" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox8">
                      Photography<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="catCheckbox9" required />
                    <label class="custom-control-label custom--control-label text-black" for="catCheckbox9">
                      Finance<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                </div>
                <!-- end collapse -->
                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMore" role="button" aria-expanded="false" aria-controls="collapseMore">
                  <span class="collapse-btn-hide">Show more<i class="la la-angle-down ms-1 fs-14"></i></span>
                  <span class="collapse-btn-show">Show less<i class="la la-angle-up ms-1 fs-14"></i></span>
                </a>
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">
                  Video Duration
                </h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="videoDurationCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="videoDurationCheckbox">
                    0-2 Hours<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="videoDurationCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="videoDurationCheckbox2">
                    3-6 Hours<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="videoDurationCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="videoDurationCheckbox3">
                    7-14 Hours<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="videoDurationCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="videoDurationCheckbox4">
                    16+ Hours<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Level</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="levelCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox">
                    All Levels<span class="ms-1 text-gray">(20,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox2">
                    Beginner<span class="ms-1 text-gray">(5,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox3">
                    Intermediate<span class="ms-1 text-gray">(3,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="levelCheckbox4">
                    Expert<span class="ms-1 text-gray">(1,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Language</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="lanCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="lanCheckbox">
                    English<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="laCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="laCheckbox2">
                    Português<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="lanCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="lanCheckbox3">
                    Español<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="lanCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="lanCheckbox4">
                    Türkçe<span class="ms-1 text-gray">(12,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="collapse" id="collapseMoreTwo">
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="lanCheckbox5" required />
                    <label class="custom-control-label custom--control-label text-black" for="lanCheckbox5">
                      Français<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="lanCheckbox6" required />
                    <label class="custom-control-label custom--control-label text-black" for="lanCheckbox6">
                      中文<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="lanCheckbox7" required />
                    <label class="custom-control-label custom--control-label text-black" for="lanCheckbox7">
                      Deutsch<span class="ms-1 text-gray">(12,300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="lanCheckbox8" required />
                    <label class="custom-control-label custom--control-label text-black" for="lanCheckbox8">
                      日本語<span class="ms-1 text-gray">(300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="lanCheckbox9" required />
                    <label class="custom-control-label custom--control-label text-black" for="lanCheckbox9">
                      Polski<span class="ms-1 text-gray">(300)</span>
                    </label>
                  </div>
                  <!-- end custom-control -->
                </div>
                <!-- end collapse -->
                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMoreTwo" role="button" aria-expanded="false" aria-controls="collapseMoreTwo">
                  <span class="collapse-btn-hide">Show more<i class="la la-angle-down ms-1 fs-14"></i></span>
                  <span class="collapse-btn-show">Show less<i class="la la-angle-up ms-1 fs-14"></i></span>
                </a>
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">By Cost</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="priceCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="priceCheckbox">
                    Paid<span class="ms-1 text-gray">(19,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="priceCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="priceCheckbox2">
                    Free<span class="ms-1 text-gray">(1,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="priceCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="priceCheckbox3">
                    All<span class="ms-1 text-gray">(20,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Instructors</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="instructorCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox">
                    All Instructor
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="instructorCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox2">
                    Aatef Jaberi
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="instructorCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox3">
                    Emilee Logan
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="instructorCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox4">
                    Harley Ferrell
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="collapse" id="collapseMoreThree">
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox5" required />
                    <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox5">
                      Nahla Jones
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox6" required />
                    <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox6">
                      Tomi Hensley
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox7" required />
                    <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox7">
                      Foley Patrik
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox8" required />
                    <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox8">
                      Oliver Porter
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <div class="custom-control custom-checkbox mb-1 fs-15">
                    <input type="checkbox" class="custom-control-input" id="instructorCheckbox9" required />
                    <label class="custom-control-label custom--control-label text-black" for="instructorCheckbox9">
                      Fahad Chaudhry
                    </label>
                  </div>
                  <!-- end custom-control -->
                </div>
                <!-- end collapse -->
                <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMoreThree" role="button" aria-expanded="false" aria-controls="collapseMoreThree">
                  <span class="collapse-btn-hide">Show more<i class="la la-angle-down ms-1 fs-14"></i></span>
                  <span class="collapse-btn-show">Show less<i class="la la-angle-up ms-1 fs-14"></i></span>
                </a>
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-3">
              <div class="widget-panel">
                <h3 class="fs-18 font-weight-semi-bold pb-3">Features</h3>
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="featureCheckbox" required />
                  <label class="custom-control-label custom--control-label text-black" for="featureCheckbox">
                    Captions<span class="ms-1 text-gray">(20,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="featureCheckbox2" required />
                  <label class="custom-control-label custom--control-label text-black" for="featureCheckbox2">
                    Quizzes<span class="ms-1 text-gray">(5,300)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="featureCheckbox3" required />
                  <label class="custom-control-label custom--control-label text-black" for="featureCheckbox3">
                    Coding Exercises<span class="ms-1 text-gray">(12)</span>
                  </label>
                </div>
                <!-- end custom-control -->
                <div class="custom-control custom-checkbox mb-1 fs-15">
                  <input type="checkbox" class="custom-control-input" id="featureCheckbox4" required />
                  <label class="custom-control-label custom--control-label text-black" for="featureCheckbox4">
                    Practice Tests<span class="ms-1 text-gray">(200)</span>
                  </label>
                </div>
                <!-- end custom-control -->
              </div>
              <!-- end widget-panel -->
            </div>
            <!-- end col-lg-3 -->
          </div>
          <!-- end row -->
        </div>
        <!-- end collapse -->
      </div>
      <!-- end filter-bar -->
      <div class="row">
          <?php
          # Prepare the SELECT Query for courses in the current category
          $sqlCourses = "SELECT course.*, AVG(course_review.rating) AS avg_rating, COUNT(course_review.review) AS total_reviews 
                                       FROM course 
                                       LEFT JOIN course_review ON course.course_id = course_review.course_id 
                                       GROUP BY course.course_id";
          $coursesResult = $conn->query($sqlCourses);

          if ($coursesResult->num_rows > 0) {
          while ($course = $coursesResult->fetch_assoc()) {
          ?>
        <div class="col-lg-12">
          <div class="card card-item card-preview card-item-list-layout" data-tooltip-content="#tooltip_content_1">
            <div class="card-image">
              <a href="course-details.php?course_id=<?php echo $course['course_id']; ?>" class="d-block">
                <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="<?php echo $course['course_image']; ?>" alt="Card image cap" />
              </a>
              <div class="course-badge-labels">
                <div class="course-badge">Bestseller</div>
                <div class="course-badge blue">-39%</div>
              </div>
            </div>
            <!-- end card-image -->
            <div class="card-body">
              <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
              <h5 class="card-title">
                <a href="course-details.php"><?php echo $course['course_title']; ?></a>
              </h5>
              <p class="card-text">
                <a href="teacher-detail.html"><?php echo $course['course_author']; ?></a>
              </p>
              <div class="rating-wrap d-flex align-items-center py-2">
                <div class="review-stars">
                  <span class="rating-number">4.4</span>
                  <span class="la la-star"></span>
                  <span class="la la-star"></span>
                  <span class="la la-star"></span>
                  <span class="la la-star"></span>
                  <span class="la la-star-o"></span>
                </div>
                <span class="rating-total ps-1">(20,230)</span>
              </div>
              <!-- end rating-wrap -->
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-price text-black font-weight-bold">
                  12.99
                  <span class="before-price font-weight-medium">129.99</span>
                </p>
                <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                  <i class="la la-heart-o"></i>
                </div>
              </div>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
        </div>
        <!-- end col-lg-12 -->
      <?php }  ?>

      <?php } else { ?>
          <div class="col-lg-4">No courses found</div>';
      <?php } ?>
      </div>
      <!-- end row -->
      <div class="text-center pt-3">
        <nav aria-label="Page navigation example" class="pagination-box">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
        <p class="fs-14 pt-2">Showing 1-6 of 56 results</p>
      </div>
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

  <div class="tooltip_templates">
    <div id="tooltip_content_1">
      <div class="card card-item">
        <div class="card-body">
          <h5 class="card-title">What you’ll learn</h5>
          <ul class="generic-list-item fs-14 pt-2">
            <li>
              <i class="la la-check me-1 text-black"></i> Become an expert in
              Statistics, SQL, Tableau, and problem solving
            </li>
            <li>
              <i class="la la-check me-1 text-black"></i> Boost your resume
              with in-demand skills
            </li>
            <li>
              <i class="la la-check me-1 text-black"></i> Gather, organize,
              analyze and visualize data
            </li>
          </ul>
        </div>
      </div>
      <!-- end card -->
    </div>
  </div>
  <!-- end tooltip_templates -->

  <?php
  include 'include/footer-scripts.php';
  ?>
</body>

</html>
