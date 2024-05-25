<?php
require('connect.php');
include('logged_user.php');
include('errors.php');
$errors = array();
$product_id = mysqli_real_escape_string($db, $_GET['id']);
$client_id = mysqli_real_escape_string($db, $_GET['client_id']);

$clientdetails = "SELECT c.*,t.name as outlet, c.outlet_type_id FROM checkin as c
left join outlet_type t on c.outlet_type_id = t.id
 where c.id = $client_id ";
$result =  mysqli_query($db, $clientdetails);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  //$client_id = $row['id'];
  $trading_name = $row['trading_name'];
  $outlet = $row['outlet'];
  $outlet_type_id =$row['outlet_type_id'];
}

if (isset($_GET['id'])) {
  $product_id = mysqli_real_escape_string($db, $_GET['id']);
  echo $product_id;
  $product_details = "select * from product where id = $product_id ";
  $result =  mysqli_query($db, $product_details);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $product_id = $row['id'];
    $product_name = $row['name'];
  }
}



?>
<!DOCTYPE html>
<html lang="en">
<!-- ======= Head ======= -->
<?php include('inc/headjs.php'); ?>
<!-- ======= Head ======= -->

<body>
  <!-- ======= Header ======= -->
  <?php include('inc/header.php');?>
  <!-- End Header -->
 <!-- ======= Sidebar ======= -->
 <?php include('inc/saleside.php');?>
  <!-- End Sidebar-->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?php echo "$trading_name" ?></h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="sales.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">You are making an order for <span
                                    class="text-success pt-2 fw-bold"><?php echo $product_name ?></span> at a <span
                                    class="text-success pt-2 fw-bold"><?php echo $outlet ?></span> price on
                                <span class="text-success pt-2 fw-bold"><?php echo $trading_name ?></span>'s account.
                            </h5>
                            <!-- General Form Elements -->

                            <form class="row g-3 needs-validation" id="form" novalidate method="post" autocomplete="off"
                                action="sales_transaction.php">
                                <?php include('errors.php'); ?>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id ?>" />
                                <input type="hidden" id="product_id" name="product_id"
                                    value="<?php echo $product_id ?>" />
                                <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id ?>" />
                                <div class="form-group row">
                                                                        <?php
                                                    $outlet_type = $role_id;
                                                    $query = "SELECT ot.id,b.name as brand, b.id as brand_id, p.name as product,ot.name as outlet,
                                                            unit_cost, pc.id as product_cost_id, b.brandimage
                                                            FROM product_cost pc
                                                            left JOIN outlet_type ot ON ot.id=pc.outlet_type_id 
                                                            left JOIN product p ON p.id=pc.product_id
                                                            left JOIN brand b ON b.id=pc.brand_id
                                                            where ot.id = '$outlet_type_id' and b.product_id = $product_id ";
                                                    $rows = mysqli_query($db, $query);
                                                    while ($row = mysqli_fetch_array(
                                                        $rows,
                                                        MYSQLI_ASSOC
                                                    )) :;
                                                    ?>
                                    <div class="col-sm-3">
                                        <div class="col-sm-10 offset-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input brand" type="checkbox"
                                                    id="brand<?php echo $row["brand_id"]; ?>" name="brand[]"
                                                    value="<?php echo $row["brand_id"]; ?>">
                                                <!-- <input type="hidden"  id="product_cost_id<?php echo $row["brand_id"]; ?>" name="product_cost_id<?php echo $row["brand_id"]; ?>" > -->
                                                <label class="form-check-label" for="gridCheck1">
                                                    <?php echo $row["brand"]; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="col-sm-10">
                                            <a href="#"><img src="image/<?= $row['brandimage']?>" width="90"
                                                    height="100" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- <label for="validationCustom04" class="form-label">Packets</label> -->
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="Quantity"
                                                id="quantity<?php echo $row["brand_id"]; ?>"
                                                name="quantity<?php echo $row["brand_id"]; ?>"
                                                class="form-control quantity" data-quantity min=1>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- <label for="inputEmail" class="form-label">Amount</label> -->
                                        <div class="col-sm-10">
                                            <input type="hidden" id="userid" name="userid"
                                                value="<?php echo $user_id ?>" />
                                            <input type="hidden" id="client_id" name="client_id"
                                                value="<?php echo $client_id ?>" />
                                            <input type="hidden" id="product_cost_id<?php echo $row["brand_id"]; ?>"
                                                name="product_cost_id<?php echo $row["brand_id"]; ?>"
                                                value="<?php echo $row["product_cost_id"]; ?>">
                                            <input class="unit_cost" type="hidden"
                                                id="unit_cost<?php echo $row["brand_id"]; ?>"
                                                name="unit_cost<?php echo $row["brand_id"]; ?>"
                                                value="<?php echo $row["unit_cost"]; ?>">
                                            <input type="number" id="cost<?php echo $row["brand_id"]; ?>"
                                                name="cost<?php echo $row["brand_id"]; ?>" value="0"
                                                class="form-control cost" disabled>
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
                                            <select class="form-select" id="paymentmode" name="paymentmode"
                                                value="<?php echo $paymentmode; ?>" required>
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
                                            <input type="text" placeholder="Transaction Code" id="" name="code"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail" class="form-label">Amount</label>
                                        <div class="col-sm-10">
                                            <input type="number" placeholder="Amount" id="amount" name="amount"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                </div>
                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Comment</label>
                                    <div class="col-md-8 col-lg-9">
                                        <textarea class="form-control" style="height: 50px" name="comment"
                                            value="<?php echo $comment; ?>" id="comment" required></textarea>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please put your comment
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" name="add_sales_transaction"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            <!-- End General Form Elements -->
                            </div><!-- End sidebar recent posts-->

                        </div>
                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->
        </section>
    </main><!-- End #main -->
    <?php include('inc/footer.php'); ?>
    <?php include('inc/footjs.php'); ?>
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