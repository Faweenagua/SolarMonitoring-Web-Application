<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php include 'helpers/format_helper.php'; ?>
<?php
  if(isset($_SESSION['account_id'])){
    $accountID = $_SESSION['account_id'];
  }else{
    header("Location: login.php");
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


    if(isset($_POST['submitFile'])){

    //   $irradiance = $db->escapeString($_POST['irradianceValue']);
      $dateTime = $db->escapeString($_POST['datetime']);
      $comment = $db->escapeString($_POST['comment']);

      if(strlen($comment) < 1){

        $comment = " ";
      }

      // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        
        // Validate whether selected file is a CSV file
        if(!empty($_FILES['irradianceFile']['name']) && in_array($_FILES['irradianceFile']['type'], $csvMimes)){
            
            // If the file is uploaded
            if(is_uploaded_file($_FILES['irradianceFile']['tmp_name'])){
                
                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['irradianceFile']['tmp_name'], 'r');
                
                // Skip the first line
                fgetcsv($csvFile);

                $dateTimeStamp=date_create($dateTime);
                // Parse data from CSV file line by line
                $count = 0;
                while(($line = fgetcsv($csvFile)) !== FALSE){

                    if($count > 0){
                        // Get row data
                        $time   = $line[0];
                        $irradiance  = $line[1];
                        
                        // $dateTimeStamp = strtotime($dateTime);
                        
                        $dataDateTime = date_format($dateTimeStamp,"c");

                        
                        $query = "INSERT INTO `irradiancedatabvvjkjnjbh` (`irradiance`, `comment`, `datetimeFed`, `accountID`) VALUES ('$irradiance', '$comment', '$dataDateTime', '$accountID');";
                        // echo $query;
                        if($db->insert($query)){
                            $alertMe = 1;
                        }else{
                            $alertMe = 2;
                        }
                        date_add($dateTimeStamp,date_interval_create_from_date_string("3 Minutes"));
                    }
                    $count++;
                }
                
                // Close opened CSV file
                fclose($csvFile);
                
                $qstring = '?status=succ';
            }else{
                $qstring = '?status=err';
            }
        }else{
            $alertMe = 3;
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
                    echo('<div class="alert bg-success border-0 alert-dismissible fade show py-2">');
                      echo('<div class="d-flex align-items-center">');
                        echo('<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>');
                        echo('</div>');
                        echo('<div class="ms-3">');
                          echo('<h6 class="mb-0 text-white">Irradiance Uploaded Successfully</h6>');
                          echo('</div>');
                        echo('</div>');
                      echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    echo('</div>');
                }else if ($alertMe == 2){
                  echo('<div class="alert bg-danger border-0 alert-dismissible fade show py-2">');
                      echo('<div class="d-flex align-items-center">');
                        echo('<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>');
                        echo('</div>');
                        echo('<div class="ms-3">');
                          echo('<h6 class="mb-0 text-white">File Upload Failed</h6>');
                          echo('<div class="text-white">Try again.</div>');
                          echo('</div>');
                        echo('</div>');
                      echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                    echo('</div>');
                }else if ($alertMe == 3){
                    echo('<div class="alert bg-danger border-0 alert-dismissible fade show py-2">');
                        echo('<div class="d-flex align-items-center">');
                          echo('<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>');
                          echo('</div>');
                          echo('<div class="ms-3">');
                            echo('<h6 class="mb-0 text-white">Please Upload a Valid CSV File.</h6>');
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
                    <h5 class="mb-0 text-white">Upload Irradiance File</h5>
                  </div>
                  <hr />
                  <form class="row g-3" enctype='multipart/form-data' method="POST" action="uploadIrradiance.php">
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
                        >Select Irradiance CSV File to Upload</label
                      >
                      <br>
                      <input
                        type="file"
                        class="form-control-file"
                        id="irradianceFile"
                        name="irradianceFile"
                        required />
                    </div>
                    <div class="col-12">
                      <label class="form-label">Select Data Collection Starting Date & time:</label>
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
                      <button type="submit" class="btn btn-light px-5" name="submitFile">
                        Upload File
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
