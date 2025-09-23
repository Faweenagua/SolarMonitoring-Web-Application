<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php
  if(isset($_SESSION['account_id'])){
    $accountID = $_SESSION['account_id'];
  }else{
    header("Location: login.php");
    exit();
  }
?>
<?php

$db = new Database();

$mydata = [];

//$query1 = "select AVG(`ch4ConcValue`) as avgCh4Conc, AVG(`preBmValue`) as avgPressure, AVG(`phValue`) as AvgpH, DAYNAME(`deviceLocalTime`) as dayOfWeek from sensordatarecords where deviceLocalTime > now() - interval 1 week GROUP BY DATE(`deviceLocalTime`) ORDER BY DATE(`deviceLocalTime`) ASC;";
$query1 = "SELECT AVG(`batteryChargePercentControl`) as controlBatSoc, AVG(`batteryChargePercentTest`) as testBatSoc, AVG(`chargeControlCurrentControl`) as controlChargeCurrent, AVG(`chargeControlCurrentTest`) as testChargeCurrent, DATE_FORMAT(`serverTime`, '%D %l %p') as hourOfDay from sensordatarecords WHERE accountID = $accountID AND panelCurrentControl >= 0 AND panelCurrentTest >= 0 AND DATE_SUB(UTC_TIMESTAMP,INTERVAL 23 HOUR) <= serverTime AND TIME(`serverTime`) GROUP BY HOUR(`serverTime`) ORDER BY `serverTime` ASC;";



if($results = $db->select($query1)){
   $mydata = $results->fetch_all(MYSQLI_ASSOC);
   $results->close();
}
echo json_encode($mydata);

?>