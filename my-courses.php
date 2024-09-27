<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config/connection.php';
require 'vendor/autoload.php';
require_once 'secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);


if (isset($_GET['session_id'])){
    // Retrieve the session ID from the query string
    $session_id = $_GET['session_id'];

    // Fetch the checkout session to validate the payment
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    $userCourses = [];
    foreach ($_SESSION['cart'] as $course) {
        $courseId = $course['course_id'];
        $userId = $_SESSION['user_id'];
        //SQL query to insert data into the database
        $sql = "INSERT INTO `user_courses`(`user_id`, `course_id`) 
         VALUES ('$userId', '$courseId')";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            foreach ($_SESSION['cart'] as $index => $session) {
                if ($session['course_id'] == $courseId) {
                    unset($_SESSION['cart'][$index]);
                    break; // Exit loop once the course is found
                }
            }
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
  <section class="breadcrumb-area py-5 bg-white pattern-bg">
      <div class="container">
          <div class="breadcrumb-content">
              <div class="section-heading">
                  <h2 class="section__title">My Courses</h2>
              </div>
              <!-- end section-heading -->
          </div>
          <!-- end breadcrumb-content -->
      </div>
      <!-- end container -->
  </section>
  <!-- end breadcrumb-area -->
  <!-- ================================
  END BREADCRUMB AREA
================================= -->

  <!-- ================================
     START MY COURSES
================================= -->
  <section class="my-courses-area pt-30px pb-90px">
      <div class="container">
          <div class="my-course-content-wrap">
              <div class="tab-content" id="myTabContent">
                  <div
                          class="tab-pane fade show active"
                          id="all-course"
                          role="tabpanel"
                          aria-labelledby="all-course-tab"
                  >
                      <!-- test alert -->
                      <div class="my-course-body">
                          <?php if (isset($session)){ ?>
                          <div
                                  class="alert alert-info alert-dismissible fade show course-alert-info"
                                  role="alert"
                          >

                              <div class="d-flex align-items-center">
                                  <a
                                          href="javascript:void(0)"
                                          class="alert-link font-weight-medium ps-4"
                                  ><?php echo 'Payment was successful!'; ?></a>
                              </div>
                              <button
                                      type="button"
                                      class="btn-close close fs-16"
                                      data-bs-dismiss="alert"
                                      aria-label="Close"
                              >
                                  <span aria-hidden="true" class="la la-times"></span>
                              </button>
                          </div>
                          <!-- end alert -->
                          <?php } ?>
                          <div class="my-course-cards pt-40px">
                              <div class="row">
                                <?php
                                $query = "SELECT 
                                                c.*, 
                                                cc.cc_id, 
                                                cc.cc_name,
                                                uc.status,
                                                (SELECT AVG(rating) 
                                                    FROM course_review 
                                                    WHERE course_review.course_id = c.course_id 
                                                    GROUP BY course_review.course_id) AS avg_rating 
                                            FROM 
                                                course AS c
                                            LEFT JOIN 
                                                course_category AS cc ON cc.cc_id = c.cc_id
                                            INNER JOIN 
                                                user_courses AS uc ON uc.course_id = c.course_id
                                            WHERE 
                                                c.course_title IS NOT NULL
                                                AND uc.user_id = 2  -- Filter by user_id (adjust as necessary)
                                            HAVING 
                                                avg_rating > 0;
                                            ";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="lesson-details.html" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img8.jpg"
                                                          alt="Card image cap"
                                                  />
                                                  <div class="play-button">
                                                      <svg
                                                              version="1.1"
                                                              xmlns="http://www.w3.org/2000/svg"
                                                              x="0px"
                                                              y="0px"
                                                              viewBox="-307.4 338.8 91.8 91.8"
                                                              xml:space="preserve"
                                                      >
                                                        <style type="text/css">
                                                            .st0 {
                                                                opacity: 0.6;
                                                                fill: #000000;
                                                                border-radius: 100px;
                                                            }
                                                            .st1 {
                                                                fill: #ffffff;
                                                            }
                                                        </style>
                                                          <g>
                                                              <circle
                                                                      class="st0"
                                                                      cx="-261.5"
                                                                      cy="384.7"
                                                                      r="45.9"
                                                              ></circle>
                                                              <path
                                                                      class="st1"
                                                                      d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                              ></path>
                                                          </g>
                              </svg>
                                                  </div>
                                              </a>
                                          </div>
                                          <!-- end card-image -->
                                          <div class="card-body">
                                              <h5 class="card-title">
                                                  <a href="lesson-details.html"><?php echo $row['course_title']; ?></a>
                                              </h5>
                                              <p class="card-text lh-22 pt-2">
                                                  <a href="teacher-detail.html"><?php echo $row['course_author']; ?></a>
                                              </p>
                                              <div
                                                      class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                              >
                                                  <p class="skillbar-title">Complete:</p>
                                                  <div class="skillbar-box">
                                                      <div
                                                              class="skillbar skillbar-skillbar-2"
                                                              data-percent="70%"
                                                      >
                                                          <div
                                                                  class="skillbar-bar skillbar--bar-2 bg-1"
                                                          ></div>
                                                      </div>
                                                      <!-- End Skill Bar -->
                                                  </div>
                                                  <div class="skill-bar-percent">70%</div>
                                              </div>
                                              <!-- end my-course-progress-bar-wrap -->
                                              <div
                                                      class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                              >
                                                  <div class="review-stars">
                                                      <span class="rating-number"><?php echo number_format($row['avg_rating'], 1); ?></span>
                                                      <?php
                                                      // PHP logic for stars
                                                      $rating = round($row["avg_rating"], 1); // Get the average rating (e.g., 3.5)
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
                                                  <span class="rating-total ps-1">(20,230)</span>
                                              </div>
                                                  <a
                                                          href="#"
                                                          class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#ratingModal"
                                                  >Leave a rating</a
                                                  >
                                              </div>
                                              <!-- end rating-wrap -->
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
<!--                                    </div>-->
                                  <!-- end col-lg-4 -->
                                  <?php } } ?>
                              </div>
                              <!-- end row -->
                          </div>
                          <!-- end my-course-cards -->
                      </div>
                      <!-- end my-course-body -->
                  </div>
                  <!-- end tab-pane -->
                  <div
                          class="tab-pane fade"
                          id="collections"
                          role="tabpanel"
                          aria-labelledby="collections-tab"
                  >
                      <div class="my-course-body">
                          <div class="my-collection-item">
                              <div class="my-course-info pb-40px">
                                  <div class="d-flex align-items-center pb-2">
                                      <h3 class="fs-22 font-weight-semi-bold">Javascript</h3>
                                      <div class="my-course-info-action ms-2">
                        <span
                                class="la la-edit icon-element icon-element-xs cursor-pointer shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editCollectionModal"
                                title="Edit"
                        ></span>
                                          <span
                                                  class="la la-trash icon-element icon-element-xs cursor-pointer shadow-sm"
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#deleteModal"
                                                  title="Delete"
                                          ></span>
                                      </div>
                                  </div>
                                  <p>Leading the basics fundamentals</p>
                              </div>
                              <!-- end my-course-info -->
                              <div class="my-course-cards">
                                  <div class="row">
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img8.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLink"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLink"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >The Complete Full-Stack JavaScript Course!</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="70%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">70%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img9.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLinkTwo"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLinkTwo"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >Modern JavaScript From The Beginning</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="0%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">0%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img10.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLinkThree"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLinkThree"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >The Complete JavaScript Course 2020: Build Real
                                                          Projects!</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="0%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">0%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                  </div>
                                  <!-- end row -->
                              </div>
                              <!-- end my-course-cards -->
                          </div>
                          <!-- end my-collection-item -->
                          <div class="my-collection-item">
                              <div class="my-course-info pb-40px">
                                  <div class="d-flex align-items-center pb-2">
                                      <h3 class="fs-22 font-weight-semi-bold">Business</h3>
                                      <div class="my-course-info-action ms-2">
                        <span
                                class="la la-edit icon-element icon-element-xs cursor-pointer shadow-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editCollectionModal"
                                title="Edit"
                        ></span>
                                          <span
                                                  class="la la-trash icon-element icon-element-xs cursor-pointer shadow-sm"
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#deleteModal"
                                                  title="Delete"
                                          ></span>
                                      </div>
                                  </div>
                                  <p>Leading the basics fundamentals</p>
                              </div>
                              <!-- end my-course-info -->
                              <div class="my-course-cards">
                                  <div class="row">
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img11.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLinkFour"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLinkFour"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >An Entire MBA in 1 Course:Award Winning
                                                          Business School Prof</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="70%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">70%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img12.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLinkFive"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLinkFive"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >The Complete Financial Analyst Course 2020</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="0%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">0%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                      <div class="col-lg-4 responsive-column-half">
                                          <div class="card card-item">
                                              <div class="card-image">
                                                  <a href="lesson-details.html" class="d-block">
                                                      <img
                                                              class="card-img-top lazy"
                                                              src="assets/images/img-loading.png"
                                                              data-src="assets/images/img13.jpg"
                                                              alt="Card image cap"
                                                      />
                                                      <div class="play-button">
                                                          <svg
                                                                  version="1.1"
                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                  x="0px"
                                                                  y="0px"
                                                                  viewBox="-307.4 338.8 91.8 91.8"
                                                                  xml:space="preserve"
                                                          >
                                  <style type="text/css">
                                      .st0 {
                                          opacity: 0.6;
                                          fill: #000000;
                                          border-radius: 100px;
                                      }
                                      .st1 {
                                          fill: #ffffff;
                                      }
                                  </style>
                                                              <g>
                                                                  <circle
                                                                          class="st0"
                                                                          cx="-261.5"
                                                                          cy="384.7"
                                                                          r="45.9"
                                                                  ></circle>
                                                                  <path
                                                                          class="st1"
                                                                          d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                                  ></path>
                                                              </g>
                                </svg>
                                                      </div>
                                                  </a>
                                                  <div
                                                          class="course-badge-labels course--badge-labels"
                                                  >
                                                      <div
                                                              class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                      >
                                                          <div class="dropdown">
                                                              <a
                                                                      class="action-btn bg-white text-gray dropdown-btn"
                                                                      href="#"
                                                                      role="button"
                                                                      id="collectionMenuLinkSix"
                                                                      data-toggle="dropdown"
                                                                      aria-haspopup="true"
                                                                      aria-expanded="false"
                                                              >
                                                                  <i class="la la-ellipsis-v"></i>
                                                              </a>
                                                              <div
                                                                      class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                      aria-labelledby="collectionMenuLinkSix"
                                                              >
                                                                  <a
                                                                          href="javascript:void(0)"
                                                                          class="dropdown-item"
                                                                  >
                                                                      Remove from Collection
                                                                  </a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- end card-image -->
                                              <div class="card-body">
                                                  <h5 class="card-title">
                                                      <a href="lesson-details.html"
                                                      >Ninja Writing: The Four Levels Of Writing
                                                          Mastery</a
                                                      >
                                                  </h5>
                                                  <p class="card-text lh-22 pt-2">
                                                      <a href="teacher-detail.html">Jose Portilla</a
                                                      ><span>, Software Engineer and Developer</span>
                                                  </p>
                                                  <div
                                                          class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                                  >
                                                      <p class="skillbar-title">Complete:</p>
                                                      <div class="skillbar-box">
                                                          <div
                                                                  class="skillbar skillbar-skillbar-2"
                                                                  data-percent="0%"
                                                          >
                                                              <div
                                                                      class="skillbar-bar skillbar--bar-2 bg-1"
                                                              ></div>
                                                          </div>
                                                          <!-- End Skill Bar -->
                                                      </div>
                                                      <div class="skill-bar-percent">0%</div>
                                                  </div>
                                                  <!-- end my-course-progress-bar-wrap -->
                                                  <div
                                                          class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                                  >
                                                      <div class="review-stars">
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                          <span class="la la-star-o"></span>
                                                      </div>
                                                      <a
                                                              href="#"
                                                              class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#ratingModal"
                                                      >Leave a rating</a
                                                      >
                                                  </div>
                                                  <!-- end rating-wrap -->
                                              </div>
                                              <!-- end card-body -->
                                          </div>
                                          <!-- end card -->
                                      </div>
                                      <!-- end col-lg-4 -->
                                  </div>
                                  <!-- end row -->
                              </div>
                              <!-- end my-course-cards -->
                          </div>
                          <!-- end my-collection-item -->
                      </div>
                      <!-- end my-course-body -->
                  </div>
                  <!-- end tab-pane -->
                  <div
                          class="tab-pane fade"
                          id="wishlist"
                          role="tabpanel"
                          aria-labelledby="wishlist-tab"
                  >
                      <div class="my-course-body">
                          <div
                                  class="my-course-info pb-40px d-flex flex-wrap align-items-center justify-content-between"
                          >
                              <h3 class="fs-22 font-weight-semi-bold">My wishlist</h3>
                              <form method="post">
                                  <div class="input-group">
                                      <input
                                              class="form-control form--control form--control-gray ps-3"
                                              type="text"
                                              name="search"
                                              placeholder="Search courses"
                                      />
                                      <div class="input-group-append">
                                          <button class="btn theme-btn shadow-none">
                                              <i class="la la-search"></i>
                                          </button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <!-- end my-course-info -->
                          <div class="my-course-cards">
                              <div class="row">
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="course-details.php" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img8.jpg"
                                                          alt="Card image cap"
                                                  />
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
                                                  <a href="course-details.php"
                                                  >The Business Intelligence Analyst Course 2021</a
                                                  >
                                              </h5>
                                              <p class="card-text">
                                                  <a href="teacher-detail.html">Jose Portilla</a>
                                              </p>
                                              <div
                                                      class="rating-wrap d-flex align-items-center py-2"
                                              >
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
                                              <div
                                                      class="d-flex justify-content-between align-items-center"
                                              >
                                                  <p class="card-price text-black font-weight-bold">
                                                      12.99
                                                      <span class="before-price font-weight-medium"
                                                      >129.99</span
                                                      >
                                                  </p>
                                                  <div
                                                          class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                                          title="Remove from Wishlist"
                                                  >
                                                      <i class="la la-heart"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="course-details.php" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img9.jpg"
                                                          alt="Card image cap"
                                                  />
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
                                                  <a href="course-details.php"
                                                  >The Business Intelligence Analyst Course 2021</a
                                                  >
                                              </h5>
                                              <p class="card-text">
                                                  <a href="teacher-detail.html">Jose Portilla</a>
                                              </p>
                                              <div
                                                      class="rating-wrap d-flex align-items-center py-2"
                                              >
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
                                              <div
                                                      class="d-flex justify-content-between align-items-center"
                                              >
                                                  <p class="card-price text-black font-weight-bold">
                                                      129.99
                                                  </p>
                                                  <div
                                                          class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                                          title="Remove from Wishlist"
                                                  >
                                                      <i class="la la-heart"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="course-details.php" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img10.jpg"
                                                          alt="Card image cap"
                                                  />
                                              </a>
                                          </div>
                                          <!-- end card-image -->
                                          <div class="card-body">
                                              <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                                                  All Levels
                                              </h6>
                                              <h5 class="card-title">
                                                  <a href="course-details.php"
                                                  >The Business Intelligence Analyst Course 2021</a
                                                  >
                                              </h5>
                                              <p class="card-text">
                                                  <a href="teacher-detail.html">Jose Portilla</a>
                                              </p>
                                              <div
                                                      class="rating-wrap d-flex align-items-center py-2"
                                              >
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
                                              <div
                                                      class="d-flex justify-content-between align-items-center"
                                              >
                                                  <p class="card-price text-black font-weight-bold">
                                                      129.99
                                                  </p>
                                                  <div
                                                          class="icon-element icon-element-sm shadow-sm cursor-pointer"
                                                          title="Remove from Wishlist"
                                                  >
                                                      <i class="la la-heart"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                              </div>
                              <!-- end row -->
                          </div>
                          <!-- end my-course-cards -->
                      </div>
                      <!-- end my-course-body -->
                  </div>
                  <!-- end tab-pane -->
                  <div
                          class="tab-pane fade"
                          id="archived"
                          role="tabpanel"
                          aria-labelledby="archived-tab"
                  >
                      <div class="my-course-body">
                          <div class="my-course-info pb-40px">
                              <h3 class="fs-22 font-weight-semi-bold">My archives</h3>
                          </div>
                          <!-- end my-course-info -->
                          <div class="my-course-cards">
                              <div class="row">
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="lesson-details.html" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img8.jpg"
                                                          alt="Card image cap"
                                                  />
                                                  <div class="play-button">
                                                      <svg
                                                              version="1.1"
                                                              xmlns="http://www.w3.org/2000/svg"
                                                              x="0px"
                                                              y="0px"
                                                              viewBox="-307.4 338.8 91.8 91.8"
                                                              xml:space="preserve"
                                                      >
                                <style type="text/css">
                                    .st0 {
                                        opacity: 0.6;
                                        fill: #000000;
                                        border-radius: 100px;
                                    }
                                    .st1 {
                                        fill: #ffffff;
                                    }
                                </style>
                                                          <g>
                                                              <circle
                                                                      class="st0"
                                                                      cx="-261.5"
                                                                      cy="384.7"
                                                                      r="45.9"
                                                              ></circle>
                                                              <path
                                                                      class="st1"
                                                                      d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                              ></path>
                                                          </g>
                              </svg>
                                                  </div>
                                              </a>
                                              <div class="course-badge-labels course--badge-labels">
                                                  <div
                                                          class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                  >
                                                      <div class="dropdown">
                                                          <a
                                                                  class="action-btn bg-white text-gray dropdown-btn"
                                                                  href="#"
                                                                  role="button"
                                                                  id="archiveMenuLink"
                                                                  data-toggle="dropdown"
                                                                  aria-haspopup="true"
                                                                  aria-expanded="false"
                                                          >
                                                              <i class="la la-ellipsis-v"></i>
                                                          </a>
                                                          <div
                                                                  class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                  aria-labelledby="archiveMenuLink"
                                                          >
                                                              <a
                                                                      href="javascript:void(0)"
                                                                      class="dropdown-item d-flex align-items-center justify-content-between"
                                                              >
                                                                  <span>Unarchive</span>
                                                                  <i class="la la-archive"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-image -->
                                          <div class="card-body">
                                              <h5 class="card-title">
                                                  <a href="lesson-details.html"
                                                  >The Complete Full-Stack JavaScript Course!</a
                                                  >
                                              </h5>
                                              <p class="card-text lh-22 pt-2">
                                                  <a href="teacher-detail.html">Jose Portilla</a
                                                  ><span>, Software Engineer and Developer</span>
                                              </p>
                                              <div
                                                      class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                              >
                                                  <p class="skillbar-title">Complete:</p>
                                                  <div class="skillbar-box">
                                                      <div
                                                              class="skillbar skillbar-skillbar-2"
                                                              data-percent="70%"
                                                      >
                                                          <div
                                                                  class="skillbar-bar skillbar--bar-2 bg-1"
                                                          ></div>
                                                      </div>
                                                      <!-- End Skill Bar -->
                                                  </div>
                                                  <div class="skill-bar-percent">70%</div>
                                              </div>
                                              <!-- end my-course-progress-bar-wrap -->
                                              <div
                                                      class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                              >
                                                  <div class="review-stars">
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                  </div>
                                                  <a
                                                          href="#"
                                                          class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#ratingModal"
                                                  >Leave a rating</a
                                                  >
                                              </div>
                                              <!-- end rating-wrap -->
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="lesson-details.html" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img9.jpg"
                                                          alt="Card image cap"
                                                  />
                                                  <div class="play-button">
                                                      <svg
                                                              version="1.1"
                                                              xmlns="http://www.w3.org/2000/svg"
                                                              x="0px"
                                                              y="0px"
                                                              viewBox="-307.4 338.8 91.8 91.8"
                                                              xml:space="preserve"
                                                      >
                                <style type="text/css">
                                    .st0 {
                                        opacity: 0.6;
                                        fill: #000000;
                                        border-radius: 100px;
                                    }
                                    .st1 {
                                        fill: #ffffff;
                                    }
                                </style>
                                                          <g>
                                                              <circle
                                                                      class="st0"
                                                                      cx="-261.5"
                                                                      cy="384.7"
                                                                      r="45.9"
                                                              ></circle>
                                                              <path
                                                                      class="st1"
                                                                      d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                              ></path>
                                                          </g>
                              </svg>
                                                  </div>
                                              </a>
                                              <div class="course-badge-labels course--badge-labels">
                                                  <div
                                                          class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                  >
                                                      <div class="dropdown">
                                                          <a
                                                                  class="action-btn bg-white text-gray dropdown-btn"
                                                                  href="#"
                                                                  role="button"
                                                                  id="archiveMenuLinkTwo"
                                                                  data-toggle="dropdown"
                                                                  aria-haspopup="true"
                                                                  aria-expanded="false"
                                                          >
                                                              <i class="la la-ellipsis-v"></i>
                                                          </a>
                                                          <div
                                                                  class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                  aria-labelledby="archiveMenuLinkTwo"
                                                          >
                                                              <a
                                                                      href="javascript:void(0)"
                                                                      class="dropdown-item d-flex align-items-center justify-content-between"
                                                              >
                                                                  <span>Unarchive</span>
                                                                  <i class="la la-archive"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-image -->
                                          <div class="card-body">
                                              <h5 class="card-title">
                                                  <a href="lesson-details.html"
                                                  >Modern JavaScript From The Beginning</a
                                                  >
                                              </h5>
                                              <p class="card-text lh-22 pt-2">
                                                  <a href="teacher-detail.html">Jose Portilla</a
                                                  ><span>, Software Engineer and Developer</span>
                                              </p>
                                              <div
                                                      class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                              >
                                                  <p class="skillbar-title">Complete:</p>
                                                  <div class="skillbar-box">
                                                      <div
                                                              class="skillbar skillbar-skillbar-2"
                                                              data-percent="0%"
                                                      >
                                                          <div
                                                                  class="skillbar-bar skillbar--bar-2 bg-1"
                                                          ></div>
                                                      </div>
                                                      <!-- End Skill Bar -->
                                                  </div>
                                                  <div class="skill-bar-percent">0%</div>
                                              </div>
                                              <!-- end my-course-progress-bar-wrap -->
                                              <div
                                                      class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                              >
                                                  <div class="review-stars">
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                  </div>
                                                  <a
                                                          href="#"
                                                          class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#ratingModal"
                                                  >Leave a rating</a
                                                  >
                                              </div>
                                              <!-- end rating-wrap -->
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                                  <div class="col-lg-4 responsive-column-half">
                                      <div class="card card-item">
                                          <div class="card-image">
                                              <a href="lesson-details.html" class="d-block">
                                                  <img
                                                          class="card-img-top lazy"
                                                          src="assets/images/img-loading.png"
                                                          data-src="assets/images/img10.jpg"
                                                          alt="Card image cap"
                                                  />
                                                  <div class="play-button">
                                                      <svg
                                                              version="1.1"
                                                              xmlns="http://www.w3.org/2000/svg"
                                                              x="0px"
                                                              y="0px"
                                                              viewBox="-307.4 338.8 91.8 91.8"
                                                              xml:space="preserve"
                                                      >
                                <style type="text/css">
                                    .st0 {
                                        opacity: 0.6;
                                        fill: #000000;
                                        border-radius: 100px;
                                    }
                                    .st1 {
                                        fill: #ffffff;
                                    }
                                </style>
                                                          <g>
                                                              <circle
                                                                      class="st0"
                                                                      cx="-261.5"
                                                                      cy="384.7"
                                                                      r="45.9"
                                                              ></circle>
                                                              <path
                                                                      class="st1"
                                                                      d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"
                                                              ></path>
                                                          </g>
                              </svg>
                                                  </div>
                                              </a>
                                              <div class="course-badge-labels course--badge-labels">
                                                  <div
                                                          class="generic-action-wrap generic--action-wrap generic--action-wrap-2"
                                                  >
                                                      <div class="dropdown">
                                                          <a
                                                                  class="action-btn bg-white text-gray dropdown-btn"
                                                                  href="#"
                                                                  role="button"
                                                                  id="archiveMenuLinkThree"
                                                                  data-toggle="dropdown"
                                                                  aria-haspopup="true"
                                                                  aria-expanded="false"
                                                          >
                                                              <i class="la la-ellipsis-v"></i>
                                                          </a>
                                                          <div
                                                                  class="dropdown-menu dropdown-menu-right dropdown-menu-wrap"
                                                                  aria-labelledby="archiveMenuLinkThree"
                                                          >
                                                              <a
                                                                      href="javascript:void(0)"
                                                                      class="dropdown-item d-flex align-items-center justify-content-between"
                                                              >
                                                                  <span>Unarchive</span>
                                                                  <i class="la la-archive"></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- end card-image -->
                                          <div class="card-body">
                                              <h5 class="card-title">
                                                  <a href="lesson-details.html"
                                                  >The Complete JavaScript Course 2020: Build Real
                                                      Projects!</a
                                                  >
                                              </h5>
                                              <p class="card-text lh-22 pt-2">
                                                  <a href="teacher-detail.html">Jose Portilla</a
                                                  ><span>, Software Engineer and Developer</span>
                                              </p>
                                              <div
                                                      class="my-course-progress-bar-wrap d-flex flex-wrap align-items-center mt-3 position-relative"
                                              >
                                                  <p class="skillbar-title">Complete:</p>
                                                  <div class="skillbar-box">
                                                      <div
                                                              class="skillbar skillbar-skillbar-2"
                                                              data-percent="0%"
                                                      >
                                                          <div
                                                                  class="skillbar-bar skillbar--bar-2 bg-1"
                                                          ></div>
                                                      </div>
                                                      <!-- End Skill Bar -->
                                                  </div>
                                                  <div class="skill-bar-percent">0%</div>
                                              </div>
                                              <!-- end my-course-progress-bar-wrap -->
                                              <div
                                                      class="rating-wrap d-flex align-items-center justify-content-between pt-3"
                                              >
                                                  <div class="review-stars">
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                      <span class="la la-star-o"></span>
                                                  </div>
                                                  <a
                                                          href="#"
                                                          class="btn theme-btn theme-btn-sm theme-btn-transparent"
                                                          data-bs-toggle="modal"
                                                          data-bs-target="#ratingModal"
                                                  >Leave a rating</a
                                                  >
                                              </div>
                                              <!-- end rating-wrap -->
                                          </div>
                                          <!-- end card-body -->
                                      </div>
                                      <!-- end card -->
                                  </div>
                                  <!-- end col-lg-4 -->
                              </div>
                              <!-- end row -->
                          </div>
                          <!-- end my-course-cards -->
                      </div>
                      <!-- end my-course-body -->
                  </div>
                  <!-- end tab-pane -->
              </div>
              <!-- end tab-content -->
          </div>
      </div>
      <!-- end container -->
  </section>
  <!-- end my-courses-area -->
  <!-- ================================
     START MY COURSES
