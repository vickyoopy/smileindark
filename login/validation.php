<?php
	header("Content-Type: application/json; charset=UTF-8");
	$username = $_GET['us'];
	$password = $_GET['pa'];
	if($username=="yaopeng" && $password=="happy233")
		$valid = ["valid" =>true];
	else
		$valid = ["valid" =>false];
	$jsonText = json_encode($valid);
	$result = urldecode($jsonText);
	echo $result;
?>