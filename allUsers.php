<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- ======= Head ======= -->
<?php include('inc/headjs.php');?>
<!-- ======= Head ======= -->

<body>
    <!-- ======= Header ======= -->
    <?php include('inc/header.php');?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include('inc/side.php');?>
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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $tot_clients ?>
                                            </h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>
                                                <?php echo $tot_sales ?>
                                            </h6>
                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Kshs. <?php echo $sum_revenue ['sum(amount)']  ?></h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-exchange"></i>
                                        </div>
                                        <div class="ps-3">


                                            <h6>Kshs. <?php echo $sum_new_sale ['sum(amount)']  ?></h6>

                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                        </div>
                                        <div class="ps-3">

                                            <h6>Kshs. <?php echo $sum_approved_sale ['sum(amount)']  ?></h6>

                                            <span class="text-success small pt-1 fw-bold">12%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

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
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hand-thumbs-down"></i>

                                        </div>
                                        <div class="ps-3">
                                            <h6>Kshs. <?php echo $sum_rejected_sale ['sum(amount)']  ?></h6>
                                            <span class="text-success small pt-1 fw-bold">8%</span> <span
                                                class="text-muted small pt-2 ps-1">increase</span>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div><!-- End Rejected Card -->
                        <!-- All Users-->
                        <div class="col-18">
                            <div class="card recent-sales overflow-auto">
                                <!-- 
              <div class="">
                  <button  onclick="location.href = 'new_retailer.php';"  type="submit" class="btn btn-primary">Add Client</button>
                </div> -->

                                <div class="card-body">
                                    <h5 class="card-title">Actual Users <span>| Today</span></h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Company</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                   
                                    $query = 'SELECT users.id,first_name,last_name, role.name as role,company.name as company,status FROM 
                                    users left JOIN role ON role.id=users.role_id left JOIN company ON company.id=users.company_id' ; 
                                    $users = mysqli_query($db, $query);

                                    if(mysqli_num_rows($users) > 0)
                                    {
                                      $sn=1;
                                        foreach($users as $user)
                                        {
                                            ?>
                                            <tr>
                                                <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                                <td><a href="#" class="text-primary"><?= $user['first_name'] ?>
                                                        <?= $user['last_name']; ?></td>
                                                <td><?= $user['role'] ?></td>
                                                <td><?= $user['company'] ?></td>

                                                <td><?= $user['status'] ?></td>
                                                <!-- <td><span class="badge bg-success"><?= $user['contacttype'] ?></td> -->
                                                <td>
                                                    <a href="update_client.php?id=<?= $user['id']; ?>"
                                                        class="btn btn-primary btn-sm">View</a>
                                                    <a href="updateActualUsers.php?id=<?= $user['id']; ?>"
                                                        class="btn btn-success btn-sm">Edit</a>
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
                        $query = "SELECT checkin.id as client_id,trading_name,concat(users.first_name, ' ', users.last_name) as owner_name,email,phone,id_no,
                           curLocation,city2,checkin.comment,contact_type.name as contacttype,outlet_type.name as shoptype, 
                             concat(users.first_name, ' ', users.last_name) as username,
                            cityLat,cityLng,checkin.date_created,checkin.comment, outlet_type_id, user_id FROM checkin
                             left join outlet_type on checkin.outlet_type_id = outlet_type.id
                             left join users on checkin.user_id = users.id
                             left join contact_type on checkin.contacttype_id = contact_type.id ";
                                    $clients = mysqli_query($db, $query);

                                    if(mysqli_num_rows($clients) > 0)
                                    {
                                      $sn=1;
                                        foreach($clients as $client)
                                        {
                                            ?>
                                            <tr>
                                                <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                                <td><a href="#" class="text-primary"><?= $client['trading_name']; ?>
                                                </td>
                                                <td><?= $client['owner_name'] ?></td>
                                                <td><?= $client['contacttype'] ?></td>
                                                <td><?= $client['phone'] ?></td>
                                                <td><?= $client['shoptype'] ?></td>
                                                <td><?= $client['username'] ?></td>
                                                <td>
                                                    <a href="update_client.php?id=<?= $client['client_id']; ?>"
                                                        class="btn btn-primary btn-sm">View</a>
                                                    <a href="updateUser.php?id=<?= $client['client_id']; ?>"
                                                        class="btn btn-success btn-sm">Edit</a>
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
                        <!-- Horizontal Form -->


                        <!-- Recent sales -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add a new company</h5>

                                <!-- General Form Elements -->
                                <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                    enctype="multipart/form-data" action="code.php">
                                    <?php include('errors.php'); ?>

                                    <div class="row mb-3">
                                    </div>

                                    <div class="form-group row">

                                        <!-- add company -->
                                        <div class="form-group row">
                                            <div class="col-sm-6" id="company">
                                                <label for="inputTime" class="form-label">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input name="company" type="text" class="form-control" id="company">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Company Image</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="file" name="companyimage"
                                                        value="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <button type="submit" name="add_company"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                </form><!-- End General Form Elements -->

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date Entered</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    $query = "SELECT * FROM company ";
                                    // $query = "SELECT * FROM checkin WHERE id='$client_id' and user_id='$user_id'  ";
                                    $users = mysqli_query($db, $query);

                                    if(mysqli_num_rows($users) > 0)
                                    {
                                      $sn=1;
                                        foreach($users as $user)
                                        {
                                            ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                            <td><a href="#" class="text-primary"><?= $user['id']; ?></td>
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['date_created'] ?></td>
                                            <td>
                                                <a href="update_client.php?id=<?= $user['id']; ?>"
                                                    class="btn btn-primary btn-sm">View</a>
                                                <a href="updateActualUsers.php?id=<?= $user['id']; ?>"
                                                    class="btn btn-success btn-sm">Edit</a>
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
                    </div>

                    <!-- End General Form Elements -->

                                            
                        <!-- Recent sales -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add a new Product</h5>

                                <!-- General Form Elements -->
                                <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                    enctype="multipart/form-data" action="code.php">
                                    <?php include('errors.php'); ?>

                                    <div class="row mb-3">
                                    </div>

                                    <div class="form-group row">

                                        <!-- add company -->
                                        <div class="form-group row">
                                            <div class="col-sm-6" id="company">
                                                <label for="inputTime" class="form-label">Product Name</label>
                                                <div class="col-sm-10">
                                                    <input name="product" type="text" class="form-control" id="product">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Product Image</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="file" name="productimage"
                                                        value="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <button type="submit" name="add_product"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                </form><!-- End General Form Elements -->

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date Entered</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    $query = "SELECT * FROM product ";
                                    // $query = "SELECT * FROM checkin WHERE id='$client_id' and user_id='$user_id'  ";
                                    $users = mysqli_query($db, $query);

                                    if(mysqli_num_rows($users) > 0)
                                    {
                                      $sn=1;
                                        foreach($users as $user)
                                        {
                                            ?>
                                        <tr>
                                            <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['date_created'] ?></td>
                                            <td>
                                                <a href="update_client.php?id=<?= $user['id']; ?>"
                                                    class="btn btn-primary btn-sm">View</a>
                                                <a href="updateActualUsers.php?id=<?= $user['id']; ?>"
                                                    class="btn btn-success btn-sm">Edit</a>
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
                    </div>

                    <!-- End General Form Elements -->

                    <!-- Recent sales -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add a Role</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                action="code.php">
                                <?php include('errors.php'); ?>

                                <div class="row mb-3">
                                </div>

                                <div class="form-group row">

                                    <!-- add role -->
                                    <div class="form-group row">
                                        <div class="col-sm-8" id="role">
                                            <label for="inputTime" class="form-label">Role</label>
                                            <div class="col-sm-10">
                                                <input name="role" type="text" class="form-control" id="role">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <button type="submit" name="add_role"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                            </form><!-- End General Form Elements -->

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date Entered</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = "SELECT * FROM role ";
                                    // $query = "SELECT * FROM checkin WHERE id='$client_id' and user_id='$user_id'  ";
                                    $users = mysqli_query($db, $query);

                                    if(mysqli_num_rows($users) > 0)
                                    {
                                      $sn=1;
                                        foreach($users as $user)
                                        {
                                            ?>
                                    <tr>
                                        <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                        <td><a href="#" class="text-primary"><?= $user['id']; ?></td>
                                        <td><?= $user['name']?></td>
                                        <td><?= $user['date_created'] ?></td>
                                        <td>
                                            <a href="update_client.php?id=<?= $user['id']; ?>"
                                                class="btn btn-primary btn-sm">View</a>
                                            <a href="updateActualUsers.php?id=<?= $user['id']; ?>"
                                                class="btn btn-success btn-sm">Edit</a>
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
                </div>

                <!-- End General Form Elements -->

                <!-- Add a brand -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Brand</h5>

                        <!-- Brand form -->
                        <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                            enctype="multipart/form-data" action="code.php">
                            <?php include('errors.php'); ?>

                            <div class="row mb-3">
                            </div>

                            <div class="form-group row">
                                <!-- add cost product mapping-->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="validationCustom04" class="form-label">Company</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="role" name="company" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                                    $query = "SELECT * FROM company ";
                                                                    $companies = mysqli_query($db, $query);
                                                              while ($company = mysqli_fetch_array(
                                                                      $companies,MYSQLI_ASSOC)):;
                                                          ?>
                                                <option value="<?php echo $company["id"]; ?>">
                                                    <?php echo $company["name"]; ?>
                                                </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="inputNumber" class="form-label">Product</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="product" name="product" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                              $query = "SELECT * FROM product ";
                                                              $rows = mysqli_query($db, $query);
                                                        while ($row = mysqli_fetch_array(
                                                                $rows,MYSQLI_ASSOC)):;
                                                    ?>
                                                <option value="<?php echo $row["id"];?>">
                                                    <?php echo $row["name"]; ?>
                                                </option>
                                                <?php endwhile; ?>
                                            </select>
                                            <div class="invalid-feedback">Please enter email!</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="inputPassword" class="form-label">Brand</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Brand Name" id="brand" name="brand"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Brand Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="brandimage" value="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" name="add_brand" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                        </form><!-- End of brand -->

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = 'SELECT b.id,company.name as company,b.name as brand,b.brandimage, product.name as product FROM 
                                    brand b
                                    left JOIN company ON company.id = b.company_id 
                                    left JOIN product ON product.id = b.product_id' ; 
                                    $rows = mysqli_query($db, $query);

                                    if(mysqli_num_rows($rows) > 0)
                                    {
                                      $sn=1;
                                        foreach($rows as $row)
                                        {
                                            ?>
                                <tr>
                                    <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                    <td><a href="#" class="text-primary"><?= $row['company']?></td>
                                    <td><?= $row['product'] ?></td>
                                    <td><?= $row['brand']?></td>
                                    <th scope="row"><a href="#"><img src="image/<?= $row['brandimage']?>" alt=""></a>
                                    </th>
                                    <td>
                                        <!-- <a href="update_client.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View</a> -->
                                        <a href="update_brand.php?brand_id=<?= $row['id']; ?>"
                                            class="btn btn-success btn-sm">Edit</a>
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
            </div>

            <!-- End General Form Elements -->

            <!-- Cost Product Mapping -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Map Product to cost</h5>

                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                        action="code.php">
                        <?php include('errors.php'); ?>

                        <div class="row mb-3">
                        </div>

                        <div class="form-group row">
                            <!-- add cost product mapping-->
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="validationCustom04" class="form-label">Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="company" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM company ";
                      $companies = mysqli_query($db, $query);
                while ($company = mysqli_fetch_array(
                        $companies,MYSQLI_ASSOC)):;
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
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="inputNumber" class="form-label">Product</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="product" name="product" required>
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
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputPassword" class="form-label">Brand</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM brand ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="inputNumber" class="form-label">Quality</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="quality" name="quality" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM product_quality ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="inputNumber" class="form-label">Outlet Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="outlet" name="outlet" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM outlet_type ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputPassword" class="form-label">Unit Cost</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" placeholder="Unit Cost" id="cost" name="cost"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" name="add_cost_mapping"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                    </form><!-- End General Form Elements -->

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Company</th>
                                <th scope="col">Product</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Outlet</th>
                                <th scope="col">Unit Cost</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $query = 'SELECT outlet_type.id,company.name as company,brand.name as brand, product.name as product,outlet_type.name as outlet,unit_cost FROM 
                                    product_cost 
                                    left JOIN company ON company.id=product_cost.company_id 
                                    left JOIN outlet_type ON outlet_type.id=product_cost.outlet_type_id 
                                    left JOIN product ON product.id=product_cost.product_id
                                    left JOIN brand ON brand.id=product_cost.brand_id ' ; 
                                    $rows = mysqli_query($db, $query);

                                    if(mysqli_num_rows($rows) > 0)
                                    {
                                      $sn=1;
                                        foreach($rows as $row)
                                        {
                                            ?>
                            <tr>
                                <th scope="row"><a href="#"><?php echo $sn; ?></a></th>

                                <td><a href="#" class="text-primary"><?= $row['id']?></td>

                                <td><?= $row['product'] ?></td>
                                <td><?= $row['brand']?></td>
                                <td><?= $row['outlet'] ?></td>
                                <td><?= $row['unit_cost'] ?></td>
                                <td>
                                    <!-- <a href="update_client.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">View</a> -->
                                    <a href="update_product.php?id=<?= $row['id']; ?>"
                                        class="btn btn-success btn-sm">Edit</a>
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
            </div>

            <!-- End General Form Elements -->


            <!-- Recent sales -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Pending <span>| Orders</span></h5>
                        <?php
        $query3 = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status
        FROM sales
        left join users on sales.userid = users.id
        left join checkin on sales.client_id = checkin.id
        left join payment on sales.id = payment.sales_id
    left join payment_type on payment.payment_type_id = payment_type.id
         where sales.status = 3 and payment.payment_type_id <> 1 ";
       $orders = mysqli_query($db, $query3);
       ?>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Payment Mode</th>
                                    <th scope="col">Amount (Kshs)</th>
                                    <th scope="col">Sold by</th>
                                    <th scope="col">Date Sold</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
          if(mysqli_num_rows($orders) > 0)
          {
            $sn=1;
              foreach($orders as $order)
              {
                  ?>
                                <tr>
                                    <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                    <td><a href="#" class="text-primary"><?php echo $order ['trading_name'] ?></td>
                                    <td><?= $order['paymentmode'] ?></td>
                                    <td><?php echo $order ['amount'] ?></td>
                                    <td><?php echo $order ['sold_by'] ?></td>
                                    <td><?= $order['saledate'] ?></td>
                                    <!-- <td><span class="badge bg-danger"><?= $order['orderstatus'] ?></td>  -->
                                    <!-- <td>
                                                  <a href="update_retailer.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                  <!-- <a href="edit_retailer.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
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
            </div>
            <!--End Recent Sales -->

            <!-- Approved Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Approved <span>| Orders</span></h5>
                        <?php
        $query3 = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
        checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status
                FROM sales
                left join users on sales.userid = users.id
                left join checkin on sales.client_id = checkin.id
                left join payment on sales.id = payment.sales_id
            left join payment_type on payment.payment_type_id = payment_type.id
                 where sales.status = 1 and payment.payment_type_id = 1 ";
       $orders = mysqli_query($db, $query3);
       ?>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Payment Mode</th>
                                    <th scope="col">Amount (Kshs)</th>
                                    <th scope="col">Sold by</th>
                                    <th scope="col">Date Sold</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

          if(mysqli_num_rows($orders) > 0)
          {
            $sn=1;
              foreach($orders as $order)
              {
                  ?>
                                <tr>
                                    <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                    <td><a href="#" class="text-primary"><?php echo $order ['trading_name'] ?></td>
                                    <td><?= $order['paymentmode'] ?></td>
                                    <td><?php echo $order ['amount'] ?></td>
                                    <td><?php echo $order ['sold_by'] ?></td>
                                    <td><?= $order['saledate'] ?></td>
                                    <!-- <td><span class="badge bg-danger"><?= $order['orderstatus'] ?></td>  -->
                                    <!-- <td>
                                                  <a href="update_retailer.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                  <!-- <a href="edit_retailer.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
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
            </div>
            <!--End Approved Selling -->

            <!-- Approved Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Rejected <span>| Orders</span></h5>
                        <?php
        $query3 = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
        checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status
                FROM sales
                left join users on sales.userid = users.id
                left join checkin on sales.client_id = checkin.id
                left join payment on sales.id = payment.sales_id
            left join payment_type on payment.payment_type_id = payment_type.id
                 where sales.status = 3  ";
       $orders = mysqli_query($db, $query3);
       ?>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Payment Mode</th>
                                    <th scope="col">Amount (Kshs)</th>
                                    <th scope="col">Sold by</th>
                                    <th scope="col">Date Sold</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

          if(mysqli_num_rows($orders) > 0)
          {
            $sn=1;
              foreach($orders as $order)
              {
                  ?>
                                <tr>
                                    <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                                    <td><a href="#" class="text-primary"><?php echo $order ['trading_name'] ?></td>
                                    <td><?= $order['paymentmode'] ?></td>
                                    <td><?php echo $order ['amount'] ?></td>
                                    <td><?php echo $order ['sold_by'] ?></td>
                                    <td><?= $order['saledate'] ?></td>
                                    <!-- <td><span class="badge bg-danger"><?= $order['orderstatus'] ?></td>  -->
                                    <!-- <td>
                                                  <a href="update_retailer.php?id=<?= $order['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                  <!-- <a href="edit_retailer.php?id=<?= $client['id']; ?>" class="btn btn-success btn-sm">Edit</a> -->
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
            </div>
            <!--End Rejected Sales -->

            </div>
            </div><!-- End Left side columns -->
            </div>
            </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

            </div>
        </section>
    </main><!-- End #main -->
    <?php include('inc/footer.php');?>
    <?php include('inc/footjs.php');?>
</body>

</html>