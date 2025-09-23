<?php include 'libraries/Database.php'; ?>

<?php


$db = new Database();
$alertMe = 0;

// Define location data
$city = 'Berekuso';
$lat = 5.759049;
$lon = -0.217649;
$alt = 151; #m

// Get current date and back date to 3 days ago
$todayDate = date_create(date("Y-m-d"));
date_sub($todayDate,date_interval_create_from_date_string("3 days"));
$start = date_format($todayDate,"Ymd");
// $start = ''.date("Ymd");
$endd = $start;

// Retrieve data from the dataset
$service_url = 'https://power.larc.nasa.gov/api/temporal/hourly/point?parameters=ALLSKY_SFC_SW_DWN,SZA,T2M,RH2M&community=RE&longitude='.$lon.'&latitude='.$lat.'&start='.$start.'&end='.$endd.'&format=JSON';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
// echo 'response ok!';
// echo $curl_response;
// var_dump(json_decode($curl_response, true));
$response_array = json_decode($curl_response, true);

// Parse data into Associative arrays
$response_parameters = $response_array['properties']['parameter'];

$ALLSKY_SFC_SW_DWN_Data = $response_parameters['ALLSKY_SFC_SW_DWN'];
$SZA_Data = $response_parameters['SZA'];
$T2M_Data = $response_parameters['T2M'];
$RH2M_Data = $response_parameters['RH2M'];


// var_dump($RH2M_Data);

// $keys = array_keys($RH2M_Data);

// print_r($keys);

// Loop through arrays and upload data to the database
foreach($RH2M_Data as $key => $value) {
    $ALLSKY_SFC_SW_DWN = $ALLSKY_SFC_SW_DWN_Data[$key];
    $SZA = $SZA_Data[$key];
    $RH = $RH2M_Data[$key];
    $T2M = $T2M_Data[$key];

    $dt = date_format($todayDate,"c"); 
    
    // echo $ALLSKY_SFC_SW_DWN."  ".$RH.'   '.$T2M.'     '.$dt.'<br>';

    $query = "INSERT INTO `nasaIrradianceData` (`ALLSKY_SFC_SW_DWN`, `SZA`, `T2M`, `RH2M`, `datetime`, `dateTimeSaved`) VALUES ('$ALLSKY_SFC_SW_DWN', '$SZA', '$T2M', '$RH', '$dt', '2023-11-18T07:00:00-06:00');";
    // echo $query;
    if($db->insert($query)){
        $alertMe = 1;
        // echo "siuuu";
    }else{
        $alertMe = 2;
        // echo "😥";
    }

    date_add($todayDate,date_interval_create_from_date_string("1 Hour")); // Add an hour (sampling time) to the time to match the data's time

}


?>