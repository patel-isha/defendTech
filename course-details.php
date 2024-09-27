<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/connection.php';
include 'include/session.php';

# Prepare the SELECT Query
$sqlCourseDetail = "SELECT c.*,cc.cc_id, 
    cc.cc_name,
    (SELECT AVG(rating) FROM course_review WHERE course_review.course_id = c.course_id GROUP BY course_review.course_id) AS avg_rating FROM course AS c 
LEFT JOIN course_category AS cc ON cc.cc_id = c.cc_id  
WHERE c.course_title IS NOT NULL HAVING avg_rating > 0";
$resultCourseDetail = $conn->query($sqlCourseDetail);
$courseDetail = $resultCourseDetail->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<?php
include 'include/header-links.php';
?>

<body>
  <!-- start cssload-loader -->
<!--  <div class="preloader">-->
<!--    <div class="loader">-->
<!--      <svg class="spinner" viewBox="0 0 50 50">-->
<!--        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>-->
<!--      </svg>-->
<!--    </div>-->
<!--  </div>-->
  <!-- end cssload-loader -->

  <?php
  include 'include/header.php';
  ?>

  <!-- ================================
    START BREADCRUMB AREA
================================= -->
  <section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
      <div class="col-lg-8 me-auto">
        <div class="breadcrumb-content">
          <div class="section-heading">
            <h2 class="section__title">
                <?php echo $courseDetail['course_title']; ?>
            </h2>
            <p class="section__desc pt-2 lh-30">
                <?php echo $courseDetail['course_subtext']; ?>
            </p>
          </div>
          <!-- end section-heading -->
          <div class="d-flex flex-wrap align-items-center pt-3">
            <h6 class="ribbon ribbon-lg me-2 bg-3 text-white"><?php echo ucfirst(str_replace('_', ' ', $courseDetail['course_badge'])); ?></h6>
            <div class="rating-wrap d-flex flex-wrap align-items-center">
              <div class="review-stars">
                <span class="rating-number"><?php echo number_format($courseDetail['avg_rating'], 1); ?></span>
                  <?php
                  // PHP logic for stars
                  $rating = round($courseDetail["avg_rating"], 1); // Get the average rating (e.g., 3.5)
                  $filledStars = floor($rating); // Number of fully filled stars
                  $hasHalfStar = fmod($rating, 1) !== 0.0; // Check if there's a fractional part
                  $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars

                  // Display filled stars
                  for ($i = 1; $i <= $filledStars; $i++) { ?>
                  <span class="la la-star"></span>
                  <?php }

                  // Display half-empty star if applicable
                  if ($hasHalfStar) { ?>
                  <span class="la la-star-o"></span>
                  <?php }

                  // Display empty stars
                  for ($i = 1; $i <= $emptyStars; $i++) { ?>
                  <span class="la la-star-o"></span>
                  <?php } ?>

              </div>
            </div>
          </div>
          <!-- end d-flex -->
          <p class="pt-2 pb-1">
            Created by
            <a href="teacher-detail.html" class="text-color hover-underline"><?php echo $courseDetail['course_author']; ?></a>
          </p>
          <div class="d-flex flex-wrap align-items-center">
            <p class="pe-3 d-flex align-items-center">
              <svg class="svg-icon-color-gray me-1" width="16px" viewBox="0 0 24 24">
                <path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
              </svg>
              Last updated <?php echo date('j M, Y', strtotime($courseDetail['updated_at']));?>
            </p>
            <p class="pe-3 d-flex align-items-center">
              <svg class="svg-icon-color-gray me-1" width="16px" viewBox="0 0 24 24">
                <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56A15.65 15.65 0 008.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"></path>
              </svg>
              English
            </p>
          </div>
          <!-- end d-flex -->
        </div>
        <!-- end breadcrumb-content -->
      </div>
      <!-- end col-lg-8 -->
    </div>
    <!-- end container -->
  </section>
  <!-- end breadcrumb-area -->
  <!-- ================================
    END BREADCRUMB AREA
