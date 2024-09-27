<?php
include 'config/connection.php';

$id = $_GET["b_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['b_id'])) {
    //Retrieve form data
    $date = $_POST["blog_date"];
    $content = $_POST["blog_content"];

    //File Upload
    if ($_FILES["blog_image"]["size"] > 0) {
        $customFile = $_FILES["blog_image"]["name"];
        $tempname = $_FILES["blog_image"]["tmp_name"];
        $folder = "assets/images/blog/" . basename($_FILES["blog_image"]["name"]);

        //SQL query to update data into the database
        $sql = "UPDATE `blog` SET blog_date='$date', blog_content='$content', `blog_image` = '$customFile'
    WHERE b_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname, $folder)) {
            echo "<h3>Blog Details Updated Successfully!</h3>";
            echo "<script> location.href='blog-list.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    } else {
        //SQL query to update data into the database
        $sql = "UPDATE `blog` SET blog_date='$date', blog_content='$content'
    WHERE b_id='$id'";

        //Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>Blog Details Updated Successfully!</h3>";
            echo "<script> location.href='blog-list.php'; </script>";
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
                                            <h3 class="nk-block-title page-title">Edit BLog Details Form</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-bordered">
                                    <div class="card-inner bg-grey">
                                        <?php
                                        if (isset($_GET['b_id'])) {
                                            $id = $_GET['b_id'];

                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM `blog` WHERE b_id = $id";
                                            $result = $conn->query($sql);
                                            # Execute the SELECT Query
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc()
                                        ?>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Blog Id -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="b_id">Blog Id</label>
                                                                <div class="form-control-wrap">
                                                                    <input class="form-control" id="b_id" name="b_id" value="<?php echo $row['b_id']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Blog Title -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_title">Blog Title</label>
                                                                <div class="form-control-wrap ">
                                                                    <input class="form-control" id="blog_title" name="blog_title" value="<?php echo $row['blog_title']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Blog Author -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_author">Blog Author</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="text" class="form-control" id="blog_author" name="blog_author" value="<?php echo $row['blog_author']; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Date -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_date">Date</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-left">
                                                                        <em class="icon ni ni-calendar"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" id="blog_date" name="blog_date" value="<?php echo $row['blog_date']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Upload Image -->
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_image">Upload Image</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input" id="blog_image" name="blog_image" onchange="loadFile(event)">
                                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_image"></label>
                                                                <div class="form-control-wrap">
                                                                    <img class="form-control w-80" src="../assets/images/img-loading.png"
                                                                        data-src="assets/images/blog/<?php echo $row['blog_image']; ?>" alt="BLog image"
                                                                        onerror="this.src='../assets/images/img-loading.png'" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Blog Content -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="blog_content">Content Description</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control form-control-sm" id="blog_content" name="blog_content" placeholder="Enter blog content" required><?php echo $row['blog_content']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-lg btn-primary">Update Blog Details</button>
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