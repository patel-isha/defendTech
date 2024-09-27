 <!-- sidebar @s -->
 <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
     <div class="nk-sidebar-element nk-sidebar-head">
         <div class="nk-menu-trigger">
             <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
             <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
         </div>
         <div class="nk-sidebar-brand">
             <a href="course-list.php" class="logo-link nk-sidebar-logo">
                 <img class="w-45" src="assets/images/dashboard-logo.png" alt="logo">
             </a>
         </div>
     </div><!-- .nk-sidebar-element -->
     <div class="nk-sidebar-element nk-sidebar-body">
         <div class="nk-sidebar-content">
             <div class="nk-sidebar-menu" data-simplebar>
                 <ul class="nk-menu">
                     <li class="nk-menu-item has-sub">
                         <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                             <span class="nk-menu-icon"><em class="icon fa fa-book"></em></span>
                             <span class="nk-menu-text">Courses</span>
                         </a>
                         <ul class="nk-menu-sub">
                             <li class="nk-menu-item">
                                 <a href="course-list.php" class="nk-menu-link"><span class="nk-menu-text">Course Listing</span></a>
                             </li>
                             <?php if ($_SESSION['designation'] == 'admin') { ?>
                                 <li class="nk-menu-item" style="display: <?php if ($_SESSION['designation'] == "tutor") {
                                                                                echo "none";
                                                                            } else {
                                                                                echo "block";
                                                                            } ?>;">
                                     <a href="add-course-category.php" class="nk-menu-link"><span class="nk-menu-text">Course Category</span></a>
                                 </li>
                             <?php } ?>
                             <li class="nk-menu-item">
                                 <a href="course-content-list.php" class="nk-menu-link"><span class="nk-menu-text">Course Content</span></a>
                             </li>
                             <li class="nk-menu-item">
                                 <a href="reviews.php" class="nk-menu-link"><span class="nk-menu-text">Course Reviews</span></a>
                             </li>
                         </ul><!-- .nk-menu-sub -->
                     </li><!-- .nk-menu-item -->
                     <?php if ($_SESSION['designation'] == 'admin') { ?>
                         <li class="nk-menu-item">
                             <a href="tutor-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">Tutors</span>
                             </a>
                         </li>
                         <li class="nk-menu-item">
                             <a href="student-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user"></em></span>
                                 <span class="nk-menu-text">Students</span>
                             </a>
                         </li>
                     <?php } ?>
                     <?php if ($_SESSION['designation'] == 'tutor') { ?>
                         <li class="nk-menu-item">
                             <a href="edit-tutor-profile.php?id=<?php echo $_SESSION["admin_id"] ?>" target="_blank" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">My Profile</span>
                             </a>
                         </li>
                     <?php } ?>
                     <li class="nk-menu-item">
                         <a href="blog-list.php" class="nk-menu-link">
                             <span class="nk-menu-icon"><em class="icon fas fa-blog"></em></span>
                             <span class="nk-menu-text">Blog</span>
                         </a>
                     </li>
                     <!-- <li class="nk-menu-item">
                         <a href="bookings.php" class="nk-menu-link">
                             <span class="nk-menu-icon"><em class="icon fas fa-calendar-alt"></em></span>
                             <span class="nk-menu-text">Enrollments</span>
                         </a>
                     </li> -->
                 </ul><!-- .nk-menu -->
             </div><!-- .nk-sidebar-menu -->
         </div><!-- .nk-sidebar-content -->
     </div><!-- .nk-sidebar-element -->
 </div>
 <!-- sidebar @e -->