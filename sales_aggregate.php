<?php
include('logged_user.php');
//clents
$query1 = "SELECT * FROM checkin where user_id = $user_id";
$clients = mysqli_query($db, $query1);
                               $client_sale = mysqli_fetch_array($clients);
                               if ($result=mysqli_query($db,$query1))
                               {
                               $tot_clients =mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
//sales
$query2 = "SELECT * FROM sales where userid = $user_id";
$client_sales = mysqli_query($db, $query2);
                               $client_sale = mysqli_fetch_array($client_sales);
                               if ($result=mysqli_query($db,$query2))
                               {
                               $tot_sales=mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
    
                               //sum sales
                               $query3 = "SELECT sum(amount) FROM sales  where userid = $user_id";

                               $sales = mysqli_query($db, $query3);
                               $sum_sale = mysqli_fetch_array($sales);

                               //sum Revenue
                               $query7 = "SELECT sum(amount) FROM sales  where userid = $user_id";
                               $revenue = mysqli_query($db, $query7);
                               $sum_revenue = mysqli_fetch_array($revenue);


//Today's clents
$query1 = "SELECT * FROM checkin where DATE(date_created) = CURDATE() and  user_id = $user_id";
$clients = mysqli_query($db, $query1);
                               $client_sale = mysqli_fetch_array($clients);
                               if ($result=mysqli_query($db,$query1))
                               {
                               $tot_clients_today =mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
//Todays's sales
$query2 = "SELECT * FROM sales where DATE(date_created) = CURDATE() and userid = $user_id";
$client_sales = mysqli_query($db, $query2);
                               $client_sale = mysqli_fetch_array($client_sales);
                               if ($result=mysqli_query($db,$query2))
                               {
                               $tot_sales_today =mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
    
                               //sum sales
                               $query3 = "SELECT sum(amount) FROM sales where DATE(date_created) = CURDATE() and userid = $user_id";

                               $sales = mysqli_query($db, $query3);
                               $sum_sale_today = mysqli_fetch_array($sales);

                               //sum Revenue
                               $query7 = "SELECT sum(amount) FROM sales where DATE(date_created) = CURDATE() and userid = $user_id";
                               $revenue = mysqli_query($db, $query7);
                               $sum_revenue_today = mysqli_fetch_array($revenue);


//Month's clents
$query1 = "SELECT * FROM checkin where MONTH(date_created) = MONTH(CURDATE()) and  user_id = $user_id";
$clients = mysqli_query($db, $query1);
                               $client_sale = mysqli_fetch_array($clients);
                               if ($result=mysqli_query($db,$query1))
                               {
                               $tot_clients_month =mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
//Todays's sales
$query2 = "SELECT * FROM sales where MONTH(date_created) = MONTH(CURDATE()) and userid = $user_id";
$client_sales = mysqli_query($db, $query2);
                               $client_sale = mysqli_fetch_array($client_sales);
                               if ($result=mysqli_query($db,$query2))
                               {
                               $tot_sales_month =mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
    
                               //sum sales
                               $query3 = "SELECT sum(amount) FROM sales where MONTH(date_created) = MONTH(CURDATE()) and userid = $user_id";

                               $sales = mysqli_query($db, $query3);
                               $sum_sale_month = mysqli_fetch_array($sales);

                               //sum Revenue
                               $query7 = "SELECT sum(amount) FROM sales where MONTH(date_created) = MONTH(CURDATE()) and userid = $user_id";
                               $revenue = mysqli_query($db, $query7);
                               $sum_revenue_month = mysqli_fetch_array($revenue);