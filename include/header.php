<header class="header-menu-area bg-white">
    <div class="header-top pe-150px ps-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pe-3 me-3 border-right border-right-gray">
                                <i class="la la-phone me-1 f-large"></i><a href="tel:+1(888)7601940"> + 1 (888) 760 1940</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="la la-envelope-o me-1 f-large"></i><a href="mailto:info@defendtech.com"> info@defendtech.com</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end header-widget -->
                </div>
                <!-- end col-lg-6 -->
                <?php if (!isset($_SESSION['user_id'])) { ?>
                    <div class="col-lg-6">
                        <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                            <div class="theme-picker d-flex align-items-center">
                                <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                    <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                    </svg>
                                </button>
                                <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                    <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="5"></circle>
                                        <line x1="12" y1="1" x2="12" y2="3"></line>
                                        <line x1="12" y1="21" x2="12" y2="23"></line>
                                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                        <line x1="1" y1="12" x2="3" y2="12"></line>
                                        <line x1="21" y1="12" x2="23" y2="12"></line>
                                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                    </svg>
                                </button>
                            </div>

                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray ps-3 ms-3">
                                <li class="d-flex align-items-center pe-3 me-3 border-right border-right-gray">
                                    <i class="la la-sign-in me-1 f-large"></i><a href="login.php"> Login</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="la la-user me-1 f-large"></i><a href="register.php"> Register</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end header-widget -->
                    </div>
                <?php } ?>
                <!-- end col-lg-6 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end header-top -->
    <div class="header-menu-content pe-150px ps-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="index.php" class="logo"><img src="assets/images/logo.png" class="w-90" alt="logo" /></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm me-2" data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm me-2" data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="about.php">about us</a>
                                    </li>
                                    <li>
                                        <a href="course-grid.php">courses</a>
                                    </li>
                                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['designation'] == 'student')) { ?>
                                        <li>
                                            <a href="quiz.php">quiz</a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="blog.php">blog </a>
                                    </li>
                                    <li>
                                        <a href="contact.php">contact us</a>
                                    </li>
                                </ul>
                                <!-- end ul -->
                            </nav>
                            <!-- end main-menu -->
                            <div class="shop-cart me-4">
                                <ul>
                                    <li>
                                        <a href="shopping-cart.php" class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-shopping-cart f-large"></i>
                                            <span class="product-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                                        </a>

                                    </li>
                                </ul>
                            </div>
                            <!-- end shop-cart -->
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <div class="shop-cart user-profile-cart me-2">
                                    <ul>
                                        <li>
                                            <div class="shop-cart-btn">
                                                <div class="avatar-xs">
                                                    <img
                                                        class="rounded-full img-fluid"
                                                        src="assets/images/small-avatar-1.jpg"
                                                        alt="Avatar image" />
                                                </div>
                                            </div>
                                            <ul
                                                class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
                                                <li
                                                    class="menu-heading-block d-flex align-items-center">
                                                    <a href="javascript:void(0)"
                                                        class="avatar-sm flex-shrink-0 d-block">
                                                        <img
                                                            class="rounded-full img-fluid"
                                                            src="assets/images/small-avatar-1.jpg"
                                                            alt="Avatar image" />
                                                    </a>
                                                    <div class="ms-2">
                                                        <h4>
                                                            <a href="javascript:void(0)"
                                                                class="text-black">
                                                                <?php
                                                                $fullname = $_SESSION['name'];
                                                                echo $fullname;
                                                                ?>
                                                            </a>
                                                        </h4>
                                                        <span class="d-block fs-14 lh-20">
                                                        <?php
                                                                $email = $_SESSION['email'];
                                                                echo $email;
                                                                ?>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                        <button
                                                            class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Dark mode">
                                                            <svg
                                                                class="me-1"
                                                                viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path
                                                                    d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                                            </svg>
                                                            Dark Mode
                                                        </button>
                                                        <button
                                                            class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center"
                                                            title="Light mode">
                                                            <svg
                                                                class="me-1"
                                                                viewBox="0 0 24 24"
                                                                stroke-width="1.5"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <circle cx="12" cy="12" r="5"></circle>
                                                                <line
                                                                    x1="12"
                                                                    y1="1"
                                                                    x2="12"
                                                                    y2="3"></line>
                                                                <line
                                                                    x1="12"
                                                                    y1="21"
                                                                    x2="12"
                                                                    y2="23"></line>
                                                                <line
                                                                    x1="4.22"
                                                                    y1="4.22"
                                                                    x2="5.64"
                                                                    y2="5.64"></line>
                                                                <line
                                                                    x1="18.36"
                                                                    y1="18.36"
                                                                    x2="19.78"
                                                                    y2="19.78"></line>
                                                                <line
                                                                    x1="1"
                                                                    y1="12"
                                                                    x2="3"
                                                                    y2="12"></line>
                                                                <line
                                                                    x1="21"
                                                                    y1="12"
                                                                    x2="23"
                                                                    y2="12"></line>
                                                                <line
                                                                    x1="4.22"
                                                                    y1="19.78"
                                                                    x2="5.64"
                                                                    y2="18.36"></line>
                                                                <line
                                                                    x1="18.36"
                                                                    y1="5.64"
                                                                    x2="19.78"
                                                                    y2="4.22"></line>
                                                            </svg>
                                                            Light Mode
                                                        </button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <ul class="generic-list-item">
                                                        <li>
                                                            <a href="my-courses.php">
                                                                <i class="la la-file-video-o me-1"></i> My
                                                                courses
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="my-profile.php">
                                                                <i class="la la-user me-1"></i> My
                                                                profile
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="logout.php">
                                                                <i class="la la-power-off me-1"></i>
                                                                Logout
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <div class="section-block"></div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                            <!-- end profile -->
                        </div>
                        <!-- end menu-wrapper -->
                    </div>
                    <!-- end col-lg-10 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div>
        <!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="#">Home</a>
                <ul class="sub-menu">
                    <li><a href="index.php">Home One</a></li>
                </ul>
            </li>
            <li>
                <a href="#">courses</a>
                <ul class="sub-menu">
                    <li><a href="course-grid.html">course grid</a></li>
                    <li><a href="course-list.html">course list </a></li>
                </ul>
            </li>
            <li>
                <a href="#">Student</a>
                <ul class="sub-menu">
                    <li><a href="student-detail.html">student detail</a></li>
                    <li><a href="student-quiz.html">take quiz</a></li>
                    <li><a href="student-quiz-results.html">quiz results</a></li>
                </ul>
            </li>
            <li>
                <a href="#">pages</a>
                <ul class="sub-menu">
                    <li>
                        <a href="dashboard.html">dashboard <span class="ribbon">Hot</span></a>
                    </li>
                    <li><a href="about.php">about</a></li>
                </ul>
            </li>
            <li>
                <a href="#">blog</a>
                <ul class="sub-menu">
                    <li><a href="blog-full-width.html">blog full width </a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end off-canvas-menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
            <i class="la la-times"></i>
        </div>
        <!-- end off-canvas-menu-close -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="course-grid.html">Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Development</a></li>
                    <li><a href="#">Web Development</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">business</a>
                <ul class="sub-menu">
                    <li><a href="#">All Business</a></li>
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Entrepreneurship</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">IT & Software</a>
                <ul class="sub-menu">
                    <li><a href="#">All IT & Software</a></li>
                    <li><a href="#">IT Certification</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Finance & Accounting</a>
                <ul class="sub-menu">
                    <li><a href="#"> All Finance & Accounting</a></li>
                    <li><a href="#">Accounting & Bookkeeping</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">design</a>
                <ul class="sub-menu">
                    <li><a href="#">All Design</a></li>
                    <li><a href="#">Graphic Design</a></li>
                    <li><a href="#">Web Design</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Personal Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Personal Development</a></li>
                    <li><a href="#">Personal Transformation</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Marketing</a>
                <ul class="sub-menu">
                    <li><a href="#">All Marketing</a></li>
                    <li><a href="#">Digital Marketing</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Health & Fitness</a>
                <ul class="sub-menu">
                    <li><a href="#">All Health & Fitness</a></li>
                    <li><a href="#">Fitness</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Photography</a>
                <ul class="sub-menu">
                    <li><a href="#">All Photography</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- end off-canvas-menu -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 me-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control ps-3" type="text" name="search" placeholder="Search for anything" />
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div>
            <!-- end off-canvas-menu-close -->
        </div>
    </div>
    <!-- end mobile-search-form -->
    <div class="body-overlay"></div>
</header>
<!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->