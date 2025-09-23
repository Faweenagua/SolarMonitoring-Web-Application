<?php session_start(); ?>
<?php include 'libraries/Database.php'; ?>
<?php

    $msg = " ";
    $db = new Database();

    date_default_timezone_set('GMT');

    $amountOfRainfall = -1;

    $amountOfRainfall = rand(0,100);
    
    $amountOfRainfall = $_GET['amountOfRainfall'];
    
    $dt = date("Y-m-d H:i:s");
    

    if($amountOfRainfall > -1){
      $sql = "INSERT INTO `rainTest` ".
                "(`ammountOfRain`, `dataDateTime`) "."VALUES ".
                "('$amountOfRainfall', '$dt')";

        if($db->insert($sql)){
            echo "Success";
        }else {
            echo "Failed to upload data";
        }
    }
    
            
?>