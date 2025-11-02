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

//$query1 = "select AVG(`ch4ConcValue`) as avgCh4Conc, AVG(`preBmValue`) as avgPressure, AVG(`phValue`) as AvgpH, DAYNAME(`deviceLocalTime`) as dayOfWeek from sensordatarecords where deviceLocalTime > now() - interval 1 week GROUP BY DATE(`deviceLocalTime`) ORDER BY DATE(`deviceLocalTime`) ASC;";
$query1 = "SELECT `soilingRatio`, `soilingLoss`, `controlPanelPR`, `controlPanelCPR`, `testPanelPR`, `testPanelCPR`, DATE_FORMAT(`dataTime`, '%D %b') as dataDay from calculatedparametersdwlklqw WHERE accountID = $accountID AND DATE_SUB(UTC_TIMESTAMP,INTERVAL 14 DAY) <= `dataTime` ORDER BY `dataTime` ASC;";



if($results = $db->select($query1)){
   $mydata = $results->fetch_all(MYSQLI_ASSOC);
   $results->close();
}
echo json_encode($mydata);

?>