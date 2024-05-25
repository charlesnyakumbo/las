<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');

$product_id = 2;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Client / Profile -</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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
    <?php
    if (isset($_GET['id'])) {
      $client_id = mysqli_real_escape_string($db, $_GET['id']);
      $query = "SELECT checkin.id as client_id,trading_name,concat(checkin.first_name, ' ',checkin.last_name) as owner_name,email,phone,id_no,
                            curLocation,city2,comment,contact_type.name as contacttype,outlet_type.name as shoptype, 
                            concat(users.first_name, ' ', users.last_name) as username,inventoryimagefilename,storefrontimagefilename,
                            cityLat,cityLng,checkin.date_created,checkin.comment, outlet_type_id, checkin.user_id, checkin.company_id FROM checkin
                            left join outlet_type on checkin.outlet_type_id = outlet_type.id
                            left join users on checkin.user_id = users.id
                            left join contact_type on checkin.contacttype_id = contact_type.id
                             WHERE checkin.id='$client_id' ";
      $clients = mysqli_query($db, $query);

      if (mysqli_num_rows($clients) > 0) {
        $client = mysqli_fetch_array($clients);
    ?>

        <div class="pagetitle">
          <h1><?php echo $client['trading_name'] ?> 's Profile</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="all_retailer.php">Clients </a></li>
              <li class="breadcrumb-item active"> Profile</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section profile">

          <div class="row">
            <div class="col-xl-4">
              <?php
              $query2 = "SELECT sum(amount) FROM sales";

              $client_sales = mysqli_query($db, $query2);
              $client_sale = mysqli_fetch_array($client_sales);
              ?>
              <div class="card">
                <h5 class="card-title">Expenditure <span>| This Month</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                  </div>
                  <div class="ps-3">
                    <h4>Kshs. <?php echo $client_sale['sum(amount)'] ?></h4>
                    <!-- <h4>Kshs. <?php echo $revenues ?></h4> -->
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

              <div class="card">
                <h5 class="card-title">Pending <span>| This Month</span></h5>
                <?php
                $query3 = "SELECT sum(amount) FROM sales";

                $client_sales = mysqli_query($db, $query3);
                $client_sale = mysqli_fetch_array($client_sales);
                ?>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <!-- <i class="bi bi-currency-dollar"></i> -->
                  </div>
                  <div class="ps-3">
                    <h4>Kshs. <?php echo $client_sale['sum(amount)'] ?></h4>
                    <!-- <h4>Kshs. <?php echo $revenues ?></h4> -->
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

              <div class="card">
                <h5 class="card-title">Revenue <span>| This Month</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h4>Kshs. <?php echo $client_sale['sum(amount)'] ?></h4>
                    <!-- <h4>Kshs. <?php echo $revenues ?></h4> -->
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-8">

              <div class="card">
                <div class="card-body pt-3">
                  <!-- Bordered Tabs -->
                  <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Biodata</button>
                    </li>

                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Client Visit</button>
                    </li>

                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Order Now</button>
                    </li>

                    <li class="nav-item">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">All Sales</button>
                    </li>

                  </ul>
                  <div class="tab-content pt-2">



                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                      <h5 class="card-title">Comments</h5>
                      <p class="small fst-italic">
                        <td><?php echo $client['comment'] ?><br> Data entered by: <b>
                        <td><?php echo $client['username'] ?></td></b> at <b>
                          <td><?php echo $client['date_created'] ?></td>
                        </b>.
                      </p>

                      <h5 class="card-title">Client Details</h5>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Trading Name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['trading_name'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Contact Person</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['owner_name'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Position</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['contacttype'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Phone Number</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['phone'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['email'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Shop Type</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['shoptype'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Shop Address</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['curLocation'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">City</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['city2'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Latitude</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['cityLat'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Longitude</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['cityLng'] ?></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">National ID</div>
                        <div class="col-lg-9 col-md-8"><a href="download.php?file=<?php echo $client['inventoryimagefilename'] ?>" target="blank">
                            <?php echo $client['inventoryimagefilename'] ?></a></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Business Permit</div>
                        <div class="col-lg-9 col-md-8"><a href="download.php?file=<?php echo $client['storefrontimagefilename'] ?>" target="blank">
                            <?php echo $client['storefrontimagefilename'] ?></a></div>
                      </div>
                  <?php
                } else {
                  echo "<h4>No Such Id Found</h4>";
                }
              }
                  ?>
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <!-- <h5 class="card-title">First Manufucturer Details</h5> -->

                        <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off" action="code.php">
                          <?php include('errors.php'); ?>

                          <input type="hidden" id="userid" name="userid" value="<?php echo $user_id ?>" />
                          <input type="hidden" id="retilerid" name="client_id" value="<?php echo $client_id ?>" />


                          <div class="row mb-3">
                            <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Visit Reason</label>
                            <div class="col-md-8 col-lg-9">
                              <select class="form-select" id="visitreason" name="visitreason"  required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                $query = "SELECT * FROM visit_reason ";
                                $rows = mysqli_query($db, $query);
                                while ($row = mysqli_fetch_array(
                                  $rows,
                                  MYSQLI_ASSOC
                                )) :;
                                ?>
                                  <option value="<?php echo $row["id"];
                                                  ?>">
                                    <?php echo $row["name"];
                                    ?>
                                  </option>
                                <?php
                                endwhile;
                                ?>
                              </select>
                              <div class="invalid-feedback">Please select one choice </div>
                            </div>
                          </div>

                          <div class="row mb-3" id="stock">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Stock Remaining</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="stock" type="number" class="form-control" id="stock"  step="1" min="0" max="499" required>
                              <div class="invalid-feedback">Please enter the number of items available </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Comment</label>
                            <div class="col-md-8 col-lg-9">
                              <textarea class="form-control" style="height: 50px" name="comment"  id="comment" required></textarea>
                              <div class="invalid-feedback">Please put your comment </div>
                            </div>

                          </div>

                          <div class="text-center">
                            <button type="submit" name="add_visit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                      <!-- End visit form data -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">
                      <form class="row g-3 needs-validation" id="form" novalidate method="post" autocomplete="off" action="transaction.php">
                        <?php include('errors.php'); ?>
                        <input type="hidden" id="userid" name="userid" value="<?php echo $user_id ?>" />
                        <!-- <input type="" id="userid" name="userid" value="<?php echo $role_id ?>" />  -->
                        <input type="hidden" id="userid" name="outlet_type" value="<?php echo $client['outlet_type_id'] ?>" /> 
                        <input type="hidden" id="userid" name="product_id" value="<?php echo $product_id ?>" />
                        <input type="hidden" id="client_id" name="retailerid" value="<?php echo $company_id ?>" />
                        <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>" />
                        <input type="hidden" id="company_id" name="user_type" value="<?php echo $user_type ?>" />
                        <div class="form-group row">
                          
                          <?php
                          $outlet_type = $client['outlet_type_id'];
                          $query = "SELECT outlet_type.id,brand.name as brand,
                          brand.id as brand_id, product.name as product,outlet_type.name as outlet,
                          unit_cost, product_cost.id as product_cost_id
                           FROM product_cost 
                          left JOIN outlet_type ON outlet_type.id=product_cost.outlet_type_id 
                          left JOIN product ON product.id=product_cost.product_id
                          left JOIN brand ON brand.id=product_cost.brand_id
                          where outlet_type.id = '$outlet_type' and brand.product_id > 1";
                          $rows = mysqli_query($db, $query);
                          while ($row = mysqli_fetch_array(
                            $rows,
                            MYSQLI_ASSOC
                          )) :;
                          ?>
                            <div class="col-sm-4">
                              <div class="col-sm-10 offset-sm-2">
                                <div class="form-check">
                                  <input class="form-check-input brand" type="checkbox" id="brand<?php echo $row["brand_id"]; ?>" name="brand[]" value="<?php echo $row["brand_id"]; ?>">
                                  <!-- <input type="hidden"  id="product_cost_id<?php echo $row["brand_id"]; ?>" name="product_cost_id<?php echo $row["brand_id"]; ?>" > -->
                                  <label class="form-check-label" for="gridCheck1">
                                    <?php echo $row["brand"]; ?>
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                              <div class="col-sm-10">
                                <input type="number" placeholder="Quantity" id="quantity<?php echo $row["brand_id"]; ?>" name="quantity<?php echo $row["brand_id"]; ?>" class="form-control quantity" data-quantity min=1>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                              <div class="col-sm-10">
                                <input type="hidden" id="userid" name="userid" value="<?php echo $user_id ?>" />
                                <input type="hidden" id="retilerid" name="client_id" value="<?php echo $company_id ?>" />
                                <input type="hidden" id="product_cost_id<?php echo $row["brand_id"]; ?>" name="product_cost_id<?php echo $row["brand_id"]; ?>" value="<?php echo $row["product_cost_id"]; ?>">
                                <input class="unit_cost" type="hidden" id="unit_cost<?php echo $row["brand_id"]; ?>" name="unit_cost<?php echo $row["brand_id"]; ?>" value="<?php echo $row["unit_cost"]; ?>">
                                <input type="number" id="cost<?php echo $row["brand_id"]; ?>" name="cost<?php echo $row["brand_id"]; ?>" value="0" class="form-control cost" disabled>
                              </div>
                            </div>
                            <div class="row mb-3">
                            </div>
                          <?php
                          endwhile;
                          ?>
                        </div>

                        <div class="row mb-3">
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-4">
                            <label for="validationCustom04" class="form-label">Payment Type</label>
                            <div class="col-sm-10">
                              <select class="form-select" id="paymentmode" name="paymentmode" value="<?php echo $paymentmode; ?>" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                $query = "SELECT * FROM payment_type ";
                                $rows = mysqli_query($db, $query);
                                while ($row = mysqli_fetch_array(
                                  $rows,
                                  MYSQLI_ASSOC
                                )) :;
                                ?>
                                  <option value="<?php echo $row["id"];
                                                  ?>">
                                    <?php echo $row["name"];
                                    ?>
                                  </option>
                                <?php
                                endwhile;
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <label for="validationCustom04" class="form-label">Transaction Code</label>
                            <div class="col-sm-10">
                              <input type="text" placeholder="Transaction Code" id="" name="code" class="form-control">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <label for="inputEmail" class="form-label">Amount</label>
                            <div class="col-sm-10">
                              <input type="number" placeholder="Amount" id="amount" name="amount" class="form-control" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                        </div>
                        <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Comment</label>
                          <div class="col-md-8 col-lg-9">
                            <textarea class="form-control" style="height: 50px" name="comment" value="<?php echo $comment; ?>" id="comment" required></textarea>
                          </div>
                          <div class="invalid-feedback">
                            Please put your comment
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" name="add_transaction" class="btn btn-primary">Submit</button>
                        </div>
                      </form>


                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                      <!-- Change Password Form -->
                      <?php
                      $query3 = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
        checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status
                FROM sales
                left join users on sales.userid = users.id
                left join checkin on sales.client_id = checkin.id
                left join payment on sales.id = payment.sales_id
                left join payment_type on payment.payment_type_id = payment_type.id
                 where checkin.id = $client_id ";
                      $orders = mysqli_query($db, $query3);
                      ?>
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Amount (Kshs)</th>
                            <th scope="col">Sold by</th>
                            <th scope="col">Date Sold</th>
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
                                <!-- <td ><a href="#" class="text-primary"><?php echo $order['trading_name'] ?></td> -->
                                <td><?= $order['paymentmode'] ?></td>
                                <td><?php echo $order['amount'] ?></td>
                                <td><?php echo $order['sold_by'] ?></td>
                                <td><?= $order['saledate'] ?></td>
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
                    <!-- End Change Password Form -->
                    </div>
                  </div><!-- End Bordered Tabs -->
                </div>
              </div>
            </div>

            <!-- Right side columns -->
            <div class="col-lg-12">
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

  <script defer>
    let dynamic_quantity = document.querySelectorAll(".quantity");
    dynamic_quantity.forEach((quantity) => {
      quantity.addEventListener('change', (event) => {
        // Slice string and exract id
        let item_id = event.target.id.slice(8)

        // Automatically check box
        let checkbox = document.getElementById('brand' + item_id);
        event.target.value.length > 0 ? checkbox.checked = true : checkbox.checked = false;

        let unit_cost = document.getElementById('unit_cost' + item_id).value;
        document.getElementById('cost' + item_id).value = unit_cost * event.target.value;

        let allNodes = document.querySelectorAll(".cost");
        let sum = 0;
        allNodes.forEach((node) => {
          sum += parseInt(node.value);
          console.log(sum);
        });
        document.getElementById('amount').value = sum
      });
    });
  </script>

</body>

</html>