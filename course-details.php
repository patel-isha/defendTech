<?php
include 'config/connection.php';
include 'config/session.php';
session_start();

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
  <section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
      <div class="col-lg-8 me-auto">
        <div class="breadcrumb-content">
          <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Development</a></li>
            <li><a href="#">Java</a></li>
          </ul>
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
          <div class="bread-btn-box pt-3">
            <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 me-2 mb-2">
              <i class="la la-heart-o me-1"></i>
              <span class="swapping-btn" data-text-swap="Wishlisted" data-text-original="Wishlist">Wishlist</span>
            </button>
            <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 me-2 mb-2" data-bs-toggle="modal" data-bs-target="#shareModal">
              <i class="la la-share me-1"></i>Share
            </button>
            <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mb-2" data-bs-toggle="modal" data-bs-target="#reportModal">
              <i class="la la-flag me-1"></i>Report abuse
            </button>
          </div>
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
          <div class="course-details-content-wrap pt-90px">
            <div class="course-overview-card bg-gray p-4 rounded">
              <h3 class="fs-24 font-weight-semi-bold pb-3">
                What you'll learn?
              </h3>
              <ul class="generic-list-item overview-list-item">
                <li>
                  <i class="la la-check me-1 text-black"></i> Learn the core
                  Java skills needed to apply for Java developer positions in
                  just 14 hours.
                </li>
                <li>
                  <i class="la la-check me-1 text-black"></i> Be able to
                  demonstrate your understanding of Java to future employers.
                </li>
                <li>
                  <i class="la la-check me-1 text-black"></i> Acquire
                  essential java basics for transitioning to the Spring
                  Framework, Java EE, Android development and more.
                </li>
                <li>
                  <i class="la la-check me-1 text-black"></i> Be able to sit
                  for and pass the Oracle Java Certificate exam if you choose.
                </li>
                <li>
                  <i class="la la-check me-1 text-black"></i> Learn industry
                  "best practices" in Java software development from a
                  professional Java developer who has worked in the language
                  for 18 years.
                </li>
                <li>
                  <i class="la la-check me-1 text-black"></i> Obtain
                  proficiency in Java 8 and Java 11.
                </li>
              </ul>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card bg-gray p-4 rounded">
              <h3 class="fs-16 font-weight-semi-bold">
                Curated for the
                <a href="for-business.html" class="text-color hover-underline">DefendTech for Business</a>
                collection
              </h3>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card">
              <h3 class="fs-24 font-weight-semi-bold pb-3">Requirements</h3>
              <ul class="generic-list-item generic-list-item-bullet fs-15">
                <li>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </li>
                <li>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </li>
                <li>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </li>
              </ul>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card border border-gray p-4 rounded">
              <h3 class="fs-20 font-weight-semi-bold">
                Top companies trust DefendTech
              </h3>
              <p class="fs-15 pb-1">
                Get your team access to DefendTech's top 5,000+ courses
              </p>
              <div class="pb-3">
                <img width="85" class="me-3" src="assets/images/sponsor-img.png" alt="company logo" />
                <img width="80" class="me-3" src="assets/images/sponsor-img2.png" alt="company logo" />
                <img width="80" class="me-3" src="assets/images/sponsor-img3.png" alt="company logo" />
                <img width="70" class="me-3" src="assets/images/sponsor-img4.png" alt="company logo" />
              </div>
              <a href="for-business.html" class="btn theme-btn theme-btn-sm">Try DefendTech for Business</a>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card">
              <h3 class="fs-24 font-weight-semi-bold pb-3">Description</h3>
              <p class="fs-15 pb-2">
                Lorem Ipsum has been the industry’s standard dummy text ever
                since the 1500s, when an unknown printer took a galley of type
                and scrambled it to make a type specimen book. It has survived
                not only five centuries, Lorem Ipsum has been the industry’s
                standard dummy text ever since the 1500s, when an unknown
                printer took a galley of type and scrambled it to make a type
                specimen book.
              </p>
              <p class="fs-15 pb-2">
                It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially
                unchanged.Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry’s
                standard dummy
              </p>
              <p class="fs-15 pb-1">
                - Lorem ipsum dolor sit amet, consectetur.
              </p>
              <p class="fs-15 pb-1">
                - Lorem ipsum dolor sit amet, consectetur.
              </p>
              <p class="fs-15 pb-1">
                - Lorem ipsum dolor sit amet, consectetur.
              </p>
              <p class="fs-15 pt-3 pb-2 lh-22">
                <strong class="font-weight-semi-bold text-black">Are you aiming to get your first Java Programming job but
                  struggling to find out what skills employers want</strong>
                and which course will give you those skills?
              </p>
              <p class="fs-15 pb-2">
                This course is designed to give you the Java skills you need
                to get a job as a Java developer. By the end of the course,
                you will understand Java extremely well and be able to build
                your own Java apps and be productive as a software developer.
              </p>
              <div class="collapse" id="collapseMore">
                <p class="fs-15 pb-2">
                  The core java material you need to learn java development is
                  covered in the first seven sections (around 14 hours in
                  total). The Java Basics are covered in those sections. The
                  rest of the course covers intermediate, advanced, and
                  optional material you do not technically need to go through.
                </p>
                <h4 class="fs-20 font-weight-semi-bold py-2">
                  Who this course is for:
                </h4>
                <ul class="generic-list-item generic-list-item-bullet fs-15">
                  <li>Anyone who wants to become a computer programmer</li>
                  <li>Anyone who wants to become a computer programmer</li>
                  <li>Anyone who wants to become a computer programmer</li>
                </ul>
              </div>
              <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMore" role="button" aria-expanded="false" aria-controls="collapseMore">
                <span class="collapse-btn-hide">Show more<i class="la la-angle-down ms-1 fs-14"></i></span>
                <span class="collapse-btn-show">Show less<i class="la la-angle-up ms-1 fs-14"></i></span>
              </a>
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card">
              <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                <h3 class="fs-24 font-weight-semi-bold">Course content</h3>
                <div class="curriculum-duration fs-15">
                  <span class="curriculum-total__text me-2"><strong class="text-black font-weight-semi-bold">Total:</strong>
                    17 lectures</span>
                  <span class="curriculum-total__hours"><strong class="text-black font-weight-semi-bold">Total hours:</strong>
                    02:35:47</span>
                </div>
              </div>
              <div class="curriculum-content">
                <div id="accordion" class="generic-accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <button class="btn btn-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="la la-plus"></i>
                        <i class="la la-minus"></i>
                        Course introduction
                        <span class="fs-15 text-gray font-weight-medium">6 lectures</span>
                      </button>
                    </div>
                    <!-- end card-header -->
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                      <div class="card-body">
                        <ul class="generic-list-item">
                          <li>
                            <a href="#" class="d-flex align-items-center justify-content-between text-color" data-bs-toggle="modal" data-bs-target="#previewModal">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Introductory words
                                <span class="ribbon ms-2 fs-13">Preview</span>
                              </span>
                              <span>02:27</span>
                            </a>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Remaster in Progress
                              </span>
                              <span>03:09</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Video Quality
                              </span>
                              <span>01:16</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Important Tip - Source Code
                              </span>
                              <span>02:07</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <!-- end card-body -->
                    </div>
                    <!-- end collapse -->
                  </div>
                  <!-- end card -->
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <button class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="la la-plus"></i>
                        <i class="la la-minus"></i>
                        Software tools setup
                        <span class="fs-15 text-gray font-weight-medium">6 lectures</span>
                      </button>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                      <div class="card-body">
                        <ul class="generic-list-item">
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Biggest Tip to Succeed as a Java Programmer
                              </span>
                              <span>02:27</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-file me-1"></i>
                                ** IMPORTANT ** - Configuring IntelliJ IDEA
                              </span>
                              <span>00:16</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Video Quality
                              </span>
                              <span>01:16</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Important Tip - Source Code
                              </span>
                              <span>02:07</span>
                            </div>
                          </li>
                          <li>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>
                                <i class="la la-code me-1"></i>
                                Interface
                              </span>
                              <span>1 question</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <!-- end card-body -->
                    </div>
                  </div>
                  <!-- end card -->
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <button class="btn btn-link collapsed d-flex align-items-center justify-content-between" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="la la-plus"></i>
                        <i class="la la-minus"></i>
                        Conclusion
                        <span class="fs-15 text-gray font-weight-medium">1 lectures</span>
                      </button>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                      <div class="card-body">
                        <ul class="generic-list-item">
                          <li>
                            <a href="#" class="d-flex align-items-center justify-content-between text-color" data-bs-toggle="modal" data-bs-target="#previewModal">
                              <span>
                                <i class="la la-play-circle me-1"></i>
                                Conclusion
                                <span class="ribbon ms-2 fs-13">Watch</span>
                              </span>
                              <span>02:27</span>
                            </a>
                          </li>
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
            <div class="course-overview-card pt-4">
              <h3 class="fs-24 font-weight-semi-bold pb-4">
                Students also bought
              </h3>
              <div class="view-more-carousel owl-action-styled">
                <div class="card card-item card-item-list-layout border border-gray shadow-none">
                  <div class="card-image">
                    <a href="course-details.php" class="d-block">
                      <img class="card-img-top" src="assets/images/img8.jpg" alt="Card image cap" />
                    </a>
                    <div class="course-badge-labels">
                      <div class="course-badge">Bestseller</div>
                      <div class="course-badge blue">-39%</div>
                    </div>
                  </div>
                  <!-- end card-image -->
                  <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                      All Levels
                    </h6>
                    <h5 class="card-title">
                      <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
                    </h5>
                    <p class="card-text">
                      <a href="teacher-detail.html">Jose Portilla</a>
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
                <div class="card card-item card-item-list-layout border border-gray shadow-none">
                  <div class="card-image">
                    <a href="course-details.php" class="d-block">
                      <img class="card-img-top" src="assets/images/img9.jpg" alt="Card image cap" />
                    </a>
                    <div class="course-badge-labels">
                      <div class="course-badge red">Featured</div>
                    </div>
                  </div>
                  <!-- end card-image -->
                  <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                      All Levels
                    </h6>
                    <h5 class="card-title">
                      <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
                    </h5>
                    <p class="card-text">
                      <a href="teacher-detail.html">Jose Portilla</a>
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
                        129.99
                      </p>
                      <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                        <i class="la la-heart-o"></i>
                      </div>
                    </div>
                  </div>
                  <!-- end card-body -->
                </div>
                <!-- end card -->
                <div class="card card-item card-item-list-layout border border-gray shadow-none">
                  <div class="card-image">
                    <a href="course-details.php" class="d-block">
                      <img class="card-img-top" src="assets/images/img8.jpg" alt="Card image cap" />
                    </a>
                    <div class="course-badge-labels">
                      <div class="course-badge">Bestseller</div>
                      <div class="course-badge blue">-39%</div>
                    </div>
                  </div>
                  <!-- end card-image -->
                  <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                      All Levels
                    </h6>
                    <h5 class="card-title">
                      <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
                    </h5>
                    <p class="card-text">
                      <a href="teacher-detail.html">Jose Portilla</a>
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
                <div class="card card-item card-item-list-layout border border-gray shadow-none">
                  <div class="card-image">
                    <a href="course-details.php" class="d-block">
                      <img class="card-img-top" src="assets/images/img9.jpg" alt="Card image cap" />
                    </a>
                    <div class="course-badge-labels">
                      <div class="course-badge red">Featured</div>
                    </div>
                  </div>
                  <!-- end card-image -->
                  <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                      All Levels
                    </h6>
                    <h5 class="card-title">
                      <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
                    </h5>
                    <p class="card-text">
                      <a href="teacher-detail.html">Jose Portilla</a>
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
                        129.99
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
              <!-- end view-more-carousel -->
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card pt-4">
              <h3 class="fs-24 font-weight-semi-bold pb-4">
                About the instructor
              </h3>
              <div class="instructor-wrap">
                <div class="media media-card">
                  <div class="instructor-img">
                    <a href="teacher-detail.html" class="media-img d-block">
                      <img class="lazy" src="assets/images/img-loading.png" data-src="assets/images/small-avatar-1.jpg" alt="Avatar image" />
                    </a>
                    <ul class="generic-list-item pt-3">
                      <li>
                        <i class="la la-star me-2 text-color-3"></i> 4.6
                        Instructor Rating
                      </li>
                      <li>
                        <i class="la la-user me-2 text-color-3"></i> 45,786
                        Students
                      </li>
                      <li>
                        <i class="la la-comment-o me-2 text-color-3"></i>
                        2,533 Reviews
                      </li>
                      <li>
                        <i class="la la-play-circle-o me-2 text-color-3"></i>
                        24 Courses
                      </li>
                      <li>
                        <a href="teacher-detail.html">View all Courses</a>
                      </li>
                    </ul>
                  </div>
                  <!-- end instructor-img -->
                  <div class="media-body">
                    <h5><a href="teacher-detail.html">Tim Buchalka</a></h5>
                    <span class="d-block lh-18 pt-2 pb-3">Joined 4 years ago</span>
                    <p class="text-black lh-18 pb-3">
                      Java Python Android and C# Expert Developer - 878K+
                      students
                    </p>
                    <p class="pb-3">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the
                      industry’s standard dummy text ever since the 1500s,
                      when an unknown printer took a galley of type and
                      scrambled it to make a type specimen book. It has
                      survived not only five centuries, but also the leap into
                      electronic typesetting, remaining essentially unchanged.
                    </p>
                    <div class="collapse" id="collapseMoreTwo">
                      <p class="pb-3">
                        After learning the hard way, Tim was determined to
                        become the best teacher he could, and to make his
                        training as painless as possible, so that you, or
                        anyone else with the desire to become a software
                        developer, could become one.
                      </p>
                      <p class="pb-3">
                        If you want to become a financial analyst, a finance
                        manager, an FP&A analyst, an investment banker, a
                        business executive, an entrepreneur, a business
                        intelligence analyst, a data analyst, or a data
                        scientist,
                        <strong class="text-black font-weight-semi-bold">Tim Buchalka's courses are the perfect course to
                          start</strong>.
                      </p>
                    </div>
                    <a class="collapse-btn collapse--btn fs-15" data-bs-toggle="collapse" href="#collapseMoreTwo" role="button" aria-expanded="false" aria-controls="collapseMoreTwo">
                      <span class="collapse-btn-hide">Show more<i class="la la-angle-down ms-1 fs-14"></i></span>
                      <span class="collapse-btn-show">Show less<i class="la la-angle-up ms-1 fs-14"></i></span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- end instructor-wrap -->
            </div>
            <!-- end course-overview-card -->
            <div class="course-overview-card pt-4">
              <h3 class="fs-24 font-weight-semi-bold pb-40px">
                Student feedback
              </h3>
              <div class="feedback-wrap">
                <div class="media media-card align-items-center">
                  <div class="review-rating-summary">
                    <span class="stats-average__count">4.6</span>
                    <div class="rating-wrap pt-1">
                      <div class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-half-alt"></span>
                      </div>
                      <span class="rating-total d-block">(2,533)</span>
                      <span>Course Rating</span>
                    </div>
                    <!-- end rating-wrap -->
                  </div>
                  <!-- end review-rating-summary -->
                  <div class="media-body">
                    <div class="review-bars d-flex align-items-center mb-2">
                      <div class="review-bars__text">5 stars</div>
                      <div class="review-bars__fill">
                        <div class="skillbar-box">
                          <div class="skillbar" data-percent="77%">
                            <div class="skillbar-bar bg-3"></div>
                          </div>
                          <!-- End Skill Bar -->
                        </div>
                      </div>
                      <!-- end review-bars__fill -->
                      <div class="review-bars__percent">77%</div>
                    </div>
                    <!-- end review-bars -->
                    <div class="review-bars d-flex align-items-center mb-2">
                      <div class="review-bars__text">4 stars</div>
                      <div class="review-bars__fill">
                        <div class="skillbar-box">
                          <div class="skillbar" data-percent="54%">
                            <div class="skillbar-bar bg-3"></div>
                          </div>
                          <!-- End Skill Bar -->
                        </div>
                      </div>
                      <!-- end review-bars__fill -->
                      <div class="review-bars__percent">54%</div>
                    </div>
                    <!-- end review-bars -->
                    <div class="review-bars d-flex align-items-center mb-2">
                      <div class="review-bars__text">3 stars</div>
                      <div class="review-bars__fill">
                        <div class="skillbar-box">
                          <div class="skillbar" data-percent="14%">
                            <div class="skillbar-bar bg-3"></div>
                          </div>
                          <!-- End Skill Bar -->
                        </div>
                      </div>
                      <!-- end review-bars__fill -->
                      <div class="review-bars__percent">14%</div>
                    </div>
                    <!-- end review-bars -->
                    <div class="review-bars d-flex align-items-center mb-2">
                      <div class="review-bars__text">2 stars</div>
                      <div class="review-bars__fill">
                        <div class="skillbar-box">
                          <div class="skillbar" data-percent="5%">
                            <div class="skillbar-bar bg-3"></div>
                          </div>
                          <!-- End Skill Bar -->
                        </div>
                      </div>
                      <!-- end review-bars__fill -->
                      <div class="review-bars__percent">5%</div>
                    </div>
                    <!-- end review-bars -->
                    <div class="review-bars d-flex align-items-center mb-2">
                      <div class="review-bars__text">1 stars</div>
                      <div class="review-bars__fill">
                        <div class="skillbar-box">
                          <div class="skillbar" data-percent="2%">
                            <div class="skillbar-bar bg-3"></div>
                          </div>
                          <!-- End Skill Bar -->
                        </div>
                      </div>
                      <!-- end review-bars__fill -->
                      <div class="review-bars__percent">2%</div>
                    </div>
                    <!-- end review-bars -->
                  </div>
                  <!-- end media-body -->
                </div>
              </div>
              <!-- end feedback-wrap -->
            </div>
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
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <div class="media-img me-4 rounded-full">
                    <img class="rounded-full lazy" src="assets/images/img-loading.png" data-src="assets/images/small-avatar-1.jpg" alt="User image" />
                  </div>
                  <div class="media-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                      <h5>Kavi arasan</h5>
                      <div class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </div>
                    </div>
                    <span class="d-block lh-18 pb-2">a month ago</span>
                    <p class="pb-2">
                      This is one of the best courses I have taken in Udemy.
                      It is very complete, and it has made continue learning
                      about Java and SQL databases as well.
                    </p>
                    <div class="helpful-action">
                      <span class="d-block fs-13">Was this review helpful?</span>
                      <button class="btn">Yes</button>
                      <button class="btn">No</button>
                      <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal" data-bs-target="#reportModal">Report</span>
                    </div>
                  </div>
                </div>
                <!-- end media -->
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <div class="media-img me-4 rounded-full">
                    <img class="rounded-full lazy" src="assets/images/img-loading.png" data-src="assets/images/small-avatar-2.jpg" alt="User image" />
                  </div>
                  <div class="media-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                      <h5>Jitesh Shaw</h5>
                      <div class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </div>
                    </div>
                    <span class="d-block lh-18 pb-2">1 months ago</span>
                    <p class="pb-2">
                      This is one of the best courses I have taken in Udemy.
                      It is very complete, and it has made continue learning
                      about Java and SQL databases as well.
                    </p>
                    <div class="helpful-action">
                      <span class="d-block fs-13">Was this review helpful?</span>
                      <button class="btn">Yes</button>
                      <button class="btn">No</button>
                      <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal" data-bs-target="#reportModal">Report</span>
                    </div>
                  </div>
                </div>
                <!-- end media -->
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <div class="media-img me-4 rounded-full">
                    <img class="rounded-full lazy" src="assets/images/img-loading.png" data-src="assets/images/small-avatar-3.jpg" alt="User image" />
                  </div>
                  <div class="media-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                      <h5>Miguel Sanches</h5>
                      <div class="review-stars">
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                      </div>
                    </div>
                    <span class="d-block lh-18 pb-2">2 month ago</span>
                    <p class="pb-2">
                      This is one of the best courses I have taken in Udemy.
                      It is very complete, and it has made continue learning
                      about Java and SQL databases as well.
                    </p>
                    <div class="helpful-action">
                      <span class="d-block fs-13">Was this review helpful?</span>
                      <button class="btn">Yes</button>
                      <button class="btn">No</button>
                      <span class="btn-text fs-14 cursor-pointer ps-1" data-bs-toggle="modal" data-bs-target="#reportModal">Report</span>
                    </div>
                  </div>
                </div>
                <!-- end media -->
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
                    <span class="fs-35 font-weight-semi-bold text-black">$76.99</span>
                    <span class="before-price mx-1">$104.99</span>
                    <span class="price-discount">24% off</span>
                  </p>
                  <p class="preview-price-discount-text pb-35px">
                    <span class="text-color-3">4 days</span> left at this
                    price!
                  </p>
                  <div class="buy-course-btn-box">
                    <button type="button" class="btn theme-btn w-100 mb-2">
                      <i class="la la-shopping-cart fs-18 me-1"></i> Add to
                      cart
                    </button>
                    <button type="button" class="btn theme-btn w-100 theme-btn-white mb-2">
                      <i class="la la-shopping-bag me-1"></i> Buy this course
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
                    <div class="buy-for-team-container pt-4">
                      <h3 class="fs-18 font-weight-semi-bold pb-2">
                        Training 5 or more people?
                      </h3>
                      <p class="lh-24 pb-3">
                        Get your team access to 3,000+ top DefendTech courses
                        anytime, anywhere.
                      </p>
                      <a href="for-business.html" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-30 w-100">Try DefendTech for Business</a>
                    </div>
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
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Course Categories</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item">
                  <li><a href="#">Development</a></li>
                  <li><a href="#">Web Design</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">IT & Software</a></li>
                  <li><a href="#">Backend</a></li>
                  <li><a href="#">Marketing</a></li>
                  <li><a href="#">Photography</a></li>
                  <li><a href="#">Frontend</a></li>
                </ul>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Related Courses</h3>
                <div class="divider"><span></span></div>
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <a href="course-details.php" class="media-img">
                    <img class="me-3 lazy" src="assets/images/img-loading.png" data-src="assets/images/small-img-2.jpg" alt="Related course image" />
                  </a>
                  <div class="media-body">
                    <h5 class="fs-15">
                      <a href="course-details.php">The Complete JavaScript Course 2021</a>
                    </h5>
                    <span class="d-block lh-18 py-1 fs-14">Kamran Ahmed</span>
                    <p class="text-black font-weight-semi-bold lh-18 fs-15">
                      $12.99 <span class="before-price fs-14">$129.99</span>
                    </p>
                  </div>
                </div>
                <!-- end media -->
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <a href="course-details.php" class="media-img">
                    <img class="me-3 lazy" src="assets/images/img-loading.png" data-src="assets/images/small-img-3.jpg" alt="Related course image" />
                  </a>
                  <div class="media-body">
                    <h5 class="fs-15">
                      <a href="course-details.php">Learning jQuery Mobile for Beginners</a>
                    </h5>
                    <span class="d-block lh-18 py-1 fs-14">Kamran Ahmed</span>
                    <p class="text-black font-weight-semi-bold lh-18 fs-15">
                      $129.99
                    </p>
                  </div>
                </div>
                <!-- end media -->
                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                  <a href="course-details.php" class="media-img">
                    <img class="me-3 lazy" src="assets/images/img-loading.png" data-src="assets/images/small-img-4.jpg" alt="Related course image" />
                  </a>
                  <div class="media-body">
                    <h5 class="fs-15">
                      <a href="course-details.php">Introduction LearnPress – LMS plugin</a>
                    </h5>
                    <span class="d-block lh-18 py-1 fs-14">Kamran Ahmed</span>
                    <p class="text-black font-weight-semi-bold lh-18 fs-15">
                      Free
                    </p>
                  </div>
                </div>
                <!-- end media -->
                <div class="view-all-course-btn-box">
                  <a href="course-grid.html" class="btn theme-btn w-100">View All Courses
                    <i class="la la-arrow-right icon ms-1"></i></a>
                </div>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Course Tags</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                  <li class="me-2"><a href="#">Beginner</a></li>
                  <li class="me-2"><a href="#">Advanced</a></li>
                  <li class="me-2"><a href="#">Tips</a></li>
                  <li class="me-2"><a href="#">Photoshop</a></li>
                  <li class="me-2"><a href="#">Software</a></li>
                  <li class="me-2"><a href="#">Backend</a></li>
                  <li class="me-2"><a href="#">Freelance</a></li>
                  <li class="me-2"><a href="#">Frontend</a></li>
                  <li class="me-2"><a href="#">Technology</a></li>
                </ul>
              </div>
            </div>
            <!-- end card -->
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

  <!--======================================
        START RELATED COURSE AREA
