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

// $query1 = "SELECT AVG(`massOfDust`) as massOfDust, DAYNAME(`dateAdded`) as dayOfWeek FROM massofdustrecordsalkdsj WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 6 DAY) <= dateAdded GROUP BY DATE(`dateAdded`) ORDER BY DATE(`dateAdded`) ASC;";
$query1 = "SELECT AVG(`massOfDust`) as massOfDust, DAYNAME(`dateAdded`) as dayOfWeek FROM massofdustrecordsalkdsj WHERE accountID = $accountID AND DATE_SUB(UTC_TIMESTAMP,INTERVAL 14 DAY) <= dateAdded AND DATE_SUB(UTC_TIMESTAMP,INTERVAL 7 DAY) > dateAdded GROUP BY DATE(`dateAdded`) ORDER BY DATE(`dateAdded`);";


if($results = $db->select($query1)){
   $mydata = $results->fetch_all(MYSQLI_ASSOC);
   $results->close();
}
echo json_encode($mydata);

?>