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

$query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID ORDER BY dataID ASC";
$dataRangeName = " ";

if(isset($_GET['range'])){
    $dataRange = $_GET['range'];

    if($dataRange == 0){
        $query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= serverTime ORDER BY dataID ASC";
        $dataRangeName = "Last 7 Days";
    } else if($dataRange == 1){
        $query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 14 DAY) <= serverTime ORDER BY dataID ASC";
        $dataRangeName = "Last 14 Days";
    }else if($dataRange == 2){
        $query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID AND DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= serverTime ORDER BY dataID ASC";
        $dataRangeName = "Last 30 Days";
    }else{
        $query1 = "SELECT * FROM sensordatarecords WHERE accountID = $accountID ORDER BY dataID ASC";
        $dataRangeName = "All Data";
    }
}


date_default_timezone_set('GMT');


if($results = $db->select($query1)){

    // Fetch records from database 
    $rowNumber = 0;

 
    if($results->num_rows > 0){ 
        $delimiter = ","; 
        $filename = $dataRangeName."-solarMonitoring-data_" . date('Y-m-d_H-i-s') . ".csv"; 
        
        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 
        
        // Set column headers 
        $fields = array('#', 'device_id', 'massOfDust(g)', 'controlPanelTemperature(*C)', 'testPanelTemperature(*C)', 'ambientTemperature(*C)', 'humidity(%)', 'controlPanelCurrent(mA)',
                        'testPanelCurrent(mA)', 'controlBatteryCurrent(mA)', 'testBatteryCurrent(mA)','batteryChargePercentTest(%)', 'batteryChargePercentControl(%)', 'controlPanelVoltage(V)', 'testPanelVoltage(V)', 
                        'controlChargeControllerVoltage(V)', 'testChargeControllerVoltage(V)', 'massConcentrationPm1p0(µg/m^3)', 'massConcentrationPm2p5(µg/m^3)', 'massConcentrationPm4p0(µg/m^3)', 'massConcentrationPm10p0(µg/m^3)', 'ambientHumidityPMSensor(%)', 
                        'ambientTemperaturePMSensor(*C)', 'windDirection(degrees)', 'windSpeed(m/s)', 'amountOfRainfall(mm)', 'controlPanelPower(W)', 'testPanelPower(W)', 'controlChargeControllerPower(W)', 'testChargeControlPower(W)', 'irradiance(W/m^2)', 'vocIndex', 'noxIndex', 'DateTime',
                        'calcIndexControl', 'instIndexControl', 'efficiencyControl(%)', 'calcIndexTest', 'instIndexTest', 'efficiencyTest(%)'); 
        fputcsv($f, $fields, $delimiter);
        
        // Output each row of the data, format line as csv and write to file pointer 
        while($row = $results->fetch_assoc()){ 
            //$status = ($row['status'] == 1)?'Active':'Inactive'; 
            $lineData = array($rowNumber, $row['deviceID'], $row['massOfDust'], $row['tempOfPanelControl'], $row['tempOfPanelTest'], $row['ambientTemp'], $row['humidity'], 
            $row['panelCurrentControl'], $row['panelCurrentTest'], $row['chargeControlCurrentControl'], $row['chargeControlCurrentTest'],$row['batteryChargePercentTest'], $row['batteryChargePercentControl'],
            $row['panelVoltageControl'], $row['panelVoltageTest'], 
            $row['chargeControlVoltageControl'], $row['chargeControlVoltageTest'], $row['massConcentrationPm1p0'], $row['massConcentrationPm2p5'], $row['massConcentrationPm4p0'], 
            $row['massConcentrationPm10p0'], $row['ambientHumidityPM'], $row['ambientTemperaturePM'], $row['windDirection'], $row['windSpeed'], $row['amountOfRainfall'], ($row['panelPowerControl']/1000), ($row['panelPowerTest']/1000), 
            ($row['chargeControlPowerControl']/1000), ($row['chargeControlPowerTest']/1000), $row['irradiance'], $row['vocIndex'], $row['noxIndex'], $row['serverTime'],
            $row['calcIndexControl'], $row['instIndexControl'], $row['efficiencyControl'], $row['calcIndexTest'], $row['instIndexTest'], $row['efficiencyTest']); 
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