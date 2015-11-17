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

try{
	$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->exec("set names 'utf8'");
	
	$sth = $dbh->prepare("SELECT * FROM `photos` ORDER BY `time` DESC LIMIT 10;");
	$sth->execute();
	$res = $sth->fetchAll();

	foreach ($res as $row) {
		$photoList[]=$row['filename'];
		$descList[]=$row['desc'];
	}
	$result["success"] = true;
}catch(PDOException $e){
	$result['msg'] = $e->getMessage();
}
$result["photoList"] = $photoList;
$result["descList"] = $descList;
$jsonText = json_encode($result);
$result = urldecode($jsonText);
echo $result;

?>