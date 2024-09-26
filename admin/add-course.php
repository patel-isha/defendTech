<?php
include 'config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Retrieve form data
    $tutor = $_POST["course_tutor"];
    $title = $_POST["course_title"];
    $category = $_POST["course_category"];
    $subtext = $_POST["course_subtext"];
    $badge = $_POST["course_badge"];
    $level = $_POST["course_level"];
    $cost = $_POST["course_cost"];

    //File Upload
    if ($_FILES["course_image"]["size"] > 0) {
        $customFile = $_FILES["course_image"]["name"];
        $tempname = $_FILES["course_image"]["tmp_name"];
        $folder = "assets/images/course/" . basename($_FILES["course_image"]["name"]);

        //SQL query to inser data into the database
        $sql = "INSERT INTO `course`(`user_id`, `course_title`, `cc_id`,`course_subtext`, `course_badge`, `course_level`, `course_cost`, `course_image`) 
    VALUES ('$tutor', '$title', '$category','$subtext', '$badge', '$level', '$cost', '$customFile')";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
            echo "<h3>Course Added Successfully!</h3>";
            echo "<script> location.href='course-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    } else {
        //SQL query to inser data into the database
        $sql = "INSERT INTO `course`(`user_id`, `course_title`, `cc_id`,`course_subtext`, `course_badge`, `course_level`, `course_cost`) 
         VALUES ('$tutor', '$title', '$category','$subtext', '$badge', '$level', '$cost')";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>Course Added Successfully!</h3>";
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
                                            <h3 class="nk-block-title page-title">Course Details Form</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row g-gs">
                                                <?php if ($_SESSION['designation'] == 'admin') { ?>
                                                    <!-- Course Tutor Name -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label" for="course_tutor">Course Tutor's Name</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2" id="course_tutor" name="course_tutor" required>
                                                                    <option>Select Tutor</option>
                                                                    <?php
                                                                    # Prepare the SELECT Query
                                                                    $sql = "SELECT user_id, first_name, last_name FROM `users` WHERE designation = 'tutor'";
                                                                    $result = $conn->query($sql);

                                                                    if ($result->num_rows > 0) {
                                                                        while ($row = $result->fetch_assoc()) {
                                                                    ?>
                                                                            <option value="<?php echo $row["user_id"]; ?>"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></option>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <!-- Course Title -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_title">Course Title</label>
                                                        <div class="form-control-wrap ">
                                                            <input type="text" class="form-control" id="course_title" name="course_title" placeholder="Enter course title" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Course Category -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_category">Course Category</label>
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2" id="course_category" name="course_category">
                                                                <?php
                                                                # Prepare the SELECT Query
                                                                $sql = "SELECT cc_id, cc_name FROM `course_category`";
                                                                $result = $conn->query($sql);

                                                                if ($result->num_rows > 0) {
                                                                    while ($rowCategory = $result->fetch_assoc()) {
                                                                ?>
                                                                        <option value="<?php echo $rowCategory["cc_id"]; ?>"><?php echo $rowCategory["cc_name"]; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Course Badge -->
                                                <div class="<?php echo ($_SESSION['designation'] == 'tutor') ? 'col-md-4' : 'col-md-3'; ?>">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_badge">Course Badge</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="course_badge" name="course_badge" data-placeholder="Select a option" required>
                                                                <option value="Bestseller">Bestseller</option>
                                                                <option value="Free">Free</option>
                                                                <option value="Highest rated">Highest rated</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Course Level -->
                                                <div class="<?php echo ($_SESSION['designation'] == 'tutor') ? 'col-md-4' : 'col-md-3'; ?>">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_level">Course Level</label>
                                                        <div class="form-control-wrap ">
                                                            <select class="form-select js-select2" id="course_level" name="course_level" data-placeholder="Select a option" required>
                                                                <option value="Beginner">Beginner</option>
                                                                <option value="Intermediate">Intermediate</option>
                                                                <option value="Expert">Expert</option>
                                                                <option value="All Levels">All Levels</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Course Cost -->
                                                <div class="<?php echo ($_SESSION['designation'] == 'tutor') ? 'col-md-4' : 'col-md-3'; ?>">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_cost">Course Cost</label>
                                                        <div class="form-control-wrap">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">£</span>
                                                                </div>
                                                                <input type="number" class="form-control" id="course_cost" name="course_cost" placeholder="0.00" step="0.01" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Upload File -->
                                                <div class="<?php echo ($_SESSION['designation'] == 'tutor') ? 'col-md-4' : 'col-md-3'; ?>">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_image">Upload photo</label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file" class="form-file-input" id="course_image" name="course_image" onchange="loadFile(event)">
                                                                <label class="form-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Course Subtext -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="course_subtext">Course Subtext</label>
                                                        <div class="form-control-wrap">
                                                            <textarea class="form-control form-control-sm" id="course_subtext" name="course_subtext" placeholder="Enter description of course" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-primary">Add Course</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
    <script>
        document.getElementById('course_cost').addEventListener('blur', function() {
            let value = parseFloat(this.value);

            // If there's a value and it's a number, format it to two decimal places
            if (!isNaN(value)) {
                this.value = value.toFixed(2); // Ensures format like 0.00
            }
        });
    </script>
</body>

</html>