<?php
include 'config/connection.php';

$id = $_GET["cr_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cr_id'])) {
    //Retrieve form data
    $review = $_POST["course_review"];
    $rating = $_POST["course_rating"];

    //SQL query to update data into the database
    $sql = "UPDATE `course_review` SET review='$review', rating='$rating' WHERE cr_id='$id'";

    //Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<h3>  Course Review Successfully!</h3>";
        echo "<script> location.href='reviews.php'; </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?php
include 'include/header-links.php';
include 'include/session.php';
?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <?php
            include 'include/sidebar.php';
            ?>
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <?php
                include 'include/header.php';
                ?>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Edit Course Review</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <?php
                                        if (isset($_GET['cr_id'])) {
                                            $id = $_GET['cr_id'];

                                            # Prepare the SELECT Query
                                            $sql = "SELECT cr.*, c.course_title, CONCAT(u.first_name, ' ', u.last_name) AS username
                                            FROM course_review cr
                                            JOIN course c ON cr.course_id = c.course_id
                                            JOIN users u ON cr.user_id = u.user_id
                                            WHERE cr_id = $id";
                                            $result = $conn->query($sql);
                                            # Execute the SELECT Query
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc()
                                        ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Course Title -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_title">Course Title</label>
                                                                <div class="form-control-wrap ">
                                                                    <input class="form-control" id="course_title" name="course_title" value="<?php echo $row['course_title']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- User name -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="uname">Username</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="course_title" name="course_title" value="<?php echo $row['username']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Review -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_review">Course Review</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="course_review" name="course_review" required><?php echo $row['review']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Rating -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_rating">Course Rating</label>
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select js-select2" id="course_rating" name="course_rating" data-placeholder="Select a option" required>
                                                                        <option value="1" <?php if ($row['rating'] == '1') echo 'selected'; ?>>1</option>
                                                                        <option value="2" <?php if ($row['rating'] == '2') echo 'selected'; ?>>2</option>
                                                                        <option value="3" <?php if ($row['rating'] == '3') echo 'selected'; ?>>3</option>
                                                                        <option value="4" <?php if ($row['rating'] == '4') echo 'selected'; ?>>4</option>
                                                                        <option value="5" <?php if ($row['rating'] == '5') echo 'selected'; ?>>5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                        <?php
                                            } else {
                                                $row = $conn->error;
                                            }
                                        } else {
                                            echo "Invalid request";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <?php
                include 'include/dashboard-footer.php';
                ?>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <?php
    include 'include/footer-scripts.php';
    ?>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</body>

</html>