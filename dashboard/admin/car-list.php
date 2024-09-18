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
                                                <h3 class="nk-block-title page-title">Car Listing</h3>
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
                                                                    <a href="add-car.php" class="btn btn-lg btn-primary">Add Car</a>
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
                                            $userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';

                                            if ($_SESSION['roletype'] == "owner"){
                                                # Prepare the SELECT Query
                                                $sql = "SELECT *,
                                                        (SELECT name from owners where owner_id = car_details.owner_id) as ownerName
                                                         FROM car_details WHERE car_name LIKE '%$search%' AND owner_id = '$userId'";
                                            } else {
                                                # Prepare the SELECT Query
                                                $sql = "SELECT *,
                                                        (SELECT name from owners where owner_id = car_details.owner_id) as ownerName
                                                         FROM car_details WHERE car_name LIKE '%$search%'";
                                            }

                                            # Execute the SELECT Query
                                            if (!($result = $conn->query($sql))) {
                                                echo 'Retrieval of data from Database Failed - #' . $sql . ': ' . $conn->error;
                                            } else {
                                                if ($result->num_rows == 0) {
                                                    echo '<div class="text-center mtb10">No Data Found
                                                            <div class="mt-10">
                                                                <a href="add-car.php" class="btn btn-lg btn-primary text-center" target="_blank">Add Car</a>
                                                            </div>
                                                        </div>';
                                                } else {
                                            ?>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Car Name</th>
                                                                    <th>Owner Name</th>
                                                                    <th>Car Year</th>
                                                                    <th>Make</th>
                                                                    <th>Model</th>
                                                                    <th>Color</th>
                                                                    <th>Current Mileage</th>
                                                                    <th>Alarm Type</th>
                                                                    <th>Category</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($row = $result->fetch_assoc()) {
                                                                    $_SESSION['id'] = $row['car_id'];
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['car_id']; ?></td>
                                                                        <td><?php echo $row['car_name']; ?></td>
                                                                        <td><?php echo $row['ownerName']; ?></td>
                                                                        <td><?php echo $row['vehicle_year']; ?></td>
                                                                        <td><?php echo $row['vehicle_make']; ?></td>
                                                                        <td><?php echo $row['vehicle_model']; ?></td>
                                                                        <td><?php echo $row['color']; ?></td>
                                                                        <td><?php echo $row['mileage']; ?></td>
                                                                        <td><?php echo $row['alarm_type']; ?></td>
                                                                        <td><?php echo $row['category_id']; ?></td>
                                                                        <td class="nk-tb-col nk-tb-col-tools">
                                                                            <ul class="nk-tb-actions gx-1">
                                                                                <li>
                                                                                    <div class="drodown">
                                                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                                        <div class="dropdown-menu dropdown-menu-end">
                                                                                            <ul class="link-list-opt no-bdr">
                                                                                                <li><a href="edit-car-details.php?id=<?php echo $row['car_id']; ?>" target="_blank">Edit</a></li>
                                                                                                <li><a onclick="deleteData('<?php echo $row['car_id']; ?>')" class="text-danger cursor-pointer">Remove</a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
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
                        type: "car-list",
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

</html>
