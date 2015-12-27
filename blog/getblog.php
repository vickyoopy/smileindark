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
$min=$_POST['min'];
$max=$_POST['max'];

$idList = array();
$titleList=array();
$catagoryList=array();
$timeList=array();
$contentList=array();

        try{

            $dbh1 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh1->exec("set names 'utf8'");
            //$total 获取评论总数
            $test = $dbh1->prepare('SELECT id FROM posts');
            $test->execute();
            $total = count($test->fetchAll());
            if ($max > $total) {
                $min = $total - 7;
            }


            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            $sth = $dbh->prepare('SELECT * FROM posts Order by time DESC LIMIT ?,7');
            $sth->bindParam(1, $min, PDO::PARAM_STR);
            $sth->execute();
            $res = $sth->fetchAll();

            foreach ($res as $row) {
                $idList[]=$row['id'];
                $titleList[]=$row['title'];
                $catagoryList[]=$row['catagory'];
                $timeList[]=$row['time'];
                $contentList[]=$row['content'];
            }

            $result["success"] = true;

            }

            catch(PDOException $e){
                $result['msg'] = $e->getMessage();
            }

        

            $result["idList"] = $idList;
            $result["titleList"] = $titleList;
            $result["catagoryList"] = $catagoryList;
            $result["timeList"] = $timeList;
            $result["contentList"] = $contentList;
            $jsonText = strip_tags(json_encode($result));
            $result = urldecode($jsonText);
            echo $result;

?>