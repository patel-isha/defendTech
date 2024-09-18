 <!-- sidebar @s -->
 <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
     <div class="nk-sidebar-element nk-sidebar-head">
         <div class="nk-menu-trigger">
             <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
             <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
         </div>
         <div class="nk-sidebar-brand">
             <a href="dashboard.php" class="logo-link nk-sidebar-logo">
                 <img class="logo-white logo-img" src="assets/images/logo-white.png" alt="logo">
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
                             <span class="nk-menu-icon"><em class="icon fas fa-car"></em></span>
                             <span class="nk-menu-text">Car</span>
                         </a>
                         <ul class="nk-menu-sub">
                             <li class="nk-menu-item">
                                 <a href="car-list.php" class="nk-menu-link"><span class="nk-menu-text">Car</span></a>
                             </li>
                             <?php if ($_SESSION['roletype'] == 'admin'){ ?>
                                 <li class="nk-menu-item" style="display: <?php if($_SESSION['roletype'] == "owner") {
                                    echo "none";
                                 }
                                 else {
                                    echo "block";
                                 } ?>;" >
                                     <a href="add-car-category.php" class="nk-menu-link"><span class="nk-menu-text">Car Category</span></a>
                                 </li>
                                 <li class="nk-menu-item">
                                     <a href="add-car-brand.php" class="nk-menu-link"><span class="nk-menu-text">Car Brand</span></a>
                                 </li>
                             <?php } ?>
                         </ul><!-- .nk-menu-sub -->
                     </li><!-- .nk-menu-item -->
                     <?php if ($_SESSION['roletype'] == 'admin'){ ?>
                         <li class="nk-menu-item">
                             <a href="owner-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">Owner</span>
                             </a>
                         </li>
                         <li class="nk-menu-item">
                             <a href="driver-list.php" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user"></em></span>
                                 <span class="nk-menu-text">Driver</span>
                             </a>
                         </li>
                     <?php } ?>
                     <?php if ($_SESSION['roletype'] == 'owner'){ ?>
                         <li class="nk-menu-item">
                             <a href="edit-owner.php?id=<?php echo $_SESSION['user_id']?>" target="_blank" class="nk-menu-link">
                                 <span class="nk-menu-icon"><em class="icon fas fa-user-tie"></em></span>
                                 <span class="nk-menu-text">My Profile</span>
                             </a>
                         </li>
                     <?php } ?>
                     <li class="nk-menu-item">
                         <a href="admin-bookings.php" class="nk-menu-link">
                             <span class="nk-menu-icon"><em class="icon fas fa-calendar-alt"></em></span>
                             <span class="nk-menu-text">Bookings</span>
                         </a>
                     </li>
                 </ul><!-- .nk-menu -->
             </div><!-- .nk-sidebar-menu -->
         </div><!-- .nk-sidebar-content -->
     </div><!-- .nk-sidebar-element -->
 </div>
 <!-- sidebar @e -->
