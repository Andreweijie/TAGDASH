<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli('127.0.0.1', 'root', '', 'cdmb');;


$query = "SELECT * FROM tagging ";

    $result = $conn->query($query);
	

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	if ($outp != "[") {$outp .= ",";}
	$outp .= '{"Number":"'  . $rs["Number"] . '",';
	$outp .= '"STDate":"' . $rs["STDate"] . '",';
	$outp .= '"Category":' . $rs["Category"] . '}';
}
$outp .="]";

$conn->close();


echo($outp);
?>





