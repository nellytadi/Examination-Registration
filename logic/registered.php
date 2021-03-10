<?php
require_once '../src/DatabaseConnection.php';

 header('Content-Type: application/json; charset=UTF-8');

$conn = new DatabaseConnection();
$conn = $conn->connect();

$stmt = $conn->prepare("SELECT * FROM maths_competition");
$stmt->execute();


$registered_students = array();
 
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$registered_students[] = $row;	
	}
	
die(json_encode($registered_students));

?>