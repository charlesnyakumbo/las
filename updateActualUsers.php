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
      $query = "SELECT * FROM users WHERE id='$client_id' ";
      $clients = mysqli_query($db, $query);

      if (mysqli_num_rows($clients) > 0) {
        $client = mysqli_fetch_array($clients);
    ?>

        <div class="pagetitle">
          <h1><?php echo $client['first_name'] ?> 's Profile</h1>
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
              $query2 = "SELECT sum(amount) FROM sales WHERE client_id='$client_id' ";

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
                $query3 = "SELECT sum(amount) FROM sales WHERE client_id='$client_id'  ";

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
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Details</button>
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
                      <!-- <p class="small fst-italic"><td><?php echo $client['comment'] ?><br> Data entered by: <b><td><?php echo $client['username'] ?></td></b> at <b><td><?php echo $client['timein'] ?></td></b>.</p> -->

                      <h5 class="card-title">Client Details</h5>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">UserName</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['username'] ?></div>
                      </div>


                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">First Name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['first_name'] ?></div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Last Name</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['last_name'] ?></div>
                      </div>

                      <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client['role'] ?></div>
                  </div> -->

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Status</div>
                        <div class="col-lg-9 col-md-8"><?php echo $client['status'] ?></div>
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
                          <!-- <input type="hidden" id="shoptype" name="role" value="<?php echo $client['role'] ?>" /> -->
                          <input type="hidden" id="userid" name="userid" value="<?php echo $client['id'] ?>" />

                          <div class="row mb-3">
                            <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Role</label>
                            <div class="col-md-8 col-lg-9">
                              <select class="form-select" id="role" name="role_id" value="<?php echo $client['role'] ?>" required>
                                <?php
                                $query = "SELECT * FROM role ";
                                $all_roles = mysqli_query($db, $query);

                                while ($role = mysqli_fetch_array(
                                  $all_roles,
                                  MYSQLI_ASSOC
                                )) :;
                                ?>
                                  <option value="<?php echo $role["id"];
                                                  // The value we usually set is the primary key
                                                  ?>">
                                    <?php echo $role["name"];
                                    // To show the category name to the user
                                    ?>
                                  </option>
                                <?php
                                endwhile;
                                // While loop must be terminated
                                ?>
                              </select>
                              <div class="invalid-feedback">Please select one choice </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Company</label>
                            <div class="col-md-8 col-lg-9">
                              <select class="form-select" id="role" name="company_id" value="<?php echo $client['role'] ?>" required>
                                <?php
                                $query = "SELECT * FROM company ";
                                $comoanies = mysqli_query($db, $query);
                                while ($company = mysqli_fetch_array(
                                  $comoanies,
                                  MYSQLI_ASSOC
                                )) :;
                                ?>
                                  <option value="<?php echo $company["id"];
                                                  ?>">
                                    <?php echo $company["name"];
                                    ?>
                                  </option>
                                <?php
                                endwhile;
                                ?>
                              </select>
                              <div class="invalid-feedback">Please select one choice </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-9">
                              <select class="form-select" id="status" name="status" value="<?php echo $client['status'] ?>" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                              <div class="invalid-feedback">Please select one choice </div>
                            </div>
                          </div>
                          <div class="row mb-3" id="stock">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="first_name" type="text" class="form-control" id="stock" value="<?php echo $client['first_name'] ?>" required>
                              <div class="invalid-feedback">Please enter the number of moko mattress available </div>
                            </div>
                          </div>

                          <div class="row mb-3" id="stock">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="last_name" type="text" class="form-control" id="stock" value="<?php echo $client['last_name'] ?>" required>
                              <div class="invalid-feedback">Please enter the number of moko mattress available </div>
                            </div>
                          </div>
                          <div class="row mb-3" id="stock">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Username</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="username" type="text" class="form-control" id="stock" value="<?php echo $client['username'] ?>" required>
                              <div class="invalid-feedback">Please enter the number of moko mattress available </div>
                            </div>
                          </div>
                          <div class="row mb-3" id="stock">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="password" type="text" class="form-control" id="password"  required>
                              <div class="invalid-feedback">Please enter the number of moko mattress available </div>
                            </div>
                          </div>


                          <div class="text-center">
                            <button type="submit" name="edit_user_details" class="btn btn-primary">Submit</button>
                          </div>
                        </form>


                      </div>
                      <!-- End visit form data -->
                    </div>
                    <div class="tab-pane fade pt-3" id="profile-settings">
                      <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off" action="code.php">
                        <?php include('errors.php'); ?>
                        <input type="hidden" id="shoptype" name="shoptype" value="<?php echo $client['shoptype'] ?>" />
                        <input type="hidden" id="userid" name="userid" value="<?php echo $client['user_id'] ?>" />
                        <input type="hidden" id="sold_by" name="sold_by" value="<?php echo $client['owner_name'] ?>" />
                        <input type="hidden" id="retilerid" name="retailerid" value="<?php echo $client['id'] ?>" />
                        <input type="hidden" id="retilername" name="retailername" value="<?php echo $client['trading_name'] ?>" />
                        <div class="row mb-3">
                          <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Do you want Moko Product?</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-select" id="wantmoko" name="wantmoko" value="<?php echo $wantmoko; ?>" onchange="ShowHideDiv()" required>
                              <option selected disabled value="">Choose...</option>
                              <option value="Yes" onclick="text(0)" checked>Yes</option>
                              <option value="No" onclick="text(1)">No</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select one choice
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3" id="product">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Product</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" name="product" value="<?php echo $product; ?>" required>
                              <option disabled selected>Select Product</option>
                              <option value="Mattress">Mattress</option>
                              <option value="Sofas">Sofas</option>
                              <option value="Carpets">Carpets</option>
                              <option value="Beds">Beds</option>
                              <option value="Kitchen items">Kitchen items</option>
                              <option value="Wood Seats">Wood Seats</option>
                              <option value="Upholstered">Upholstered</option>
                              <option value="Msc Furniture">Msc Furniture</option>
                              <option value="Other seats & parts">Other seats & parts</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="size">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">First Size</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="size" name="size1" value="<?php echo $size1; ?>" onchange="calculateAmount()" required>
                              <option disabled selected>Select Size</option>
                              <option value="36by74by6">36x74x6 (3x6)</option>
                              <option value="36by74by8">36x74x8 (3x8)</option>
                              <option value="42by74by6">42x74x6 (3.5x6)</option>
                              <option value="42by74by8">42x74x8 (3.5x6)</option>
                              <option value="48by74by6">48x74x6 (4x6)</option>
                              <option value="48by74by8">48x74x8 (4x8)</option>
                              <option value="54by74by6">48x74x6 (4x6)</option>
                              <option value="54by74by8">48x74x8 (4x8)</option>
                              <option value="60by74by6">60x74x6 (5x6)</option>
                              <option value="60by74by8">60x74x8 (5x8)</option>
                              <option value="72by74by6">72x74x6 (6x6)</option>
                              <option value="72by74by8">72x74x8 (6x8)</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="quantity1">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Quantity 1</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="quantity1" type="number" class="form-control" id="quantity1" value="<?php echo $quantity1; ?>" step="1" min="1" max="499" onchange="calculateAmount()">
                          </div>
                        </div>

                        <div class="row mb-3" id="size2">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Second Size</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" name="size2" value="<?php echo $size2; ?>" onchange="calculateAmount()">
                              <option disabled selected>Select Size</option>
                              <option value="36by74by6">36x74x6 (3x6)</option>
                              <option value="36by74by8">36x74x8 (3x8)</option>
                              <option value="42by74by6">42x74x6 (3.5x6)</option>
                              <option value="42by74by8">42x74x8 (3.5x6)</option>
                              <option value="48by74by6">48x74x6 (4x6)</option>
                              <option value="48by74by8">48x74x8 (4x8)</option>
                              <option value="54by74by6">48x74x6 (4x6)</option>
                              <option value="54by74by8">48x74x8 (4x8)</option>
                              <option value="60by74by6">60x74x6 (5x6)</option>
                              <option value="60by74by8">60x74x8 (5x8)</option>
                              <option value="72by74by6">72x74x6 (6x6)</option>
                              <option value="72by74by8">72x74x8 (6x8)</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="quantity2">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Quantity 2</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="quantity2" type="number" class="form-control" id="quantity2" value="<?php echo $quantity2; ?>" step="1" min="1" max="499" onchange="calculateAmount()">
                          </div>
                        </div>

                        <div class="row mb-3" id="size3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Third Size</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="size3" name="size3" value="<?php echo $size3; ?>" onchange="calculateAmount()">
                              <option disabled selected>Select Size</option>
                              <option value="36by74by6">36x74x6 (3x6)</option>
                              <option value="36by74by8">36x74x8 (3x8)</option>
                              <option value="42by74by6">42x74x6 (3.5x6)</option>
                              <option value="42by74by8">42x74x8 (3.5x6)</option>
                              <option value="48by74by6">48x74x6 (4x6)</option>
                              <option value="48by74by8">48x74x8 (4x8)</option>
                              <option value="54by74by6">48x74x6 (4x6)</option>
                              <option value="54by74by8">48x74x8 (4x8)</option>
                              <option value="60by74by6">60x74x6 (5x6)</option>
                              <option value="60by74by8">60x74x8 (5x8)</option>
                              <option value="72by74by6">72x74x6 (6x6)</option>
                              <option value="72by74by8">72x74x8 (6x8)</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="quantity3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Quantity 3</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="quantity3" type="number" class="form-control" id="quantity3" value="<?php echo $quantity3; ?>" step="1" min="1" max="499" onchange="calculateAmount()">
                          </div>
                        </div>


                        <div class="row mb-3" id="size4">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Fourth Size</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="size4" name="size4" value="<?php echo $size4; ?>" onchange="calculateAmount()">
                              <option disabled selected>Select Size</option>
                              <option value="36by74by6">36x74x6 (3x6)</option>
                              <option value="36by74by8">36x74x8 (3x8)</option>
                              <option value="42by74by6">42x74x6 (3.5x6)</option>
                              <option value="42by74by8">42x74x8 (3.5x6)</option>
                              <option value="48by74by6">48x74x6 (4x6)</option>
                              <option value="48by74by8">48x74x8 (4x8)</option>
                              <option value="54by74by6">48x74x6 (4x6)</option>
                              <option value="54by74by8">48x74x8 (4x8)</option>
                              <option value="60by74by6">60x74x6 (5x6)</option>
                              <option value="60by74by8">60x74x8 (5x8)</option>
                              <option value="72by74by6">72x74x6 (6x6)</option>
                              <option value="72by74by8">72x74x8 (6x8)</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="quantity4">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Quantity 4</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="quantity4" type="number" class="form-control" id="quantity4" value="<?php echo $quantity4; ?>" step="1" min="1" max="499" onchange="calculateAmount()">
                          </div>
                        </div>

                        <div class="row mb-3" id="quality">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Quality</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="quality" name="quality" value="<?php echo $quality; ?>" required>
                              <option disabled selected>Select Quality</option>
                              <option value="Medium">Medium</option>
                              <option value="Heavy">Heavy</option>
                              <option value="Super Heavy">Super Heavy</option>
                              <option value="Class 23">Class 23</option>
                              <option value="Class 30">Class 30</option>
                              <option value="Class 40">Class 40</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="paymentmode">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Payment Mode</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="paymentmode" name="paymentmode" value="<?php echo $paymentmode; ?>" required>
                              <option disabled selected>Select Type</option>
                              <option value="Credit">Credit</option>
                              <option value="Cash">Cash</option>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-3" id="why_no">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">If no why?</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-control" id="why_no" name="why_no" value="<?php echo $why_no; ?>">
                              <option disabled selected>Select Reason</option>
                              <option value="Too expensive">Too expensive</option>
                              <option value="Don’t have space">Don’t have space</option>
                              <option value="Need credit">Need credit</option>
                              <option value="Brand not known">Brand not known</option>
                              <option value="Quality issue">Quality issue</option>
                              <option value="Other">Other</option>

                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Prospect Status</label>
                          <div class="col-md-8 col-lg-9">
                            <select class="form-select" name="prospectstatus" value="<?php echo $prospectstatus; ?>" id="validationCustom04" required>
                              <option selected disabled value="">Choose...</option>
                              <option value="Initial Sale Made">Initial Sale Made</option>
                              <option value="Active Lead">Active Lead</option>
                              <option value="Repeat Sale Made">Repeat Sale Made</option>
                              <option value="Paused Lead">Paused Lead</option>
                              <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid status.
                            </div>
                          </div>
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
                          <button type="submit" name="add_order" class="btn btn-primary">Submit</button>
                        </div>
                      </form>


                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                      <!-- Change Password Form -->
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Size</th>
                            <th scope="col">Quality</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Sold by</th>
                            <!-- <th scope="col">Date</th> -->

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query3 = "SELECT * FROM sales WHERE client_id='$client_id' ";

                          $sales = mysqli_query($db, $query3);

                          if (mysqli_num_rows($sales) > 0) {
                            $sn = 1;
                            foreach ($sales as $sale) {
                          ?>

                              <tr>
                                <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                <td><a href="#" class="text-primary"><?php echo $sale['product'] ?></td>
                                <td><?php echo $sale['size'] ?></td>
                                <td><?php echo $sale['quality'] ?></td>
                                <td><?php echo $sale['quantity'] ?></td>
                                <td><?php echo $sale['amount'] ?></td>
                                <td><?php echo $sale['sold_by'] ?></td>
                                <!-- <td><span class="badge bg-success"><?php echo $sale['order_status'] ?></td> -->
                                <!-- <td>
                                                  <button type="button" class="btn btn-primary"><a href="update_retailer.php?edit=<?php echo $sale['id']; ?>" class="text-light">View</a></button>
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

</body>

</html>