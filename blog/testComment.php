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
$contentList = array();

        try{

            $dbh1 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh1->exec("set names 'utf8'");
            //$total 获取评论总数
            $test = $dbh1->prepare('SELECT id FROM test');
            $test->execute();
            $total = count($test->fetchAll());
            if ($max > $total) {
                $min = $total - 5;
            }


            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            $sth = $dbh->prepare('SELECT * FROM test Order by id ASC LIMIT ?,5');
            $sth->bindParam(1, $min, PDO::PARAM_STR);
            $sth->execute();
            $res = $sth->fetchAll();

            foreach ($res as $row) {
                $idList[]=$row['id'];
                $contentList[]=$row['content'];
            }

            $result["success"] = true;

            }

            catch(PDOException $e){
                $result['msg'] = $e->getMessage();
            }

            $result["idList"] = $idList;
            $result["contentList"] = $contentList;
            $jsonText = json_encode($result);
            $result = urldecode($jsonText);
            echo $result;

?>