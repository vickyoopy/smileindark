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

$blogid=$_POST['blogid'];

$nameList = array();
$timeList = array();
$msgList = array();
$replyList=array();

        try{

            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            $sth = $dbh->prepare('SELECT * FROM comments where blogid = ? Order by time desc ');
            $sth->bindParam(1, $blogid, PDO::PARAM_STR);
            $sth->execute();
            $res = $sth->fetchAll();

            foreach ($res as $row) {
                $nameList[]=$row['name'];
                $timeList[]=$row['time'];
                $msgList[]=$row['message'];
                $replyList[]=$row['replymsg'];
            }

            $result["success"] = true;
            }

            catch(PDOException $e){
                $result['msg'] = $e->getMessage();
            }

            $result["nameList"] = $nameList;
            $result["timeList"] = $timeList;
            $result["msgList"] = $msgList;
            $result["replyList"] = $replyList;
            $jsonText = json_encode($result);
            $result = urldecode($jsonText);
            echo $result;

?>