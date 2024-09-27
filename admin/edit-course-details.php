<?php
include 'config/connection.php';

$id = $_GET["course_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['course_id'])) {
    //Retrieve form data
    $subtext = $_POST["course_subtext"];
    $badge = $_POST["course_badge"];
    $level = $_POST["course_level"];
    $cost = $_POST["course_cost"];

    if ($_FILES["course_image"]["size"] > 0) {
        $customFile = $_FILES["course_image"]["name"];
        $tempname = $_FILES["course_image"]["tmp_name"];
        $folder = "assets/images/course/" . basename($_FILES["course_image"]["name"]);
        //SQL query to inser data into the database
        $sql = "UPDATE `course` SET course_subtext='$subtext', course_badge='$badge', course_level='$level', course_cost='$cost', `course_image` = '$customFile'
    WHERE course_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Course Updated Successfully!</h3>";
            echo "<script> location.href='course-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    } else {
        //SQL query to inser data into the database
        $sql = "UPDATE `course` SET course_subtext='$subtext', course_badge='$badge', course_level='$level', course_cost='$cost'
    WHERE course_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>  Course Updated Successfully!</h3>";
            echo "<script> location.href='course-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
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
                                            <h3 class="nk-block-title page-title">Edit Course Details</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <?php
                                        if (isset($_GET['course_id'])) {
                                            $id = $_GET['course_id'];

                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM `course` WHERE course_id = $id";
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
                                                                <label class="form-label" for="course_title">Course</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="text" class="form-control" id="course_title" name="course_title" value="<?php echo $row['course_title']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Category -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="ccid">Course Category</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select js-select2" id="ccid" name="ccid" disabled>
                                                                        <?php
                                                                        # Prepare the SELECT Query
                                                                        $sql = "SELECT cc_id, cc_name FROM `course_category`";
                                                                        $result = $conn->query($sql);

                                                                        if ($result->num_rows > 0) {
                                                                            while ($rowCategory = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <option value="<?php echo $rowCategory["cc_id"]; ?>" <?php if ($rowCategory["cc_id"] == $row['cc_id']) { ?> selected <?php } ?>><?php echo $rowCategory["cc_name"]; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Tutor -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="ccid">Course Tutor</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select js-select2" id="userid" name="userid" disabled>
                                                                        <?php
                                                                        # Prepare the SELECT Query
                                                                        $sql = "SELECT user_id, first_name, last_name FROM `users`";
                                                                        $result = $conn->query($sql);

                                                                        if ($result->num_rows > 0) {
                                                                            while ($rowTutor = $result->fetch_assoc()) {
                                                                        ?>
                                                                                <option value="<?php echo $rowTutor["user_id"]; ?>" <?php if ($rowTutor["user_id"] == $row['user_id']) { ?> selected <?php } ?>><?php echo $rowTutor["first_name"] . ' ' . $rowTutor["last_name"]; ?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Badge -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_badge">Course Badge</label>
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select js-select2" id="course_badge" name="course_badge" data-placeholder="Select a option" required>
                                                                        <option value="Bestseller" <?php if ($row['course_badge'] == 'Bestseller') echo 'selected'; ?>>Bestseller</option>
                                                                        <option value="Free" <?php if ($row['course_badge'] == 'Free') echo 'selected'; ?>>Free</option>
                                                                        <option value="Highest rated" <?php if ($row['course_badge'] == 'Highest rated') echo 'selected'; ?>>Highest rated</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Level -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_level">Course Level</label>
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select js-select2" id="course_level" name="course_level" data-placeholder="Select a option" required>
                                                                        <option value="Beginner" <?php if ($row['course_level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
                                                                        <option value="Intermediate" <?php if ($row['course_level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
                                                                        <option value="Expert" <?php if ($row['course_level'] == 'Expert') echo 'selected'; ?>>Expert</option>
                                                                        <option value="All Levels" <?php if ($row['course_level'] == 'All Levels') echo 'selected'; ?>>All Levels</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Subtext -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_subtext">Course Subtext</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="course_subtext" name="course_subtext"><?php echo $row['course_subtext']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Cost -->
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_cost">Course Cost</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">£</span>
                                                                        </div>
                                                                        <input type="number" class="form-control" id="course_cost" name="course_cost" value="<?php echo $row['course_cost']; ?>" step="0.01" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Upload File -->
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_image">Upload photo</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input" id="course_image" name="course_image" onchange="loadFile(event)">
                                                                        <label class="form-file-label" for="course_image">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_image"></label>
                                                                <div class="form-control-wrap">
                                                                    <img class="form-control w-80"
                                                                        src="../assets/images/img-loading.png"
                                                                        data-src="assets/images/course/<?php echo $row['course_image']; ?>"
                                                                        onerror="this.src='../assets/images/img-loading.png'" />
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
    <script>
        $(document).on('keyup', '#location', function() {
            $("#location").autocomplete({
                source: function(request, response) {
                    $.post("autocomplete.php", {
                        'name': $("#location").val()
                    }).done(function(data, status) {

                        response(JSON.parse(data));
                    });
                }
            });
        });
    </script>
</body>

</html>
