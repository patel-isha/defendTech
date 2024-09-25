<?php
include 'config/connection.php';

// Fetch Car Category Details
$id = "";
if (isset($_GET['cc_id'])) {
    $id = $_GET['cc_id'];
    $editCourseCategorySql = "SELECT * FROM `course_category` WHERE cc_id = '$id'";
    $editCourseCategoryResult = $conn->query($editCourseCategorySql);
    if ($editCourseCategoryResult->num_rows > 0) {
        $rowEditCategory = $editCourseCategoryResult->fetch_assoc();
    } else {
        echo "<h3>No Data Found!</h3>";
        die;
    }
}
//Execute the query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateCategory"])) {
        //Retrieve form data
        $categoryName = $_POST["cc_name"];
        $categoryAllias = $_POST["cc_allias"];
        if ($_FILES["cc_image"]["size"] > 0) {
            $customFile = $_FILES["cc_image"]["name"];
            $tempname = $_FILES["cc_image"]["tmp_name"];
            $folder = "assets/images/category/" . basename($_FILES["cc_image"]["name"]);
            //SQL query to inser data into the database
            $sql = "UPDATE `course_category` SET `cc_name` = '$categoryName', `cc_allias` = '$categoryAllias', `cc_image` = '$customFile' WHERE cc_id = '$id'";

            //Execute the query
            if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Course Category Updated Successfully!</h3>";
                echo "<script> location.href='add-course-category.php'; </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                die;
            }
        } else {
            //SQL query to insert data into the database
            $sql = "UPDATE `course_category` SET `cc_name` = '$categoryName', `cc_allias` = '$categoryAllias' WHERE cc_id = '$id'";

            //Execute the query
            if ($conn->query($sql) === TRUE) {
                echo "<h3>  Course Category Updated Successfully!</h3>";
                echo "<script> location.href='add-course-category.php'; </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                die;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

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
                                <div class="components-preview wide-lg mx-auto">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Edit Course Category</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner bg-grey">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Category -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="categoryName">Category Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="categoryName" name="cc_name" value="<?php echo isset($rowEditCategory['cc_name']) ? $rowEditCategory['cc_name'] : '' ?>" placeholder="Cybersecurity Basics" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Category -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="categoryAllias">Category Allias</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="categoryAllias" name="cc_allias" value="<?php echo isset($rowEditCategory['cc_allias']) ? $rowEditCategory['cc_allias'] : '' ?>" placeholder="Basics" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Upload File -->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="noofseats">Upload photo</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input" id="customFile" name="cc_image" onchange="loadFile(event)">
                                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="categoryImage"></label>
                                                                <div class="form-control-wrap">
                                                                    <img class="form-control w-80" src="../assets/images/img-loading.png"
                                                                        data-src="assets/images/category/<?php echo $rowEditCategory['cc_image']; ?>" alt="Category image"
                                                                        onerror="this.src='../assets/images/img-loading.png'"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row g-gs">
                                                        <div class="col-md-9"></div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="form-control-wrap">
                                                                    <button type="submit" class="btn btn-lg btn-primary" name="updateCategory">Update Category</button>
                                                                </div>
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
                    </div>
                </div>
                <!-- content @e -->
                <?php
                include 'include/dashboard-footer.php';
                ?>
            </div>
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->

    <?php
    include 'include/footer-scripts.php';
    ?>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('customFile');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>