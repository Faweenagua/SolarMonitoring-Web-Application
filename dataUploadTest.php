<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php

    $msg = " ";
    $db = new Database();

    date_default_timezone_set('GMT');


    $userID = 1;
    $deviceID = -1;
    $massOfDust = -1;
    $tempOfPanelControl = -1;
    $tempOfPanelTest = -1;
    $ambientTemp = -1;
    $humidity = -1;
    $panelCurrentControl = -1;
    $panelCurrentTest = -1;
    $chargeControlCurrentControl = -1;
    $chargeControlCurrentTest = -1;
    $panelVoltageControl = -1;
    $panelVoltageTest = -1;
    $chargeControlVoltageControl = -1;
    $chargeControlVoltageTest = -1;
    $charging = -1;
    $deviceLocalTime = -1;
    $serverTime = -1;
    $accountID = -1;
    $massConcentrationPm1p0 = -1;
    $massConcentrationPm2p5 = -1;
    $massConcentrationPm4p0 = -1;
    $massConcentrationPm10p0 = -1;
    $ambientHumidityPM = -1;
    $ambientTemperaturePM = -1;
    $windDirection = -1;
    $windSpeed = -1;
    $amountOfRainfall = -1;
    $panelPowerControl = -1;
    $panelPowerTest = -1;
    $chargeControlPowerControl = -1;
    $chargeControlPowerTest = -1;
    $irradiance = -1;
    $soilingRatio = 0;
    $soilingLoss = 0;

    $irradianceRef = 1000;
    $irradianceValue = 0;
    $tempCoef = -0.43;
    $standardTemp = 25;
    $maxPowerSoiled = 0;
    $maxPowerRef = 100;
    $maxPowerCleaned = 0;
    $samplingTime = 0.05;
    $timeOverRefPower = $samplingTime/$maxPowerRef;
    $timeOverRefIrr = $samplingTime/$irradianceRef;
    $performanceRatioControl = 0;
    $performanceRatioTest = 0;
    $corrPerformanceRatioControl = 0;
    $corrPerformanceRatioTest = 0;
    $daysAgo = 7;


    


    $userID = 1;
    $deviceID = "xxv233";
    $massOfDust = rand(0,100);
    $tempOfPanelControl = rand(0,100);
    $tempOfPanelTest = rand(0,100);
    $ambientTemp = rand(0,100);
    $humidity = rand(0,100);
    $panelCurrentControl = rand(0,100);
    $panelCurrentTest = rand(0,100);
    $chargeControlCurrentControl = rand(0,100);
    $chargeControlCurrentTest = rand(0,100);
    $panelVoltageControl = rand(0,100);
    $panelVoltageTest = rand(0,100);
    $chargeControlVoltageControl = rand(0,100);
    $chargeControlVoltageTest = rand(0,100);
    $charging = rand(0,1);
    $deviceLocalTime = date("Y-m-d  H:i:s",time());
    $accountID = 1;
    $massConcentrationPm1p0 = rand(0,100);
    $massConcentrationPm2p5 = rand(0,100);
    $massConcentrationPm4p0 = rand(0,100);
    $massConcentrationPm10p0 = rand(0,100);
    $ambientHumidityPM = rand(0,100);
    $ambientTemperaturePM = rand(0,100);
    $windDirection = rand(0,360);
    $windSpeed = rand(0,100);
    $amountOfRainfall = rand(0,100);
    $panelPowerControl = rand(0,100);
    $panelPowerTest = rand(0,100);
    $chargeControlPowerControl = rand(0,100);
    $chargeControlPowerTest = rand(0,100);
    $irradiance = rand(0,100);
    
    
    if(isset($_GET['user_id'])){
        $userID = test_input($_GET['user_id']);
    }
    if(isset($_GET['device_id'])){
        $deviceID = test_input($_GET['device_id']);
    }
    if(isset($_GET['massOfDust'])){
        //$ch4ConcValue = $_GET['methaneC'];
        $massOfDust =  rand(5,90);;

    }
    if(isset($_GET['tempOfPanelControl'])){
        $tempOfPanelControl = test_input($_GET['tempOfPanelControl']);
        $tempOfPanelTest = test_input($_GET['tempOfPanelTest']);
        $ambientTemp = test_input($_GET['ambientTemp']);
        $humidity = test_input($_GET['humidity']);
        $panelCurrentControl = abs(test_input($_GET['panelCurrentControl']));
        $panelCurrentTest = abs(test_input($_GET['panelCurrentTest']));
        $chargeControlCurrentControl = abs(test_input($_GET['chargeControlCurrentControl']));
        $chargeControlCurrentTest = abs(test_input($_GET['chargeControlCurrentTest']));
        $panelVoltageControl = test_input($_GET['panelVoltageControl']);
        $panelVoltageTest = test_input($_GET['panelVoltageTest']);
        $chargeControlVoltageControl = test_input($_GET['chargeControlVoltageControl']);
        $chargeControlVoltageTest = test_input($_GET['chargeControlVoltageTest']);
        // $charging = test_input($_GET['charging']);
        $massConcentrationPm1p0 = test_input($_GET['massConcentrationPm1p0']);
        $massConcentrationPm2p5 = test_input($_GET['massConcentrationPm2p5']);
        $massConcentrationPm4p0 = test_input($_GET['massConcentrationPm4p0']);
        $massConcentrationPm10p0 = test_input($_GET['massConcentrationPm10p0']);
        $ambientHumidityPM = test_input($_GET['ambientHumidityPM']);
        $ambientTemperaturePM = test_input($_GET['ambientTemperaturePM']);
        $windDirection = test_input($_GET['windDirection']);
        $windSpeed = test_input($_GET['windSpeed']);
        $amountOfRainfall = test_input($_GET['amountOfRainfall']);
        $panelPowerControl = test_input($_GET['panelPowerControl']);
        $panelPowerTest = test_input($_GET['panelPowerTest']);
        $chargeControlPowerControl = test_input($_GET['chargeControlPowerControl']);
        $chargeControlPowerTest = test_input($_GET['chargeControlPowerTest']);
        $irradiance = test_input($_GET['irradiance']);
        
    }
    
    if(isset($_GET['deviceLocalTime'])){
        $deviceLocalTime = test_input($_GET['deviceLocalTime']);
    }
    if(isset($_GET['deviceLocalDate'])){
        $deviceLocalTime = test_input($_GET['deviceLocalDate']) . " " . $deviceLocalTime;
    }

    if(isset($_GET['userKey'])){
        $userKey = test_input($_GET['userKey']);
    }

    $deviceTime = new DateTime($deviceLocalTime);

    $startTime = new DateTime("2009-10-11 18:00:00");
    $endTime = new DateTime("2009-10-11 18:05:00");

    $deviceTimeTime =  $deviceTime->format("H:i:s");
    $endTimeTime =  $endTime->format("H:i:s");
    $startTimeTime = $startTime->format("H:i:s");

    
    $userKeyQuery = "SELECT accountID FROM `devicesoenjnjcdbbevebbre` WHERE deviceID = '$deviceID'";
    $userIDResponse = $db->select($userKeyQuery);

    if($userIDResponse == false){
        echo "Failed to upload data";
    }else{
        $userID = $userIDResponse->fetch_assoc()['accountID'];
        $accountID = $userID;
        // $sql = "INSERT INTO `sensordatarecords` ".
        //         "(`userID`, `deviceID`, `massOfDust`, `tempOfPanelControl`, `tempOfPanelTest`, `ambientTemp`, `humidity`, `panelCurrentControl`, `panelCurrentTest`, `chargeControlCurrentControl`, `chargeControlCurrentTest`, `panelVoltageControl`, `panelVoltageTest`, `chargeControlVoltageControl`, `chargeControlVoltageTest`,`massConcentrationPm1p0`, `massConcentrationPm2p5`, `massConcentrationPm4p0`, `massConcentrationPm10p0`, `ambientHumidityPM`, `ambientTemperaturePM`, `windDirection`, `windSpeed`, `amountOfRainfall`, `panelPowerControl`, `panelPowerTest`, `chargeControlPowerControl`, `chargeControlPowerTest`, `irradiance`, `charging`, `deviceLocalTime`, `accountID`) "."VALUES ".
        //         "('$userID', '$deviceID', '$massOfDust', '$tempOfPanelControl', '$tempOfPanelTest', '$ambientTemp', '$humidity', '$panelCurrentControl', '$panelCurrentTest', '$chargeControlCurrentControl', '$chargeControlCurrentTest', '$panelVoltageControl', '$panelVoltageTest', '$chargeControlVoltageControl', '$chargeControlVoltageTest', '$massConcentrationPm1p0', '$massConcentrationPm2p5', '$massConcentrationPm4p0', '$massConcentrationPm10p0', '$ambientHumidityPM', '$ambientTemperaturePM', '$windDirection', '$windSpeed', '$amountOfRainfall', '$panelPowerControl', '$panelPowerTest', '$chargeControlPowerControl', '$chargeControlPowerTest', '$irradiance', '$charging', '$deviceLocalTime', '$userID')";

        // if($db->insert($sql)){
        //     echo "Success";
        // }else {
        //     echo "Failed to upload data";
        // }
    }
    


    if($deviceTimeTime > $startTimeTime && $deviceTimeTime < $endTimeTime){

        $totalControlPower = 0;
        $totalTestPower = 0;
        $controlPanelTemp = 0;
        $testPanelTemp = 0;
        $irradianceTotal = 0;
        $numberOfDataPoints = 0;


        $query1 = "SELECT SUM(irradiance) as sumIrradiance, COUNT(irradiance) as countIrradiance from irradiancedatabvvjkjnjbh WHERE accountID = $accountID AND DATE_SUB(DATE(UTC_TIMESTAMP),INTERVAL $daysAgo DAY) = DATE(datetimeFed) AND TIME(`datetimeFed`) BETWEEN '06:00:00' AND '18:00:00' ORDER BY `irradiancedatabvvjkjnjbh`.`datetimeFed` ASC;";

        if($results = $db->select($query1)){
            $mydata = $results->fetch_assoc();
            $irradianceTotal = $mydata['sumIrradiance'];
            $numberOfDataPoints = $mydata['countIrradiance'];
        }


        $query89 = "SELECT MAX(`panelPowerControl`) as maxControlPower, MAX(`panelPowerTest`) as maxTestPower from sensordatarecords WHERE accountID = $accountID AND DATE_SUB(DATE(UTC_TIMESTAMP),INTERVAL $daysAgo DAY) = DATE(deviceLocalTime) AND TIME(`deviceLocalTime`) BETWEEN '06:00:00' AND '18:00:00' GROUP BY DATE(`deviceLocalTime`) ORDER BY `deviceLocalTime` ASC;";

        $maxPowerResponse = $db->select($query89);
        
        if($maxPowerResponse == false || $numberOfDataPoints <= 0){

            echo "Failed to upload data";
        }else{
            $maxPowerResponseAssoc = $maxPowerResponse->fetch_assoc();

            $controlMaxPower = $maxPowerResponseAssoc['maxControlPower'];
            $testMaxPower = $maxPowerResponseAssoc['maxTestPower'];

            if($controlMaxPower > 0 && $testMaxPower > 0){
                $soilingRatio = $testMaxPower/$controlMaxPower;
                $soilingLoss = 1 - $soilingRatio;
            }


            $query1 = "SELECT SUM(controlTotalPower) as controlTotalPower, SUM(testTotalPower) as testTotalPower from (SELECT DISTINCT (`panelPowerControl`) as controlTotalPower, (`panelPowerTest`) as testTotalPower, `deviceLocalTime` from sensordatarecords WHERE accountID = $accountID AND DATE_SUB(DATE(UTC_TIMESTAMP),INTERVAL $daysAgo DAY) = DATE(deviceLocalTime) AND TIME(`deviceLocalTime`) BETWEEN '06:00:00' AND '18:00:00' ORDER BY `sensordatarecords`.`deviceLocalTime` ASC) as foo;";

            if($results = $db->select($query1)){
                $mydata = $results->fetch_assoc();
                $totalControlPower =  $mydata['controlTotalPower'];
                $totalTestPower =  $mydata['testTotalPower'];

                if($totalTestPower > 0 && $totalControlPower > 0 && $irradianceTotal > 0){
                    $performanceRatioTest = ($totalTestPower*$samplingTime)/($maxPowerRef*$irradianceTotal*$timeOverRefIrr)/10;
                    $performanceRatioControl = ($totalControlPower*$samplingTime)/($maxPowerRef*$irradianceTotal*$timeOverRefIrr)/10;
                }
            }


            $query1 = "SELECT DISTINCT `tempOfPanelControl` as controlPanelTemp, `tempOfPanelTest` as testPanelTemp, `deviceLocalTime` from sensordatarecords WHERE accountID = $accountID AND DATE_SUB(DATE(UTC_TIMESTAMP),INTERVAL $daysAgo DAY) = DATE(deviceLocalTime) AND TIME(`deviceLocalTime`) BETWEEN '06:00:00' AND '18:00:00' ORDER BY `sensordatarecords`.`deviceLocalTime` ASC";

            if($results = $db->select($query1)){
                while($mydata = $results->fetch_assoc()){
                    $controlPanelTemp = $controlPanelTemp + (1 + $tempCoef *($mydata['controlPanelTemp'] - $standardTemp));
                    $testPanelTemp = $testPanelTemp + (1 + $tempCoef *($mydata['testPanelTemp'] - $standardTemp));
                }

                $testPanelTemp = abs($testPanelTemp);
                $controlPanelTemp = abs($controlPanelTemp);

                if($totalTestPower > 0 && $totalControlPower > 0 && $irradianceTotal > 0 && $testPanelTemp > 0 && $controlPanelTemp > 0){
                    $corrPerformanceRatioTest = ($totalTestPower*$samplingTime)/($maxPowerRef*$testPanelTemp*$irradianceTotal*$timeOverRefIrr)*100;
                    $corrPerformanceRatioControl = ($totalControlPower*$timeOverRefPower)/($controlPanelTemp*$irradianceTotal*$timeOverRefIrr)*100;
                }
            }
        }

        $dateTimeStamp=date_create($deviceLocalTime);
        date_sub($dateTimeStamp,date_interval_create_from_date_string($daysAgo ." Days"));
        $dataDateTimeAgo = date_format($dateTimeStamp,"c");

        $sql = "INSERT INTO `calculatedparametersdwlklqw` ".
                    "(`accountID`, `soilingRatio`, `soilingLoss`, `controlPanelPR`, `controlPanelCPR`, `testPanelPR`, `testPanelCPR`,`currentTime`,`dataTime`) "."VALUES ".
                    "('$accountID', '$soilingRatio', '$soilingLoss', '$performanceRatioControl', '$corrPerformanceRatioControl', '$performanceRatioTest', '$corrPerformanceRatioTest','$deviceLocalTime','$dataDateTimeAgo')";
    
        if($db->insert($sql)){
            // echo "Success";
        }else {
            // echo "Failed to upload data";
        }

    }




    
    // energierichsolar.com/hardware_code/insert.php?device_id=ENERGIERICH&current=7&voltage=7&temperature=7&humidity=7&dust=7&light_intensity=7&atmospheric_pressure=7

// INSERT INTO `sensordatarecords` (`userID`, `deviceID`, `ch4ConcValue`, `phValue`, 
            // `tempProbeTopValue`, `tempProbeMidValue`, `tempProbeBotValue`, `tempIrObValue`, 
            // `tempIrAmValue`, `tempBmAmValue`, `humBmValue`, `preBmValue`, `gasResBmValue`, 
            // `altBmValue`, `batteryLevel`, `charging`, `deviceLocalTime`) VALUES 
            // ('1', '1', '24', '3.5', '23', '24.5', '24.3', '23.5', '25.6', '26.1', '76', '1200', 
            // '110', '482', '60', '1', '2022-11-15 06:25:08');


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
            
?>