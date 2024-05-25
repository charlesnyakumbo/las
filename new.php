<?php include('connect.php') ?>
<?php
$cur_username = $_SESSION["username"];

// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You have to log in first";
  header('location: login.php');
}
if ($cur_username == null) {

  header("Location: login.php");
} else {

  //$db =mysqli_connect("localhost","root","","moko");

  $getUserDetails = "SELECT * FROM users WHERE username = '$cur_username' ";

  $result =  mysqli_query($db, $getUserDetails);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $first_name = $row['first_name'];
    $first_name = $row['first_name'];
    $email = $row['username'];
    // $role=$row['role'];


  } else {
    echo "error this user does not exist";
    exit();
  }

  // Check connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  $sql = "SELECT * FROM checkin";
  $result = $db->query($sql);


  $db->close();

  // Logout button will destroy the session, and
  // will unset the session variables
  // User will be headed to 'login.php'
  // after logging out
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Crowbyte - Coming Soon</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets2/img/favicon.png" rel="icon">
  <link href="assets2/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets2/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">
      <?php

      //$newDate = date('Y-m-d', strtotime('tomorrow'));

      // Current date and time
      $datetime = date('Y-m-d', strtotime('tomorrow'));

      // Convert datetime to Unix timestamp
      $timestamp = strtotime($datetime);

      // Subtract time from datetime
      $time = $timestamp - (10 * 60 * 60);

      // Date and time after subtraction
      $datetime = date("Y-m-d H:i:s", $time);

      //echo $newDate;

      ?>
      <h1>Welcome <?php echo "$first_name" ?></h1>
      <h2>We're glad to have you onboard and our team will approve your request within </h2>
      <div class="countdown d-flex justify-content-center" data-count="<?php echo "$datetime" ?>">
        <div>
          <h3>%d</h3>
          <h4>Days</h4>
        </div>
        <div>
          <h3>%h</h3>
          <h4>Hours</h4>
        </div>
        <div>
          <h3>%m</h3>
          <h4>Minutes</h4>
        </div>
        <div>
          <h3>%s</h3>
          <h4>Seconds</h4>
        </div>
      </div>
      <p>Once approved, we shall notify you. You will use your email; <?php echo "$email" ?> as username </p>
      <div class="subscribe">
        <h4>Subscribe now to get the latest updates!</h4>
        <form action="forms/notify.php" method="post" role="form" class="php-email-form">
          <div class="subscribe-form">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </div>
          <div class="mt-2">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your notification request was sent. Thank you!</div>
          </div>
        </form>
      </div>

      <div class="social-links text-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>

    </div>
  </header><!-- End #header -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6">
            <h2>Crowbyte</h2>
            <h3>To use Technology categories to significantly improve key areas of youth wellbeing</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              To use technology to impact on human and transform their wellbeing.
              We equip youth with basic technological skills and knowledge for disruption that
              focus on innovation and increase labor market fluidity.
            </p>
            <ul>
              <li><i class="bi bi-check"></i> Web Applications and Hosting</li>
              <li><i class="bi bi-check"></i> Mobile Application</li>
              <li><i class="bi bi-check"></i> Intelligent Data Analytics</li>
              <li><i class="bi bi-check"></i> Video Impact Training (Youth Led)</li>
              <li><i class="bi bi-check"></i> Digital Literacy Programs</li>
            </ul>
            <p class="fst-italic">
              Visit our website <a href="https://crowbyt.com/" target="blank">Crowbyte</a> for more.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Location:</h4>
                  <p>P.O BOX 5177 <br>G.P.O Nairobi, Kenya</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope"></i>
                  <h4>Email:</h4>
                  <p>info@crowbyt.com<br>contact@crowbyt.com</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone"></i>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 51<br>+1 5589 22475 14</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row justify-content-center">
          <div class="col-lg-10">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Crowbyte</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="https://crowbyt.com/">Crowbyte</a>
      </div>
    </div>
  </footer><!-- End #footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets2/js/main.js"></script>

</body>
</html>