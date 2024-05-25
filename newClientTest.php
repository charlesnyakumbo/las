<?php
include('connect.php');
include('logged_user.php');
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjxbg05YLIPbml3P0B3YEGye9LJiMBDfY&libraries=places&callback=initMap">
</script>
<script>
function initialize() {
    var input = document.getElementById('curLocation');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        document.getElementById('city2').value = place.name;
        document.getElementById('cityLat').value = place.geometry.location.lat();
        document.getElementById('cityLng').value = place.geometry.location.lng();
    });
    autocomplete.setComponentRestrictions({
        country: ["ke"],
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>


<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clients/ New Client </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body onload="getLocation();">
    <script type="text/javascript">
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        }
    }

    function showPosition(position) {
        document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
        document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
        document.querySelector('.myForm input[name = "accuracy"]').value = position.coords.accuracy;
    }

    // function showError(error){
    //     switch(error.code){
    //         case error.PERMISSION_DENIED:
    //             alert("You must allow the app to access your location to fill the form");
    //             location.reload();
    //             break;
    //     }
    // }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
    </script>
    <!-- ======= Header ======= -->
    <?php include('inc/header.php'); ?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include('inc/saleside.php'); ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>New Client</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Clients</li>
                    <li class="breadcrumb-item active">New Client</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Shop-Level Data</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                enctype="multipart/form-data" action="code.php">
                                <?php include('errors.php'); ?>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <input type="hidden" name="accuracy" id="accuracy">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="inputText" class="form-label">Your Current Location</label>
                                        <div class="col-sm-10">
                                            <input id="curLocation" name="curLocation" type="text" size="50"
                                                placeholder="Enter a location" autocomplete="on" runat="server"
                                                class="form-control" required />
                                            <input type="hidden" id="city2" name="city2"
                                                value="<?php echo $city2; ?>" />
                                            <input type="hidden" id="cityLat" name="cityLat"
                                                value="<?php echo ""; ?>" />
                                            <input type="hidden" id="cityLng" name="cityLng"
                                                value="<?php echo "";  ?>" />
                                            <div class="invalid-feedback">Please enter a valid location!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="validationCustom04" class="form-label">Shop Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="shoptype" name="shoptype"
                                                value="<?php echo $shoptype; ?>" required>
                                                <!-- <select class="form-control" id="shoptype" name="shoptype"  value="<?php echo $shoptype; ?>" required> -->
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                        $query = "SELECT * FROM outlet_type ";
                        $rows = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_array(
                          $rows,
                          MYSQLI_ASSOC
                        )) :;
                        ?>
                                                <option value="<?php echo $row["id"]; ?>">
                                                    <?php echo $row["name"]; ?>
                                                </option>
                                                <?php
                        endwhile;
                        ?>
                                            </select>
                                            <div class="invalid-feedback">Please enter Shop type!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail" class="form-label">Trading Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Trading Name " id="trading_name"
                                                name="trading_name" class="form-control" required>
                                            <div class="invalid-feedback">Please enter a trading name!</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="validationCustom04" class="form-label">Contact Person
                                            Position</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="contacttype" name="contacttype" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                        $query = "SELECT * FROM contact_type ";
                        $rows = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_array(
                          $rows,
                          MYSQLI_ASSOC
                        )) :;
                        ?>
                                                <option value="<?php echo $row["id"]; ?>">
                                                    <?php echo $row["name"]; ?>
                                                </option>
                                                <?php
                        endwhile;
                        ?>
                                            </select>
                                            <div class="invalid-feedback">Please enter a contact position!</div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="inputPassword" class="form-label">Contact First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="First Name " id="first_name"
                                                name="first_name" class="form-control" required>
                                            <div class="invalid-feedback">Please enter first name!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputPassword" class="form-label">Contact Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Surname " id="last_name" name="last_name"
                                                class="form-control" required>
                                            <div class="invalid-feedback">Please enter surname!</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="inputNumber" class="form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="Phone Number " name="phone" id="phone"
                                                class="form-control" required>
                                            <div class="invalid-feedback">Please enter valid phone number!</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputDate" class="form-label">National ID</label>
                                        <div class="col-sm-10">
                                            <input type="text" placeholder="National ID " name="id_no" id="id_no"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="validationCustom04" class="form-label">Product Company</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="shoptype" name="product"
                                                value="<?php echo $product; ?>" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                        $query = "SELECT * FROM company ";
                        $rows = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_array(
                          $rows,
                          MYSQLI_ASSOC
                        )) :;
                        ?>
                                                <option value="<?php echo $row["id"]; ?>">
                                                    <?php echo $row["name"]; ?>
                                                </option>
                                                <?php
                        endwhile;
                        ?>
                                            </select>
                                            <div class="invalid-feedback">Please enter Shop type!</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="inputTime" class="form-label">Photo of Nationl ID or
                                            Equivalent</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="inventoryimage" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Photo of Business Permit or equivalent</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" name="storefrontimage" value="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" name="save" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('inc/footer.php'); ?>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.min.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>