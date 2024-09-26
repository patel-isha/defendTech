<?php
include 'config/connection.php';

$id = $_GET["cct_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['cct_id'])) {
    //Retrieve form data
    $content_title = $_POST["content_title"];
    $duration = $_POST["content_duration"];
    $description = $_POST["content_description"];
    $type = $_POST["content_type"];
    $order = $_POST["content_order"];

    //File Upload
    if ($_FILES["content_file"]["size"] > 0) {
        $customFile = $_FILES["content_file"]["name"];
        $tempname = $_FILES["content_file"]["tmp_name"];
        $folder = "assets/images/course-content/" . basename($_FILES["content_file"]["name"]);

        //SQL query to update data into the database
        $sql = "UPDATE `course_content` SET content_title='$content_title', content_duration='$duration', content_description='$description', content_type='$type', content_order='$order', `content_file` = '$customFile'
    WHERE cct_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
            echo "<h3>Course Content Updated Successfully!</h3>";
            echo "<script> location.href='course-content-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    } else {
        //SQL query to update data into the database
        $sql = $sql = "UPDATE `course_content` SET content_title='$content_title', content_duration='$duration', content_description='$description', content_type='$type', content_order='$order'
    WHERE cct_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>Course Content Updated Successfully!</h3>";
            echo "<script> location.href='course-content-list.php'; </script>";
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
                                            <h3 class="nk-block-title page-title">Edit Course Content Details Form</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <?php
                                        if (isset($_GET['cct_id'])) {
                                            $id = $_GET['cct_id'];

                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM `course_content` WHERE cct_id = $id";
                                            $result = $conn->query($sql);
                                            # Execute the SELECT Query
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc()
                                        ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Course Content Id -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cct_id">Content Id</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="cct_id" name="cct_id" value="<?php echo $row['cct_id']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Title -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="course_title">Course Title</label>
                                                                <div class="form-control-wrap ">
                                                                    <?php
                                                                    $sqlTitle = "SELECT course_content.*, course.course_title 
                                                                    FROM course_content 
                                                                    INNER JOIN course ON course_content.course_id = course.course_id";
                                                                    $resultTitle = $conn->query($sqlTitle);

                                                                    if ($resultTitle->num_rows > 0) {
                                                                        $rowTitle = $resultTitle->fetch_assoc(); // Fetch the first row of the result
                                                                    ?>
                                                                        <input class="form-control" id="course_title" name="course_title" value="<?php echo $rowTitle['course_title']; ?>" disabled>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Content Title -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_title">Course Content Title</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="text" class="form-control" id="content_title" name="content_title" value="<?php echo $row['content_title']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Content Duration -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_duration">Duration (HH:MM):</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="text" class="form-control" id="content_duration" name="content_duration"
                                                                        placeholder="HH:MM" pattern="([0-9]{2}):([0-9]{2})" value="<?php echo $row['content_duration']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Content Type -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_type">Content Type</label>
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select js-select2" id="content_type" name="content_type" data-placeholder="Select a option" required>
                                                                        <option value="Video" <?php if ($row['content_type'] == 'Video') echo 'selected'; ?>>Video</option>
                                                                        <option value="PDF" <?php if ($row['content_type'] == 'PDF') echo 'selected'; ?>>PDF</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Course Content Order -->
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_order">Content Order</label>
                                                                <div class="form-control-wrap ">
                                                                    <select class="form-select js-select2" id="content_order" name="content_order" data-placeholder="Select a option" required>
                                                                        <option value="1" <?php if ($row['content_order'] == '1') echo 'selected'; ?>>1</option>
                                                                        <option value="2" <?php if ($row['content_order'] == '2') echo 'selected'; ?>>2</option>
                                                                        <option value="3" <?php if ($row['content_order'] == '3') echo 'selected'; ?>>3</option>
                                                                        <option value="4" <?php if ($row['content_order'] == '4') echo 'selected'; ?>>4</option>
                                                                        <option value="5" <?php if ($row['content_order'] == '5') echo 'selected'; ?>>5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Upload File -->
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_file">Upload File</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input" id="content_file" name="content_file" onchange="validateFile(event)">
                                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                    <?php if (!empty($row['content_file'])): ?>
                                                                        <div class="uploaded-file-info">
                                                                            <p><strong><?php echo basename($row['content_file']); ?></strong></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <small id="error-message" style="color: red; display: none;">Invalid file type. Please upload a video or PDF file based on the type of file you selected.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Content Description -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="content_description">Content Description</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="content_description" name="content_description" required><?php echo $row['content_description']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Update Content</button>
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

    <script>
        function validateFile(event) {
            const contentType = document.getElementById('content_type').value;
            const fileInput = event.target;
            const filePath = fileInput.value;
            const allowedExtensions = contentType === 'Video' ? ['mp4', 'mkv', 'avi'] : ['pdf'];
            const fileExtension = filePath.split('.').pop().toLowerCase();

            const errorMessage = document.getElementById('error-message');

            if (!allowedExtensions.includes(fileExtension)) {
                errorMessage.style.display = 'block'; // Show error message
                fileInput.value = ''; // Clear the input
            } else {
                errorMessage.style.display = 'none'; // Hide error message
            }
        }
    </script>
</body>

</html>