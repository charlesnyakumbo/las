<?php
require('connect.php');
$cur_username = $_SESSION["username"];
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You have to log in first";
  header('location: login.php');
}
if ($cur_username == null) {

  header("Location: login.php");
} else {

  //$db=mysqli_connect("localhost","root","","moko");

  $getUserDetails = "SELECT users.id as id,first_name, last_name,company_id,user_type_id,role_id,role.name as role 
FROM users
left join role on users.role_id = role.id
 WHERE username = '$cur_username' ";
  $result =  mysqli_query($db, $getUserDetails);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $first_name = $row['first_name'];
    $role_id = $row['role_id'];
    $role = $row['role'];
    $lastname = $row['last_name'];
    $company_id = $row['company_id'];
    $user_type = $row['user_type_id'];
  } else {
    echo "error this user does not exist";
    exit();
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
}
