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


/* 
    if(isset($_SESSION['doctor_id'])){
        $doctorID = $_SESSION['doctor_id'];
    }else{
        header("Location: doctor-login.php");
        exit();
    }
*/
    
    
    

    if(isset($_POST['submit'])){

      if(isset($_POST['changeDefaults'])){

        $ch4min = $db->escapeString($_POST['CH4Min']);
        $ch4max = $db->escapeString($_POST['CH4Max']);
  
        $batMin = $db->escapeString($_POST['batMin']);
        $batMax = $db->escapeString($_POST['batMax']);
  
        $phRedMin = $db->escapeString($_POST['phRedMin']);
        $phYellowMin = $db->escapeString($_POST['phYellowMin']);
        $phYellowMax = $db->escapeString($_POST['phYellowMax']);
        $phRedMax = $db->escapeString($_POST['phRedMax']);
  
        $tempRedMin = $db->escapeString($_POST['tempRedMin']);
        $tempYellowMin = $db->escapeString($_POST['tempYellowMin']);
        $tempYellowMax = $db->escapeString($_POST['tempYellowMax']);
        $tempRedMax = $db->escapeString($_POST['tempRedMax']);
  
  
        $ch4Thresholds = $ch4min . "|" . $ch4max;
        $batThresholds = $batMin . "|" . $batMax;
        $phThresholds = $phRedMin . "|".$phYellowMin . "|" . $phYellowMax . "|" . $phRedMax; 
        $tempThresholds = $tempRedMin . "|".$tempYellowMin . "|" . $tempYellowMax . "|" . $tempRedMax; 
  
        //echo($tempThresholds);
  
        
        $query = "INSERT INTO `alertthresholdssdlnajnnkdsk` (`useDefault`, `methaneThreshold`, `phThreshold`, `tempThreshold`, `batteryThreshold`) VALUES ('1', '$ch4Thresholds', '$phThresholds', '$tempThresholds', '$batThresholds');";
  
        if($db->insert($query)){
             $alertMe = 1;
       }else{
            $alertMe = 3;
       }

      }else{
        $query1 = "SELECT * from defaultthresholdsdskjajdjsk ORDER BY ID DESC LIMIT 1";


        if($results = $db->select($query1)){
          $mydata = $results->fetch_assoc();
          
          //echo($mydata["methaneDefaultThreshold"]);

          $ch4Thresholds = $mydata["methaneDefaultThreshold"];
          $batThresholds = $mydata["batteryDefaultthreshold"];
          $phThresholds = $mydata["phDefaultThreshold"];
          $tempThresholds = $mydata["tempDefaultThreshold"];

          $query = "INSERT INTO `alertthresholdssdlnajnnkdsk` (`useDefault`, `methaneThreshold`, `phThreshold`, `tempThreshold`, `batteryThreshold`, `accountID`) VALUES ('0', '$ch4Thresholds', '$phThresholds', '$tempThresholds', '$batThresholds', '$accountID');";
  
          if($db->insert($query)){
              $alertMe = 2;
          }else{
              $alertMe = 3;
          }

          $results->close();
        }

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
                          echo('<h6 class="mb-0 text-white">New User Alert Saved Successfully</h6>');
                          echo('<div class="text-white"> </div>');
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
                        echo('<h6 class="mb-0 text-white">Alerts Have Been Set to Default Values</h6>');
                        echo('<div class="text-white"> </div>');
                        echo('</div>');
                      echo('</div>');
                    echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                  echo('</div>');
                }else if($alertMe == 3){
                  echo('<div class="alert border-0 alert-dismissible fade show py-2">');
                    echo('<div class="d-flex align-items-center">');
                      echo('<div class="font-35 text-white"><i class="bx bx-info-circle"></i>');
                      echo('</div>');
                      echo('<div class="ms-3">');
                        echo('<h6 class="mb-0 text-white">Failed To Add Alert</h6>');
                        echo('<div class="text-white"> </div>');
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
                      <i class="bx bx-error me-1 font-22 text-white"></i>
                    </div>
                    <h5 class="mb-0 text-white">Set Alerts</h5>
                  </div>
                  <hr />
                  <form class="row g-3" method="POST" action="setAlerts.php">
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" name="changeDefaults" type="checkbox" value="" id="flexCheckDefault" onchange="activateDefaultChange()">
                            <label class="form-check-label" for="flexCheckDefault">Change default alerts</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Methane Alerts</label>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Red when less than</span>
                        <input type="number" class="form-control" min="0" max="100" placeholder="Value" aria-label="Value" name="CH4Min" id="CH4Min" disabled> <span class="input-group-text"> Yellow when between</span>
                            <input type="number" class="form-control" min="0" max="100" placeholder="Value" aria-label="Value" name="CH4Max" id="CH4Max" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Green when above</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Battery Alerts</label>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Red when less than</span>
                        <input type="number" class="form-control" min="0" max="100" placeholder="Value" aria-label="Value" name="batMin" id="batMin" disabled> <span class="input-group-text"> Yellow when between</span>
                            <input type="number" class="form-control" min="0" max="100" placeholder="Value" aria-label="Value" name="batMax" id="batMax" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Green when above</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">pH Alerts</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Red</span>
                            <input type="number" class="form-control" min="0" max="15" step=".1" placeholder="Value" aria-label="Value" name="phRedMin" id="phRedMin" disabled> <span class="input-group-text"> Yellow</span>
                            <input type="number" class="form-control" min="0" max="15" step=".1" placeholder="Value" aria-label="Value" name="phYellowMin" id="phYellowMin" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Green</span>
                            <input type="number" class="form-control" min="0" max="15" step=".1" placeholder="Value" aria-label="Value" name="phYellowMax" id="phYellowMax" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Yellow</span>
                            <input type="number" class="form-control" min="0" max="15" step=".1" placeholder="Value" aria-label="Value" name="phRedMax" id="phRedMax" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Red </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Temperature Alerts</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Red</span>
                            <input type="number" class="form-control" min="0" max="100" step=".1" placeholder="Value" aria-label="Value" name="tempRedMin" id="tempRedMin" disabled> <span class="input-group-text"> Yellow</span>
                            <input type="number" class="form-control" min="0" max="100" step=".1" placeholder="Value" aria-label="Value" name="tempYellowMin" id="tempYellowMin" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Green</span>
                            <input type="number" class="form-control" min="0" max="100" step=".1" placeholder="Value" aria-label="Value" name="tempYellowMax" id="tempYellowMax" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Yellow</span>
                            <input type="number" class="form-control" min="0" max="100" step=".1" placeholder="Value" aria-label="Value" name="tempRedMax" id="tempRedMax" disabled><span class="input-group-text" id="inputGroup-sizing-sm"> Red </span>
                        </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-light px-5" name="submit">
                        Submit
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
    <script src="assets/js/criticalPoints.js"></script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>

    <script>
      let radioStatus = 0;

      function activateDefaultChange(){
        if(radioStatus == 1){
            document.getElementById('batMax').disabled = true;
            document.getElementById('batMin').disabled = true;
            document.getElementById('CH4Max').disabled = true;
            document.getElementById('CH4Min').disabled = true;

            document.getElementById('phRedMin').disabled = true;
            document.getElementById('phYellowMin').disabled = true;
            document.getElementById('phYellowMax').disabled = true;
            document.getElementById('phRedMax').disabled = true;

            document.getElementById('tempRedMin').disabled = true;
            document.getElementById('tempYellowMin').disabled = true;
            document.getElementById('tempYellowMax').disabled = true;
            document.getElementById('tempRedMax').disabled = true;
            setDefaultThresholds();
            radioStatus = 0;
        }else{
            document.getElementById('batMax').disabled = false;
            document.getElementById('batMin').disabled = false;
            document.getElementById('CH4Max').disabled = false;
            document.getElementById('CH4Min').disabled = false;

            document.getElementById('phRedMin').disabled = false;
            document.getElementById('phYellowMin').disabled = false;
            document.getElementById('phYellowMax').disabled = false;
            document.getElementById('phRedMax').disabled = false;

            document.getElementById('tempRedMin').disabled = false;
            document.getElementById('tempYellowMin').disabled = false;
            document.getElementById('tempYellowMax').disabled = false;
            document.getElementById('tempRedMax').disabled = false;


            radioStatus = 1;
        }
          
        
      }


      function setDefaultThresholds(){
        let json_dataDCP = 0;

        $.ajax({
          url: "getDefaultCriticalPoints.php",
          type: "POST",
          success: function (result) {
            json_dataDCP = JSON.parse(result);
            methaneThresholds = json_dataDCP[0].methaneDefaultThreshold.split("|");
            phThresholds = json_dataDCP[0].phDefaultThreshold.split("|");
            tempThresholds = json_dataDCP[0].tempDefaultThreshold.split("|");
            batteryThresholds = json_dataDCP[0].batteryDefaultthreshold.split("|");

            //console.log(parseFloat(methaneThresholds[1]));
          },
        }).then(setFormValues);
      }

      function setFormValues(){
        document.getElementById("CH4Min").value = parseFloat(methaneThresholds[0]);
        document.getElementById("CH4Max").value = parseFloat(methaneThresholds[1]);
        document.getElementById("batMin").value = parseFloat(batteryThresholds[0]);
        document.getElementById("batMax").value = parseFloat(batteryThresholds[1]);
        document.getElementById("phRedMin").value = parseFloat(phThresholds[0]);
        document.getElementById("phYellowMin").value = parseFloat(phThresholds[1]);
        document.getElementById("phYellowMax").value = parseFloat(phThresholds[2]);
        document.getElementById("phRedMax").value = parseFloat(phThresholds[3]);
        document.getElementById("tempRedMin").value = parseFloat(tempThresholds[0]);
        document.getElementById("tempYellowMin").value = parseFloat(
          tempThresholds[1]
        );
        document.getElementById("tempYellowMax").value = parseFloat(
          tempThresholds[2]
        );
        document.getElementById("tempRedMax").value = parseFloat(tempThresholds[3]);

      }
    </script>
  </body>
</html>
