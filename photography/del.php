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

$name = $_POST['q'];

try{
	$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->exec("set names 'utf8'");
	
	$sth = $dbh->prepare("DELETE FROM `photos` WHERE title = ?");
	$sth->execute(array($name));
	unlink("upload/".$name);
	unlink("thumbnail/".$name);
	$result["success"] = true;
}catch(PDOException $e){
	$result['msg'] = $e->getMessage();
}
$jsonText = json_encode($result);
$result = urldecode($jsonText);
echo $result;

?>