<?php session_start(); ?>
<?php
  if(isset($_SESSION['account_id'])){
    $accountID = $_SESSION['account_id'];
  }else{
    header("Location: login.php");
    exit();
  }
?>

<?php

$alertMe = 0;

if(isset($_GET['alert'])){
  $alertMe = test_input($_GET['alert']);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
                  echo('<div class="alert border-0 bg-danger bg-gradient alert-dismissible fade show py-2">');
                    echo('<div class="d-flex align-items-center">');
                      echo('<div class="font-35 text-white"><i class="bx bx-info-circle"></i>');
                      echo('</div>');
                      echo('<div class="ms-3">');
                        echo('<h6 class="mb-0 text-white">No Data Found For Selected Duration</h6>');
                        echo('<div class="text-white"> </div>');
                        echo('</div>');
                      echo('</div>');
                    echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                  echo('</div>');
                }else if ($alertMe == 3){
                  echo('<div class="alert border-0 bg-danger bg-gradient alert-dismissible fade show py-2">');
                    echo('<div class="d-flex align-items-center">');
                      echo('<div class="font-35 text-white"><i class="bx bx-info-circle"></i>');
                      echo('</div>');
                      echo('<div class="ms-3">');
                        echo('<h6 class="mb-0 text-white">No Data Found For Selected Duration</h6>');
                        echo('<div class="text-white"> </div>');
                        echo('</div>');
                      echo('</div>');
                    echo('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
                  echo('</div>');
                }
              ?>
            </div>
          </div>
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
            <div class="col">
              <div class="card radius-10 ">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">PM 2.5 (µg/m<sup>3</sup>)</p>
                      <h5 class="mb-0" id="pm2_5">85</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart1"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">PM 10 (µg/m<sup>3</sup>)</p>
                      <h5 class="mb-0" id="pm10">50</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart2"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Soiling Loss (%)</p>
                      <h5 class="mb-0" id="soilingLoss">3.2</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart3"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Mass of Dust (g)</p>
                      <h5 class="mb-0" id="massOfDust">7</h5>
                    </div>
                  </div>
                <div class="" id="w-chart4"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Irradiance (W/m<sup>2</sup>)</p>
                      <h5 class="mb-0" id="irradiance">20</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart5"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Ambient Temperature (°C)</p>
                      <h5 class="mb-0" id="ambTemp">20</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart6"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Humidity (%)</p>
                      <h5 class="mb-0" id="humidity">51</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart7"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Wind Speed (m/s)</p>
                      <h5 class="mb-0" id="windSpeed">45</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart8"></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0">Amount of Rainfall (mm)</p>
                      <h5 class="mb-0" id="rainFall">230</h5>
                    </div>
                  </div>
                  <div class="" id="w-chart9"></div>
                </div>
              </div>
            </div>
           <!--  <div class="col">
              <div class="card radius-10 bg-success bg-gradient" id="phWidget">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white" id="phText">pH Level</p>
                      <h4 class="my-1 text-white" id="phValue">--</h4>
                    </div>
                    <div class="text-white ms-auto font-35" id="phIcon">
                      <i class="bx bx-test-tube"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10 bg-success bg-gradient" id="tempWidget">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white" id="tempText">Temperature</p>
                      <h4 class="text-white my-1" id="tempValue">--°C</h4>
                    </div>
                    <div class="text-white ms-auto font-35" id="tempIcon">
                      <i class="bx bxs-thermometer"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card radius-10 bg-success bg-gradient" id="batWidget">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <p class="mb-0 text-white" id="batText">Battery Level</p>
                      <h4 class="my-1 text-white" id="batteryLevelValue">-%</h4>
                    </div>
                    <div class="text-white ms-auto font-35" id="batIcon">
                      <i class="bx bxs-battery-low"></i>
                    </div>
                  </div>
                </div>
              </div> 
            </div>-->
          </div>
          <div class="row row-cols-1 row-cols-xl-2">
            <div class="col d-flex">
              <div class="card radius-10 w-100">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="mb-1">Control Panel</h5>
                      <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>last 10 recordings</p>
                    </div>
                    <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                  </div>
                </div>
                <div class="controlParameter-list p-3 mb-3">
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/electric-current.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Current (A)</h6>
                          <p class="mb-0">Average = <span id="ctrlCurrentAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="ctrlCurrentMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="ctrlCurrentMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart5"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/voltage.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Voltage (V)</h6>
                          <p class="mb-0">Average = <span id="ctrlVoltageAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="ctrlVoltageMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="ctrlVoltageMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart6"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/bulb.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Power (W)</h6>
                          <p class="mb-0">Average = <span id="ctrlPowerAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="ctrlPowerMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="ctrlPowerMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart7"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/hot.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Temperature (°C)</h6>
                          <p class="mb-0">Average = <span id="ctrlTempAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="ctrlTempMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="ctrlTempMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart8"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col d-flex">
              <div class="card radius-10 w-100">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h5 class="mb-1">Test Panel</h5>
                      <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>last 10 recordings</p>
                    </div>
                    <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                  </div>
                </div>
                <div class="testParameter-list p-3 mb-3">
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/electric-current.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Current (A)</h6>
                          <p class="mb-0">Average = <span id="testCurrentAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="testCurrentMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="testCurrentMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart9"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/voltage.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Voltage (V)</h6>
                          <p class="mb-0">Average = <span id="testVoltageAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="testVoltageMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="testVoltageMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart10"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/bulb.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Power (W)</h6>
                          <p class="mb-0">Average = <span id="testPowerAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="testPowerMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="testPowerMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart11"></div>
                    </div>
                  </div>
                  <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                    <div class="col-sm-6">
                      <div class="d-flex align-items-center">
                        <div class="product-img">
                          <img src="assets/images/icons/hot.png" alt="" />
                        </div>
                        <div class="ms-2">
                          <h6 class="mb-1">Temperature (°C)</h6>
                          <p class="mb-0">Average = <span id="testTempAvg"> 1150 </span></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm">
                      <h6 class="mt-2 mb-1">MAX: <span id="testTempMax"> 1150 </span></h6>
                      <h6 class="mb-0"> MIN: <span id="testTempMin"> 1150 </span></h6>
                    </div>
                    <div class="col-sm">
                      <div id="chart123"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Graph of Soiling Loss and Mass of Dust</h6>
                    </div>
                  </div>
                  <div id="soiling-dust"></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Graph of Daily Energy Generation</h6>
                    </div>
                  </div>
                  <div id="dailyPowerGen"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Graph of Average Hourly Panel Current</h6>
                    </div>
                  </div>
                  <div id="currentplot"></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Graph of Average Hourly Panel Power</h6>
                    </div>
                  </div>
                  <div id="powerplot"></div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->

          <div class="row">
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Average Battery Charge Current Over Time</h6>
                    </div>
                  </div>
                  <div id="batteryChargeCurrentPlot"></div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-12 col-xl-6">
              <div class="card radius-10">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-2 mt-2">Battery State of Charge Over Time</h6>
                    </div>
                  </div>
                  <div id="batterySOCplot"></div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->

          <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
              <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="mb-0">Performance Ratio Graph</h6>
                    </div>
                  </div>
                  <div class="chart-container">
                    <div id="performanceRatio"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->

          <!--end row-->
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
        <p class="foot mb-0">Copyright © 2023. All right reserved.</p>
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
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/index.js"></script>

    <!-- <script src="assets/js/dashboard-eCommerce.js"></script> -->
    <!--app JS-->
    <script src="assets/js/app.js"></script>

    <script>
      new PerfectScrollbar('.controlParameter-list');
      new PerfectScrollbar('.testParameter-list');
    </script>

  </body>
</html>
