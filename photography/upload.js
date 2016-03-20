$("#uploadBtn").click(function(){
	$("#uploadBtn").text("正在上传...")
	$("#uploadForm").ajaxSubmit({
		type:'post',
		url:"upload.php",
		success: function(response){
			if(response.success){
				//alert("上传成功");
				getPhotoList();
			}else{
				alert("上传失败，"+response.msg);
			}
			$("#uploadBtn").text("点此上传")
		},
		resetForm: false,
		clearForm: true
	});
})

function getPhotoList(){
	$("#imgList").html("");
	$.get("list.php",function(response){
		if(response.success){
			for (var i = 0; i < response.photoList.length; i++) {
				var html = '<div class="col-lg-6">' +
				'	<div class="panel panel-default">' +
				'		<div class="panel-body row">' +
				'			<div class="col-sm-6" style="margin-left:20px;"><a href="upload/' + response.photoList[i] +'"><img src="thumbnail/' + response.photoList[i] +'"></a></div>' +
				'			<div class="col-sm-3">' + response.descList[i] + '</div>' +
				'		</div>' +
				'	</div>' +
				'</div>';

				$("#imgList").append(html);
			};
		}else{
			alert("failed to get photos, " + response.msg)
		}
	})
}

var img=[];
$(document).ready(function() {
	getPhotoList();
	showphotos();
});

function showphotos(){
    $("#travellist").html("");
    $("#dailylist").html("");
    $("#designlist").html("");

    $.get("list.php",function(response){
        if(response.success){
            for (var i = 0; i < response.photoList1.length; i++) {
                var html1 = '<li><a href="upload/' + response.photoList1[i] +'"><img src="thumbnail/' + response.photoList1[i] +'"></a></li>';
                $("#travellist").append(html1);
            };
            for (var i = 0; i < response.photoList2.length; i++) {
                var html2 = '<li><a href="upload/' + response.photoList2[i] +'"><img src="thumbnail/' + response.photoList2[i] +'"></a></li>';
                $("#dailylist").append(html2);
            };
            for (var i = 0; i < response.photoList3.length; i++) {
                var html3= '<li><a href="upload/' + response.photoList3[i] +'"><img src="thumbnail/' + response.photoList3[i] +'"></a></li>';
                $("#designlist").append(html3);
            };
              
            var spa = -2;  

                var odiv1 = document.getElementById('div1');
                var oul1 = odiv1.getElementsByTagName('ul')[0];
                var ali1 = oul1.getElementsByTagName('li');          
                oul1.innerHTML=oul1.innerHTML+oul1.innerHTML;
                oul1.style.width=ali1[0].offsetWidth*ali1.length+'px';

                var odiv2 = document.getElementById('div2');
                var oul2 = odiv2.getElementsByTagName('ul')[0];
                var ali2 = oul2.getElementsByTagName('li');             
                oul2.innerHTML=oul2.innerHTML+oul2.innerHTML;
                oul2.style.width=ali2[0].offsetWidth*ali2.length+'px';

                var odiv3 = document.getElementById('div3');
                var oul3 = odiv3.getElementsByTagName('ul')[0];
                var ali3 = oul3.getElementsByTagName('li');          
                oul3.innerHTML=oul3.innerHTML+oul3.innerHTML;
                oul3.style.width=ali3[0].offsetWidth*ali3.length+'px';

                function move(){
                    if(oul1.offsetLeft<-oul1.offsetWidth/2){
                        oul1.style.left='0';
                    }
                    if(oul1.offsetLeft>0){
                        oul1.style.left=-oul1.offsetWidth/2+'px'
                    }
                    oul1.style.left=oul1.offsetLeft+spa+'px';

                    if(oul2.offsetLeft<-oul2.offsetWidth/2){
                        oul2.style.left='0';
                    }
                    if(oul2.offsetLeft>0){
                        oul2.style.left=-oul2.offsetWidth/2+'px'
                    }
                    oul2.style.left=oul2.offsetLeft+spa+'px';

                    if(oul3.offsetLeft<-oul3.offsetWidth/2){
                        oul3.style.left='0';
                    }
                    if(oul3.offsetLeft>0){
                        oul3.style.left=-oul3.offsetWidth/2+'px'
                    }
                    oul3.style.left=oul3.offsetLeft+spa+'px';

                }



                var timer= setInterval(move,30)
                odiv1.onmousemove=function(){clearInterval(timer);}
                odiv1.onmouseout=function(){timer = setInterval(move,30)};
                odiv2.onmousemove=function(){clearInterval(timer);}
                odiv2.onmouseout=function(){timer = setInterval(move,30)};
                odiv3.onmousemove=function(){clearInterval(timer);}
                odiv3.onmouseout=function(){timer = setInterval(move,30)};
 

        }else{
            alert("failed to get photos, " + response.msg)
        }
    })
}
            



function deleteImg(name){
	$.get("del.php?q="+name,function(response){
		if(response.success){
			getPhotoList();
		}else{
			alert("删除图片失败, " + response.msg)
		}
	})
}
