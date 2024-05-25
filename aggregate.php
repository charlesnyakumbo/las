<?php

//clents
$query1 = "SELECT * FROM checkin";
$clients = mysqli_query($db, $query1);
                               $client_sale = mysqli_fetch_array($clients);
                               if ($result=mysqli_query($db,$query1))
                               {
                               $tot_clients=mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
//sales
$query2 = "SELECT * FROM sales";
$client_sales = mysqli_query($db, $query2);
                               $client_sale = mysqli_fetch_array($client_sales);
                               if ($result=mysqli_query($db,$query2))
                               {
                               $tot_sales=mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
    
                               //sum sales
                               $query3 = "SELECT sum(amount) FROM sales";

                               $sales = mysqli_query($db, $query3);
                               $sum_sale = mysqli_fetch_array($sales);

                               //sum Revenue
                               $query7 = "SELECT sum(amount) FROM sales";

                               $revenue = mysqli_query($db, $query7);
                               $sum_revenue = mysqli_fetch_array($revenue);


                               //sum new sales
$query4 = "SELECT sum(amount) FROM sales";
$new_sales = mysqli_query($db, $query4);
 $sum_new_sale = mysqli_fetch_array($new_sales);


                                //sum approved sales
$query5 = "SELECT sum(amount) FROM sales";
$approved_sales = mysqli_query($db, $query5);
 $sum_approved_sale = mysqli_fetch_array($approved_sales);


                                 //sum rejected sales
$query6 = "SELECT sum(amount) FROM sales";
$rejected_sales = mysqli_query($db, $query6);
 $sum_rejected_sale = mysqli_fetch_array($rejected_sales);



 //clents of mtk
$query1 = "SELECT * FROM checkin";
$clients = mysqli_query($db, $query1);
                               $client_sale = mysqli_fetch_array($clients);
                               if ($result=mysqli_query($db,$query1))
                               {
                               $mtk_tot_clients=mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
//sales
$query2 = "SELECT * FROM sales";
$client_sales = mysqli_query($db, $query2);
                               $client_sale = mysqli_fetch_array($client_sales);
                               if ($result=mysqli_query($db,$query2))
                               {
                               $mtk_tot_sales=mysqli_num_rows($result);
                               mysqli_free_result($result);
                               }
    
                               //sum sales
                               $query3 = "SELECT sum(amount) FROM sales";

                               $sales = mysqli_query($db, $query3);
                               $mtk_sum_sale = mysqli_fetch_array($sales);

                               //sum Revenue
                               $query7 = "SELECT sum(amount) FROM sales";

                               $revenue = mysqli_query($db, $query7);
                               $mtk_sum_revenue = mysqli_fetch_array($revenue);


                               //sum new sales
$query4 = "SELECT sum(amount) FROM sales ";
$new_sales = mysqli_query($db, $query4);
 $mtk_sum_new_sale = mysqli_fetch_array($new_sales);


                                //sum approved sales
$query5 = "SELECT sum(amount) FROM sales";
$approved_sales = mysqli_query($db, $query5);
 $mtk_sum_approved_sale = mysqli_fetch_array($approved_sales);


                                 //sum rejected sales
$query6 = "SELECT sum(amount) FROM sales ";
$rejected_sales = mysqli_query($db, $query6);
 $mtk_sum_rejected_sale = mysqli_fetch_array($rejected_sales);
