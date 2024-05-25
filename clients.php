
<?php
//session_start();
require('connect.php');
include('logged_user.php');
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Crowbyte / Clients </title>
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
  <?php include('inc/header.php');?>
  <!-- End Header -->
 <!-- ======= Sidebar ======= -->
 <?php include('inc/saleside.php');?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>All Clients</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="sales.php">Home</a></li>
          <li class="breadcrumb-item">Clients</li>
          <li class="breadcrumb-item active">All Clients</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="">
 
                                <!-- All Clients -->
                                <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">All Clients</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Trading Name</th>
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Entered by</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                      $query = "SELECT checkin.id as client_id,trading_name,concat(checkin.first_name, ' ', checkin.last_name) as owner_name,email,phone,id_no,
                        curLocation,city2,checkin.comment,contact_type.name as contacttype,outlet_type.name as shoptype, 
                          concat(users.first_name, ' ', users.last_name) as username,
                         cityLat,cityLng,checkin.date_created,checkin.comment, outlet_type_id, user_id FROM checkin
                          left join outlet_type on checkin.outlet_type_id = outlet_type.id
                          left join users on checkin.user_id = users.id
                          left join contact_type on checkin.contacttype_id = contact_type.id ";
                      $clients = mysqli_query($db, $query);

                      if (mysqli_num_rows($clients) > 0) {
                        $sn = 1;
                        foreach ($clients as $client) {
                      ?>
                                            <tr>
                                                <th scope="row"><a href="#">#<?php echo $sn; ?></a></th>
                                                <td><?= $client['trading_name']; ?></td>
                                                <td><a href="#" class="text-primary"><?= $client['owner_name'] ?></a>
                                                </td>
                                                <td><?= $client['phone'] ?></td>
                                                <td><?= $client['username'] ?></td>
                                                <td>
                                                    <a href="sales_order.php?id=<?= $client['client_id']; ?>"
                                                        class="btn btn-primary btn-sm">Transact</a>
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
                        </div><!-- End All Clients -->

              <!-- Horizontal Form -->
      
            </div>
          </div>
        </div>

      </div>
    </section>

  </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('inc/footer.php'); ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
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