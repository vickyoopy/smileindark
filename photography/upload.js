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
			alert("获取图片失败, " + response.msg)
		}
	})
}

var img=[];
$(document).ready(function() {
	getPhotoList();
	showphotos();
	//imgprocess();
});

function showphotos(){
    //$("#photoList").html("");
    $.get("list.php",function(response){
        if(response.success){
            for (var i = 0; i < response.photoList.length; i++) {
            	img[i]=
					{
						'href':'upload/' + response.photoList[i],
						'alt':'loading',
						'src':'upload/' + response.photoList[i],
						'smallSrc':'thumbnail/' + response.photoList[i],
						'title':response.descList[i]
					}
				// var html = '<div class="col-lg-6">' +
				// '	<div class="panel panel-default">' +
				// '		<div class="panel-body row">' +
				// '			<div class="col-sm-6""><a href="upload/' + response.photoList[i] +'"><img src="thumbnail/' + response.photoList[i] +'"></a></div>' +
				// '			<div class="col-sm-3">' + response.descList[i] + '</div>' +
				// '		</div>' +
				// '	</div>' +
				// '</div>';
    //             $("#photoList").append(html);
            };
             var i=0,//大图编号
        len=img.length,//img数组的长度
        cur=0;//当前图片编号
        j=9,//默认显示小图个数
        page=0,//小图的页码
        $s_next=$('#smallImg-next'),//小图下一页
        $s_pre=$('#smallImg-pre'),//小图上一页
        box=$('#smallImg-box').width(),//显示的长度
        $ul=$('#smallImg-ul'),//小图外层
        $imgLi=$ul.find('li'),//小图li
        html=_html='';//存放载入的代码     
    $('#detailImg-box').append('<a href=\"'+img[0].href+'\" class=\"detailImg_1\"><img alt=\"'+img[0].alt+'\" src=\"'+img[i].src+'\"></a><p>'+img[i].title+'</p>');
    //大图    
    $('#detailImg-next').click(function(){
        ++i;
        detailImg_click($s_next,i,len);
    })
    $('#detailImg-pre').click(function(){
        --i;
        detailImg_click($s_pre,i,len);
    })
    //小图
    for(var k=0;k<j;k++){
        var _k=k%len;
        s_html(_k);
        html+=h;
    }
    $ul.append(html);
    $('.smallImg_1').addClass('cur');   
    //小图下一页
    $('#smallImg-next').click(function(){
        if(!$ul.is(':animated')){
            page++;
            var a=page*j,_a,c;
            for(var k=0;k<j;k++,a++){
                smallImg_click(a,_a,len,i);
                _html+=h;
            }
            $ul.append(_html);
            $ul.css({'left':0,'right':'auto'});
            $ul.animate({left:-box},1600,function(){
                $ul.find('li:lt('+j+')').detach();
                $ul.css('left',0);
                _html='';
            });//动画执行后,再删除前9个li,将left设回0
            $('#smallImg-ul li').click(function(){//三处一样，不知道这个要怎么优化？？？
                var _this=$(this);
                i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
                img_info(i);
                s_a_r(_this,'cur');
                cur=i;
            })
        }
    })

    //小图上一页
    $('#smallImg-pre').click(function(){
        if(!$ul.is(':animated')){
            page--;
            var a=(page-1)*j,_a,c;
            for(var k=0;k<j;k++,a--){
                smallImg_click(a,_a,len,i);
                _html=h+_html;
            }
            $ul.prepend(_html).css({'right':box,'left':'auto'});
            $ul.animate({right:0},1600,function(){
                $ul.find('li:gt('+(j-1)+')').detach();//删除后9个li,从8开始
                _html='';
            });
            $('#smallImg-ul li').click(function(){
                var _this=$(this);
                i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
                img_info(i);
                s_a_r(_this,'cur');
                cur=i;
            })
        }
            
    })
    //点击小图
    $('#smallImg-ul li').click(function(){
        var _this=$(this);
        i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
        img_info(i);
        s_a_r(_this,'cur');
        cur=i;
    })


        }
        else{
            alert("获取图片失败, " + response.msg)
        }
    })
}

