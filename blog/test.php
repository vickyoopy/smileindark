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
            }
            else if (isset($_GET['posturl'])) {
                $posturl=$_GET['posturl'];
                $sth = $dbh->prepare('SELECT * FROM posts where posturl = ?');
                $sth->bindParam(1, $posturl, PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch();
            }
            echo
                '<article class="post" style="color:white">'.
                '<div>'.
                    '<h1 class="post-title">'.$result['title'].'</h1>'.
                    '<div class="entry-meta">'.$result['catagory'].'|'.$result['time'].'|Vicky </div>'.
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
<div id="cotentList">
  
</div>
</div>

<div class="container" style="text-align: center">
<button id="pre" onclick="readPre()">pre</button>
<button id="next" onclick="readNext()">next</button>
</div>


</main>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/pace.min.js"></script>
    <script src="js/modernizr.custom.js"></script>  
    
    <script type="text/javascript">
    var content = document.getElementById("cotentList") 
    var min=parseInt(0)
    var max=parseInt(5)

    $(document).ready(function() {
    $("#cotentList").html("");
	var data = {min,max}
	$.post("testComment.php",data).done(function(response){
		if(response.success){
			for (var i = 0; i < response.idList.length; i++) {
				var html = '<div class="col-xs-12">'+
                    	   '<article class="post">'+
                           '<h1 class="post-title" style="text-align: left">'+ response.idList[i]+'</h1>'+
                        '<div class="entry-content clearfix" style="text-align: left">'+
                        '<p>'+ response.contentList[i]+'</p>'+
                        '</div>'+
                   		 '</article>'+
                    	'</div>';
				$("#cotentList").append(html);
			};
		}
		else{
			alert("获取评论失败, " + response.msg)
		}
	})
	});


    readPre= function() {
    	if ((parseInt(min)-parseInt(5))>0) {
    		min=parseInt(min-5)
    		max=parseInt(max-5)
    	}
    	else {
    		min=parseInt(0)
    		max=parseInt(5)
    	}
    	$("#cotentList").html("");
		var datapre = {min,max}	
		$.post("testComment.php",datapre).done(function(response){
		if(response.success){
			for (var i = 0; i < response.idList.length; i++) {
				var html = '<div class="col-xs-12">'+
                    	   '<article class="post">'+
                           '<h1 class="post-title" style="text-align: left">'+ response.idList[i]+'</h1>'+
                        '<div class="entry-content clearfix" style="text-align: left">'+
                        '<p>'+ response.contentList[i]+'</p>'+
                        '</div>'+
                   		 '</article>'+
                    	'</div>';
				$("#cotentList").append(html);
			};
		}
		else{
			alert("获取评论失败, " + response.msg)
		}
	})
	}

    readNext= function(){
    	var xmlHttp = new XMLHttpRequest()
    	min=parseInt(min+5)
    	max=parseInt(max+5)
    	$("#cotentList").html("");
    	var datanext = {min,max}			
		$.post("testComment.php",datanext).done(function(response){
		if(response.success){
			for (var i = 0; i < response.idList.length; i++) {
				var html = '<div class="col-xs-12">'+
                    	   '<article class="post">'+
                           '<h1 class="post-title" style="text-align: left">'+ response.idList[i]+'</h1>'+
                        '<div class="entry-content clearfix" style="text-align: left">'+
                        '<p>'+ response.contentList[i]+'</p>'+
                        '</div>'+
                   		 '</article>'+
                    	'</div>';
				$("#cotentList").append(html);
			};
		}
		else{
			alert("获取评论失败, " + response.msg)
		}
	})
	}
                    
</script>   

</body>
</html> 