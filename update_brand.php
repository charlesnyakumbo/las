<?php
//require('connect.php');
include('logged_user.php');
//include('aggregate.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<!-- ======= Head ======= -->
<?php include('inc/headjs.php');?>
<!-- ======= Head ======= -->

<body>
    <!-- ======= Header ======= -->
    <?php include('inc/header.php');?>
    <!-- End Header -->
    <!-- ======= Sidebar ======= -->
    <?php include('inc/side.php');?>
    <!-- End Sidebar-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Recent sales -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add a new company</h5>

                                <!-- General Form Elements -->
                                <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                    enctype="multipart/form-data" action="code.php">
                                    <?php include('errors.php'); ?>

                                    <div class="row mb-3">
                                    </div>

                                    <div class="form-group row">

                                        <!-- add company -->
                                        <div class="form-group row">
                                            <div class="col-sm-6" id="company">
                                                <label for="inputTime" class="form-label">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input name="company" type="text" class="form-control" id="company">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label">Company Image</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="file" name="companyimage"
                                                        value="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <button type="submit" name="add_company"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                </form><!-- End General Form Elements -->

                            </div>
                        </div>
                    </div>

                    <!-- End General Form Elements -->


                    <!-- Recent sales -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add a new Product</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                                enctype="multipart/form-data" action="code.php">
                                <?php include('errors.php'); ?>

                                <div class="row mb-3">
                                </div>

                                <div class="form-group row">

                                    <!-- add company -->
                                    <div class="form-group row">
                                        <div class="col-sm-6" id="company">
                                            <label for="inputTime" class="form-label">Product Name</label>
                                            <div class="col-sm-10">
                                                <input name="product" type="text" class="form-control" id="product">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">Product Image</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="productimage" value="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-10">
                                            <button type="submit" name="add_product"
                                                class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>

                <!-- End General Form Elements -->

                <!-- Recent sales -->
            </div>

            <!-- End General Form Elements -->

            <!-- Add a brand -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Update Brand</h5>

                    <!-- Brand form -->
                    <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                        enctype="multipart/form-data" action="code.php">
                        <?php include('errors.php'); ?>

                        <div class="row mb-3">
                        </div>

                        <div class="form-group row">
                            <!-- add cost product mapping-->
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="validationCustom04" class="form-label">Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="company" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                                                                    $query = "SELECT * FROM company ";
                                                                    $companies = mysqli_query($db, $query);
                                                              while ($company = mysqli_fetch_array(
                                                                      $companies,MYSQLI_ASSOC)):;
                                                          ?>
                                            <option value="<?php echo $company["id"]; ?>">
                                                <?php echo $company["name"]; ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="inputNumber" class="form-label">Product</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="product" name="product" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                                                              $query = "SELECT * FROM product ";
                                                              $rows = mysqli_query($db, $query);
                                                        while ($row = mysqli_fetch_array(
                                                                $rows,MYSQLI_ASSOC)):;
                                                    ?>
                                            <option value="<?php echo $row["id"];?>">
                                                <?php echo $row["name"]; ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                            </div>
                            <?php
                                        if (isset($_GET['brand_id'])) {
                                        $brand_id = mysqli_real_escape_string($db, $_GET['brand_id']);
                                        $query = "SELECT * FROM brand WHERE id ='$brand_id' ";
                                        $brands = mysqli_query($db, $query);

                                        if (mysqli_num_rows($brands) > 0) {
                                            $brand = mysqli_fetch_array($brands);
                                        ?>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                <input type="text" id="brand_id" name="brand_id" value="<?php echo $brand_id ?>" />
                                    <label for="inputPassword" class="form-label">Brand</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" placeholder="Brand Name" id="brand" name="brand"
                                            value="<?php echo $brand['name'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Brand Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="brandimage" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                            </div>
                                                    <?php
                                        } else {
                                        echo "<h4>No Such Id Found</h4>";
                                        }
                                    }
                                        ?>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" name="edit_brand" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                    </form><!-- End of brand -->


                    </table>
                </div>
            </div>
            </div>

            <!-- End General Form Elements -->

            <!-- Cost Product Mapping -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Map Product to cost</h5>

                    <!-- General Form Elements -->
                    <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off"
                        action="code.php">
                        <?php include('errors.php'); ?>

                        <div class="row mb-3">
                        </div>

                        <div class="form-group row">
                            <!-- add cost product mapping-->
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="validationCustom04" class="form-label">Company</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="role" name="company" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM company ";
                      $companies = mysqli_query($db, $query);
                while ($company = mysqli_fetch_array(
                        $companies,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $company["id"];
                ?>">
                                                <?php echo $company["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <label for="inputNumber" class="form-label">Product</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="product" name="product" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM product ";
                      $rows = mysqli_query($db, $query);
                while ($row = mysqli_fetch_array(
                        $rows,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $row["id"];
                ?>">
                                                <?php echo $row["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputPassword" class="form-label">Brand</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="brand" name="brand" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM brand ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
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
                                <div class="col-sm-4">
                                    <label for="inputNumber" class="form-label">Quality</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="quality" name="quality" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM product_quality ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="inputNumber" class="form-label">Outlet Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="outlet" name="outlet" required>
                                            <option selected disabled value="">Choose...</option>
                                            <?php
                      $query = "SELECT * FROM outlet_type ";
                      $brands = mysqli_query($db, $query);
                while ($brand = mysqli_fetch_array(
                        $brands,MYSQLI_ASSOC)):;
            ?>
                                            <option value="<?php echo $brand["id"];
                ?>">
                                                <?php echo $brand["name"];
                    ?>
                                            </option>
                                            <?php
                endwhile;
            ?>
                                        </select>
                                        <div class="invalid-feedback">Please enter email!</div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <label for="inputPassword" class="form-label">Unit Cost</label>
                                    <div class="col-sm-10">
                                        <input type="decimal" placeholder="Unit Cost" id="cost" name="cost"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" name="add_cost_mapping"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>
            </div>

            <!-- End General Form Elements -->

            </div>
            </div><!-- End Left side columns -->
            </div>
            </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

            </div>
        </section>
    </main><!-- End #main -->
    <?php include('inc/footer.php');?>
    <?php include('inc/footjs.php');?>
</body>

</html>