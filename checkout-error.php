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
   START ERROR AREA
================================= -->
<section class="error-area section--padding dot-bg overflow-hidden">
    <div class="container">
        <div class="col-lg-7 mx-auto">
            <div class="error-content text-center">
                <img src="assets/images/payment-failed.png" class="w-50">
                <div class="section-heading">
                    <h3 class="section__title pb-3">
                        Whoops! Payment Failed
                    </h3>
                    <p class="section__desc">
                        Forgot to add something to your cart? Shop around then come back to pay!
                    </p>
                </div>
                <div class="btn-box pt-30px">
                    <a href="index.php" class="btn theme-btn"
                    ><i class="la la-reply me-1"></i> Back to Home</a>
                </div>
            </div>
            <!-- end error-content -->
        </div>
        <!-- end col-lg-7 -->
    </div>
    <!-- end container -->
</section>
<!-- end error-area -->
<!-- ================================
   START ERROR AREA
================================= -->


<div class="section-block"></div>


<?php
include 'include/footer.php';
?>i

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
