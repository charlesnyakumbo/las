<?php
require('connect.php');
include('logged_user.php');
include('errors.php');
$errors = array();
$product_id = mysqli_real_escape_string($db, $_GET['product']);

$clientdetails = "SELECT c.*,t.name as outlet FROM checkin as c
left join outlet_type t on c.outlet_type_id = t.id
 where c.id = $company_id ";
$result =  mysqli_query($db, $clientdetails);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $clint_id = $row['id'];
  $trading_name = $row['trading_name'];
  $outlet = $row['outlet'];
}

if (isset($_GET['product'])) {
  $product_id = mysqli_real_escape_string($db, $_GET['product']);
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
  <?php include('inc/header.php'); ?>
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
    <div class="pagetitle">
      <h1><?php echo "$trading_name" ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="client_area.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
      <div class="row">
        <div class="">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">You are making an order for <span class="text-success pt-2 fw-bold"><?php echo $product_name ?></span> at a <span class="text-success pt-2 fw-bold"><?php echo $outlet ?></span> price</h5>
              <!-- General Form Elements -->

              <form class="row g-3 needs-validation" id="form" novalidate method="post" autocomplete="off" action="transaction.php">
                <?php include('errors.php'); ?>
                <input type="hidden" id="userid" name="userid" value="<?php echo $user_id ?>" />
                <!-- <input type="" id="userid" name="userid" value="<?php echo $role_id ?>" /> -->
                <input type="hidden" id="userid" name="product_id" value="<?php echo $product_id ?>" />
                <input type="hidden" id="client_id" name="retailerid" value="<?php echo $company_id ?>" />
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>" />
                <input type="hidden" id="company_id" name="user_type" value="<?php echo $user_type ?>" />
                <div class="form-group row">
                  <?php
                  $outlet_type = $role_id;
                  $query = "SELECT outlet_type.id,brand.name as brand,
                          brand.id as brand_id, product.name as product,outlet_type.name as outlet,
                          unit_cost, product_cost.id as product_cost_id
                           FROM product_cost 
                          left JOIN outlet_type ON outlet_type.id=product_cost.outlet_type_id 
                          left JOIN product ON product.id=product_cost.product_id
                          left JOIN brand ON brand.id=product_cost.brand_id
                          where outlet_type.id = '$outlet_type' and brand.product_id = $product_id ";
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
              <!-- End General Form Elements -->
            </div>
          </div>
        </div>

      </div>
      </div><!-- End Left side columns -->
      </div>
      </div><!-- End News & Updates -->
      </div><!-- End Right side columns -->
      </div>
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