======================================-->
  <section class="related-course-area bg-gray pt-60px pb-60px">
    <div class="container">
      <div class="related-course-wrap">
        <h3 class="fs-28 font-weight-semi-bold pb-35px">
          More Courses by
          <a href="teacher-detail.html" class="text-color hover-underline">Tim Buchalka</a>
        </h3>
        <div class="view-more-carousel-2 owl-action-styled">
          <div class="card card-item">
            <div class="card-image">
              <a href="course-details.php" class="d-block">
                <img class="card-img-top" src="assets/images/img8.jpg" alt="Card image cap" />
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
                <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
              </h5>
              <p class="card-text">
                <a href="teacher-detail.html">Jose Portilla</a>
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
          <div class="card card-item">
            <div class="card-image">
              <a href="course-details.php" class="d-block">
                <img class="card-img-top" src="assets/images/img9.jpg" alt="Card image cap" />
              </a>
              <div class="course-badge-labels">
                <div class="course-badge red">Featured</div>
              </div>
            </div>
            <!-- end card-image -->
            <div class="card-body">
              <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
              <h5 class="card-title">
                <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
              </h5>
              <p class="card-text">
                <a href="teacher-detail.html">Jose Portilla</a>
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
                <p class="card-price text-black font-weight-bold">129.99</p>
                <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                  <i class="la la-heart-o"></i>
                </div>
              </div>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
          <div class="card card-item">
            <div class="card-image">
              <a href="course-details.php" class="d-block">
                <img class="card-img-top" src="assets/images/img8.jpg" alt="Card image cap" />
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
                <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
              </h5>
              <p class="card-text">
                <a href="teacher-detail.html">Jose Portilla</a>
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
          <div class="card card-item">
            <div class="card-image">
              <a href="course-details.php" class="d-block">
                <img class="card-img-top" src="assets/images/img9.jpg" alt="Card image cap" />
              </a>
              <div class="course-badge-labels">
                <div class="course-badge red">Featured</div>
              </div>
            </div>
            <!-- end card-image -->
            <div class="card-body">
              <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
              <h5 class="card-title">
                <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
              </h5>
              <p class="card-text">
                <a href="teacher-detail.html">Jose Portilla</a>
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
                <p class="card-price text-black font-weight-bold">129.99</p>
                <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                  <i class="la la-heart-o"></i>
                </div>
              </div>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->
        </div>
        <!-- end view-more-carousel -->
      </div>
      <!-- end related-course-wrap -->
    </div>
    <!-- end container -->
  </section>
  <!-- end related-course-area -->
  <!--======================================
        END RELATED COURSE AREA
