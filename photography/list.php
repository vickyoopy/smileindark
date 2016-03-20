<?php
header("Content-Type: application/json; charset=UTF-8");
define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );

$result = array(
	"success"=>false,
	"msg"=>""
);

$photoList = array();
$descList = array();

$photoList1 = array();
$descList1 = array();

$photoList2 = array();
$descList2 = array();

$photoList3 = array();
$descList3 = array();

$album1="travel";
$album2="daily";
$album3="design";

try{
	$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->exec("set names 'utf8'");
	$sth = $dbh->prepare("SELECT * FROM `photos` ORDER BY `time` DESC LIMIT 10;");
	$sth->execute();
	$res = $sth->fetchAll();
	foreach ($res as $row) {
		$photoList[]=$row['title'];
		$descList[]=$row['description'];
	}

	$dbh1 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh1->exec("set names 'utf8'");
	$sth1 = $dbh1->prepare("SELECT * FROM `photos` where album = ? ORDER BY `time` DESC ;");
	$sth1->bindParam(1, $album1, PDO::PARAM_STR);
	$sth1->execute();
	$res1 = $sth1->fetchAll();
	foreach ($res1 as $row1) {
		$photoList1[]=$row1['title'];
		$descList1[]=$row1['description'];
	}

	$dbh2 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh2->exec("set names 'utf8'");
	$sth2 = $dbh2->prepare("SELECT * FROM `photos` where album = ? ORDER BY `time` DESC ;");
	$sth2->bindParam(1, $album2, PDO::PARAM_STR);
	$sth2->execute();
	$res2 = $sth2->fetchAll();
	foreach ($res2 as $row2) {
		$photoList2[]=$row2['title'];
		$descList2[]=$row2['description'];
	}

	$dbh3 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh3->exec("set names 'utf8'");
	$sth3 = $dbh3->prepare("SELECT * FROM `photos` where album = ? ORDER BY `time` DESC ;");
	$sth3->bindParam(1, $album3, PDO::PARAM_STR);
	$sth3->execute();
	$res3 = $sth3->fetchAll();
	foreach ($res3 as $row3) {
		$photoList3[]=$row3['title'];
		$descList3[]=$row3['description'];
	}
	$result["success"] = true;
}catch(PDOException $e){
	$result['msg'] = $e->getMessage();
}
$result["photoList"] = $photoList;
$result["descList"] = $descList;
$result["photoList1"] = $photoList1;
$result["descList1"] = $descList1;
$result["photoList2"] = $photoList2;
$result["descList2"] = $descList2;
$result["photoList3"] = $photoList3;
$result["descList3"] = $descList3;
$jsonText = json_encode($result);
$result = urldecode($jsonText);
echo $result;

?>