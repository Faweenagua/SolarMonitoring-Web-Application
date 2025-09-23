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

$query1 = "SELECT * FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID ORDER BY ID DESC";
$dataRangeName = " ";

if(isset($_GET['range'])){
    $dataRange = $_GET['range'];

    if($dataRange == 0){
        $query1 = "SELECT * FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= datetimeFed ORDER BY datetimeFed DESC";
        $dataRangeName = "Last 7 Days";
    } else if($dataRange == 1){
        $query1 = "SELECT * FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 14 DAY) <= datetimeFed ORDER BY datetimeFed  DESC";
        $dataRangeName = "Last 14 Days";
    }else if($dataRange == 2){
        $query1 = "SELECT * FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= datetimeFed ORDER BY datetimeFed  DESC";
        $dataRangeName = "Last 30 Days";
    }else{
        $query1 = "SELECT * FROM irradiancedatabvvjkjnjbh WHERE accountID = $accountID ORDER BY datetimeFed  DESC";
        $dataRangeName = "All Data";
    }
}


date_default_timezone_set('GMT');


if($results = $db->select($query1)){

    // Fetch records from database 
    $rowNumber = 0;

 
    if($results->num_rows > 0){ 
        $delimiter = ","; 
        $filename = $dataRangeName."-irradiance-data_" . date('Y-m-d_H-i-s') . ".csv"; 
        
        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 
        
        // Set column headers 
        $fields = array('#', 'irradiance[W/m2]', 'Date Recorded', 'Time Recorded'); 
        fputcsv($f, $fields, $delimiter);
        
        // Output each row of the data, format line as csv and write to file pointer 
        while($row = $results->fetch_assoc()){ 
            //$status = ($row['status'] == 1)?'Active':'Inactive'; 
            $mydate=date_create($row['datetimeFed']);
            $lineData = array($rowNumber, $row['irradiance'], date_format($mydate,"Y/m/d"), date_format($mydate,"H:i")); 
            
            fputcsv($f, $lineData, $delimiter); 
            $rowNumber++;
        } 
        
        // Move back to beginning of file 
        fseek($f, 0); 
        
        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
        
        //output all remaining data on a file pointer 
        fpassthru($f); 
        exit;
    }else{
        header("Location: index.php?alert=2");
        exit;
    }
}else{
    header("Location: index.php?alert=2");
    exit;
}
 
exit; 
 
?>