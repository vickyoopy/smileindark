<?php
	header("Content-Type: application/json; charset=UTF-8");
	$password = $_GET['q'];
	if($password=="happyday")
		$valid = ["valid" =>true];
	else
		$valid = ["valid" =>false];
	$jsonText = json_encode($valid);
	$result = urldecode($jsonText);
	echo $result;
?>