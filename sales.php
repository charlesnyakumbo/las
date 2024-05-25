<?php
require('connect.php');
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
$a=$db->query("select amount from sales where date_created >= curdate() and userid = '$user_id' ");
while($arow=$a->fetch_array()){
$total_sales += $arow['amount'];
}

//toatl orders
$a=$db->query("select quantity from orders where date_created >= curdate() and user_id = '$user_id' ");
while($row=$a->fetch_array()){
$total_orders += $row['quantity'];
}

//quantity sold
$sql = "SELECT COUNT(brand_id) AS total FROM orders where date_created >= curdate() and user_id = '$user_id' ";
$result = mysqli_query($db, $sql);
$ordersCount = mysqli_fetch_assoc($result);

//clients registered
$sql = "SELECT COUNT(id) AS total FROM checkin where date_created >= curdate() and user_id = '$user_id' ";
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
    <?php include('inc/header.php'); ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include('inc/saleside.php'); ?>
    <!-- End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="sales.php">Home</a></li>
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
                                            <span class="text-success small pt-1 fw-bold">(<?php echo $target- $total_orders ?>)</span>
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
                                            <span
                                                class="text-success small pt-1 fw-bold"></span>
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
                                            <span
                                                class="text-danger small pt-1 fw-bold"></span>
                                            <span class="text-muted small pt-2 ps-1">Today</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- End Customers Card -->

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
                          left join contact_type on checkin.contacttype_id = contact_type.id 
                          where checkin.user_id = $user_id ";
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
                        where s.userid = $user_id and s.date_created >= curdate() ";
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
                                            left join product p on s.product_id = p.id where userid = '$user_id' and s.date_created >= curdate()
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
                                            left join checkin c on s.client_id = c.id where userid = '$user_id' and s.date_created >= curdate()
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
                      $query = "SELECT s.id as sale_id,s.amount,concat(u.first_name, ' ', u.last_name) as sold_by,
                      c.trading_name, pt.name as paymentmode,s.date_created as saledate, pr.name as product, s.client_id as id
                      FROM sales s
                      left join users u on s.userid = u.id
                      left join checkin c on s.client_id = c.id
                      left join payment p on s.id = p.sales_id
                      left join product pr on s.product_id = pr.id
                      left join payment_type pt on p.payment_type_id = pt.id
                        where s.userid = $user_id ";
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
                                        name: 'Access From',
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
                                            value: <?php echo $order['amount'] ?>,
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