<?php
include('connect.php');
// Start transaction
$db->query("START TRANSACTION");
// insert a new client
// Start transaction
$db->query("START TRANSACTION");
  $user_id = mysqli_real_escape_string($db, $_POST["user_id"]);
  $trading_name = mysqli_real_escape_string($db, $_POST["trading_name"]);
  $first_name = mysqli_real_escape_string($db, $_POST["first_name"]);
  $last_name = mysqli_real_escape_string($db, $_POST["last_name"]);
  $phone = mysqli_real_escape_string($db, $_POST["phone"]);
  $email = trim(strtolower($first_name)) . substr($phone, -9);
  $id_no = mysqli_real_escape_string($db, $_POST["id_no"]);
  $latitude = mysqli_real_escape_string($db, $_POST["latitude"]);
  $longitude = mysqli_real_escape_string($db, $_POST["longitude"]);
  $accuracy = mysqli_real_escape_string($db, $_POST["accuracy"]);
  $cityLat = mysqli_real_escape_string($db, $_POST["cityLat"]);
  $cityLng = mysqli_real_escape_string($db, $_POST["cityLng"]);
  $curLocation = mysqli_real_escape_string($db, $_POST["curLocation"]);
  $city2 = mysqli_real_escape_string($db, $_POST["city2"]);
  $contacttype = mysqli_real_escape_string($db, $_POST["contacttype"]);
  $shoptype = mysqli_real_escape_string($db, $_POST["shoptype"]);
  $phone2 = substr($phone, -9);

  // if (empty($trading_name)) {
  //   array_push($errors, "Trading Name is required");
  // }

  //$sql_u ="SELECT phone FROM checkin WHERE RIGHT(phone,9) = '$phone2'";
  $sql1 = mysqli_query($db, "SELECT phone FROM checkin WHERE RIGHT(phone,9) = $phone2 ") or exit(mysqli_error($db));
  if (mysqli_num_rows($sql1) > 0) {
    $name_error = "Sorry... username already taken"; 	
    header("Location: clients.php");
  }
  else{

    $que = "INSERT INTO checkin (user_id, trading_name, email,phone, id_no,
     latitude,longitude,accuracy,cityLat,cityLng,curLocation,
     city2,outlet_type_id,contacttype_id,first_name,last_name)
        VALUES('$user_id','$trading_name','$email','$phone', '$id_no',
        '$latitude', '$longitude', '$accuracy','$cityLat','$cityLng','$curLocation',
        '$city2','$shoptype','$contacttype','$first_name','$last_name')";

$results = mysqli_query($db, $que);
// if (count($errors) != 0) {
// }
  
  // get client_id
$company_id = $db->insert_id;
$status = 1;
$user_type = 1;
$password_1 = substr($phone,-9);

  $password = md5($password_1);
  $que1 = "INSERT INTO users (password,role_id,first_name,last_name,company_id,
  status,user_type_id,username)
      VALUES('$password','$shoptype','$first_name','$last_name','$company_id',
      '$status','$user_type','$email')";

  $results = mysqli_query($db, $que1);

  $db->query('COMMIT');

  header("Location: sales.php");
}
