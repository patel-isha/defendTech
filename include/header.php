<header class="header-menu-area bg-white">
    <div class="header-top pe-150px ps-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pe-3 me-3 border-right border-right-gray">
                                <i class="la la-phone me-1"></i><a href="tel:00123456789"> (00) 123 456 789</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="la la-envelope-o me-1"></i><a href="mailto:contact@demo.com"> contact@defendtech.com</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end header-widget -->
                </div>
                <!-- end col-lg-6 -->
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
                        <?php if (!isset($_SESSION['user_id'])) { ?>
                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray ps-3 ms-3">
                                <li class="d-flex align-items-center pe-3 me-3 border-right border-right-gray">
                                    <i class="la la-sign-in me-1"></i><a href="login.php"> Login</a>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class="la la-user me-1"></i><a href="register.php"> Register</a>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray ps-3 ms-3">
                                <li class="nav-item dropdown">
                                    <label class="welcome-user cursor-pointer" for="dropdown-toggle">
                                        <span><i class="fa-solid fa-circle-user fa-fw align-middle f-28"></i></span>Welcome <?php echo $_SESSION['fname']; ?> <i class="fas fa-angle-down align-middle ml-10"></i>
                                    </label>
                                    <input type="checkbox" id="dropdown-toggle" class="toggle-input">
                                    <ul class="submenu">
                                        <li><a href="my-account.php">My Profile</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                    <!-- end header-widget -->
                </div>
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
                                    <li>
                                        <a href="quiz.php">quiz</a>
                                    </li>
                                    <!-- <li>
                                         <a href="#">My profile <i class="la la-angle-down fs-12"></i></a>
                                         <ul class="dropdown-menu-item">
                                             <li>
                                                 <a href="student-detail.html">my details</a>
                                             </li>
                                             
                                             <li><a href="student-path.html">path details </a></li>
                                             <li>
                                                 <a href="student-path-assessment.html">Skill Assessment</a>
                                             </li>
                                             <li>
                                                 <a href="student-path-assessment-result.html">Skill result</a>
                                             </li>
                                         </ul>
                                     </li> -->
                                    <!-- <li class="mega-menu-has">
                                         <a href="#">pages <i class="la la-angle-down fs-12"></i></a>
                                         <div class="dropdown-menu-item mega-menu">
                                             <ul class="row no-gutters">
                                                 <li class="col-lg-3">
                                                     <a href="dashboard.html">dashboard <span class="ribbon">Hot</span></a>

                                                     <a href="teachers.html">Teachers</a>
                                                     <a href="teacher-detail.html">Teacher detail</a>
                                                     <a href="categories.html">categories </a>
                                                     <a href="terms-and-conditions.html">Terms & conditions
                                                     </a>
                                                     <a href="privacy-policy.html">privacy policy </a>
                                                     <a href="invite.html">invite friend </a>
                                                 </li>
                                                 <li class="col-lg-3">
                                                     <a href="careers.html">careers </a>
                                                     <a href="career-details.html">career details </a>
                                                     <a href="become-a-teacher.html">become an instructor</a>
                                                     <a href="faq.html">FAQs</a>
                                                     <a href="admission.html">admission</a>
                                                     <a href="gallery.html">gallery</a>
                                                     <a href="pricing-table.html">pricing tables</a>

                                                 </li>
                                                 <li class="col-lg-3">
                                                     <a href="for-business.html">for business </a>
                                                     <a href="register.php">sign-up</a>
                                                     <a href="login.php">login</a>
                                                     <a href="forgot-password.php">recover</a>
                                                     <a href="shopping-cart.html">cart</a>
                                                     <a href="checkout.html">checkout</a>
                                                     <a href="error.html">page 404</a>
                                                 </li>
                                                 <li class="col-lg-3">
                                                     <div class="menu-banner position-relative h-100">
                                                         <div class="overlay rounded-rounded opacity-4"></div>
                                                         <div class="menu-banner-content p-4 position-absolute bottom-0 left-0">
                                                             <h4 class="fs-20 font-weight-bold pb-3 text-white">
                                                                 30 days free trail for new users
                                                             </h4>
                                                             <a href="register.php" class="btn theme-btn theme-btn-sm theme-btn-white">Start Learning
                                                                 <i class="la la-arrow-right icon ms-1"></i></a>
                                                         </div>
                                                         <img src="assets/images/menu-banner-img.jpg" alt="menu banner image" class="w-100 h-100 rounded-rounded" />
                                                     </div>
                                                 </li>
                                             </ul>
                                         </div>
                                     </li> -->
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
                    <li><a href="home-2.html">Home Two</a></li>
                    <li><a href="home-3.html">Home Three</a></li>
                    <li><a href="home-4.html">Home four </a></li>
                </ul>
            </li>
            <li>
                <a href="#">courses</a>
                <ul class="sub-menu">
                    <li><a href="course-grid.html">course grid</a></li>
                    <li><a href="course-list.html">course list </a></li>
                    <li><a href="course-left-sidebar.html">left sidebar </a></li>
                    <li><a href="course-right-sidebar.html">right sidebar </a></li>
                    <li><a href="course-details.php">course details</a></li>
                    <li><a href="lesson-details.html">lesson details</a></li>
                    <li><a href="my-courses.html">My courses</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Student</a>
                <ul class="sub-menu">
                    <li><a href="student-detail.html">student detail</a></li>
                    <li><a href="student-quiz.html">take quiz</a></li>
                    <li><a href="student-quiz-results.html">quiz results</a></li>
                    <li>
                        <a href="student-quiz-result-details.html">quiz details</a>
                    </li>
                    <li>
                        <a href="student-quiz-result-details-2.html">quiz details 2</a>
                    </li>
                    <li><a href="student-path.html">path details </a></li>
                    <li>
                        <a href="student-path-assessment.html">Skill Assessment</a>
                    </li>
                    <li>
                        <a href="student-path-assessment-result.html">Skill result</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">pages</a>
                <ul class="sub-menu">
                    <li>
                        <a href="dashboard.html">dashboard <span class="ribbon">Hot</span></a>
                    </li>
                    <li><a href="about.php">about</a></li>
                    <li><a href="teachers.html">Teachers</a></li>
                    <li><a href="teacher-detail.html">Teacher detail</a></li>
                    <li><a href="careers.html">careers </a></li>
                    <li><a href="career-details.html">career details </a></li>
                    <li><a href="categories.html">categories </a></li>
                    <li>
                        <a href="terms-and-conditions.html">Terms & conditions </a>
                    </li>
                    <li><a href="privacy-policy.html">privacy policy </a></li>
                    <li><a href="for-business.html">for business </a></li>
                    <li><a href="become-a-teacher.html">become an instructor</a></li>
                    <li><a href="faq.html">FAQs</a></li>
                    <li><a href="admission.html">admission</a></li>
                    <li><a href="gallery.html">gallery</a></li>
                    <li><a href="pricing-table.html">pricing tables</a></li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a href="register.php">sign-up</a></li>
                    <li><a href="login.php">login</a></li>
                    <li><a href="forgot-password.php">recover</a></li>
                    <li><a href="shopping-cart.html">cart</a></li>
                    <li><a href="checkout.html">checkout</a></li>
                    <li><a href="error.html">page 404</a></li>
                </ul>
            </li>
            <li>
                <a href="#">blog</a>
                <ul class="sub-menu">
                    <li><a href="blog-full-width.html">blog full width </a></li>
                    <li><a href="blog-no-sidebar.html">blog no sidebar</a></li>
                    <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                    <li><a href="blog-right-sidebar.html">blog right sidebar</a></li>
                    <li><a href="blog-detail.php">blog detail</a></li>
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
                    <li><a href="#">Mobile Apps</a></li>
                    <li><a href="#">Game Development</a></li>
                    <li><a href="#">Databases</a></li>
                    <li><a href="#">Programming Languages</a></li>
                    <li><a href="#">Software Testing</a></li>
                    <li><a href="#">Software Engineering</a></li>
                    <li><a href="#">E-Commerce</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">business</a>
                <ul class="sub-menu">
                    <li><a href="#">All Business</a></li>
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Entrepreneurship</a></li>
                    <li><a href="#">Strategy</a></li>
                    <li><a href="#">Real Estate</a></li>
                    <li><a href="#">Home Business</a></li>
                    <li><a href="#">Communications</a></li>
                    <li><a href="#">Industry</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">IT & Software</a>
                <ul class="sub-menu">
                    <li><a href="#">All IT & Software</a></li>
                    <li><a href="#">IT Certification</a></li>
                    <li><a href="#">Hardware</a></li>
                    <li><a href="#">Network & Security</a></li>
                    <li><a href="#">Operating Systems</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Finance & Accounting</a>
                <ul class="sub-menu">
                    <li><a href="#"> All Finance & Accounting</a></li>
                    <li><a href="#">Accounting & Bookkeeping</a></li>
                    <li><a href="#">Cryptocurrency & Blockchain</a></li>
                    <li><a href="#">Economics</a></li>
                    <li><a href="#">Investing & Trading</a></li>
                    <li><a href="#">Other Finance & Economics</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">design</a>
                <ul class="sub-menu">
                    <li><a href="#">All Design</a></li>
                    <li><a href="#">Graphic Design</a></li>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Design Tools</a></li>
                    <li><a href="#">3D & Animation</a></li>
                    <li><a href="#">User Experience</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Personal Development</a>
                <ul class="sub-menu">
                    <li><a href="#">All Personal Development</a></li>
                    <li><a href="#">Personal Transformation</a></li>
                    <li><a href="#">Productivity</a></li>
                    <li><a href="#">Leadership</a></li>
                    <li><a href="#">Personal Finance</a></li>
                    <li><a href="#">Career Development</a></li>
                    <li><a href="#">Parenting & Relationships</a></li>
                    <li><a href="#">Happiness</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Marketing</a>
                <ul class="sub-menu">
                    <li><a href="#">All Marketing</a></li>
                    <li><a href="#">Digital Marketing</a></li>
                    <li><a href="#">Search Engine Optimization</a></li>
                    <li><a href="#">Social Media Marketing</a></li>
                    <li><a href="#">Branding</a></li>
                    <li><a href="#">Video & Mobile Marketing</a></li>
                    <li><a href="#">Affiliate Marketing</a></li>
                    <li><a href="#">Growth Hacking</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Health & Fitness</a>
                <ul class="sub-menu">
                    <li><a href="#">All Health & Fitness</a></li>
                    <li><a href="#">Fitness</a></li>
                    <li><a href="#">Sports</a></li>
                    <li><a href="#">Dieting</a></li>
                    <li><a href="#">Self Defense</a></li>
                    <li><a href="#">Meditation</a></li>
                    <li><a href="#">Mental Health</a></li>
                    <li><a href="#">Yoga</a></li>
                    <li><a href="#">Dance</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
            </li>
            <li>
                <a href="course-grid.html">Photography</a>
                <ul class="sub-menu">
                    <li><a href="#">All Photography</a></li>
                    <li><a href="#">Digital Photography</a></li>
                    <li><a href="#">Photography Fundamentals</a></li>
                    <li><a href="#">Commercial Photography</a></li>
                    <li><a href="#">Video Design</a></li>
                    <li><a href="#">Photography Tools</a></li>
                    <li><a href="#">Other</a></li>
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