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


/* 
    if(isset($_SESSION['doctor_id'])){
        $doctorID = $_SESSION['doctor_id'];
    }else{
        header("Location: doctor-login.php");
        exit();
    }
*/
    
    
    $query1 = "SELECT * FROM feedshknsdbkernjjn WHERE accountID = $accountID";

    $feed = $db->select($query1);

    if($feed == false){
      $numOfRows = 0;
    }else{
      $numOfRows = $feed->num_rows;

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
    <link
      href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css"
      rel="stylesheet"
    />
   
    <?php require 'includes/header.php'; ?>
    
      <!--end header -->
      <!--start page wrapper -->
      <div class="page-wrapper">
        <div class="page-content">
          <div class="row">
            <h6 class="mb-0 text-uppercase">Feed Records</h6>
            <hr />
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example2"
                    class="table table-striped table-bordered"
                  >
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Feed</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Comment</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php

                      if($numOfRows > 0){
                        while($row = $feed->fetch_object()){
                          $feedID = $row->ID;
                          $fullName = $row->fullName;
                          $feedRecorded = $row->feed;
                          $comment = $row->comment;
                          $dateFed = formatDateForForm($row->datetimeFed);
                          $timeFed = formatTime($row->datetimeFed);

                          if($comment == " "){

                            $comment = "N/A";
                          }

                          echo "

                          <tr>
                            <td>".$fullName."</td>
                            <td>".$feedRecorded."</td>
                            <td>".$dateFed."</td>
                            <td>".$timeFed."</td>
                            <td>".$comment."</td>
                          </tr>
                          
                          ";

                        }
                      }

                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Full Name</th>
                        <th>Feed</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Comment</th>
                      </tr>
                    </tfoot>
                  </table>
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
    <!--<script src="assets/js/dashboard-human-resources.js"></script>-->
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <!-- <script>
		$(document).ready(function() {
			$('#example').DataTable(
			  
			  );
			$("div.dataTables_filter input").focus();
		  } );
	</script> -->

    <script>
      $(document).ready(function () {
        $("#example").DataTable();
      });
    </script>

    <script>
      $(document).ready(function () {
        var table = $("#example2").DataTable({
          lengthChange: false,
          buttons: ["copy", "excel", "pdf", "print"],
        });

        table
          .buttons()
          .container()
          .appendTo("#example2_wrapper .col-md-6:eq(0)");
      });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
  </body>
</html>
