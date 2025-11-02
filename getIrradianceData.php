<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php
  if(isset($_SESSION['account_id'])){
    $accountID = $_SESSION['account_id'];
  }else{
    header("Location: login_test.php");
    exit();
  }
?>
<?php 
 

$db = new Database();

$mydata = [];

$query1 = "SELECT MAX(`irradiance`) as irradiance, DATE_FORMAT(`datetimeFed`,'%a %D %b') as dayOfWeek FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= datetimeFed GROUP BY DATE(`datetimeFed`) ORDER BY DATE(`datetimeFed`) ASC;";

if($results = $db->select($query1)){
   $mydata = $results->fetch_all(MYSQLI_ASSOC);
   $results->close();
}
echo json_encode($mydata);

?>