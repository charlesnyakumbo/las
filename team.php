<?php
// require('connect.php');
include('logged_user.php');
if ($user_type == 1) {
  header("refresh:0;url=client_area.php");
}


$total_sales=0;
$product=0;
$allSales = 0;
$amount = 0;
$total_orders=0;
$allorders = 0;
$ordersCount = 0;
$target = 0;
$clientCount = 0;

//total sales
$a=$db->query("select amount from sales where date_created >= curdate()  ");
while($arow=$a->fetch_array()){
$total_sales += $arow['amount'];
}

//toatl orders
$a=$db->query("select quantity from orders where date_created >= curdate()  ");
while($row=$a->fetch_array()){
$total_orders += $row['quantity'];
}

//quantity sold
$sql = "SELECT COUNT(brand_id) AS total FROM orders where date_created >= curdate() ";
$result = mysqli_query($db, $sql);
$ordersCount = mysqli_fetch_assoc($result);

//clients registered
$sql = "SELECT COUNT(id) AS total FROM checkin where date_created >= curdate()  ";
$result = mysqli_query($db, $sql);
$clientCount = mysqli_fetch_assoc($result);

//target
$sqlT = "SELECT amount from target where id = 1";
$result = mysqli_query($db, $sqlT);
$row = mysqli_fetch_assoc($result);
$target = $row['amount'];

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
                <a class="nav-link " href="sales.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- End Dashboard Nav --

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="components-alerts.html">
        <i class="bi bi-circle"></i><span>Alerts</span>
      </a>
    </li>
    <li>
      <a href="components-accordion.html">
        <i class="bi bi-circle"></i><span>Accordion</span>
      </a>
    </li>
    <li>
      <a href="components-badges.html">
        <i class="bi bi-circle"></i><span>Badges</span>
      </a>
    </li>
    <li>
      <a href="components-breadcrumbs.html">
        <i class="bi bi-circle"></i><span>Breadcrumbs</span>
      </a>
    </li>
    <li>
      <a href="components-buttons.html">
        <i class="bi bi-circle"></i><span>Buttons</span>
      </a>
    </li>
    <li>
      <a href="components-cards.html">
        <i class="bi bi-circle"></i><span>Cards</span>
      </a>
    </li>
    <li>
      <a href="components-carousel.html">
        <i class="bi bi-circle"></i><span>Carousel</span>
      </a>
    </li>
    <li>
      <a href="components-list-group.html">
        <i class="bi bi-circle"></i><span>List group</span>
      </a>
    </li>
    <li>
      <a href="components-modal.html">
        <i class="bi bi-circle"></i><span>Modal</span>
      </a>
    </li>
    <li>
      <a href="components-tabs.html">
        <i class="bi bi-circle"></i><span>Tabs</span>
      </a>
    </li>
    <li>
      <a href="components-pagination.html">
        <i class="bi bi-circle"></i><span>Pagination</span>
      </a>
    </li>
    <li>
      <a href="components-progress.html">
        <i class="bi bi-circle"></i><span>Progress</span>
      </a>
    </li>
    <li>
      <a href="components-spinners.html">
        <i class="bi bi-circle"></i><span>Spinners</span>
      </a>
    </li>
    <li>
      <a href="components-tooltips.html">
        <i class="bi bi-circle"></i><span>Tooltips</span>
      </a>
    </li>
  </ul>
</li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Clients</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="new_client.php">
                            <i class="bi bi-circle"></i><span>New Client</span>
                        </a>
                    </li>
                    <li>
                        <a href="all_clients.php">
                            <i class="bi bi-circle"></i><span>All Clients</span>
                        </a>
                    </li>

                    <!--
    <li>
      <a href="forms-editors.html">
        <i class="bi bi-circle"></i><span>Form Editors</span>
      </a>
    </li>
    <li>
      <a href="forms-validation.html">
        <i class="bi bi-circle"></i><span>Form Validation</span>
      </a>
    </li>
                </ul>
            </li>
             End Forms Nav --


            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Transactions</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="orders.php" class="active">
                            <i class="bi bi-circle"></i><span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="stores.php">
                            <i class="bi bi-circle"></i><span>Stores</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- End Tables Nav --

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="allUsers.php">
                            <i class="bi bi-circle"></i><span>All Users</span>
                        </a>
                    </li>

                </ul>
            </li>
            <!-- End Charts Nav --

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="icons-bootstrap.html">
        <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
      </a>
    </li>
    <li>
      <a href="icons-remix.html">
        <i class="bi bi-circle"></i><span>Remix Icons</span>
      </a>
    </li>
    <li>
      <a href="icons-boxicons.html">
        <i class="bi bi-circle"></i><span>Boxicons</span>
      </a>
    </li>
  </ul>