================================= -->

  <!--======================================
      START CTA AREA
======================================-->
  <section class="cta-area py-5 bg-gray position-relative overflow-hidden">
      <span class="stroke-shape stroke-shape-1"></span>
      <span class="stroke-shape stroke-shape-2"></span>
      <span class="stroke-shape stroke-shape-3"></span>
      <span class="stroke-shape stroke-shape-4"></span>
      <span class="stroke-shape stroke-shape-5"></span>
      <span class="stroke-shape stroke-shape-6"></span>
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <div class="cta-content-wrap">
                      <h3 class="fs-20 font-weight-semi-bold lh-28">
                          Top companies choose
                          <a href="for-business.html" class="text-color hover-underline"
                          >DefendTech for Business</a
                          >
                          to build in-demand career skills.
                      </h3>
                  </div>
              </div>
              <!-- end col-lg-6 -->
              <div class="col-lg-6">
                  <div class="client-logo-wrap text-end">
                      <a href="#" class="client-logo-item client--logo-item-2 pe-3"
                      ><img src="assets/images/sponsor-img.png" alt="brand image"
                          /></a>
                      <a href="#" class="client-logo-item client--logo-item-2 pe-3"
                      ><img src="assets/images/sponsor-img2.png" alt="brand image"
                          /></a>
                      <a href="#" class="client-logo-item client--logo-item-2 pe-3"
                      ><img src="assets/images/sponsor-img3.png" alt="brand image"
                          /></a>
                  </div>
                  <!-- end client-logo-wrap -->
              </div>
              <!-- end col-lg-6 -->
          </div>
          <!-- end row -->
      </div>
      <!-- end container -->
  </section>
  <!-- end cta-area -->
  <!--======================================
      END CTA AREA
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
</body>

</html>
