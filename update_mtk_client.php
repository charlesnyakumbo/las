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
  <?php include('inc/header.php');?>
  <!-- End Header -->
 <!-- ======= Sidebar ======= -->
 <?php include('inc/side.php');?>
  <!-- End Sidebar-->

  <main id="main" class="main">
  <?php
                        if(isset($_GET['id']))
                        {
                            $client_id = mysqli_real_escape_string($db, $_GET['id']);
                            $query = "SELECT * FROM checkin WHERE id='$client_id' ";
                            $clients = mysqli_query($db, $query);

                            if(mysqli_num_rows($clients) > 0)
                            {
                                $client = mysqli_fetch_array($clients);
                                ?>
                                
    <div class="pagetitle">
      <h1><?php echo $client ['trading_name'] ?>  's Profile</h1>
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
          $query2 = "SELECT sum(amount) FROM sales WHERE retailerid='$client_id' ";

          $client_sales = mysqli_query($db, $query2);
          $client_sale = mysqli_fetch_array($client_sales);
?>
          <div class="card">
                  <h5 class="card-title">Expenditure <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    
                    </div>
                    <div class="ps-3">
                      <h4>Kshs. <?php echo $client_sale ['sum(amount)'] ?></h4>
                      <!-- <h4>Kshs. <?php echo $revenues ?></h4> -->
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

                <div class="card">
                  <h5 class="card-title">Pending <span>| This Month</span></h5>
                  <?php
          $query3 = "SELECT sum(amount) FROM sales WHERE retailerid='$client_id' and orderstatus ='new' ";

          $client_sales = mysqli_query($db, $query3);
          $client_sale = mysqli_fetch_array($client_sales);
?>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <!-- <i class="bi bi-currency-dollar"></i> -->
                    </div>
                    <div class="ps-3">
                      <h4>Kshs. <?php echo $client_sale ['sum(amount)'] ?></h4>
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
                      <h4>Kshs. <?php echo $client_sale ['sum(amount)'] ?></h4>
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
                  <p class="small fst-italic"><td><?php echo $client ['comment'] ?><br> Data entered by: <b><td><?php echo $client ['username'] ?></td></b> at <b><td><?php echo $client ['timein'] ?></td></b>.</p>

                  <h5 class="card-title">Client Details</h5>
                                                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Trading Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['trading_name'] ?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact Person</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['owner_name'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Position</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['contacttype'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone Number</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['phone'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['email'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Main Area of Product</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['product'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Shop Type</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['shoptype'] ?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Shop Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['curLocation'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">City</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['city2'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Latitude</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['cityLat'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Longitude</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['cityLng'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Latitude2</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['latitude'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Longitude2</div>
                    <div class="col-lg-9 col-md-8"><?php echo $client ['longitude'] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">National ID</div>
                    <div class="col-lg-9 col-md-8"><a href="download.php?file=<?php echo $client['inventoryimagefilename'] ?>" target="blank">
                    <?php echo $client ['inventoryimagefilename'] ?></a></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Business Permit</div>
                    <!-- Download<br> -->
               
                    <div class="col-lg-9 col-md-8"><a href="download.php?file=<?php echo $client['storefrontimagefilename'] ?>" target="blank">
                    <?php echo $client ['storefrontimagefilename'] ?></a></div>
                  </div>
                  <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">First Manufucturer Details</h5> -->
                                                  
                  <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"  action="code.php"   >
              <?php include('errors.php'); ?>
                     <input type="hidden" id="shoptype" name="shoptype" value="<?php echo $client ['shoptype'] ?>" />
                     <input type="hidden" id="userid" name="userid" value="<?php echo $client ['user_id'] ?>" />
                     <input type="hidden" id="sold_by" name="sold_by" value="<?php echo $client ['owner_name'] ?>"  />
                    <input type="hidden" id="retilerid" name="retailerid" value="<?php echo $client ['id'] ?>"  />
                    <input type="hidden" id="retilername" name="retailername" value="<?php echo $client ['trading_name'] ?>"  />

<div class="row mb-3">
<label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Visit Reason</label>
<div class="col-md-8 col-lg-9">
                  <select class="form-select"id="visitreason" name="visitreason"  value="<?php echo $visitreason; ?>" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Credit Follow Up">Credit Follow Up</option>
                    <option value="Check Up"  >Check Up</option>
                    <option value="Client Request"  >Client Request</option>
                  </select>
                  <div class="invalid-feedback">Please select one choice </div>
  </div>
  </div>

  <div class="row mb-3"  id="stock">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Stock Remaining</label>
  <div class="col-md-8 col-lg-9">
  <input name="stock" type="number" class="form-control" id="stock" value="<?php echo $stock; ?>"  step="1" min="1" max="499"  required>
  <div class="invalid-feedback">Please enter the number of moko mattress available </div>                                                                
</div>
</div>

<div class="row mb-3">
<label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Comment</label>
  <div class="col-md-8 col-lg-9">
                    <textarea class="form-control" style="height: 50px" name="comment" value="<?php echo $comment; ?>" id="comment" required></textarea>
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

            <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"  action="code.php"   >
              <?php include('errors.php'); ?>

                     <input type="hidden" id="shoptype" name="shoptype" value="<?php echo $client ['shoptype'] ?>" />
                     <input type="hidden" id="userid" name="userid" value="<?php echo $client ['user_id'] ?>" />
                     <input type="hidden" id="sold_by" name="sold_by" value="<?php echo $client ['owner_name'] ?>"  />
                    <input type="hidden" id="retilerid" name="retailerid" value="<?php echo $client ['id'] ?>"  />
                    <input type="hidden" id="retilername" name="retailername" value="<?php echo $client ['trading_name'] ?>"  />
                     <input type="hidden" id="company_id" name="company_id" value="<?php echo $client ['company_id'] ?>"  /> 

             <div class="form-group row">
                    <div class="col-sm-4">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="size" value="Supermatch Kings">
                      <label class="form-check-label" for="gridCheck1">
                      Supermatch Kings
                      </label>
                    </div>
                  </div>
                </div>
               <div class="col-sm-4">
                <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Packets" id="" name="quantity1"   class="form-control" min =1 >
                  </div>
                </div> 
              <div class="col-sm-4">
                  <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Amount" id="amount" name="amount"  class="form-control" >
                </div>
              </div>
            </div>

            <div class="row mb-3">
              </div>

            <div class="form-group row">
                    <div class="col-sm-4">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="size2" value="Supermatch Menthol">
                      <label class="form-check-label" for="gridCheck1">
                      Supermatch Menthol
                      </label>
                    </div>
                  </div>
                </div>
               <div class="col-sm-4">
                <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Packets" id="" name="quantity2"   class="form-control" min =1 >
                  </div>
                </div> 
              <div class="col-sm-4">
                  <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Amount" id="amount" name="amount"  class="form-control" >
                </div>
              </div>
            </div>

            <div class="row mb-3">
              </div>

            <div class="form-group row">
                    <div class="col-sm-4">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="size3" value="Rocket">
                      <label class="form-check-label" for="gridCheck1">
                      Rocket
                      </label>
                    </div>
                  </div>
                </div>
               <div class="col-sm-4">
                <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Packets" id="" name="quanitity3"   class="form-control" min =1 >
                  </div>
                </div> 
              <div class="col-sm-4">
                  <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Amount" id="amount" name="amount"  class="form-control" >
                </div>
              </div>
            </div>

            <div class="row mb-3">
              </div>

            <div class="form-group row">
                    <div class="col-sm-4">
                  <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        
                      <input class="form-check-input" type="checkbox" id="gridCheck1" name="size4" value="Summit lights" >
                      <label class="form-check-label" for="gridCheck1">
                      Summit lights
                      </label>
                    </div>
                  </div>
                </div>
               <div class="col-sm-4">
                <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Packets" id="" name="quantity4"   class="form-control" min =1 >
                  </div>
                </div> 
              <div class="col-sm-4">
                  <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                  <div class="col-sm-10">
                  <input type="number" placeholder="Amount" id="amount" name="amount"  class="form-control" >
                </div>
              </div>
            </div>

            <div class="row mb-3">
              </div>

            <div class="form-group row">
                <div class="col-sm-4">
                <label for="validationCustom04" class="form-label">Payment Type</label>
                  <div class="col-sm-10">
                  <select class="form-select" id="paymentmode" name="paymentmode"  value="<?php echo $paymentmode; ?>" required>
                  <option selected disabled value="">Choose...</option>
                                                                        <option value="Mpesa">Mpesa</option>
                                                                        <option value="Cash">Cash</option>
                                                                      
                                                             </select>
                  </div>
                </div> 
               <div class="col-sm-4">
                <label for="validationCustom04" class="form-label">Transaction Code</label> 
                  <div class="col-sm-10">
                  <input type="text" placeholder="Transaction Code" id="" name="packet"   class="form-control" min =1 >
                  </div>
                </div> 
              <div class="col-sm-4">
                  <label for="inputEmail" class="form-label">Amount</label>
                  <div class="col-sm-10">
                  <input type="number" placeholder="Amount" id="amount" name="amount"  class="form-control" >
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
  <button type="submit" name="add_mtk_order" class="btn btn-primary">Submit</button>
</div>
</form>




<!-- <script>
$(document).ready(function() {

$('#myForm').submit(function(e) {
  e.preventDefault();
  var wantmoko = $('#wantmoko').val();


  $(".error").remove();

  if (wantmoko.length < 1) {
    $('#wantmoko').after('<span class="error">This field is required</span>');
  }

});

});
</script> -->

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
        $query3 = "SELECT * FROM sales WHERE retailerid='$client_id' ";

       $sales = mysqli_query($db, $query3);

          if(mysqli_num_rows($sales) > 0)
          {
            $sn=1;
              foreach($sales as $sale)
              {
                  ?>
   
                                  <tr >
                                              <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                              
                                                  <td ><a href="#" class="text-primary"><?php echo $sale ['product'] ?></td>
                                                  <td><?php echo $sale ['size'] ?></td>
                                                  <td><?php echo $sale ['quality'] ?></td>
                                                  <td><?php echo $sale['quantity'] ?></td>
                                                  <td><?php echo $sale ['amount'] ?></td>
                                                  <td><?php echo $sale ['sold_by'] ?></td>
                                                  <!-- <td><span class="badge bg-success"><?php echo $sale ['order_status'] ?></td> -->
                                                  <!-- <td>
                                                  <button type="button" class="btn btn-primary"><a href="update_retailer.php?edit=<?php echo $sale ['id']; ?>" class="text-light">View</a></button>
                                                  </td> -->
                                                 </tr>
                                                 <?php
                                                  $sn++;
                                        }
                                    }
                                    else
                                    {
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

<!-- Recent Activity --
<div class="card">
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

  <div class="card-body">
    <h5 class="card-title">Recent Comments <span>| Today</span></h5>

    <div class="activity">

      <div class="activity-item d-flex">
        <div class="activite-label">32 min</div>
        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
        <div class="activity-content">
          Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
        </div>
      </div><!-- End activity item--

    </div>

  </div>
</div><!-- End Recent Activity -->

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