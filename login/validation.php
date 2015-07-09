<?php
	header("Content-Type: application/json; charset=UTF-8");
	$username = $_GET['u'];
	$password = $_GET['p'];
	if($username=="yaopeng" && $password=="happy233")
		$valid = array("valid" =>true);
	else
		$valid = array("valid" =>false);
	$jsonText = json_encode($valid);
	$result = urldecode($jsonText);
	echo $result;
?>