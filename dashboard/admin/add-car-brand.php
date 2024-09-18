<?php
include 'config/connection.php';
//Execute the query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addBrand"])) {
        //Retrieve form data
        $brandName = $_POST["brandName"];
        $customFile = $_FILES["customFile"]["name"];
        $tempname = $_FILES["customFile"]["tmp_name"];
        $folder = "assets/images/brand/".basename($_FILES["customFile"]["name"]);

        //SQL query to inser data into the database
        $sql = "INSERT INTO `car_brand`(`brand_name`, `image`) VALUES ('$brandName', '$customFile')";

        //Execute the query
        if ($conn->query($sql) === TRUE && move_uploaded_file($tempname,$folder)) {
            echo "<h3>Car Brand Added Successfully!</h3>";
            echo "<script> location.href='add-car-brand.php'; </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
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
                                                <h3 class="nk-block-title page-title">Car Brand</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner bg-grey">
                                                <form method="post">
                                                    <div class="row g-gs mb-20">
                                                        <!-- Search bar -->
                                                        <div class="col-md-8">
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
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="form-control-wrap">
                                                                    <button type="submit" class="btn btn-lg btn-primary">Search</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row g-gs">
                                                        <!-- Category -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="brandName">Brand Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Convertible" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Upload File -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="form-label" for="noofseats">Upload photo</label>
                                                                <div class="form-control-wrap">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input" id="customFile" name="customFile" onchange="loadFile(event)">
                                                                        <label class="form-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="form-control-wrap">
                                                                    <button type="submit" class="btn btn-lg btn-primary" name="addBrand">Add Brand</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card card-bordered">
                                            <?php
                                            $search = isset($_POST["search"]) ? $_POST["search"] : '';
                                            # Prepare the SELECT Query
                                            $sql = "SELECT * FROM `car_brand` WHERE brand_name LIKE '%$search%'";
                                            # Execute the SELECT Query
                                            if (!($result = $conn->query($sql))) {
                                                echo 'Retrieval of data from Database Failed - #' . $sql . ': ' . $conn->error;
                                            } else {
                                            ?>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Brand</th>
                                                                <th>Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows == 0) {
                                                                echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                                            } else {
                                                                while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $row['brand_id']; ?></td>
                                                                        <td><?php echo $row['brand_name']; ?></td>
                                                                        <td><img src="assets/images/brand/<?php echo $row['image']; ?>" height="30"></td>
                                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                                            <ul class="nk-tb-actions gx-1 justify-content-start">
                                                                                <li class="nk-tb-action">
                                                                                    <a href="edit-car-brand.php?id=<?php echo $row['brand_id'];?>" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                                        <em class="icon fas fa-pen"></em>
                                                                                    </a>
                                                                                    <a onclick="deleteData('<?php echo $row['brand_id']; ?>')" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                                        <em class="icon fas fa-trash text-danger"></em>
                                                                                    </a>
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
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        function deleteData(brandId) {
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
                            id: brandId,
                            type: "car-brand",
                            dataType: 'json',
                        },
                        function(data) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Record Deleted Successfully",
                                icon: "success"
                            }).then(function(){
                                location.reload();
                            });
                        });
                }
            });

        }
    </script>
</body>

</html>
