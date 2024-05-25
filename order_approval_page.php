<?php
//session_start();
require('connect.php');
include('logged_user.php');
include('aggregate.php');

//specific order details
if (isset($_GET['id'])) {
  $order_id = mysqli_real_escape_string($db, $_GET['id']);
  $query = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
    checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status,
    sales.client_id,checkin.email,checkin.phone,checkin.curLocation,
    concat(checkin.first_name, ' ', checkin.last_name) as owner_name,sales.userid,product.name as product
    FROM sales
    left join users on sales.userid = users.id
    left join product on sales.product_id = product.id
    left join checkin on sales.client_id = checkin.id
    left join payment on sales.id = payment.sales_id
    left join payment_type on payment.payment_type_id = payment_type.id
    WHERE sales.id='$order_id' ";
  $orders = mysqli_query($db, $query);

  if (mysqli_num_rows($orders) > 0) {
    $order = mysqli_fetch_assoc($orders);
    $owner_id = $order['userid'];
    $sale_date = $order['saledate'];
    $client_id = $order['client_id'];
    $product = $order['product'];
  }
}
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
      <h1><?php echo $order['trading_name'] ?> => Order #<?php echo "$order_id" ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section contact">

      <div class="row gy-4">

        <div class="col-xl-6">

          <div class="row">
            <div class="col-lg-12">
              <div class="info-box card">
                <!-- <i class="bi bi-geo-alt"></i> -->
                <h3>Products Ordered</h3>
                <p>Ordered <b><?php echo $product ?></b> on <b><?php echo $sale_date ?></b></p>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Product</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Amount (Kshs)</th>
                      <!-- <th scope="col">Date Sold</th>  -->
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query2 = "SELECT o.id as sale_id,o.amount,o.quantity,o.date_created,o.user_id,o.product_cost_id,
                b.name as brand
                FROM orders as o 
                left join brand as b on o.brand_id = b.id
                where o.date_created = '$sale_date' ";
                    $sales = mysqli_query($db, $query2);
                    if (mysqli_num_rows($sales) > 0) {
                      $sale = mysqli_fetch_assoc($sales);
                    }

                    if (mysqli_num_rows($sales) > 0) {
                      $sn = 1;
                      foreach ($sales as $sale) {
                    ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                          <td><a href="#" class="text-primary"><?php echo $sale['brand'] ?></td>
                          <td><?php echo $sale['quantity'] ?></td>
                          <td><?php echo $sale['amount'] ?></td>
                          <!-- <td><?php echo $sale['product_cost_id'] ?></td> -->
                          <!-- <td><?php echo $sale['date_created'] ?></td> -->
                          <!-- <td><span class="badge bg-danger"><?= $sale['orderstatus'] ?></td>  -->
                          <td>
                            <a href="order_approval_page.php?id=<?= $order['sale_id']; ?>" class="btn btn-primary btn-sm">View</a>
                            <!-- <button type="button" class="btn btn-primary btn-sm editbtn"> EDIT </button> -->
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
          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <!-- <i class="bi bi-geo-alt"></i> -->
                <h3>Address</h3>

                <p><?php echo $order['curLocation'] ?>,<br><?php echo $order['owner_name'] ?></p>
                <p><?php echo $order['phone'] ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <!-- <i class="bi bi-telephone"></i> -->
                <h3>Ordered by</h3>
                <p><?php echo $order['sold_by'] ?> <br>
                  <?php echo $order['saledate'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card p-4">
            <form class="row g-3 needs-validation" novalidate method="post" action="code.php">
              <input type="hidden" name="order_id" id="order_id" value="<?php echo $order['sale_id'] ?>">
              <input type="hidden" id="userid" name="approver_id" value="<?php echo "$user_id" ?>" />
              <div class="row gy-4">
                <div class="col-md-6 ">
                  <?php
                  $query = "SELECT * FROM status ";
                  $rows = mysqli_query($db, $query);
                  while ($row = mysqli_fetch_array(
                    $rows,
                    MYSQLI_ASSOC
                  )) :;
                  ?>
                    <input type="radio" name="status" value="<?php echo $row["id"]; ?>" required>
                    <?php echo $row["name"];
                    // echo $row["id"];
                    ?><?php
                  endwhile;
                ?>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" name="comment" rows="6" placeholder="Your Approval Comments" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-success btn-sm" name="approve_order">Submit</button>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Crowbyte</span></strong>. All Rights Reserved
    </div>
    <div class="credits">

      Designed by <a href="https://crowbyt.com/" target="blank">Crowbyte</a>
    </div>
  </footer><!-- End Footer -->

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