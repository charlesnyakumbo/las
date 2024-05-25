<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');
//specific order details
if (isset($_GET['id'])) {
  $order_id = mysqli_real_escape_string($db, $_GET['id']);
  $query = "SELECT sales.id as sale_id,sales.amount,concat(users.first_name, ' ', users.last_name) as sold_by,
    checkin.trading_name, payment_type.name as paymentmode,sales.date_created as saledate, sales.status,
    sales.client_id,checkin.email,checkin.phone,checkin.curLocation,
    concat(checkin.first_name, ' ', checkin.last_name) as owner_name,sales.userid,product.name as product
    FROM sales
    left join users on sales.userid = users.id
    left join product on sales.product_id = product.id
    left join checkin on sales.client_id = checkin.id
    left join payment on sales.id = payment.sales_id
    left join payment_type on payment.payment_type_id = payment_type.id
    WHERE sales.id='$order_id' ";
  $orders = mysqli_query($db, $query);

  if (mysqli_num_rows($orders) > 0) {
    $order = mysqli_fetch_assoc($orders);
    $owner_id = $order['userid'];
    $sale_date = $order['saledate'];
    $client_id = $order['client_id'];
    $product = $order['product'];
  }
}

$query = "SELECT s.id as sale_id,concat(us.first_name, ' ', us.last_name) as sale_approver,
sa.date_created as sale_approval_date, sa.comment as sale_approver_comment,
st.name as sale_status,concat(uo.first_name, ' ', uo.last_name) as order_approver,
oa.date_created as order_approval_date, oa.comment as order_approver_comment,
os.name as order_status
FROM sales s
left join sale_approval sa on s.id = sa.sales_id
left join order_approval oa on s.id = oa.sales_id
left join users us on us.id = sa.approver_id
left join users uo on uo.id = oa.approver_id
left join status st on sa.status_id = st.id
left join status os on oa.status_id = os.id
WHERE s.id='$order_id' ";
$approvals = mysqli_query($db, $query);
if (mysqli_num_rows($approvals) > 0) {
  $approval = mysqli_fetch_assoc($approvals);
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
  <?php include('inc/side.php'); ?>
  <!-- End Sidebar-->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1><?php echo $order['trading_name'] ?> => Order #<?php echo "$order_id" ?></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section contact">
      <div class="row gy-4">
        <div class="col-xl-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="info-box card">
                <!-- <i class="bi bi-geo-alt"></i> -->
                <h3>Products Ordered</h3>
                <p>Ordered <b><?php echo $product ?></b> on <b><?php echo $sale_date ?></b></p>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Product</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Amount (Kshs)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query2 = "SELECT o.id as sale_id,o.amount,o.quantity,o.date_created,o.user_id,o.product_cost_id,
                    b.name as brand
                    FROM orders as o 
                    left join brand as b on o.brand_id = b.id
                    where o.date_created = '$sale_date' ";
                    $sales = mysqli_query($db, $query2);
                    if (mysqli_num_rows($sales) > 0) {
                      $sale = mysqli_fetch_assoc($sales);
                    }

                    if (mysqli_num_rows($sales) > 0) {
                      $sn = 1;
                      foreach ($sales as $sale) {
                    ?>
                        <tr>
                          <th scope="row"><a href="#"><?php echo $sn; ?></a></th>
                          <td><a href="#" class="text-primary"><?php echo $sale['brand'] ?></td>
                          <td><?php echo $sale['quantity'] ?></td>
                          <td><?php echo $sale['amount'] ?></td>
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
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="info-box card">
                <!-- <i class="bi bi-geo-alt"></i> -->
                <h3>Address</h3>
                <p><?php echo $order['curLocation'] ?></p>
                <p><?php echo $order['phone'] ?></p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="info-box card">
                <!-- <i class="bi bi-telephone"></i> -->
                <h3>Ordered by</h3>
                <p><?php echo $order['sold_by'] ?> <br>
                  <?php echo $order['saledate'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card p-4  info-box">
            <h3>Sales Approval</h3>
            <p><b>Approved by: </b> <?php echo $approval['sale_approver'] ?> <br>
              <b>Approval Status: </b> <?php echo $approval['sale_status'] ?> <br>
              <b>Date: </b> <?php echo $approval['sale_approval_date'] ?> <br>
              <b>Comments: </b> <?php echo $approval['sale_approver_comment'] ?>
            </p>

            <h3>Store Approval</h3>
            <p><b>Approved by: </b> <?php echo $approval['order_approver'] ?> <br>
              <b>Approval Status: </b> <?php echo $approval['order_status'] ?> <br>
              <b>Date: </b> <?php echo $approval['order_approval_date'] ?> <br>
              <b>Comments: </b> <?php echo $approval['order_approver_comment'] ?>
            </p>

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include('inc/footer.php'); ?>
  <?php include('inc/footjs.php'); ?>
</body>
</html>