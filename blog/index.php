<?php
define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3305 );
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
<header>
<nav id="menu" class="nav">                 
                    <ul>
                        <li>
                            <a href="../index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-home"></i>
                                </span>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-blog"></i>
                                </span>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="../photography/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-portfolio"></i>
                                </span>
                                <span>Photos</span>
                            </a>
                        </li>
                        <li>
                            <a href="http://vicky-peng.tumblr.com/">
                                <span class="icon"> 
                                    <i aria-hidden="true" class="icon-services"></i>
                                </span>
                                <span>Tumblr</span>
                            </a>
                        </li>
                    
                        
                        <li>
                            <a href="../admin/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-team"></i>
                                </span>
                                <span>Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="../contact/index.php">
                                <span class="icon">
                                    <i aria-hidden="true" class="icon-contact"></i>
                                </span>
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>
</nav>
</header>


<!-- display blog -->
<main class="main" role="main">

    <div class="container">
    <div id="blogList"> </div>
    </div>

    <div class="container" style="text-align: center">
    <button id="pre" onclick="readPre()">pre</button>
    <button id="next" onclick="readNext()">next</button>
    </div>
</main>


    <!-- Footer -->
    <div class="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            copyright©2014-2025| Vicky.P.Y | <a href="mailto:vickypy0802@gmail.com?subject=Hello,Vicky"> Email Me</a> 
            </div>
        </div>
    </div>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/pace.min.js"></script>
    <script src="../js/modernizr.custom.js"></script>  
    <script src="js/waterfall-light.js"></script>
    <script type="text/javascript">
    var min=parseInt(0)
    $(document).ready(function() {
    $("#blogList").html("");
    var data = {min}
    $.post("getblog.php",data).done(function(response){
        if(response.success){
            for (var i = 0; i < response.idList.length; i++) {
                var html = 
                    '<div class="col-xs-12 col-lg-6">'+
                    '<article class="post">'+
                    '<div>'+
                        '<h1 class="post-title"><a href="single.php?id='+response.idList[i]+'">'+response.titleList[i]+'</a></h1>'+
                        '<div class="entry-meta">'+response.catagoryList[i]+'|'+response.timeList[i]+'|'+ response.visitsList[i]+'views</div>'+
                    '</div>'+
                    '<div class="entry-content clearfix" style="text-align: left">'+
                    '<p>'+response.contentList[i].substring(0,401)+"..."+'</p>'+
                    '</div>'+
                    '<div class="read-more"><a href="single.php?id='+response.idList[i]+'">Continue reading <span>�&#65533;</span></a></div>'+
                    '</article>'+
                    '</a></div>';
                $("#blogList").append(html);
            };
            $('#blogList').waterfall();
            if (min <= 0) { 
                $('#pre').attr("disabled","disabled")
            }
            else{
                $('#pre').removeAttr("disabled");
             }
            if (response.nexthide){
                $("#next").attr("disabled","disabled")
            }
            else{
                $("#next").removeAttr("disabled")
            }

        }
        else{
            alert("获取blog失败, " + response.msg)
        }
    })
    });

    readPre= function() {
        if ((parseInt(min)-parseInt(5))>0) {
            min=parseInt(min-5)
             $('#pre').removeAttr("disabled")
        }
        else {
            min=parseInt(0)
             $('#pre').attr("disabled","disabled")
        }
        $("#blogList").html("");
        var datapre = {min} 
        $.post("getblog.php",datapre).done(function(response){
        if(response.success){
            for (var i = 0; i < response.idList.length; i++) {
                var html = '<div class="col-xs-12 col-lg-6">'+
                    '<article class="post">'+
                    '<div>'+
                        '<h1 class="post-title"><a href="single.php?id='+response.idList[i]+'">'+response.titleList[i]+'</a></h1>'+
                        '<div class="entry-meta">'+response.catagoryList[i]+'|'+response.timeList[i]+'|'+ response.visitsList[i]+'views</div>'+
                    '</div>'+
                    '<div class="entry-content clearfix" style="text-align: left">'+
                    '<p>'+response.contentList[i].substring(0,400)+"..."+'</p>'+
                     '</div>'+
                    '<div class="read-more"><a href="single.php?id='+response.idList[i]+'">Continue reading <span>�&#65533;</span></a></div>'+
                   
                    '</article>'+
                    '</div>';
                $("#blogList").append(html);
            };
            if (response.nexthide){
                $("#next").attr("disabled","disabled")
            }
            else{
                $("#next").removeAttr("disabled")
            }
            $('#blogList').waterfall();
        }
        else{
            alert("获取blog失败, " + response.msg)
        }
    })
    }

    readNext= function(){
        var xmlHttp = new XMLHttpRequest()
        min=parseInt(min+5)
        $("#blogList").html("");
        var datanext = {min}            
        $.post("getblog.php",datanext).done(function(response){
        if(response.success){
            for (var i = 0; i < response.idList.length; i++) {
                var html = '<div class="col-xs-12 col-lg-6">'+
                    '<article class="post">'+
                    '<div>'+
                        '<h1 class="post-title"><a href="single.php?id='+response.idList[i]+'">'+response.titleList[i]+'</a></h1>'+
                        '<div class="entry-meta">'+response.catagoryList[i]+'|'+response.timeList[i]+'|'+ response.visitsList[i]+'views</div>'+
                    '</div>'+
                    '<div class="entry-content clearfix" style="text-align: left">'+
                    '<p>'+response.contentList[i].substring(0,400)+"..."+'</p>'+
                     '</div>'+
                    '<div class="read-more"><a href="single.php?id='+response.idList[i]+'">Continue reading <span>�&#65533;</span></a></div>'+
                    '</article>'+
                    '</div>';
                $("#blogList").append(html);
            };
            $('#blogList').waterfall();
            if (min <= 0) { 
                $('#pre').attr("disabled","disabled")
            }
            else{
                $('#pre').removeAttr("disabled");
            }
            if (response.nexthide){
                $("#next").attr("disabled","disabled")
            }
            else{
                $("#next").removeAttr("disabled")
            }
  
        }
        else{
            alert("获取blog失败, " + response.msg)
        }


    })
    }                      
</script>   
</body>
</html>