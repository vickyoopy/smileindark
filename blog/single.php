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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <link rel="stylesheet" href="css/blog.css" type="text/css">
</head>
  
<body style="background-color: black">
<!-- Begin Header -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- large screen display-->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav row">
            <li class="col-sm-2"><a href="index.php"><img src="../imgs/blog.png"><span class="nav-label">Blog</span></a></li>
            <li class="col-sm-2"><a href="../photography/index.php"><img src="../imgs/photo.png"><span class="nav-label">Photos</span></a></li>
            <li class="col-sm-2"><a href="../index.php"><img src="../imgs/home.png" style="bottom: -3em"><span class="nav-label">Home</span></a></li>
            <li class="col-sm-2"><a href="../admin/index.php"><img src="../imgs/admin.png"> <span class="nav-label">Admin</span> </a></li>
            <li class="col-sm-2"><a href="../contact/index.php"><img src="../imgs/contact.png"><span class="nav-label">Contact</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<main class="main" role="main">

<!-- single post -->
<div class="container">
<div class="row">
<div class="col-xs-12">
        <?php
            try{
            $dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("set names 'utf8'");
            //判断传入参数
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $sth = $dbh->prepare('SELECT * FROM posts where id = ?');
                $sth->bindParam(1, $id, PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch();
                $blogid = $id;
                $sth->closeCursor();
                $views= $result['visits'];
                $updateviews = $views;

                //更新views
                $cookie_name = "viewed";
                if(!isset($_COOKIE[$cookie_name])){
                    $updateviews = $views + 1;
                    $sth1 = $dbh->prepare('UPDATE posts SET visits = ? where id = ?  ');
                    $sth1->bindParam(1,$updateviews,PDO::PARAM_INT);
                    $sth1->bindParam(2,$id,PDO::PARAM_INT);
                    $sth1->execute();
                    //set cookie
                    $cookie_value = strval($blogid);
                    setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                }
                else if(!in_array($blogid,explode(',',$_COOKIE[$cookie_name])))  {
                    $updateviews = $views + 1;
                    $sth1 = $dbh->prepare('UPDATE posts SET visits = ? where id = ?  ');
                    $sth1->bindParam(1,$updateviews,PDO::PARAM_INT);
                    $sth1->bindParam(2,$id,PDO::PARAM_INT);
                    $sth1->execute();
                    //set cookie
                    $cookie_value = $_COOKIE[$cookie_name].','.strval($blogid);
                    setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                }
                

            }
            else if (isset($_GET['posturl'])) {
                $posturl=$_GET['posturl'];
                $sth = $dbh->prepare('SELECT * FROM posts where posturl = ?');
                $sth->bindParam(1, $posturl, PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch();
                $blogid = $result['id'];
                $sth->closeCursor();
                $views= $result['visits'];
                $updateviews = $views;
                
                //更新views
                $cookie_name = "viewed";
                if(!isset($_COOKIE[$cookie_name])){
                    $updateviews = $views + 1;
                    $sth1 = $dbh->prepare('UPDATE posts SET visits = ? where id = ?  ');
                    $sth1->bindParam(1,$updateviews,PDO::PARAM_INT);
                    $sth1->bindParam(2,$id,PDO::PARAM_INT);
                    $sth1->execute();
                    //set cookie
                    $cookie_value = strval($blogid);
                    setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                }
                else if(!in_array($blogid,explode(',',$_COOKIE[$cookie_name])))  {
                   
                    $updateviews = $views + 1;
                    $sth1 = $dbh->prepare('UPDATE posts SET visits = ? where id = ?  ');
                    $sth1->bindParam(1,$updateviews,PDO::PARAM_INT);
                    $sth1->bindParam(2,$id,PDO::PARAM_INT);
                    $sth1->execute();
                    //set cookie
                    $cookie_value = $_COOKIE[$cookie_name].','.strval($blogid);
                    setcookie($cookie_name, $cookie_value, time() + (86400), "/");
                }

            }
            
            //计算评论总数
            $dbh2 = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $dbh2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh2->exec("set names 'utf8'");
            $sth2 = $dbh2->prepare('SELECT * FROM comments where blogid = ? Order by time desc ');
            $sth2->bindParam(1, $blogid, PDO::PARAM_STR);
            $sth2->execute();
            $totalcomments = count($sth2->fetchAll());

            echo
                '<article class="post" style="color:white">'.
                '<div>'.
                    '<h1 class="post-title">'.$result['title'].'</h1>'.
                    '<div class="entry-meta">'.$result['catagory'].'|'.$result['time'].'|'.$updateviews.'views|'.$totalcomments.'comments</div>'.
                '</div>'.
                '<div class="entry-content clearfix">'.
                    '<p>'.$result['content'].'</p>'.
                '</div>'.
                '</article>';
            }
            catch (PDOException $e){
                echo "连接服务器失败".$e->getMessage();
            }
        ?>
    </div>
    </div>
    </div>

<!-- Comment Wrapper -->
<div class="container">

<div class="row"> 
<div class="col-xs-12"> 
<h1 class="page-title">Comment here.</h1>
</div>
</div>



<div id="commentList">  
</div>


<form action="#" method="post" class="contact-form">
    <div class="row"> <div class="col-xs-12">
                <input type="text" id="name" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea id="message" name="message" rows="7" placeholder="Notice: 内置浏览器可能无法评论, 请选择在浏览器打开." required></textarea>
                <button class="btn-send" onclick="save()">Drop Me a Line</button>     
    </div>  </div>
</form> 

</div>
</main>

<!-- Footer -->
    <div class="footer-wrapper">
    <div class="container">
        <div class="row">
        
            <div class="col-sm-12">
            copyright©2014-2025 | Vicky.P.Y | <a href="mailto:vickypy0802@gmail.com?subject=Hello,Vicky"> Email Me</a> 
            </div>
        </div>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script> 
    <script src="js/pace.min.js"></script>
    <script src="../js/modernizr.custom.js"></script>  
    <script type="text/javascript">
    $(document).ready(function() {
    $("#commentList").html("");
    var tmp= <?php echo $blogid; ?>;
    var blogid = parseInt(tmp)
    $.post("getcomment.php",{blogid}).done(function(response){
        if(response.success){
            for (var i = 0; i < response.nameList.length; i++) {
                if (!response.replyList[i]){
                        var html = '<div class="col-xs-12">'+
                           '<article class="post">'+
                           '<h1 class="post-title" style="text-align: left">'+ response.nameList[i]+'</h1>'+
                           '<div class="entry-meta" style="text-align: left">'+ response.timeList[i] +'</div>'+
                            '<div class="entry-content clearfix" style="text-align: left">'+
                            '<p>'+ response.msgList[i]+'</p>'+'</div>'+ 
                            '</article>'+
                            '</div>';
                }
                else{
                            var html = '<div class="col-xs-12">'+
                           '<article class="post">'+
                           '<h1 class="post-title" style="text-align: left">'+ response.nameList[i]+'</h1>'+
                           '<div class="entry-meta" style="text-align: left">'+ response.timeList[i] +'</div>'+
                            '<div class="entry-content clearfix" style="text-align: left">'+
                            '<p>'+ response.msgList[i]+'</p>'+'</div>'+ 
                            '<p><h5>REPLY to '+ response.nameList[i] +':</h5></p>'+

                                '<div class="row"> <div class="col-xs-12"><article class="post">'+ '<div class="entry-content clearfix" style="text-align: left">'+
                                '<p>'+response.replyList[i]+'</p>'+'</div></article></div></div>'+ 

                            '</article>'+
                            '</div>';
                }
                
                $("#commentList").append(html);
            };
        }
        else{
            alert("获取评论失败, " + response.msg)
        }
    })
    });
    </script>  

    <script type="text/javascript">
    // var content = new Simditor({
    //     textarea: $('#message'),
    //     placeholder: 'Your Message, pls less than 1000 words'
    // });
    var save = function(){
        var data = {
            name:$('#name').val(),
            email:$('#email').val(),
            message:$('#message').val(),
        }
        var submitting = $.post("sendcomment.php",data);
        submitting.done(function(response){
            alert(response);
        })
    };
    </script>

</body>
</html> 