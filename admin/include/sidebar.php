 <!-- sidebar @s -->
 <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
     <div class="nk-sidebar-element nk-sidebar-head">
         <div class="nk-menu-trigger">
             <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
             <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
         </div>
         <div class="nk-sidebar-brand">
             <a href="dashboard.php" class="logo-link nk-sidebar-logo">
                 <img class="w-45" src="assets/images/dashboard-logo.png" alt="logo">
             </a>
         </div>
     </div><!-- .nk-sidebar-element -->
     <div class="nk-sidebar-element nk-sidebar-body">
         <div class="nk-sidebar-content">
             <div class="nk-sidebar-menu" data-simplebar>
                 <ul class="nk-menu">
                     <li class="nk-menu-item">
                         <a href="dashboard.php" class="nk-menu-link">
                             <span class="nk-menu-icon"><em class="icon fas fa-chart-line"></em></span>
                             <span class="nk-menu-text">Dashboard</span>
                         </a>
                     </li>
                     <li class="nk-menu-item has-sub">
                         <a href="#" class="nk-menu-link nk-menu-toggle">
                             <span class="nk-menu-icon"><em class="icon fa fa-book"></em></span>
                             <span class="nk-menu-text">Courses</span>
                         </a>
                         <ul class="nk-menu-sub">
                             <li class="nk-menu-item">
                                 <a href="car-list.php" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                             </li>
                             <?php if ($_SESSION['designation'] == 'admin'){ ?>
                                 <li class="nk-menu-item" style="display: <?php if($_SESSION['designation'] == "tutor") {
                                    echo "none";
                                 }
                                 else {
                                    echo "block";
                                 } ?>;" >
                                     <a href="add-car-category.php" class="nk-menu-link"><span class="nk-menu-text">Course Category</span></a>
                                 </li>
                                 <li class="nk-menu-item">
                                     <a href="add-car-brand.php" class="nk-menu-link"><span class="nk-menu-text">Add Course</span></a>
                                 </li>
                             <?php } ?>
                         </ul><!-- .nk-menu-sub -->
                     </li><!-- .nk-menu-item -->
                     <?php if ($_SESSION['designation'] == 'admin'){ ?>
                         <li class="nk-menu-item">
                             <a href="owner-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">Tutor</span>
                             </a>
                         </li>
                         <li class="nk-menu-item">
                             <a href="driver-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user"></em></span>
                                 <span class="nk-menu-text">User</span>
                             </a>
                         </li>
                     <?php } ?>
                     <?php if ($_SESSION['designation'] == 'tutor'){ ?>
                         <li class="nk-menu-item">
                             <a href="edit-owner.php?id=<?php echo $_SESSION['admin_id']?>" target="_blank" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">My Profile</span>
                             </a>
                         </li>
                     <?php } ?>
                     <li class="nk-menu-item">
                         <a href="bookings.php" class="nk-menu-link">
                             <span class="nk-menu-icon"><em class="icon fas fa-calendar-alt"></em></span>
                             <span class="nk-menu-text">Enrollments</span>
                         </a>
                     </li>
                 </ul><!-- .nk-menu -->
             </div><!-- .nk-sidebar-menu -->
         </div><!-- .nk-sidebar-content -->
     </div><!-- .nk-sidebar-element -->
 </div>
 <!-- sidebar @e -->