</li><!-- End Icons Nav --

<li class="nav-heading">Pages</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="users-profile.html">
    <i class="bi bi-person"></i>
    <span>Profile</span>
  </a>
</li><!-- End Profile Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-faq.html">
    <i class="bi bi-question-circle"></i>
    <span>F.A.Q</span>
  </a>
</li><!-- End F.A.Q Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-contact.html">
    <i class="bi bi-envelope"></i>
    <span>Contact</span>
  </a>
</li><!-- End Contact Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-register.html">
    <i class="bi bi-card-list"></i>
    <span>Register</span>
  </a>
</li><!-- End Register Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-login.html">
    <i class="bi bi-box-arrow-in-right"></i>
    <span>Login</span>
  </a>
</li><!-- End Login Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-error-404.html">
    <i class="bi bi-dash-circle"></i>
    <span>Error 404</span>
  </a>
</li><!-- End Error 404 Page Nav --

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-blank.html">
    <i class="bi bi-file-earmark"></i>
    <span>Blank</span>
  </a>
</li><!-- End Blank Page Nav -->
        </ul>
    </aside>
    <!-- End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="team.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sales</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $total_orders ?></h6>
                                            <span class="text-muted small pt-2 ps-1">Goal: <?php echo $target ?></span>
                                            <span
                                                class="text-success small pt-1 fw-bold">(<?php echo $target- $total_orders ?>)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Revenue</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">

                                            <h4> <b><?php echo $total_sales ?></b>
                                            </h4>
                                            <span class="text-success small pt-1 fw-bold"></span>
                                            <span class="text-muted small pt-2 ps-1">Today</span>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Customers </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php echo $clientCount['total'] ?></h6>
                                            <span class="text-danger small pt-1 fw-bold"></span>
                                            <span class="text-muted small pt-2 ps-1">Today</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- End Customers Card -->


                        <!-- Today's Sales -->
                        <!-- My sales by product -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Sales by Representative</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>


                                                <th scope="col">Sales Rep.</th>
                                                <th scope="col">Quantities</th>
                                                <th scope="col">Amount (Kshs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $a=$db->query("select sum(o.amount) as tot_sales,sum(o.quantity) as tot_quantity,
                                        concat(u.first_name, ' ', u.last_name) as sold_by  from  orders o 
                                            left join users u on o.user_id = u.id 
                                            where o.date_created >= curdate()
                                            group by o.user_id");
                                            while($row=$a->fetch_array()){
                                            ?>
                                            <tr>

                                                <td><?php echo $row['sold_by']; ?></td>
                                                <td><?php echo $row['tot_quantity']; ?></td>
                                                <td><?php echo $row['tot_sales']; ?></td>
                                               

                                            </tr>
                                            <?php
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- End of today' sales -->

                                                <!-- My sales by product -->
                                                <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Sales by Brand</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>


                                                <th scope="col">Brand</th>
                                                <th scope="col">Quantities</th>
                                                <th scope="col">Amount (Kshs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $a=$db->query("select sum(o.amount) as tot_sales,sum(o.quantity) as tot_quantity,
                                         b.name as product
                                        from  orders o
                                            left join product p on o.brand_id = p.id 
                                            left join brand b on o.brand_id = b.id 
                                            where o.date_created >= curdate()
                                            group by o.brand_id ");
                                            while($row=$a->fetch_array()){
                                            ?>
                                            <tr>

                                                <td><?php echo $row['product']; ?></td>
                                                <td><?php echo $row['tot_quantity']; ?></td>
                                                <td><?php echo $row['tot_sales']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- End of sales by product -->

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
                      $query = "SELECT c.id as client_id,trading_name,concat(c.first_name, ' ', c.last_name) as owner_name,email,phone,id_no,
                        curLocation,city2,c.comment,ct.name as contacttype,ot.name as shoptype, 
                          concat(u.first_name, ' ', u.last_name) as username,
                         cityLat,cityLng,c.date_created, outlet_type_id, user_id FROM checkin c
                          left join outlet_type ot on c.outlet_type_id = ot.id
                          left join users u on c.user_id = u.id
                          left join contact_type ct on c.contacttype_id = ct.id 
                          where c.date_created >= curdate() ";
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

                        <!-- My sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">My Sales</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Client</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount (Kshs)</th>
                                                <th scope="col">Date Sold</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                      $query = "SELECT s.id as sale_id,s.amount,concat(u.first_name, ' ', u.last_name) as sold_by,
                      c.trading_name, pt.name as paymentmode,s.date_created as saledate, pr.name as product, s.client_id as id
                      FROM sales s
                      left join users u on s.userid = u.id
                      left join checkin c on s.client_id = c.id
                      left join payment p on s.id = p.sales_id
                      left join product pr on s.product_id = pr.id
                      left join payment_type pt on p.payment_type_id = pt.id
                        where  s.date_created >= curdate() ";
                      $orders = mysqli_query($db, $query);

                      if (mysqli_num_rows($orders) > 0) {
                        $sn = 1;
                        foreach ($orders as $order) {
                      ?>
                                            <tr>
                                                <th scope="row"><a href="#">#<?php echo $sn; ?></a></th>
                                                <td><?php echo $order['trading_name'] ?></td>
                                                <td><a href="order_details.php?id=<?= $order['sale_id']; ?>"
                                                        class="text-primary"><?php echo $order['product'] ?></a></td>
                                                <td><?php echo $order['amount'] ?></td>
                                                <td><?= $order['saledate'] ?></td>
                                                <td>
                                                    <a href="sales_order.php?id=<?= $order['id']; ?>"
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
                        </div><!-- End of My sales -->

                        <!-- My sales by product -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">My Sales by Product</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>


                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $a=$db->query("select p.name as product,sum(s.amount) as tot_sales from  sales s 
                                            left join product p on s.product_id = p.id where s.date_created >= curdate()
                                            group by s.product_id ");
                                            while($row=$a->fetch_array()){
                                            ?>
                                            <tr>

                                                <td><?php echo $row['product']; ?></td>
                                                <td><?php echo $row['tot_sales']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- End of sales by product -->

                        <!-- My sales by shop -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Sales by Shop</h5>
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>


                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        $a=$db->query("select s.*,c.trading_name,sum(amount) as tot_sales from  sales s 
                                            left join checkin c on s.client_id = c.id where s.date_created >= curdate()
                                            group by s.client_id ");
                                            while($row=$a->fetch_array()){
                                            ?>
                                            <tr>

                                                <td><?php echo $row['trading_name']; ?></td>
                                                <td><?php echo $row['tot_sales']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div><!-- End of sales by shop -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activities <span>| <button
                                        onclick="location.href = 'new_client.php';" type="submit"
                                        class="btn btn-primary">Add Client</button></span></h5>
                            <div class="activity">

                                <?php
                                    $query2 = "SELECT s.id as sale_id,s.amount,concat(u.first_name, ' ', u.last_name) as sold_by,
                                    c.trading_name, pt.name as paymentmode, TIMESTAMPDIFF(HOUR, s.date_created, NOW()) AS duration, pr.name as product, s.client_id as id
                                    FROM sales s
                                    left join users u on s.userid = u.id
                                    left join checkin c on s.client_id = c.id
                                    left join payment p on s.id = p.sales_id
                                    left join product pr on s.product_id = pr.id
                                    left join payment_type pt on p.payment_type_id = pt.id
                                    where DATE(s.date_created) = CURDATE() ";
                                    $visits = mysqli_query($db, $query2);
                                    if (mysqli_num_rows($visits) > 0) {
                                    $visit = mysqli_fetch_assoc($visits);
                                    } 
                                        
                                if(mysqli_num_rows($visits) > 0)
                                {
                                  $sn=1;
                                    foreach($visits as $visit)
                                    {
                                        ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?php echo $visit ['duration'] ?> hrs ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content"><b><?php echo $visit ['sold_by'] ?> </b> Sold
                                        <b><?php echo $visit ['product'] ?></b> worth
                                        <?php echo $visit ['amount'] ?> to <a href="#"
                                            class="fw-bold text-dark"><?php echo $visit ['trading_name'] ?></a>
                                    </div>
                                </div><!-- End sales item-->
                                <?php
                                                  $sn++;
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5>  </h5>";
                                    }
                                ?>

                                <?php
                                    $query2 = "SELECT checkin.id as client_id,trading_name,concat(checkin.first_name, ' ', checkin.last_name) as owner_name,email,phone,id_no,
                                    curLocation,city2,checkin.comment,contact_type.name as contacttype,outlet_type.name as shoptype, 
                                      concat(users.first_name, ' ', users.last_name) as username,
                                     TIMESTAMPDIFF(HOUR,checkin.date_created, NOW()) AS duration,checkin.comment, outlet_type_id, user_id
                                      FROM checkin
                                      left join outlet_type on checkin.outlet_type_id = outlet_type.id
                                      left join users on checkin.user_id = users.id
                                      left join contact_type on checkin.contacttype_id = contact_type.id
                                      where DATE(checkin.date_created) = CURDATE() ";
                                    $visits = mysqli_query($db, $query2);
                                    if (mysqli_num_rows($visits) > 0) {
                                    $visit = mysqli_fetch_assoc($visits);
                                    } 
                                        
                                if(mysqli_num_rows($visits) > 0)
                                {
                                  $sn=1;
                                    foreach($visits as $visit)
                                    {
                                        ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?php echo $visit ['duration'] ?> hrs ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                    <div class="activity-content"><b><?php echo $visit ['username'] ?> </b> added a new
                                        client <b><?php echo $visit ['trading_name'] ?></b>
                                    </div>
                                </div><!-- End new client item-->
                                <?php
                                                  $sn++;
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5>  </h5>";
                                    }
                                ?>

                                <?php
                                    $query2 = "SELECT v.id as visit_id,v.comment,v.client_id,c.trading_name,concat(u.first_name, ' ',u.last_name) as visited_by,
                                    TIMESTAMPDIFF(HOUR, v.date_created, NOW()) AS duration, r.name as reason
                                    FROM visit as v
                                    left join users as u on v.userid = u.id
                                    left join checkin as c on v.client_id = c.id
                                    left join visit_reason as r on v.visitreason_id = r.id
                                    where DATE(v.date_created) = CURDATE()";
                                    $visits = mysqli_query($db, $query2);
                                    if (mysqli_num_rows($visits) > 0) {
                                    $visit = mysqli_fetch_assoc($visits);
                                    } 
                                        
                                if(mysqli_num_rows($visits) > 0)
                                {
                                  $sn=1;
                                    foreach($visits as $visit)
                                    {
                                        ?>
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><?php echo $visit ['duration'] ?> hrs ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    <div class="activity-content"><b><?php echo $visit ['visited_by'] ?></b> made a
                                        <?php echo $visit ['reason'] ?> for <a href="#"
                                            class="fw-bold text-dark"><?php echo $visit ['trading_name'] ?></a> --
                                        <?php echo $visit ['comment'] ?>
                                    </div>
                                </div><!-- End visit item-->
                                <?php
                                                  $sn++;
                                        }
                                    }
                                    else
                                    {
                                        echo " ";
                                    }
                                ?>

                            </div>

                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Product Report -->
                    <div class="card">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Products Report </h5>
                            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                            <?php
                      $query = " select sum(o.amount) as tot_sales,sum(o.quantity) as tot_quantity,
                      b.name as product
                     from  orders o
                         left join product p on o.brand_id = p.id 
                         left join brand b on o.brand_id = b.id 
                         where o.date_created >= curdate()
                         group by o.brand_id  ";
                      $orders = mysqli_query($db, $query);

                      if (mysqli_num_rows($orders) > 0) {
                        $sn = 1;
                        foreach ($orders as $order) {
                      ?>

                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Sales Today',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                            value: <?php echo $order['tot_sales'] ?>,
                                            name: '<?php echo $order['product'] ?>'
                                        }]
                                    }]
                                });
                            });
                            </script>
                            <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No Record Found </h5>";
                      }
                      ?>
                        </div>
                    </div><!-- End Website Traffic -->

                    <!-- News & Updates Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">News &amp; Updates <span>| This Week</span></h5>
                            <?php
                                    $query2 = "SELECT * from news
                                    where WEEK(date_created) = WEEK(CURDATE())";
                                    $news = mysqli_query($db, $query2);
                                    if (mysqli_num_rows($news) > 0) {
                                    $new = mysqli_fetch_assoc($news);
                                    } 
                                        
                                if(mysqli_num_rows($news) > 0)
                                {
                                  $sn=1;
                                    foreach($news as $new)
                                    {
                                        ?>
                            <div class="news">
                                <div class="post-item clearfix">
                                    <!-- <img src="assets/img/news-1.jpg" alt=""> -->
                                    <h4><a href="#"><?php echo $new ['topic'] ?></a></h4>
                                    <p><?php echo $visit ['body'] ?></p>
                                </div>
                                <?php
                          $sn++;
                        }
                      } else {
                        echo "<h5> No news Found </h5>";
                      }
                      ?>
                            </div><!-- End sidebar recent posts-->

                        </div>
                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <?php include('inc/footer.php'); ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
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