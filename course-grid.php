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
            We found <span class="text-black">56</span> courses available for
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
            <div class="select-container select--container">
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
                    <input class="form-control form--control ps-3" type="text" name="search" placeholder="Search courses" />
                    <span class="la la-search search-icon"></span>
                  </div>
                </form>
              </div>
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Ratings</h3>
                <div class="divider"><span></span></div>
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
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Categories</h3>
                <div class="divider"><span></span></div>
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
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Level</h3>
                <div class="divider"><span></span></div>
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
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">By Cost</h3>
                <div class="divider"><span></span></div>
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
            </div>
            <!-- end card -->
            <div class="card card-item">
              <div class="card-body">
                <h3 class="card-title fs-18 pb-2">Instructors</h3>
                <div class="divider"><span></span></div>
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
            </div>
            <!-- end card -->
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img8.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge">Bestseller</div>
                    <div class="course-badge blue">-39%</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            </div>
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img9.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge red">Featured</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img10.jpg" alt="Card image cap" />
                  </a>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img11.jpg" alt="Card image cap" />
                  </a>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img12.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge green">Free</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
                    <p class="card-price text-black font-weight-bold">Free</p>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                      <i class="la la-heart-o"></i>
                    </div>
                  </div>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card -->
            </div>
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img13.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge sky-blue">Highest rated</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img10.jpg" alt="Card image cap" />
                  </a>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img11.jpg" alt="Card image cap" />
                  </a>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img12.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge green">Free</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
                    <p class="card-price text-black font-weight-bold">Free</p>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist">
                      <i class="la la-heart-o"></i>
                    </div>
                  </div>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card -->
            </div>
            <!-- end col-lg-6 -->
            <div class="col-lg-6 responsive-column-half">
              <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                <div class="card-image">
                  <a href="course-details.php" class="d-block">
                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="assets/images/img13.jpg" alt="Card image cap" />
                  </a>
                  <div class="course-badge-labels">
                    <div class="course-badge sky-blue">Highest rated</div>
                  </div>
                </div>
                <!-- end card-image -->
                <div class="card-body">
                  
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
            <!-- end col-lg-6 -->
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
            <p class="fs-14 pt-2">Showing 1-10 of 56 results</p>
          </div>
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

  <?php
  include 'include/footer-scripts.php';
  ?>
</body>

</html>