// function imgprocess(){
//     var i=0,//大图编号
//         len=img.length,//img数组的长度
//         cur=0;//当前图片编号
//         j=9,//默认显示小图个数
//         page=0,//小图的页码
//         $s_next=$('#smallImg-next'),//小图下一页
//         $s_pre=$('#smallImg-pre'),//小图上一页
//         box=$('#smallImg-box').width(),//显示的长度
//         $ul=$('#smallImg-ul'),//小图外层
//         $imgLi=$ul.find('li'),//小图li
//         html=_html='';//存放载入的代码     
//     $('#detailImg-box').append('<a href=\"'+img[0].href+'\" class=\"detailImg_1\"><img alt=\"'+img[0].alt+'\" src=\"'+img[i].src+'\"></a><p>'+img[i].title+'</p>');
//     //大图    
//     $('#detailImg-next').click(function(){
//         ++i;
//         detailImg_click($s_next,i,len);
//     })
//     $('#detailImg-pre').click(function(){
//         --i;
//         detailImg_click($s_pre,i,len);
//     })
//     //小图
//     for(var k=0;k<j;k++){
//         var _k=k%len;
//         s_html(_k);
//         html+=h;
//     }
//     $ul.append(html);
//     $('.smallImg_1').addClass('cur');   
//     //小图下一页
//     $('#smallImg-next').click(function(){
//         if(!$ul.is(':animated')){
//             page++;
//             var a=page*j,_a,c;
//             for(var k=0;k<j;k++,a++){
//                 smallImg_click(a,_a,len,i);
//                 _html+=h;
//             }
//             $ul.append(_html);
//             $ul.css({'left':0,'right':'auto'});
//             $ul.animate({left:-box},1600,function(){
//                 $ul.find('li:lt('+j+')').detach();
//                 $ul.css('left',0);
//                 _html='';
//             });//动画执行后,再删除前9个li,将left设回0
//             $('#smallImg-ul li').click(function(){//三处一样，不知道这个要怎么优化？？？
//                 var _this=$(this);
//                 i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
//                 img_info(i);
//                 s_a_r(_this,'cur');
//                 cur=i;
//             })
//         }
//     })

//     //小图上一页
//     $('#smallImg-pre').click(function(){
//         if(!$ul.is(':animated')){
//             page--;
//             var a=(page-1)*j,_a,c;
//             for(var k=0;k<j;k++,a--){
//                 smallImg_click(a,_a,len,i);
//                 _html=h+_html;
//             }
//             $ul.prepend(_html).css({'right':box,'left':'auto'});
//             $ul.animate({right:0},1600,function(){
//                 $ul.find('li:gt('+(j-1)+')').detach();//删除后9个li,从8开始
//                 _html='';
//             });
//             $('#smallImg-ul li').click(function(){
//                 var _this=$(this);
//                 i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
//                 img_info(i);
//                 s_a_r(_this,'cur');
//                 cur=i;
//             })
//         }
            
//     })
//     //点击小图
//     $('#smallImg-ul li').click(function(){
//         var _this=$(this);
//         i=_this.attr('class').replace(/[^0-9]/ig,'')-1;
//         img_info(i);
//         s_a_r(_this,'cur');
//         cur=i;
//     })
// }


//大图图片信息
function img_info(i){
    var href=img[i].href,
        alt=img[i].alt,
        src=img[i].src,
        title=img[i].title,
        $main=$('#detailImg-box');
    $main.find('a').attr({'href':href,'class':'detailImg_'+(i+1)});
    $main.find('img').attr({'alt':alt,'src':src});
    $main.find('p').text(title);
}
function s_a_r(o,c){
    o.addClass(c).siblings().removeClass(c);    
}
//大图左右点击
function i_cur(i,len){
    i=i%len;
    if(i<0){
        i=len+i;
    }
    return i;   
}
function detailImg_click($pn,i,len){
    i_cur(i,len);
    img_info(i);
    var imgCur=$('.smallImg_'+(i+1));
    if(!imgCur.html()){
        $pn.click();
    } 
    s_a_r($('.smallImg_'+(i+1)),'cur');//小图选中
}
//小图左右点击
function smallImg_click(a,_a,len,i){
    _a=a;
    _a=a%len;
    if(_a<0){
        _a+=len;
    }
    c=_a==i?'cur':'';
    s_html(_a,c);
}
function s_html(_a,c){
    return h='<li class=\"smallImg_'+(_a+1)+' '+c+'\"><a><img alt=\"'+img[_a].alt+'\" src=\"'+img[_a].smallSrc+'\"></a></li>';
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
