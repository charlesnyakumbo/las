<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');
if ($user_type == 1) {
  header("refresh:0;url=client_area.php");
}

if (isset($_GET['id'])) {
    $client_id = mysqli_real_escape_string($db, $_GET['id']);
    
    $query = "SELECT c.id as client_id,trading_name,concat(c.first_name, ' ',c.last_name) as owner_name,email,phone,id_no,
    curLocation,city2,comment,ct.name as contacttype,ot.name as shoptype, c.outlet_type_id,
    concat(u.first_name, ' ', u.last_name) as username,ot.name as outlet,
    cityLat,cityLng,c.date_created,c.comment,c.user_id FROM checkin c
    left join outlet_type ot on c.outlet_type_id = ot.id
    left join users u on c.user_id = u.id
    left join contact_type ct on c.contacttype_id = ct.id
     WHERE c.id='$client_id' ";

    $details =  mysqli_query($db, $query);
    if (mysqli_num_rows($details) > 0) {
      $detail = mysqli_fetch_assoc($details);
      $client_id = $detail['client_id'];
      $trading_name = $detail['trading_name'];
      $outlet = $detail['outlet'];
      $comment = $detail['comment'];
      $contact_person = $detail['owner_name'];
      $contacttype = $detail['contacttype'];
      $phone = $detail['phone'];
      $email = $detail['email'];
      $shoptype = $detail['shoptype'];
      $shopaddress = $detail['curLocation'];
      $city = $detail['city2'];
      $latitude = $detail['cityLat'];
      $longitude = $detail['cityLng'];
    //   $nationalID = $detail[''];
    //   $permit = $detail[''];
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
                <h1><?php echo $trading_name ?> 's Profile</h1>
                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">


                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
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
                                    <h5 class="card-title">Top Selling <span>| Today</span></h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sold</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                    $query = 'SELECT id,name as product,productimage FROM product' ; 
                                    $rows = mysqli_query($db, $query);

                                    if(mysqli_num_rows($rows) > 0)
                                    {
                                      $sn=1;
                                        foreach($rows as $row)
                                        {
                                            ?>
                                            <tr>
                                                <th scope="row"><a href="#"><img src="image/<?= $row['productimage']?>"
                                                            alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold"><?= $row['product']?></a>
                                                </td>
                                                <td><?php echo $client_id ?> </td>
                                                <td class="fw-bold">124</td>
                                                <td>
                                                    <form method="post" autocomplete="off" action=" ">
                                                        <a href="sales_ordering.php?id=<?= $row['id']; ?>&client_id=<?php echo $client_id; ?>"
                                                            class="btn btn-primary btn-sm">Order Now</a>
                                                    </form>

                                                    <!-- <a href="sales_ordering.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View</a> -->
                                                </td>
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
                        </div><!-- End Top Selling -->

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
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
                                    <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query2 = "SELECT o.id as sale_id,o.amount,o.quantity,o.date_created as saledate,o.user_id,o.product_cost_id,
                                                b.name as brand, case when s.status = 1 then 'Approved' when s.status = 2 then 'Rejected' else 'New' end as status
                                                FROM orders as o 
                                                left join brand as b on o.brand_id = b.id
                                                left join sales s on o.date_created = s.date_created
                                                where o.client_id = $client_id ";
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
                                                <td><?php echo $sale ['brand'] ?></td>
                                                <td><a href="#"
                                                        class="text-primary"><?php echo $sale ['quantity'] ?></a></td>
                                                <td><?php echo $sale ['saledate'] ?></td>
                                                <!-- <?php echo "<td style='background-color:".(($sale['status'] = 'Approved') ? '#FF0000;' : '#FFFF00')."'></td>"; ?> -->
                                                <td><span class="badge bg-success"><?php echo $sale ['status'] ?></span>
                                                </td>
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

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">

                    <!-- Recent Activity -->
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
                            <h5 class="card-title">Biodata <span>| Today</span></h5>

                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"><b> </b> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $contact_person ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $contacttype ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $phone ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $email ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $shoptype ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $shopaddress ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $latitude ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label"> </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $longitude ?>
                                    </div>
                                </div><!-- End activity item-->
                            </div>
                            <!-- <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">  </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content"><a href="download.php?file=<?php echo $nationalID ?>" target="blank">
                                        <?php echo $nationalID ?>
                                    </div>
                                </div><!-- End activity item-->
                            <!-- </div>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">  </div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content"><a href="download.php?file=<?php echo $permit ?>" target="blank">
                                        <?php echo $permit ?>
                                    </div>
                                </div><!-- End activity item-->
                            <!-- </div> -->
                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Recent Activity -->
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
                            <h5 class="card-title">Call and Visit <span>| Today</span></h5>

                            <div class="activity">

                                <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                    action="code.php">
                                    <?php include('errors.php'); ?>

                                    <input type="hidden" id="userid" name="userid" value="<?php echo $user_id ?>" />
                                    <input type="hidden" id="retilerid" name="client_id" value="<?php echo $client_id ?>" />


                                    <div class="row mb-3">
                                        <label for="validationCustom04" class="col-md-4 col-lg-3 col-form-label">Visit
                                            Reason</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="visitreason" name="visitreason" required>
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

                                    <div class="row mb-2" id="stock">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Stock
                                            Remaining</label>
                                        <div class="col-md-10 col-lg-9">
                                            <input name="stock" type="number" class="form-control" id="stock" step="1"
                                                min="0" max="499" required>
                                            <div class="invalid-feedback">Please enter the number of items available
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword"
                                            class="col-md-4 col-lg-3 col-form-label">Comment</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea class="form-control" style="height: 50px" name="comment"
                                                id="comment" required></textarea>
                                            <div class="invalid-feedback">Please put your comment </div>
                                        </div>

                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="add_visit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div><!-- End Recent Activity -->

                    <!-- Recent Activity -->
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Recent Visits <span>| Today</span></h5>

                            <div class="activity">
                                <?php
                                    $query2 = "SELECT v.id as visit_id,v.comment,v.client_id,concat(u.first_name, ' ',u.last_name) as visited_by,
                                    TIMESTAMPDIFF(DAY, CURDATE(),v.date_created) AS duration, r.name as reason
                                    FROM visit as v
                                    left join users as u on v.userid = u.id
                                    left join visit_reason as r on v.visitreason_id = r.id
                                    where v.client_id = $client_id ";
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
                                    <div class="activite-label"><?php echo $visit ['duration'] ?> days ago</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        <?php echo $visit ['reason'] ?> by <a href="#"
                                            class="fw-bold text-dark"><?php echo $visit ['visited_by'] ?></a> --
                                        <?php echo $visit ['comment'] ?>
                                    </div>
                                </div><!-- End activity item-->
                                <?php
                                                  $sn++;
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>

                            </div>

                        </div>
                    </div><!-- End Recent Activity -->

                </div><!-- End Right side columns -->
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('inc/footer.php'); ?>

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