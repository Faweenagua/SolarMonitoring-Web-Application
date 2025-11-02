<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php include 'helpers/format_helper.php'; ?>
<?php
  if(isset($_SESSION['account_id'])){
    $accountID = $_SESSION['account_id'];
  }else{
    header("Location: login_test.php");
    exit();
  }
?>
<?php


    $msg = " ";
    $db = new Database();
    $errorNo = 0;
    $alertMe = 0;


// echo "sdknfkjfdnsknjnkjdnfjnjkndkjnfjkskjnjfnjksnkfnksnnfjksjn";

    if(isset($_POST['submit'])){

      $unitName = $db->escapeString($_POST['unitName']);
      $unitSym = $db->escapeString($_POST['unitSym']);
      $description = $db->escapeString($_POST['description']);

      //var_dump($_POST);
      if(strlen($description) < 1){

        $description = " ";
      }

      /* header("Location: index.php");
      exit(); */
      
      $query = "INSERT INTO `unitsgbkkhkhnvcf` (`unitName`, `unitSymbol`, `description`, `accountID`) VALUES ('$unitName', '$unitSym', '$description', '$accountID');";

      if($db->insert($query)){
          $alertMe = 1;
      }else{
          $alertMe = 2;
      }
    }


/* 
    $query8 = "SELECT COUNT(recordID) FROM records WHERE status = 'Pending'";
    $results8 = $db->select($query8);
    $data8 = $results8->fetch_assoc();
	$numOfPendingRecords = $data8['COUNT(recordID)'];
     */
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link
      href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
      rel="stylesheet"
    />
    <link
      href="assets/plugins/metismenu/css/metisMenu.min.css"
      rel="stylesheet"
    />
    
    <?php require 'includes/header.php'; ?>

      <!--end header -->
      <!--start page wrapper -->
      <div class="page-wrapper">

        
        <div class="page-content">
          <div class="row">
            <div class="col-xl-7 mx-auto">

              <?php

                if($alertMe == 1){
                    echo('<div class="alert border-0 alert-dismissible fade show py-2">');
                      echo('<div class="d-flex align-items-center">');
                        echo('<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>');
                        echo('</div>');
                        echo('<div class="ms-3">');
                          echo('<h6 class="mb-0 text-white">Unit Added Successfully</h6>');
                          echo('<div class="text-white">You can start using new unit.</div>');
                          echo('</div>');
                        echo('</div>');
                      echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    echo('</div>');
                }else{}

              ?>
              <div class="card border-top border-0 border-4 border-white">
                <div class="card-body p-5">
                  <div class="card-title d-flex align-items-center">
                    <div>
                      <i class="bx bx-ruler me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0 text-white">Add Unit</h5>
                  </div>
                  <hr />
                  <form class="row g-3" method="POST" action="addUnits.php">
                    <div class="col-md-12 col-sm-12">
                      <label for="unitName" class="form-label"
                        >Unit Name</label
                      >
                      <input required
                        type="text"
                        class="form-control"
                        id="unitName"
                        name="unitName"
                      />
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <label for="unitSym" class="form-label"
                        >Unit Symbol or Short form</label
                      >
                      <input required
                        type="text"
                        class="form-control"
                        id="unitSym"
                        name="unitSym"
                      />
                    </div>
                    <div class="col-12">
                      <label for="description" class="form-label" 
                        >Description</label
                      >
                      <textarea
                        class="form-control"
                        id="description"
                        placeholder="Description..."
                        rows="3"
                        name="description"
                      ></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" name="submit" class="btn btn-light px-5">
                        Add
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end page wrapper -->
      <!--start overlay-->
      <div class="overlay toggle-icon"></div>
      <!--end overlay-->
      <!--Start Back To Top Button-->
      <a href="javaScript:;" class="back-to-top"
        ><i class="bx bxs-up-arrow-alt"></i
      ></a>
      <!--End Back To Top Button-->
      <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
      </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
      <div class="switcher-btn"><i class="bx bx-cog bx-spin"></i></div>
      <div class="switcher-body">
        <div class="d-flex align-items-center">
          <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
          <button
            type="button"
            class="btn-close ms-auto close-switcher"
            aria-label="Close"
          ></button>
        </div>
        <hr />
        <p class="mb-0">Gaussian Texture</p>
        <hr />

        <ul class="switcher">
          <li id="theme1"></li>
          <li id="theme2"></li>
          <li id="theme3"></li>
          <li id="theme4"></li>
          <li id="theme5"></li>
          <li id="theme6"></li>
        </ul>
        <hr />
        <p class="mb-0">Gradient Background</p>
        <hr />

        <ul class="switcher">
          <li id="theme7"></li>
          <li id="theme8"></li>
          <li id="theme9"></li>
          <li id="theme10"></li>
          <li id="theme11"></li>
          <li id="theme12"></li>
          <li id="theme13"></li>
          <li id="theme14"></li>
          <li id="theme15"></li>
        </ul>
      </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="assets/js/dashboard-human-resources.js"></script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
  </body>
</html>
