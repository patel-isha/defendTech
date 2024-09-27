<!DOCTYPE html>
<html>

<?php
include 'include/header-links.php';
include 'config/connection.php';
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
            <div class="nk-wrap">
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
                                                <h3 class="nk-block-title page-title">Blog Listing</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner bg-grey">
                                                <form method="post">
                                                    <div class="row g-gs">
                                                        <!-- Search bar -->
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label class="form-label" for="search">Search</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-icon form-icon-right">
                                                                        <em class="icon fas fa-search"></em>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="form-control-wrap">
                                                                    <button type="submit" class="btn btn-lg btn-primary">Search</button>
                                                                    <a href="add-blog.php" class="btn btn-lg btn-primary">Add Blog</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <?php
                                            $search = isset($_POST["search"]) ? $_POST["search"] : '';
                                            $userId = isset($_SESSION["admin_id"]) ? $_SESSION["admin_id"] : '';

                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM blog
                                                WHERE blog_title LIKE '%$search%'";

                                            # Execute the SELECT Query
                                            if (!($result = $conn->query($sql))) {
                                                echo 'Retrieval of data from Database Failed - #' . $sql . ': ' . $conn->error;
                                            } else {
                                                if ($result->num_rows == 0) {
                                                    echo '<div class="text-center mtb10">No Data Found
                                                            <div class="mt-10">
                                                                <a href="add-blog.php" class="btn btn-lg btn-primary text-center" target="_blank">Add Blog</a>
                                                            </div>
                                                        </div>';
                                                } else {
                                            ?>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Title</th>
                                                                    <th>Author Name</th>
                                                                    <th>Upload Date</th>
                                                                    <th>Blog Image</th>
                                                                    <th class="w-11">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $_SESSION['id'] = $row['b_id'];
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['b_id']; ?></td>
                                                                        <td><?php echo $row['blog_title']; ?></td>
                                                                        <td><?php echo $row['blog_author']; ?></td>
                                                                        <td><?php echo $row['blog_date']; ?></td>
                                                                        <td>
                                                                            <img src="../assets/images/img-loading.png"
                                                                                data-src="assets/images/blog/<?php echo $row['blog_image']; ?>"
                                                                                height="30" alt="blog image"
                                                                                onerror="this.src='../assets/images/img-loading.png'" />
                                                                        </td>
                                                                        <td class="nk-tb-col nk-tb-col-tools w-11">
                                                                            <ul class="nk-tb-actions gx-1 justify-content-start">
                                                                                <li class="nk-tb-action">
                                                                                    <a href="edit-blog-details.php?b_id=<?php echo $row['b_id']; ?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                                        <em class="icon fas fa-pen"></em>
                                                                                    </a>
                                                                                    <button class="btn btn-trigger btn-icon" onclick="deleteData('<?php echo $row['b_id']; ?>')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                                        <em class="icon fas fa-trash text-danger"></em>
                                                                                    </button>
                                                                                </li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php
                                            }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content @e -->
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
</body>

<script>
    function deleteData(id) {
        Swal.fire({
            title: "Are you sure, you want to delete this record?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                //Single Delete Category
                $.post("single-delete.php", {
                        id: id,
                        type: "blog-list",
                        dataType: 'json',
                    },
                    function(data) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Record Deleted Successfully",
                            icon: "success"
                        }).then(function() {
                            location.reload();
                        });
                    });
            }
        });

    }
</script>

</html>