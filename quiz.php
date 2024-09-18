<?php
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
  <section class="breadcrumb-area">
    <div class="bg-white py-3 pattern-bg">
      <div class="container">
        <div class="breadcrumb-content">
          <ul class="quiz-nav d-flex flex-wrap align-items-center">

            <li>
              <div class="d-flex align-items-center">
                <a href="course-details.php">
                  <img src="assets/images/angular.png" alt="Angular thumbnail" />
                </a>
                <p>
                  <a href="course-details.php">Angular Fundamentals</a><span class="d-block fs-13">Brad Traversy</span>
                </p>
              </div>
            </li>
          </ul>
        </div>
        <!-- end breadcrumb-content -->
      </div>
      <!-- end container -->
    </div>
    <div class="bg-dark pt-60px pb-60px">
      <div class="container">
        <ul class="quiz-course-nav d-flex align-items-center justify-content-between">
          <li>
            <a href="course-details.php" class="icon-element icon-element-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Getting Started with Angular: Introduction">
              <i class="la la-check"></i>
            </a>
          </li>
          <li>
            <a href="course-details.php" class="icon-element icon-element-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Getting Started with Angular: Introduction to TypeScript">
              <i class="la la-check"></i>
            </a>
          </li>
          <li>
            <a href="course-details.php" class="icon-element icon-element-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Getting Started with Angular: Comparing Angular to AngularJS">
              <i class="la la-check"></i>
            </a>
          </li>
          <li>
            <a href="student-quiz.html" class="icon-element icon-element-sm text-success" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Quiz: Getting Started with Angular">
              <i class="la la-user"></i>
            </a>
          </li>
        </ul>
        <div class="breadcrumb-content pt-40px">
          <div class="section-heading">
            <h2 class="section__title text-white fs-30 pb-2">
              Question 1 of 5
            </h2>
            <p class="section__desc text-white-50">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Accusamus deleniti deserunt dolorum eligendi exercitationem,
              facere fuga, hic laudantium obcaecati officia omnis qui quia
              quisquam rem sed sit ullam velit voluptatibus?
            </p>
          </div>
        </div>
      </div>
      <!-- end container -->
    </div>
    <div class="quiz-action-nav bg-white py-3 shadow-sm">
      <div class="container">
        <div class="quiz-action-content d-flex flex-wrap align-items-center justify-content-between">
          <ul class="quiz-nav d-flex align-items-center">
            <li>
              <i class="la la-sliders fs-17 me-2"></i>Choose the correct
              answer below
            </li>
          </ul>
          <div class="quiz-nav-btns">
            <a href="student-quiz-result-details.html" class="btn theme-btn theme-btn-transparent me-2">Skip Quiz</a>
            <a href="course-details.php" class="btn theme-btn theme-btn-transparent me-2">Review Video</a>
            <a href="student-quiz-result-details.html" class="btn theme-btn">Next Question <i class="la la-angle-right icon ms-1"></i></a>
          </div>
        </div>
      </div>
      <!-- end container -->
    </div>
    <!-- end quiz-action-nav -->
  </section>
  <!-- end breadcrumb-area -->
  <!-- ================================
    END BREADCRUMB AREA
================================= -->

  <!-- ================================
       START QUIZ ANS AREA
================================= -->
  <section class="quiz-ans-wrap pt-60px pb-60px">
    <div class="container">
      <div class="quiz-ans-content">
        <h3 class="fs-22 font-weight-semi-bold">Your Answer:</h3>
        <div class="quiz-ans-list py-3">
          <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="custom-control-input" id="quizAnsCheckbox" required />
            <label class="custom-control-label custom--control-label" for="quizAnsCheckbox">
              Ability to use newer syntax and offers reliability
            </label>
          </div>
          <!-- end custom-control -->
          <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="custom-control-input" id="quizAnsCheckbox2" required checked />
            <label class="custom-control-label custom--control-label" for="quizAnsCheckbox2">
              Compatibility
            </label>
          </div>
          <!-- end custom-control -->
          <div class="custom-control custom-checkbox mb-1">
            <input type="checkbox" class="custom-control-input" id="quizAnsCheckbox3" required />
            <label class="custom-control-label custom--control-label" for="quizAnsCheckbox3">
              Usage of missing features
            </label>
          </div>
          <!-- end custom-control -->
        </div>
        <!-- end quiz-ans-list -->
        <p class="fs-15">
          <strong class="font-weight-semi-bold text-black">Note:</strong>
          There can be multiple correct answers to this question.
        </p>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- ================================
       START QUIZ ANS AREA
================================= -->

  <!--======================================
        START CTA AREA
======================================-->
  <section class="cta-area py-5 position-relative overflow-hidden bg-gray">
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
              <a href="for-business.html" class="text-color hover-underline">DefendTech for Business</a>
              to build in-demand career skills.
            </h3>
          </div>
        </div>
        <!-- end col-lg-6 -->
        <div class="col-lg-6">
          <div class="client-logo-wrap text-end">
            <a href="#" class="client-logo-item client--logo-item-2 pe-3"><img src="assets/images/sponsor-img.png" alt="brand image" /></a>
            <a href="#" class="client-logo-item client--logo-item-2 pe-3"><img src="assets/images/sponsor-img2.png" alt="brand image" /></a>
            <a href="#" class="client-logo-item client--logo-item-2 pe-3"><img src="assets/images/sponsor-img3.png" alt="brand image" /></a>
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

<!-- Mirrored from techydevs.com/demos/themes/html/DefendTech-demo/DefendTech/student-quiz.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Jun 2024 15:27:19 GMT -->

</html>
