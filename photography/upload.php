<?php
header("Content-Type: application/json; charset=UTF-8");
define( 'DB_NAME', 'smileindark' );
define( 'DB_USER', 'admin' );
define( 'DB_PASSWORD', 'vz28yt90' );
define( 'DB_HOST', 'localhost' );
define( 'DB_PORT', 3306 );


$result = array(
	"success"=>false,
	"msg"=>"",
	"filepath"=>""
);

$title = getSeqID();
$desc = $_POST['desc'];
try {
	if (!isset($_FILES['upload_file']['error']) || is_array($_FILES['upload_file']['error'])) {
		throw new RuntimeException('Invalid parameters.');
	}
	switch ($_FILES['upload_file']['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('没有上传文件.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new RuntimeException('文件过大.');
		default:
			throw new RuntimeException('未知错误.');
	}
	if ($_FILES['upload_file']['size'] > 2048000) {
		throw new RuntimeException('文件过大.');
	}

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	if (false === $ext = array_search(
		$finfo->file($_FILES['upload_file']['tmp_name']),
		array(
			'jpg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif',
		),
		true
	)) {
		throw new RuntimeException('上传出错，文件格式不正确，网站只允许上传jpg，png或gif文件.');
	}
	if (!move_uploaded_file($_FILES['upload_file']['tmp_name'],sprintf('upload/%s.%s',$title,$ext))){
		throw new RuntimeException('上传出错，文件未能被正确保存.');
	}
	$filepath = 'upload/'.$title.".".$ext;
	$thumb_path = 'thumbnail/'.$title.".".$ext;
	img2thumb($filepath, $thumb_path);

	try{
		$dbh = new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("set names 'utf8'");
		
		$title = $title.".".$ext;
	
		$sth = $dbh->prepare("INSERT INTO `photos` (`id`, `title`, `time`, `description`) VALUES (NULL, ?, CURRENT_TIMESTAMP, ?);");
		$sth->execute(array($title, $desc));
	}catch(PDOException $e){
		$result['msg'] = $e->getMessage();
	}

	$result["filepath"] = $filepath;
	$result["success"] = true;
} catch (RuntimeException $e) {
	$result['msg'] = $e->getMessage();
}
$jsonText = json_encode($result);
$result = urldecode($jsonText);
echo $result;

function get_extension($filename){
	return pathinfo($filename,PATHINFO_EXTENSION);
}

function getSeqID(){
	list($usec, $sec) = explode(" ", microtime()); 	
	$strsec	= sprintf("%s", $sec);
	for ($i=0; $i<4; $i++){
		$strsec = $strsec.rand(0, 9);
	}
	return $strsec;
}

function img2thumb($src_img, $dst_img, $width = 150, $height = 150, $cut = 0, $proportion = 0){
    if(!is_file($src_img))
    {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);
 
    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;
 
    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }
 
    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  //有宽无高
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  //有高无宽
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  //裁剪时无高
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  //裁剪时无宽
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }
 
    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);
 
    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}

function fileext($file){
    return pathinfo($file, PATHINFO_EXTENSION);
}
?>