======================================-->

  <!--======================================
        START CTA AREA
======================================-->
  <section class="cta-area pt-60px pb-60px position-relative overflow-hidden">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-9">
          <div class="cta-content-wrap py-4 d-flex flex-wrap align-items-center">
            <svg class="flex-shrink-0 me-4" width="70" viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg">
              <path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"></path>
              <path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path>
              <path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"></path>
              <path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"></path>
              <path d="m152 288h16v80h-16zm0 0"></path>
              <path d="m120 288h16v80h-16zm0 0"></path>
              <path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path>
            </svg>
            <div class="section-heading">
              <h2 class="section__title mb-1 fs-22">
                Become a Teacher, Share your knowledge
              </h2>
              <p class="section__desc">
                Create an online video course, reach students across the
                globe, and earn money
              </p>
            </div>
            <!-- end section-heading -->
          </div>
        </div>
        <!-- end col-lg-9 -->
        <div class="col-lg-3">
          <div class="cta-btn-box text-end">
            <a href="become-a-teacher.html" class="btn theme-btn" type="button">Tech on DefendTech <i class="la la-arrow-right icon ms-1"></i>
            </a>
          </div>
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end cta-area -->
  <!--======================================
        END CTA AREA
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

  <div class="tooltip_templates">
    <div id="tooltip_content_1">
      <div class="card card-item">
        <div class="card-body">
          <p class="card-text pb-2">
            By <a href="teacher-detail.html">Jose Portilla</a>
          </p>
          <h5 class="card-title pb-1">
            <a href="course-details.php">The Business Intelligence Analyst Course 2021</a>
          </h5>
          <div class="d-flex align-items-center pb-1">
            <h6 class="ribbon fs-14 me-2">Bestseller</h6>
            <p class="text-success fs-14 font-weight-medium">
              Updated<span class="font-weight-bold ps-1">November 2020</span>
            </p>
          </div>
          <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
            <li>23 total hours</li>
            <li>All Levels</li>
          </ul>
          <p class="card-text pt-1 fs-14 lh-22">
            The skills you need to become a BI Analyst - Statistics, Database
            theory, SQL, Tableau – Everything is included
          </p>
          <ul class="generic-list-item fs-14 py-3">
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
          <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="btn theme-btn flex-grow-1 me-3"><i class="la la-shopping-cart me-1 fs-18"></i> Add to Cart</a>
            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
              <i class="la la-heart-o"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- end card -->
    </div>
  </div>
  <!-- end tooltip_templates -->

  <!-- Modal -->
  <div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header align-items-start border-bottom-gray">
          <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalLongTitle">
            Share this course
          </h5>
          <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="la la-times"></span>
          </button>
        </div>
        <!-- end modal-header -->
        <div class="modal-body">
          <div class="copy-to-clipboard">
            <span class="success-message">Copied!</span>
            <div class="input-group">
              <input type="text" class="form-control form--control copy-input ps-3" value="https://www.DefendTech.com/share/101WxMB0oac1hVQQ==/" />
              <div class="input-group-append">
                <button class="btn theme-btn theme-btn-sm copy-btn shadow-none">
                  <i class="la la-copy me-1"></i> Copy
                </button>
              </div>
            </div>
          </div>
          <!-- end copy-to-clipboard -->
        </div>
        <!-- end modal-body -->
        <div class="modal-footer justify-content-center border-top-gray">
          <ul class="social-icons social-icons-styled">
            <li>
              <a href="#" class="facebook-bg"><i class="la la-facebook"></i></a>
            </li>
            <li>
              <a href="#" class="twitter-bg"><i class="la la-twitter"></i></a>
            </li>
            <li>
              <a href="#" class="instagram-bg"><i class="la la-instagram"></i></a>
            </li>
          </ul>
        </div>
        <!-- end modal-footer -->
      </div>
      <!-- end modal-content-->
    </div>
    <!-- end modal-dialog -->
  </div>
  <!-- end modal -->

  <!-- Modal -->
  <div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header align-items-start border-bottom-gray">
          <div class="pe-2">
            <p class="pb-2 font-weight-semi-bold">Course Preview</p>
            <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="previewModalLongTitle">
              Java Programming Masterclass for Software Developers
            </h5>
          </div>
          <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="la la-times"></span>
          </button>
        </div>
        <!-- end modal-header -->
        <div class="modal-body">
          <video controls crossorigin playsinline poster="../../../../../../cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
            <!-- Video files -->
            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576" />
            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720" />
            <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080" />
          </video>
        </div>
        <!-- end modal-body -->
      </div>
      <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
  </div>
  <!-- end modal -->

  <!-- Modal -->
  <div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header align-items-start border-bottom-gray">
          <div class="pe-2">
            <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalLongTitle">
              Report Abuse
            </h5>
            <p class="pt-1 fs-14 lh-24">
              Flagged content is reviewed by DefendTech staff to determine whether
              it violates Terms of Service or Community Guidelines. If you
              have a question or technical issue, please contact our
              <a href="contact.php" class="text-color hover-underline">Support team here</a>.
            </p>
          </div>
          <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="la la-times"></span>
          </button>
        </div>
        <!-- end modal-header -->
        <div class="modal-body select-model">
          <form method="post">
            <div class="input-box">
              <label class="label-text">Select Report Type</label>
              <div class="form-group">
                <div class="select-container select2-full-wrapper w-auto">
                  <select class="select-container-select select-cotainer-model">
                    <option value>-- Select One --</option>
                    <option value="1">Inappropriate Course Content</option>
                    <option value="2">Inappropriate Behavior</option>
                    <option value="3">DefendTech Policy Violation</option>
                    <option value="4">Spammy Content</option>
                    <option value="5">Other</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="input-box">
              <label class="label-text">Write Message</label>
              <div class="form-group">
                <textarea class="form-control form--control ps-3" name="message" placeholder="Provide additional details here..." rows="5"></textarea>
              </div>
            </div>
            <div class="btn-box text-end pt-2">
              <button type="button" class="btn font-weight-medium me-3" data-bs-dismiss="modal">
                Cancel
              </button>
              <button type="submit" class="btn theme-btn theme-btn-sm lh-30">
                Submit <i class="la la-arrow-right icon ms-1"></i>
              </button>
            </div>
          </form>
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
   <script src="assets/js/plyr.js"></script>
  <script>
     var player = new Plyr("#player");
 </script>

</body>

</html>
