<?php
require('connect.php');
include('logged_user.php');
$clientdetails = "SELECT c.*,t.name as outlet,s.date_created as saledate  FROM checkin as c
left join outlet_type t on c.outlet_type_id = t.id
left join sales s on c.id = s.client_id where c.id = $company_id ";
$result =  mysqli_query($db, $clientdetails);
  if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$client_id=$row['id'];
$trading_name=$row['trading_name'];
$sale_date=$row['saledate'];
$fname=$row['first_name'];
$lname=$row['last_name'];
$email=$row['email'];
$phone=$row['phone'];
$location=$row['curLocation'];
$outlet=$row['outlet'];


} 
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- ======= Head ======= -->

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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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

<!-- ======= Head ======= -->

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Crowbyte</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->



        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h6>
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </h6>
        </div>
        <?php endif ?>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/logo.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo "$first_name" ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo "$first_name" ?></h6>
                            <span><?php echo "$role" ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?logout='1'">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->
    </header>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="client_area.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <!-- <div class="pagetitle">
      <h1>Cards</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Components</li>
          <li class="breadcrumb-item active">Cards</li>
        </ol>
      </nav>
    </div>End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-6">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $trading_name ?></h5>
                            <p><b>Contact Person: </b><code><b><?php echo $fname ?> <?php echo $lname ?></b></code></p>
                            <p><b>Phone: </b><code><b><?php echo $phone ?></b></code></p>
                            <p><b>Email: </b><code><b><?php echo $email ?></b></code></p>
                            <p><b>Location: </b><code><b><?php echo $location ?></b></code></p>
                        </div>
                    </div><!-- End Default Card -->


                    <!-- Card with an image on left -->
                    <div class="card mb-3">
                        <div class="row g-0">
                            <!-- <div class="col-md-8">
                <img src="assets/img/client.jpg" class="img-fluid rounded-start" alt="...">
              </div> -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">You want to talk to us?</h5>
                                    <p><b>Call: </b><code><b>+254707651650</b></code></p>
                                    <p><b>Call: </b><code><b>+254717869816</b></code></p>
                                    <p><b>Email: </b><code><b>info@crowbyt.com</b></code></p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card with an image on left -->

                </div>

                <div class="col-lg-6">
                    <!-- Card with an image on top -->
                    <div class="card">
                        <img src="assets/img/client.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Make an Order</h5>
                            <p class="card-text">We currently have two products, more are on the pipeline</p>
                            <p class="card-text">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal">
                                    Order Now
                                </button>
                            </p>
                            <a href="#" class="card-link">Visit our website</a>
                        </div>
                    </div><!-- End Card with an image on top -->
                </div>
                <!-- Product Modal -->
                <div class="modal fade" id="basicModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Choose a product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <form class="row g-3 needs-validation" novalidate method="get" autocomplete="off"
                                        action="ordering.php">
                                        <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">I
                                            want</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="product" name="product"
                                                value="<?php echo $product; ?>" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                    $query = "SELECT * FROM product ";
                                      $rows = mysqli_query($db, $query);
                                  while ($row = mysqli_fetch_array(
                                        $rows,MYSQLI_ASSOC)):;
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
                                            <div class="invalid-feedback">Please choose one product </div>
                                        </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="" class="btn btn-success">Next</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div><!-- End Product Modal-->
            </div>
            <!-- All Clients -->
            <div class="col-18">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Pending <span>| Orders</span></h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sale Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $query2 = "SELECT o.id as sale_id,o.amount,o.quantity,o.date_created as saledate,o.user_id,o.product_cost_id,
                    b.name as brand
                    FROM orders as o 
                    left join brand as b on o.brand_id = b.id
                    left join sales s on o.date_created = s.date_created
                    where o.client_id = $client_id and s.status = 3 ";
                    $sales = mysqli_query($db, $query2);
                    if (mysqli_num_rows($sales) > 0) {
                      $sale = mysqli_fetch_assoc($sales);
                      } 
                                        
                                if(mysqli_num_rows($sales) > 0)
                                {
                                  $sn=1;
                                    foreach($sales as $sale)
                                    {
                                        ?>
                                <tr>
                                    <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                    <td><a href="#" class="text-primary"><?php echo $sale ['brand'] ?></td>
                                    <td><?php echo $sale ['quantity'] ?></td>
                                    <td><?php echo $sale ['saledate'] ?></td>
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
                    </div>
                </div>
            </div><!-- End Recent Sales -->


        </section>

    </main><!-- End #main -->

    <?php include('inc/footer.php');?>
    <?php include('inc/footjs.php');?>

</body>

</html>