<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sales / Crowbyte</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <?php include('inc/header.php'); ?>
  <!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <?php include('inc/side.php'); ?>
  <!-- End Sidebar-->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Clients Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Clients <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php echo $mtk_tot_clients ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Clients Card -->

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Sales <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                        <?php echo $mtk_tot_sales ?>
                      </h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">



                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Kshs. <?php echo $mtk_sum_revenue['sum(amount)']  ?></h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>

            </div><!-- End Revenue Card -->

            <!-- Pending Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">


                <div class="card-body">
                  <h5 class="card-title">Pending Sales <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-exchange"></i>
                    </div>
                    <div class="ps-3">


                      <h6>Kshs. <?php echo $mtk_sum_new_sale['sum(amount)']  ?></h6>

                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Pending Sales Card -->

            <!-- Approved Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">



                <div class="card-body">
                  <h5 class="card-title">Approved Sales <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hand-thumbs-up"></i>
                    </div>
                    <div class="ps-3">

                      <h6>Kshs. <?php echo $mtk_sum_approved_sale['sum(amount)']  ?></h6>

                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Approved Sales Card -->

            <!-- Rejected Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">


                <div class="card-body">
                  <h5 class="card-title">Rejected <span>| This Month</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hand-thumbs-down"></i>

                    </div>
                    <div class="ps-3">
                      <h6>Kshs. <?php echo $mtk_sum_rejected_sale['sum(amount)']  ?></h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>

            </div><!-- End Rejected Card -->


            <!-- All Clients -->
            <div class="col-18">
              <div class="card recent-sales overflow-auto">
                <!-- 
              <div class="">
                  <button  onclick="location.href = 'new_retailer.php';"  type="submit" class="btn btn-primary">Add Client</button>
                </div> -->


                <div class="card-body">
                  <h5 class="card-title">Clients <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Trading Name</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Position</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Shop Type</th>
                        <th scope="col">Entered by</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM checkin where company_id = 2 ";
                      // $query = "SELECT * FROM checkin WHERE id='$client_id' and user_id='$user_id'  ";
                      $clients = mysqli_query($db, $query);

                      if (mysqli_num_rows($clients) > 0) {
                        $sn = 1;
                        foreach ($clients as $client) {
                      ?>
                          <tr>
                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                            <td><a href="#" class="text-primary"><?= $client['trading_name']; ?></td>
                            <td><?= $client['owner_name'] ?></td>
                            <td><?= $client['contacttype'] ?></td>
                            <td><?= $client['phone'] ?></td>
                            <td><?= $client['shoptype'] ?></td>
                            <td><?= $client['username'] ?></td>
                            <!-- <td><span class="badge bg-success"><?= $client['contacttype'] ?></td> -->
                            <td>
                              <a href="update_mtk_client.php?id=<?= $client['id']; ?>" class="btn btn-primary btn-sm">View</a>
                              <!-- <a href="edit_retailer?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
                            </td>
                          </tr>
                      <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No Record Found </h5>";
                      }
                      ?>

                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
            <!-- Horizontal Form -->

            <!-- Recent sales -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">



                <div class="card-body pb-0">
                  <h5 class="card-title">Pending <span>| Orders</span></h5>
                  <?php
                  $query3 = "SELECT * FROM sales where orderstatus = 'new' and company_id = 2 ";

                  $orders = mysqli_query($db, $query3);
                  ?>
                  <table id="datatableid" class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client</th>
                        <th scope="col">Product</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Odered by</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if (mysqli_num_rows($orders) > 0) {
                        $sn = 1;
                        foreach ($orders as $order) {
                      ?>
                          <tr>
                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                            <td style="display:none;"><a href="#" class="text-primary"><?php echo $order['id'] ?></td>
                            <td><a href="#" class="text-primary"><?php echo $order['retailername'] ?></td>
                            <td><?php echo $order['product'] ?></td>
                            <td><?php echo $order['size'] ?></td>
                            <td><?php echo $order['quality'] ?></td>
                            <td><?php echo $order['quantity'] ?></td>
                            <td><?php echo $order['amount'] ?></td>
                            <td><?php echo $order['sold_by'] ?></td>
                            <td><?= $order['paymentmode'] ?></td>
                            <td><span class="badge bg-warning"><?= $order['orderstatus'] ?></td>
                            <!-- <td>
        
                                    <button type="button" class="btn btn-primary btn-sm editbtn"> EDIT </button>
                                </td> -->

                          </tr>
                      <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No Record Found </h5>";
                      }
                      ?>
                    </tbody>
                  </table>


                </div>

              </div>
            </div>
            <!--End Recent Sales -->


            <!-- Approved Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Approved <span>| Orders</span></h5>
                  <?php
                  $query3 = "SELECT * FROM sales where orderstatus = 'Approved' and company_id = 2 ";

                  $orders = mysqli_query($db, $query3);
                  ?>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client</th>
                        <th scope="col">Product</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Odered by</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if (mysqli_num_rows($orders) > 0) {
                        $sn = 1;
                        foreach ($orders as $order) {
                      ?>
                          <tr>
                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                            <td><a href="#" class="text-primary"><?php echo $order['retailername'] ?></td>
                            <td><?php echo $order['product'] ?></td>
                            <td><?php echo $order['size'] ?></td>
                            <td><?php echo $order['quality'] ?></td>
                            <td><?php echo $order['quantity'] ?></td>
                            <td><?php echo $order['amount'] ?></td>
                            <td><?php echo $order['sold_by'] ?></td>
                            <td><?= $order['paymentmode'] ?></td>
                            <td><span class="badge bg-success"><?= $order['orderstatus'] ?></td>
                            <!-- <td>
                                                  <a href="update_retailer.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                  <!-- <a href="edit_retailer.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
                            </td>
                          </tr>
                      <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No Record Found </h5>";
                      }
                      ?>
                    </tbody>
                  </table>


                </div>

              </div>
            </div>
            <!--End Approved Selling -->

            <!-- Approved Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Rejected <span>| Orders</span></h5>
                  <?php
                  $query3 = "SELECT * FROM sales where orderstatus = 'Rejected' and company_id = 2 ";

                  $orders = mysqli_query($db, $query3);
                  ?>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Client</th>
                        <th scope="col">Product</th>
                        <th scope="col">Size</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Odered by</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Status</th>
                        <!-- <th scope="col">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      if (mysqli_num_rows($orders) > 0) {
                        $sn = 1;
                        foreach ($orders as $order) {
                      ?>
                          <tr>
                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                            <td><a href="#" class="text-primary"><?php echo $order['retailername'] ?></td>
                            <td><?php echo $order['product'] ?></td>
                            <td><?php echo $order['size'] ?></td>
                            <td><?php echo $order['quality'] ?></td>
                            <td><?php echo $order['quantity'] ?></td>
                            <td><?php echo $order['amount'] ?></td>
                            <td><?php echo $order['sold_by'] ?></td>
                            <td><?= $order['paymentmode'] ?></td>
                            <td><span class="badge bg-danger"><?= $order['orderstatus'] ?></td>
                            <!-- <td>
                                                  <a href="update_retailer.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                  <!-- <a href="edit_retailer.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
                            </td> -->
                          </tr>
                      <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No Record Found </h5>";
                      }
                      ?>
                    </tbody>
                  </table>


                </div>

              </div>
            </div>
            <!--End Rejected Sales -->


          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <?php include('inc/footer.php'); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>