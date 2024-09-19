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
                                                <h3 class="nk-block-title page-title">Bookings</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id">ID</th>
                                                        <th class="tb-tnx-id">Car Name</th>
                                                        <th class="tb-tnx-info">Driver Name</th>
                                                        <th class="tb-tnx-info">Pick-up Location</th>
                                                        <th class="tb-tnx-info">Date & Time</th>
                                                        <th class="tb-tnx-info">Drop-off Location</th>
                                                        <th class="tb-tnx-info">Date & Time</th>
                                                        <th class="tb-tnx-info">Total</th>
                                                        <th class="tb-tnx-info">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <span class="badge badge-dot bg-warning">Pending</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <span class="badge badge-dot bg-success">Paid</span>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <span class="badge badge-dot bg-danger">Cancel</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- .card-preview -->
                                    </div>
                                    <div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Booking Requests</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id">ID</th>
                                                        <th class="tb-tnx-id">Car Name</th>
                                                        <th class="tb-tnx-info">Driver Name</th>
                                                        <th class="tb-tnx-info">Pick-up Location</th>
                                                        <th class="tb-tnx-info">Date & Time</th>
                                                        <th class="tb-tnx-info">Drop-off Location</th>
                                                        <th class="tb-tnx-info">Date & Time</th>
                                                        <th class="tb-tnx-info">Total</th>
                                                        <th class="tb-tnx-info">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <button class="btn btn-danger">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <button class="btn btn-danger">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">1</td>
                                                        <td class="tb-tnx-info">isha</td>
                                                        <td class="tb-tnx-info">mini cooper</td>
                                                        <td class="tb-tnx-info">Romford</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">Liverpool</td>
                                                        <td class="tb-tnx-info">10-05-2019</td>
                                                        <td class="tb-tnx-info">£599.00</td>
                                                        <td class="tb-tnx-info">
                                                            <button class="btn btn-danger">Cancel</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!-- .card-preview -->
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
</body>

</html>