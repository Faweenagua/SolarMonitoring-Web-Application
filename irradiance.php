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

    $allUnitsArray = array();
    $allItemsArray = array();
    $allCategoriesArray = array();


/* 
    if(isset($_SESSION['doctor_id'])){
        $doctorID = $_SESSION['doctor_id'];
    }else{
        header("Location: doctor-login.php");
        exit();
    }
*/
    
    
   
    date_default_timezone_set('GMT');


    if(isset($_POST['submit'])){

      $irradiance = $db->escapeString($_POST['irradianceValue']);
      $dateTime = $db->escapeString($_POST['datetime']);
      $comment = $db->escapeString($_POST['comment']);

      if(strlen($comment) < 1){

        $comment = " ";
      }

      $dateTimeStamp = strtotime($dateTime);

      
      $query = "INSERT INTO `irradiancedatabvvjkjnjbh` (`irradiance`, `comment`, `datetimeFed`, `accountID`) VALUES ('$irradiance', '$comment', '$dateTime', '$accountID');";

      if($db->insert($query)){
          $alertMe = 1;
      }else{
          $alertMe = 2;
      }


    }
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
                          echo('<h6 class="mb-0 text-white">Irradiance Recorded Successfully</h6>');
                          echo('<div class="text-white">You can add a new Irradiance measurement.</div>');
                          echo('</div>');
                        echo('</div>');
                      echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    echo('</div>');
                }else if ($alertMe == 2){
                  echo('<div class="alert border-0 alert-dismissible fade show py-2">');
                      echo('<div class="d-flex align-items-center">');
                        echo('<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>');
                        echo('</div>');
                        echo('<div class="ms-3">');
                          echo('<h6 class="mb-0 text-white">Failed To Record Irradiance Successful</h6>');
                          echo('<div class="text-white">Try again.</div>');
                          echo('</div>');
                        echo('</div>');
                      echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    echo('</div>');
                }
              ?>
              <div class="card border-top border-0 border-4 border-white">
                <div class="card-body p-5">
                  <div class="card-title d-flex align-items-center">
                    <div>
                      <i class="bx bx-sun me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0 text-white">Record Irradiance</h5>
                  </div>
                  <hr />
                  <form class="row g-3" method="POST" action="irradiance.php">
                     <!--<div class="col-md-12 col-sm-12">
                      <label for="inputFullName" class="form-label"
                        >Full Name</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="inputFullName"
                        name="inputFullName"
                        required />
                    </div> -->
                    <div class="col-md-12 col-sm-12">
                    <label for="irradianceValue" class="form-label"
                        >Irradiance (W/m2)</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="irradianceValue"
                        name="irradianceValue"
                        required min="0" value="0" step="0.01" />
                    </div>
                    <div class="col-12">
                      <label class="form-label">Date & time:</label>
                      <input type="datetime-local" class="form-control" name="datetime" required/>
                    </div>
                    <div class="col-12">
                      <label for="inputAddress" class="form-label" 
                        >Comment</label
                      >
                      <textarea
                        class="form-control"
                        id="inputAddress"
                        placeholder="Comment..."
                        rows="3"
                        name="comment"
                      ></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-light px-5" name="submit">
                        Record
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
    <!-- <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script> -->
    <!-- <script src="assets/js/dashboard-human-resources.js"></script> -->
    <!--app JS-->
    <script src="assets/js/app.js"></script>
  </body>
</html>
