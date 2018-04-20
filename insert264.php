<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

error_reporting(E_ERROR);

try{
	$conn = new mysqli('127.0.0.1', 'root', '', 'cdmb');		
	$Number = $_GET["Number"];
	$STDate = $_GET["STDate"];
	$Category = $_GET["Category"];


	$query = "INSERT INTO tagging (`Number`, `STDate`, `Category`,`Time`) 	
VALUES ('" . addslashes($Number) . "' , '" . addslashes($STDate) . "', '" . addslashes($Category) . "', now())"; 
	$result = $conn->query($query);

	if (!$result){
		$json_out = "[" . json_encode(array("result"=>0)) . "]";		
	}
	else {
		$json_out = "[" . json_encode(array("result"=>1)) . "]";		
	}

	echo $json_out;

	$conn->close();

	}
catch(Exception $e) {
	$json_out =  "[".json_encode(array("result"=>0))."]";
	echo $json_out;
}
?>