$("#uploadBtn").click(function(){
	$("#uploadBtn").text("正在上传...")
	$("#uploadForm").ajaxSubmit({
		type:'post',
		url:"upload.php",
		success: function(response){
			if(response.success){
				alert("上传成功");
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
			alert("获取图片失败, " + response.msg)
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

$(document).ready(function() {
	getPhotoList();
});