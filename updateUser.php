<?php
require('connect.php');
include('logged_user.php');
include('aggregate.php');
?>
<!DOCTYPE html>
<html lang="en">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjxbg05YLIPbml3P0B3YEGye9LJiMBDfY&libraries=places&callback=initMap"></script>
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
      <h1>Update Client</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Clients</li>
          <li class="breadcrumb-item active">Edit Client</li>
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
              <?php
              if (isset($_GET['id'])) {
                $client_id = mysqli_real_escape_string($db, $_GET['id']);
                $query = "SELECT * FROM checkin WHERE id='$client_id' ";
                $clients = mysqli_query($db, $query);

                if (mysqli_num_rows($clients) > 0) {
                  $client = mysqli_fetch_array($clients);
              ?>
                  <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off" enctype="multipart/form-data" action="code.php">
                    <?php include('errors.php'); ?>
                    <input type="hidden" name="client_id" value="<?= $client['id']; ?>" id="latitude">
                    <!-- <input type="hidden"  name="latitude" value="<?php echo $latitude; ?>"  id="latitude">
                <input type="hidden" name="longitude" value="<?php echo $longitude; ?>" id="longitude">
                <input type="hidden" name="accuracy" value="<?php echo $accuracy; ?>" id="accuracy"> -->

                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label for="inputText" class="form-label">Your Current Location</label>
                        <div class="col-sm-10">
                          <input id="curLocation" name="curLocation" value="<?= $client['curLocation']; ?>" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="inputTime" class="form-label">Shop Type</label>
                        <div class="col-sm-10">
                          <select class="form-select" id="shoptype" name="shoptype" value="<?php echo $shoptype; ?>" required>
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
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="inputEmail" class="form-label">Trading Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Trading Name " id="trading_name" name="trading_name" value="<?= $client['trading_name']; ?>" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <label for="inputPassword" class="form-label">Contact Person Position</label>
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
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <label for="inputPassword" class="form-label">Contact First Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Owner Name " id="first_name" name="first_name" value="<?= $client['first_name']; ?>" class="form-control" required>
                          <div class="invalid-feedback">Please enter first name!</div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="inputPassword" class="form-label">Contact Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="Surname " id="last_name" name="last_name" value="<?= $client['last_name']; ?>" class="form-control" required>
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
                          <input type="text" placeholder="Phone Number " name="phone" value="<?= $client['phone']; ?>" id="phone" class="form-control" required>
                          <div class="invalid-feedback">Please enter email!</div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="inputDate" class="form-label">National ID</label>
                        <div class="col-sm-10">
                          <input type="text" placeholder="National ID " name="id_no" value="<?= $client['id_no']; ?>" id="id_no" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="inputTime" class="form-label">User Type</label>
                        <div class="col-sm-10">
                          <select class="form-select" id="user_type" name="user_type" required>
                            <option selected disabled value="">Choose...</option>
                            <?php
                            $query = "SELECT * FROM user_type ";
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
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="inputTime" class="form-label">Photo of Nationl ID or Equivalent</label>
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

            </div>
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Comment</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 50px" name="comment" value="<?= $client['comment']; ?>" id="comment"></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-sm-10">
                <button type="submit" name="edit_client" class="btn btn-primary">Edit Client</button>
                <button type="submit" name="add_client_user" class="btn btn-success">Add As User</button>
              </div>
            </div>

            </form><!-- End General Form Elements -->
        <?php
                } else {
                  echo "<h4>No Such Id Found</h4>";
                }
              }
        ?>
          </div>
        </div>
      </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include('inc/footer.php'); ?>
  <?php include('inc/footjs.php'); ?>
</body>

</html>