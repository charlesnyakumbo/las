<?php
include('connect.php');
// Start transaction
$db->query("START TRANSACTION");

// Create a sale
$userid = mysqli_real_escape_string($db, $_POST["user_id"]);
$client_id = mysqli_real_escape_string($db, $_POST["client_id"]);
$comment = mysqli_real_escape_string($db, $_POST["comment"]);
$amount = mysqli_real_escape_string($db, $_POST["amount"]);
$product_id = mysqli_real_escape_string($db, $_POST["product_id"]);

$que1 = "INSERT INTO sales ( userid, client_id, comment,amount,product_id)
  VALUES('$userid','$client_id','$comment','$amount','$product_id')";
mysqli_query($db, $que1);


// get sales id
$sales_id = $db->insert_id;

// Insert into payments
$paymentmode = mysqli_real_escape_string($db, $_POST["paymentmode"]);
$code = mysqli_real_escape_string($db, $_POST["code"]);
$amount = mysqli_real_escape_string($db, $_POST["amount"]);



$que = "INSERT INTO payment (sales_id, payment_type_id,transaction_code,amount)
VALUES('$sales_id', '$paymentmode','$code','$amount')";
mysqli_query($db, $que);

// inserrt into orders table
$product_id = mysqli_real_escape_string($db, $_POST["product_id"]);
if (count($_POST['brand']) > 0) {
  foreach ($_POST['brand'] as $brand) {
    $id = intval($brand);
    if ((!isset($_POST['quantity' . $id])) && (isset($_POST['brand' . $id]))) {
      trigger_error("Value must be 1 or below");
      //  die("Error, select click checkbox before quantity");
      // array_push($errors, "Mark at least one brand");
      header("Location: ordering.php?product=$product_id ");
    }

    $brand_id = intval($_POST['brand_id' . $id]);
    $product_cost_id = intval($_POST['product_cost_id' . $id]);
    $quantity = intval($_POST['quantity' . $id]);
    $unit_cost = intval($_POST['unit_cost' . $id]);
    $total_cost = $quantity * $unit_cost;
    $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);
    $client_id = mysqli_real_escape_string($db, $_POST["client_id"]);

    $insertqry = "INSERT INTO orders(sales_id,brand_id,quantity,unit_cost,amount,product_cost_id,user_id,client_id) 
VALUES ('$sales_id','$id','$quantity','$unit_cost','$total_cost','$product_cost_id','$user_id','$client_id')";
    $insertqry = mysqli_query($db, $insertqry);
  }
}

$db->query('COMMIT');

header("Location: sales_order.php?id=$client_id"); 