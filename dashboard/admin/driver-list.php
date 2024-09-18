<?php
include 'config/connection.php';
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
                                                <h3 class="nk-block-title page-title">List of Drivers</h3>
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
                                                                    <a href="add-driver.php" class="btn btn-lg btn-primary">Add Driver</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <?php
                                            $search = isset($_POST["search"]) ? $_POST["search"] : '';
                                            # Prepare the SELECT Query
                                            $sql = "SELECT d.driver_id,
                                                            d.name,
                                                            d.email,
                                                            d.contact_no,
                                                            d.driving_license_no,
                                                            d.gender,
                                                            ur.username,
                                                            d.address,
                                                            d.zipcode 
                                                    FROM `drivers` as d LEFT JOIN `user_register` as ur ON d.user_id = ur.user_id WHERE d.email LIKE '%$search%'";
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
                                                            <th>Full Name</th>
                                                            <th>Email Id</th>
                                                            <th>Contact No.</th>
                                                            <th>Driving License No.</th>
                                                            <th>Gender</th>
                                                            <th>Username</th>
                                                            <th>Address</th>
                                                            <th>Zipcode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                        if ($result->num_rows == 0) {
                                                            echo '<tr><td colspan="9" class="text-center">No records found</td></tr>';
                                                        } else {
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['driver_id']?></td>
                                                            <td><?php echo $row['name']?></td>
                                                            <td><?php echo $row['email']?></td>
                                                            <td><?php echo $row['contact_no']?></td>
                                                            <td><?php echo $row['driving_license_no']?></td>
                                                            <td><?php echo $row['gender']?></td>
                                                            <td><?php echo $row['username']?></td>
                                                            <td><?php echo $row['address']?></td>
                                                            <td><?php echo $row['zipcode']?></td>
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="edit-driver.php?id=<?php echo $row['driver_id'] ?>" target="_blank">Edit</a></li>
                                                                                    <li><a onclick="deleteData('<?php echo $row['driver_id']; ?>')">Remove</a></li>
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
        function deleteData(driverId) {
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
                            id: driverId,
                            type: "car-driver",
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
