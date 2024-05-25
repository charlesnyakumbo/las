<?php
include('connect.php');


//edit client details
if (isset($_POST['edit_client'])) {
  $client_id = mysqli_real_escape_string($db, $_POST["client_id"]);
  $trading_name = mysqli_real_escape_string($db, $_POST["trading_name"]);
  $owner_name = mysqli_real_escape_string($db, $_POST["owner_name"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $phone = mysqli_real_escape_string($db, $_POST["phone"]);
  $id_no = mysqli_real_escape_string($db, $_POST["id_no"]);
  $curLocation = mysqli_real_escape_string($db, $_POST["curLocation"]);
  $product = mysqli_real_escape_string($db, $_POST["product"]);
  $comment = mysqli_real_escape_string($db, $_POST["comment"]);
  $contacttype = mysqli_real_escape_string($db, $_POST["contacttype"]);
  $shoptype = mysqli_real_escape_string($db, $_POST["shoptype"]);

 

    $que = "UPDATE checkin SET  trading_name = '$trading_name', owner_name = '$owner_name', email ='$email',
  phone = '$phone',id_no = '$id_no',product = '$product',comment = '$comment',
 shoptype='$shoptype',contacttype ='$contacttype'
    where id ='$client_id' ";


    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      move_uploaded_file($inventoryimagetempname, $inventoryimagefolder);
      move_uploaded_file($storefrontimagetempname, $storefrontimagefolder);
      header("Location: all_retailers.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }




//oder approval

if (isset($_POST['approve_order'])) {
  $user_id = mysqli_real_escape_string($db, $_POST["approver_id"]);
  $sales_id = mysqli_real_escape_string($db, $_POST["order_id"]);
  $status = mysqli_real_escape_string($db, $_POST["status"]);
  $comment = mysqli_real_escape_string($db, $_POST["comment"]);
 

    $que = "INSERT INTO sale_approval (sales_id,approver_id,status_id,comment)
  VALUES('$sales_id','$user_id','$status','$comment')";

    $que2 = "UPDATE sales SET  status = '$status' where id = '$sales_id' ";
    mysqli_query($db, $que2);
    if (mysqli_query($db, $que)) {
      header("Location: orders.php");
    } else {
      echo '<div class="btn-error">Approved ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
 
}


if (isset($_POST['approve_store'])) {
  $id = $_POST['order_id'];
  date_default_timezone_set('Africa/Nairobi');
  $approval_date = date("Y-m-d H:i:s");
  $approver_name = mysqli_real_escape_string($db, $_POST["approver_name"]);
  $approver_id = mysqli_real_escape_string($db, $_POST["approver_id"]);
  $status = mysqli_real_escape_string($db, $_POST["order_status"]);
  $comment = mysqli_real_escape_string($db, $_POST["approval_comment"]);

  // If the form is error free, then register the user



    $que = "UPDATE sales SET  storestatus = '$status', store_approver_comment = '$comment', 
      store_approver_id ='$approver_id',store_approver_name ='$approver_name',store_approver_date ='$approval_date'
        where id = '$id' ";


    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      header("Location: stores.php");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);

}

//check submit
if (filter_has_var(INPUT_POST, 'approve_order')) {
  //get form data
  $company = 'New Order';
  $name  = htmlspecialchars($_POST['contact']);
  $phone = htmlspecialchars($_POST['phone']);
  $size1 = htmlspecialchars($_POST['size1']);
  $quantity1 = htmlspecialchars($_POST['quantity1']);
  $size2 = htmlspecialchars($_POST['size2']);
  $quantity2 = htmlspecialchars($_POST['quantity2']);
  $size3 = htmlspecialchars($_POST['size3']);
  $quantity3 = htmlspecialchars($_POST['quantity3']);
  $location = htmlspecialchars($_POST['location']);
  $email = 'charlesnyakumbo@gmail.com';
  $subject = htmlspecialchars($_POST['trading_name']);
  $message = htmlspecialchars($_POST['approval_comment']);


  //passed
  $toemail = 'nyakumbosenior@gmail.com';
  $emailsubject = $subject;
  $body = '<h2>New Order for ' . $subject . '  </h2>
                  <h4>Contact Person</h4><p>' . $name . ' </p>
                  <h4>Phone</h4><p>' . $phone . ' </p>
                  <h4>Location</h4><p>' . $location . ' </p>
                  <h4>Orders</h4><p>' . $size1 . '==>' . $quantity1 . ' </p><p>
                  ' . $size2 . ',' . $quantity2 . ' </p><p>
                  ' . $size3 . ',' . $quantity3 . ' </p>
                  <h4>Comments</h4><p>' . $message . ' </p>';

  //email headers
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-Type: text/html; charset = UTF-8" . "\r\n";

  //Additional headers
  $headers .= "From: " . $company . "<" . $email . ">" . "\r\n";

  if (mail($toemail, $subject, $body, $headers)) {
    //Passed
    $msg = 'Your email has been sent successfully';
    $msgClass = 'alert-success';
  } else {
    //failed
    $msg = 'Email not sent, try again';
    $msgClass = 'alert-danger';
  }
}

//submit new order
if (isset($_POST['add_visit'])) {

  $userid = mysqli_real_escape_string($db, $_POST["userid"]);
  $client_id = mysqli_real_escape_string($db, $_POST["client_id"]);
  $visitreason = mysqli_real_escape_string($db, $_POST["visitreason"]);
  $stock = mysqli_real_escape_string($db, $_POST["stock"]);
  $comment = mysqli_real_escape_string($db, $_POST["comment"]);

 

    $que = "INSERT INTO visit (visitreason_id, stock, comment, userid,client_id

     )VALUES(
      '$visitreason', '$stock','$comment','$userid','$client_id'
    )";

    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      header("Location: sales.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a visit ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }



//update user details
if (isset($_POST['edit_user_details'])) {

  $id = mysqli_real_escape_string($db, $_POST["userid"]);
  $role_id = mysqli_real_escape_string($db, $_POST["role_id"]);
  $company_id = mysqli_real_escape_string($db, $_POST["company_id"]);
  $first_name = mysqli_real_escape_string($db, $_POST["first_name"]);
  $last_name = mysqli_real_escape_string($db, $_POST["last_name"]);
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $password = mysqli_real_escape_string($db, $_POST["password"]);
  $status = mysqli_real_escape_string($db, $_POST["status"]);
  // If the form is error free, then register the user

    // Password encryption to increase data security
    $password2 = md5($password);

    $que = "UPDATE users SET role_id = '$role_id',company_id = '$company_id',  first_name = '$first_name', 
    last_name ='$last_name', username='$username', status='$status', password = '$password2'
      where id = '$id' ";

    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      header("Location: allUsers.php");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }


//add company
if (isset($_POST['add_company'])) {
  $companyimagefilename = $_FILES["companyimage"]["name"];
  $companyimagetempname = $_FILES["companyimage"]["tmp_name"];
  $companyimagefolder = "./image/" . $companyimagefilename;

  $company = mysqli_real_escape_string($db, $_POST["company"]);



    // Inserting data into table
    $que = "INSERT INTO company (name,companyimage)
				VALUES('$company', '$companyimagefilename')";

    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      move_uploaded_file($companyimagetempname, $companyimagefolder);
      header("Location: allUsers.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }



//add company
if (isset($_POST['add_product'])) {
  $productimagefilename = $_FILES["productimage"]["name"];
  $productimagetempname = $_FILES["productimage"]["tmp_name"];
  $productimagefolder = "./image/" . $productimagefilename;

  $product = mysqli_real_escape_string($db, $_POST["product"]);



    // Inserting data into table
    $que = "INSERT INTO product (name,productimage)
				VALUES('$product', '$productimagefilename')";

    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      move_uploaded_file($productimagetempname, $productimagefolder);
      header("Location: allUsers.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }



//Convert client to user for loging in
if (isset($_POST['add_role'])) {
  $role = mysqli_real_escape_string($db, $_POST["role"]);



    // Inserting data into table
    $que = "INSERT INTO role (name)
          VALUES('$role')";

    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      header("Location: allUsers.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }


//map costs to product
if (isset($_POST['add_cost_mapping'])) {
  $company = mysqli_real_escape_string($db, $_POST["company"]);
  $product = mysqli_real_escape_string($db, $_POST["product"]);
  $brand = mysqli_real_escape_string($db, $_POST["brand"]);
  $quality = mysqli_real_escape_string($db, $_POST["quality"]);
  $outlet = mysqli_real_escape_string($db, $_POST["outlet"]);
  $cost = mysqli_real_escape_string($db, $_POST["cost"]);



    // Inserting data into table
    $que = "INSERT INTO product_cost (product_id,outlet_type_id,unit_cost,company_id,brand_id,quality_id)
          VALUES('$product','$outlet','$cost','$company','$brand','$quality')";
          
    //mysqli_query($db, $query);
    if (mysqli_query($db, $que)) {
      header("Location: allUsers.php");

      //header("Location: agent.php#addClient");
    } else {
      echo '<div class="btn-error"> could not insert a new retailer ' . mysqli_error($db, $que);
    }
    mysqli_free_result($result);
    mysqli_close($db);
  }


// change password
if (isset($_POST['change_password'])) {
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $password_1 = mysqli_real_escape_string($db, $_POST['newpassword']);
  $password_2 = mysqli_real_escape_string($db, $_POST['renewpassword']);


  // $select = mysqli_query($db, "SELECT username FROM users WHERE username = '".$_POST['username']."'") or exit(mysqli_error($db));
  // if(mysqli_num_rows($select)) {
  //     exit('This is not your current password');

  // }
  // If the form is error free, then register the user


    // Password encryption to increase data security
    $password = md5($password_1);

    // Inserting data into table
    $query = "UPDATE users SET  password = '$password' where id = $user_id ";

    mysqli_query($db, $query);
    header('location: index.php');
  }


// insert a new brand
if (isset($_POST['add_brand'])) {

    $brandimagefilename = $_FILES["brandimage"]["name"];
    $brandimagetempname = $_FILES["brandimage"]["tmp_name"];
    $brandimagefolder = "./image/" . $brandimagefilename;
  
    $company_id = mysqli_real_escape_string($db, $_POST["company"]);
    $product_id = mysqli_real_escape_string($db, $_POST["product"]);
    $brand = mysqli_real_escape_string($db, $_POST["brand"]);
  

      $que = "INSERT INTO brand (company_id, product_id, name,brandimage)
          VALUES('$company_id','$product_id','$brand','$brandimagefilename')";
  
      if (mysqli_query($db, $que)) {
        move_uploaded_file($brandimagetempname, $brandimagefolder);
      }
  
    header("Location: allUsers.php");
  }
  
    // update brand
if (isset($_POST['edit_brand'])) {
  $brand_id = mysqli_real_escape_string($db, $_POST["brand_id"]);
  $brandimagefilename = $_FILES["brandimage"]["name"];
  $brandimagetempname = $_FILES["brandimage"]["tmp_name"];
  $brandimagefolder = "./image/" . $brandimagefilename;

  $company_id = mysqli_real_escape_string($db, $_POST["company"]);
  $product_id = mysqli_real_escape_string($db, $_POST["product"]);
  $brand = mysqli_real_escape_string($db, $_POST["brand"]);

  if (empty($brand)) {
    array_push($errors, "Trading Name is required");
  }
          $que = "UPDATE brand SET  company_id = '$company_id', product_id ='$product_id',name = '$brand',
          brandimage = '$brandimagefilename'  where id = '$brand_id' ";

    if (mysqli_query($db, $que)) {
      move_uploaded_file($brandimagetempname, $brandimagefolder);
    }

  header("Location: allUsers.php");
}
  