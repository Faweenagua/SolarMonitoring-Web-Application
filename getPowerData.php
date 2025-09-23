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

$query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID ORDER BY DATE(`serverTime`) ASC;";


if($results = $db->select($query1)){
   $mydata = $results->fetch_all(MYSQLI_ASSOC);
   $results->close();
}
echo json_encode($mydata);

?>