================================= -->

  <!--======================================
        START COURSE DETAILS AREA
======================================-->
  <section class="course-details-area pb-20px">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 pb-5">
          <div class="course-details-content-wrap pt-70px">
            <div class="course-overview-card">
              <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                <h3 class="fs-24 font-weight-semi-bold">Course content</h3>
              </div>

              <div class="curriculum-content">
                <div id="accordion" class="generic-accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <button class="btn btn-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="la la-plus"></i>
                        <i class="la la-minus"></i>
                        Course Videos
                      </button>
                    </div>
                    <!-- end card-header -->
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                      <div class="card-body">
                        <ul class="generic-list-item">
                            <?php
                            $courseId = $courseDetail['course_id'];
                            # Prepare the SELECT Query
                            $sql = "SELECT course_content.*, course.course_title FROM course_content
                                                INNER JOIN course ON course_content.course_id = course.course_id
                                                WHERE course_content.course_id = '$courseId'";
                            $coursesContentResult = $conn->query($sql);

                            if ($coursesContentResult->num_rows > 0) {
                            while ($courseContent = $coursesContentResult->fetch_assoc()) {
                            ?>
                          <li>
                            <a href="#" class="d-flex align-items-center justify-content-between text-color" data-bs-toggle="modal" data-bs-target="#previewModal">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                <?php echo $courseContent['content_title'];?>
                                <span class="ribbon ms-2 fs-13">Preview</span>
                              </span>
                              <span><?php echo $courseContent['content_duration'];?></span>
                            </a>
                          </li>
                            <?php } } ?>
                        </ul>
                      </div>
                      <!-- end card-body -->
                    </div>
                    <!-- end collapse -->
                  </div>
                  <!-- end card -->
                </div>
                <!-- end generic-accordion -->
              </div>
              <!-- end curriculum-content -->
            </div>
            <!-- end course-overview-card -->
            <!-- end course-overview-card -->
            <div class="course-overview-card pt-4">
              <h3 class="fs-24 font-weight-semi-bold pb-4">Reviews</h3>
              <div class="review-wrap">
                <div class="d-flex flex-wrap align-items-center pb-4">
                  <form method="post" class="me-3 flex-grow-1">
                    <div class="form-group">
                      <input class="form-control form--control ps-3" type="text" name="search" placeholder="Search reviews" />
                      <span class="la la-search search-icon"></span>
                    </div>
                  </form>
                  <div class="select-container select2-full-wrapper mb-3">
                    <select class="select-container-select">
                      <option value="all-rating">All ratings</option>
                      <option value="five-star">Five stars</option>
                      <option value="four-star">Four stars</option>
                      <option value="three-star">Three stars</option>
                      <option value="two-star">Two stars</option>
                      <option value="one-star">One star</option>
                    </select>
                  </div>
                </div>
                  <?php
                  $courseId = $courseDetail['course_id'];
                  # Prepare the SELECT Query
                  $sql = "SELECT course_review.*, users.first_name as fname, users.last_name as lname FROM course_review LEFT JOIN users ON users.user_id = course_review.user_id WHERE course_review.course_id = '$courseId'";
                  $coursesReviewResult = $conn->query($sql);

                  if ($coursesReviewResult->num_rows > 0) {
                  while ($courseReview = $coursesReviewResult->fetch_assoc()) {
                  ?>
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <div class="media-img me-4 rounded-full">
                    <img class="rounded-full lazy" src="assets/images/img-loading.png" data-src="assets/images/small-avatar-1.jpg" alt="User image" />
                  </div>
                  <div class="media-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                      <h5><?php echo ucfirst($courseReview['fname']. " " .$courseReview['lname']);  ?></h5>
                      <div class="review-stars">
                          <?php
                          // PHP logic for stars
                          $rating = round($courseDetail["avg_rating"], 1); // Get the average rating (e.g., 3.5)
                          $filledStars = floor($rating); // Number of fully filled stars
                          $hasHalfStar = fmod($rating, 1) !== 0.0; // Check if there's a fractional part
                          $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars

                          // Display filled stars
                          for ($i = 1; $i <= $filledStars; $i++) { ?>
                          <span class="la la-star"></span>
                          <?php }

                          // Display half-empty star if applicable
                          if ($hasHalfStar) { ?>
                          <span class="la la-star-o"></span>

                          <?php }

                          // Display empty stars
                          for ($i = 1; $i <= $emptyStars; $i++) { ?>
                          <span class="la la-star-o"></span>

                          <?php } ?>
                      </div>
                    </div>
                    <span class="d-block lh-18 pb-2">a month ago</span>
                    <p class="pb-2">
                      <?php echo $courseReview['review']; ?>
                    </p>
                    <div class="helpful-action">
                      <span class="d-block fs-13">Was this review helpful?</span>
                      <button class="btn">Yes</button>
                      <button class="btn">No</button>
                      <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal" data-bs-target="#reportModal">Report</span>
                    </div>
                  </div>
                </div>
                  <?php } } ?>
              </div>
              <!-- end review-wrap -->
              <div class="see-more-review-btn text-center">
                <button type="button" class="btn theme-btn theme-btn-transparent">
                  Load more reviews
                </button>
              </div>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card pt-4">
              <h3 class="fs-24 font-weight-semi-bold pb-4">Add a Review</h3>
              <div class="leave-rating-wrap pb-4">
                <div class="leave-rating leave--rating">
                  <input type="radio" name="rate" id="star5" />
                  <label for="star5"></label>
                  <input type="radio" name="rate" id="star4" />
                  <label for="star4"></label>
                  <input type="radio" name="rate" id="star3" />
                  <label for="star3"></label>
                  <input type="radio" name="rate" id="star2" />
                  <label for="star2"></label>
                  <input type="radio" name="rate" id="star1" />
                  <label for="star1"></label>
                </div>
                <!-- end leave-rating -->
              </div>
              <form method="post" class="row">
                <div class="input-box col-lg-6">
                  <label class="label-text">Name</label>
                  <div class="form-group">
                    <input class="form-control form--control" type="text" name="name" placeholder="Your Name" />
                    <span class="la la-user input-icon"></span>
                  </div>
                </div>
                <!-- end input-box -->
                <div class="input-box col-lg-6">
                  <label class="label-text">Email</label>
                  <div class="form-group">
                    <input class="form-control form--control" type="email" name="email" placeholder="Email Address" />
                    <span class="la la-envelope input-icon"></span>
                  </div>
                </div>
                <!-- end input-box -->
                <div class="input-box col-lg-12">
                  <label class="label-text">Message</label>
                  <div class="form-group">
                    <textarea class="form-control form--control ps-3" name="message" placeholder="Write Message" rows="5"></textarea>
                  </div>
                </div>
                <!-- end input-box -->
                <div class="btn-box col-lg-12">
                  <div class="custom-control custom-checkbox mb-3 fs-15">
                    <input type="checkbox" class="custom-control-input" id="saveCheckbox" required />
                    <label class="custom-control-label custom--control-label" for="saveCheckbox">
                      Save my name, and email in this browser for the next
                      time I comment.
                    </label>
                  </div>
                  <!-- end custom-control -->
                  <button class="btn theme-btn" type="submit">
                    Submit Review
                  </button>
                </div>
                <!-- end btn-box -->
              </form>
            </div>
            <!-- end course-overview-card -->
          </div>
          <!-- end course-details-content-wrap -->
        </div>
        <!-- end col-lg-8 -->
        <div class="col-lg-4">
          <div class="sidebar sidebar-negative">
            <div class="card card-item">
              <div class="card-body">
                <div class="preview-course-video">
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#previewModal">
                    <img src="assets/images/img-loading.png" data-src="assets/images/preview-img.jpg" alt="course-img" class="w-100 rounded lazy" />
                    <div class="preview-course-video-content">
                      <div class="overlay"></div>
                      <div class="play-button">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8" style="
                              enable-background: new -307.4 338.8 91.8 91.8;
                            " xml:space="preserve">
                          <style type="text/css">
                            .st0 {
                              fill: #ffffff;
                              border-radius: 100px;
                            }

                            .st1 {
                              fill: #000000;
                            }
                          </style>
                          <g>
                            <circle class="st0" cx="-261.5" cy="384.7" r="45.9"></circle>
                            <path class="st1" d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"></path>
                          </g>
                        </svg>
                      </div>
                      <p class="fs-15 font-weight-bold text-white pt-3">
                        Preview this course
                      </p>
                    </div>
                  </a>
                </div>
                <!-- end preview-course-video -->
                <div class="preview-course-feature-content pt-40px">
                  <p class="d-flex align-items-center pb-2">
                    <span class="fs-35 font-weight-semi-bold text-black">£ <?php echo $courseDetail['course_cost'];?></span>
                  </p>
                  <div class="buy-course-btn-box">
                    <button type="button" class="btn theme-btn w-100 mb-2" onclick="addToCart(<?php echo $courseDetail['course_id']; ?>)">
                      <i class="la la-shopping-cart fs-18 me-1"></i> Add to
                      cart
                    </button>
                  </div>
                  <p class="fs-14 text-center pb-4">
                    30-Day Money-Back Guarantee
                  </p>
                  <div class="preview-course-incentives">
                    <h3 class="card-title fs-18 pb-2">
                      This course includes
                    </h3>
                    <ul class="generic-list-item pb-3">
                      <li>
                        <i class="la la-play-circle-o me-2 text-color"></i>2.5
                        hours on-demand video
                      </li>
                      <li>
                        <i class="la la-file me-2 text-color"></i>34 articles
                      </li>
                      <li>
                        <i class="la la-file-text me-2 text-color"></i>12
                        downloadable resources
                      </li>
                      <li>
                        <i class="la la-code me-2 text-color"></i>51 coding
                        exercises
                      </li>
                      <li>
                        <i class="la la-key me-2 text-color"></i>Full lifetime
                        access
                      </li>
                      <li>
                        <i class="la la-television me-2 text-color"></i>Access
                        on mobile and TV
                      </li>
                      <li>
                        <i class="la la-certificate me-2 text-color"></i>Certificate of Completion
                      </li>
                    </ul>
                    <div class="section-block"></div>
                  </div>
                  <!-- end preview-course-incentives -->
                </div>
                <!-- end preview-course-content -->
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Course Features</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item generic-list-item-flash">
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-clock me-2 text-color"></i>Duration</span>
                    2.5 hours
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-play-circle-o me-2 text-color"></i>Lectures</span>
                    17
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-file-text-o me-2 text-color"></i>Resources</span>
                    12
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-bolt me-2 text-color"></i>Quizzes</span>
                    26
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-eye me-2 text-color"></i>Preview
                      Lessons</span>
                    4
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-language me-2 text-color"></i>Language</span>
                    English
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-lightbulb me-2 text-color"></i>Skill
                      level</span>
                    All levels
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-users me-2 text-color"></i>Students</span>
                    30,506
                  </li>
                  <li class="d-flex align-items-center justify-content-between">
                    <span><i class="la la-certificate me-2 text-color"></i>Certificate</span>
                    Yes
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end course-details-area -->
  <!--======================================
        END COURSE DETAILS AREA
======================================-->


  <div class="section-block"></div>

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
   <script src="assets/js/plyr.js"></script>
  <script>
     var player = new Plyr("#player");
 </script>
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
  </script>

</body>

</html>
