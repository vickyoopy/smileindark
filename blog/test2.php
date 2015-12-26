<?php
define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="shortcut icon" href="../favicon.ico"> 
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    
</head>
  
<body style="background-color: black">


<!-- display blog -->
<main class="main" role="main">
    <div class="container">
<?php
        try{
            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            $sth = $dbh->prepare('SELECT * FROM posts Order by time desc');
            $sth->execute();
            $result = $sth->fetchAll();
        
            foreach($result as $row){
                echo
                    '<div class="col-xs-12">'.
                    '<article class="post">'.
                    '<div>'.
                        '<h1 class="post-title"><a href="test.php?id='.$row['id'].'">'.$row['title'].'</a></h1>'.
                        '<div class="entry-meta">'.$row['catagory'].'|'.$row['time'].'|Vicky </div>'.
                    '</div>'. 
                    '<div class="entry-content clearfix" style="text-align: left">'.
                    '<p>'.substr(strip_tags($row['content']), 0 , 501)."...".'</p>'.
                    '<div class="read-more"><a href="test.php?id='.$row['id'].'">Continue reading <span>→</span></a></div>'.
                    '</div>'.
                    '</article>'.
                    '</div>';
            }
        } 
        catch (PDOException $e){
            echo "连接服务器失败".$e->getMessage();
        } 
?>
    </div>
</main>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="js/modernizr.custom.js"></script>       
</body>
</html> 




