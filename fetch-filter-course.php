<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include 'config/connection.php';

if (isset($_POST["action"])) {

    $query = "SELECT 
    c.*, 
    cc.cc_id, 
    cc.cc_name,
    (SELECT AVG(rating) FROM course_review WHERE course_review.course_id = c.course_id GROUP BY course_review.course_id) AS avg_rating 
FROM course AS c 
LEFT JOIN course_category AS cc ON cc.cc_id = c.cc_id  
WHERE c.course_title IS NOT NULL 
HAVING avg_rating > 0";

    if (isset($_POST["cost"])) {
        $cost_filter = $_POST["cost"];
        // Initialize an empty array to store cost conditions
        $cost_conditions = [];

        if (in_array('free', $cost_filter)) {
            // Add condition for free courses
            $cost_conditions[] = "course_cost = 0";
        }

        if (in_array('paid', $cost_filter)) {
            // Add condition for paid courses
            $cost_conditions[] = "course_cost > 0";
        }

        // If there are any conditions in $cost_conditions, add them to the query
        if (count($cost_conditions) > 0) {
            // Join conditions with OR to handle both free and paid
            $query .= " AND (" . implode(" OR ", $cost_conditions) . ")";
        }

    }

    if (isset($_POST["level"])) {
        $level_filter = implode("','", $_POST["level"]);
        $query .= " AND c.course_level IN('" . $level_filter . "')";

    }
    if (isset($_POST["category"])) {
        $category_filter = implode("','", $_POST["category"]);
        $query .= " AND cc.cc_id IN('" . $category_filter . "')";
    }
    if (isset($_POST["rating"])) {
        $rating_filter = $_POST["rating"][0];
        if ($rating_filter == 5){
            $query .= " AND avg_rating = 5";
        }elseif ($rating_filter == 4){
            $query .= " AND avg_rating >= 4.5 and avg_rating < 5";
        }elseif ($rating_filter == 3){
            $query .= " AND avg_rating >= 3.0 and avg_rating < 4.5";
        }elseif ($rating_filter == 2){
            $query .= " AND avg_rating >= 2.0 and avg_rating < 3.0";
        }elseif ($rating_filter == 1){
            $query .= " AND avg_rating >= 1.0 and avg_rating < 2.0";
        }
    }
    if (isset($_POST["tutor"])) {
        $tutor_filter = $_POST["tutor"];
        // Check if tutor_filter has any values before adding conditions
        if (!empty($tutor_filter)) {
            // Escape/validate the values in $tutor_filter array for security (SQL injection protection)
            $filtered_ids = array_map('intval', $tutor_filter); // Assuming all IDs are integers
            // Add the condition for cc_id being in the list of tutor IDs
            $query .= " AND cc.cc_id IN (" . implode(", ", $filtered_ids) . ")";
        }
    }

    if (isset($_POST["search"]) && $_POST['search'] != "") {
        $capacity_filter = $_POST["search"];
        $query .= " AND course_title LIKE '%" . $capacity_filter . "%'";
    }

    $result = $conn->query($query);
    $output = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cost = $row['course_cost'] > 0 ? '£'.$row['course_cost'] : 'Free';

            if ($_POST["type"] == "grid") {
                $output .= '<div class="col-lg-6 responsive-column-half">
    <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_' . $row['course_id'] . '">
        <div class="card-image">
            <a href="course-details.php?course_id=' . $row['course_id'] . '" class="d-block">
                <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="' . $row['course_image'] . '" alt="Card image cap" />
            </a>
            <div class="course-badge-labels">
                <div class="course-badge">' . ucfirst(str_replace('_', ' ', $row['course_badge'])) . '</div>
            </div>
        </div>
        <!-- end card-image -->
        <div class="card-body">
            <h5 class="card-title">
                <a href="course-details.php?course_id=' . $row['course_id'] . '">' . $row['course_title'] . '</a>
            </h5>
            <p class="card-text">
                <a href="teacher-detail.html">' . $row['course_author'] . '</a>
            </p>
            <div class="rating-wrap d-flex align-items-center py-2">
                <div class="review-stars">
                    <span class="rating-number">' . number_format($row['avg_rating'], 1) . '</span>';

                // PHP logic for stars
                $rating = round($row["avg_rating"], 1); // Get the average rating (e.g., 3.5)
                $filledStars = floor($rating); // Number of fully filled stars
                $hasHalfStar = fmod($rating, 1) !== 0.0; // Check if there's a fractional part
                $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars

                // Display filled stars
                for ($i = 1; $i <= $filledStars; $i++) {
                    $output .= ' <span class="la la-star"></span>';
                }

                // Display half-empty star if applicable
                if ($hasHalfStar) {
                    $output .= ' <span class="la la-star-o"></span>';
                }

                // Display empty stars
                for ($i = 1; $i <= $emptyStars; $i++) {
                    $output .= ' <span class="la la-star-o"></span>';
                }

                $output .= '</div>
                <span class="rating-total ps-1">(20,230)</span>
            </div>
            <!-- end rating-wrap -->
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-price text-black font-weight-bold">
                    ' . $cost . '
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="javascript:void(0)" onclick="addToCart(' . $row['course_id'] . ')" class="btn theme-btn flex-grow-1 me-3"><i class="la la-shopping-cart me-1 fs-18"></i> Add to Cart</a>
                </div>
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end card -->
</div>';

            }elseif ($_POST["type"] == "list") {
                $output .='<div class="col-lg-12">
                              <div class="card card-item card-preview card-item-list-layout" data-tooltip-content="#tooltip_content_1">
                                <div class="card-image">
                                  <a href="course-details.php?course_id='.$row['course_id'].'" class="d-block">
                                    <img class="card-img-top lazy" src="assets/images/img-loading.png" data-src="'.$row['course_image'].'" alt="Card image cap" />
                                  </a>
                                  <div class="course-badge-labels">
                                    <div class="course-badge">' . ucfirst(str_replace('_', ' ', $row['course_badge'])) . '</div>
                                  </div>
                                </div>
                                <!-- end card-image -->
                                <div class="card-body">
                                  <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                                  <h5 class="card-title">
                                    <a href="course-details.php?course_id='.$row['course_id'].'">'.$row['course_title'].'</a>
                                  </h5>
                                  <p class="card-text">
                                    <a href="teacher-detail.html">'.$row['course_author'].'</a>
                                  </p>
                                  <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                      <span class="rating-number">' . number_format($row['avg_rating'], 1) . '</span>';

                                    // PHP logic for stars
                                    $rating = round($row["avg_rating"], 1); // Get the average rating (e.g., 3.5)
                                    $filledStars = floor($rating); // Number of fully filled stars
                                    $hasHalfStar = fmod($rating, 1) !== 0.0; // Check if there's a fractional part
                                    $emptyStars = 5 - $filledStars - ($hasHalfStar ? 1 : 0); // Remaining empty stars

                                    // Display filled stars
                                    for ($i = 1; $i <= $filledStars; $i++) {
                                        $output .= ' <span class="la la-star"></span>';
                                    }

                                    // Display half-empty star if applicable
                                    if ($hasHalfStar) {
                                        $output .= ' <span class="la la-star-o"></span>';
                                    }

                                    // Display empty stars
                                    for ($i = 1; $i <= $emptyStars; $i++) {
                                        $output .= ' <span class="la la-star-o"></span>';
                                    }

                                    $output .= '</div>
                                     <span class="rating-total ps-1">(20,230)</span>
                                  </div>
                                  <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-price text-black font-weight-bold">
                                            '.$cost.'
                                        </p>
                                          <div class="justify-content-between align-items-center">
                                              <a href="javascript:void(0)" onclick="addToCart(' . $row['course_id'] . ')" class="btn theme-btn flex-grow-1 me-3"><i class="la la-shopping-cart me-1 fs-18"></i> Add to Cart</a>
                                          </div>
                                      </div>
                                    </div>
                                    <!-- end card-body -->
                                  </div>
                                  <!-- end card -->
                                </div>';
            }
        }
    } else {
        $output = '<div class="col-lg-4">No courses found</div>';
    }
    echo $output;
}
