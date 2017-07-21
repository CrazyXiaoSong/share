<?php
/**
 * Created by PhpStorm.
 * User: Lemon
 * Date: 2017/7/7
 * Time: 18:53
 */
set_time_limit(0);
function addFileToZip($path,$zip){
	$handler=opendir($path); //打开当前文件夹由$path指定。
	while(($filename=readdir($handler))!==false){
		if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
			if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
				addFileToZip($path."/".$filename, $zip);
			}else{ //将文件加入zip对象
				$zip->addFile($path."/".$filename);
			}
		}
	}
	@closedir($path);
}
function delDir($dir){
    $files = scandir($dir);
    var_dump($files);
    for($i = 2;$i<count($files);$i++){
        unlink($dir."/".$files[$i]);
    }
    rmdir($dir);
    return true;
}


function getHtml($url){

	$str = file_get_contents($url);

//	$arr = explode("/",$url);
//    $end_str = mb_substr($url,strlen($url)-1);
//    $r = preg_match('/^[\d\/]$/',$end_str);
//	if($r != 1){
//        $url = str_replace(end($arr),"",$url);
//    }
//	preg_match_all('/([^a]) href="(?!http:\/\/)(.*?)"/i',$str,$data);
//
//
//	//格式化数据，保佑无BUG
//	$replacement_src = 'src="'.$url.'/${1}"';//格式化src
//	$replacement_href = '${1} href="'.$url.'/${2}"';//格式化href
//	$str = preg_replace('/src="(?!http:\/\/)(.*?)"/i',$replacement_src,$str);
//	$str = preg_replace('/([^a]) href="(?!http:\/\/)(.*?)"/i',$replacement_href,$str);
	return $str;
}

function downloadSource($url,$dir){
    $str = file_get_contents($url);
    //解析url结构
    //如果最后一个字符是/ 或者数字则代表当前页面为文件夹
    $end_url = mb_substr($url,strlen($url)-1);
    $c = preg_match('/\d/',$end_url);

    if($end_url == '/' || $c){
        echo '我是目录';
    }else{
        $arr = explode("/",$url);
        array_pop($arr);
        $url = implode("/",$arr);
    }
    var_dump($url);
    file_put_contents("./tsta.txt",$str);
    preg_match_all('/<img.+?src=[\'"](.+?)[\'"]/i',$str,$data_img);
    preg_match_all('/<script.+?src=[\'"](.+?)[\'"]/i',$str,$data_js);
    preg_match_all('/<link.+?href=[\'"](.+?)[\'"]/i',$str,$data_css);
    for($i = 0;$i < count($data_img[1]);$i++){
        $source = $data_img[1][$i];
        $r = preg_match('/http:\/\//',$source);
        if($r == 0){
            $file = file_get_contents($url."/".$source);
            file_put_contents($dir."/".$source,$file);
        }
    }
    for($i = 0;$i < count($data_js[1]);$i++){
        $source = $data_js[1][$i];
        $r = preg_match('/http:\/\//',$source);
        if($r == 0){
            $file = file_get_contents($url."/".$source);
            file_put_contents($dir."/".$source,$file);
        }
    }
    for($i = 0;$i < count($data_css[1]);$i++){
        $source = $data_css[1][$i];
        $r = preg_match('/http:\/\//',$source);
        if($r == 0){
            $file = file_get_contents($url."/".$source);
            file_put_contents($dir."/".$source,$file);
        }
    }
}


$url = isset($_GET['url'])?$_GET['url']:exit("非法闯入");
$r = preg_match('/http:\/\/www.jq22.com\/demo/',$url);
$r == 0?exit("数据非法"):'';

$str = file_get_contents($url);

//file_put_contents("./a.txt",$str);


$dir_time = time().rand(100000,999999);//文件夹
//$dir = "./file/".$dir_time;
mkdir("./".$dir_time);//创建文件夹
//推广信息导入
copy("www.lemon-x.ga.txt",$dir_time."/www.lemon-x.ga.txt");
copy("lemon.url",$dir_time."/lemon.url");
//获取首页内容
$index_html = getHtml($url);
//首页数据写入文件
file_put_contents("./{$dir_time}/index.html",$index_html);
//第一个页面资源下载
downloadSource($url,$dir_time);
//替换a标签内容
//查找a标签
preg_match_all('/<a .*?href="(http.+?)"/i',$index_html,$data);

if(count($data[0])){
	for($i = 0;$i < count($data[0]);$i++){
		$arr = explode("/",$data[1][$i]);
		$filename  = end($arr);
		if($filename == '#' || $filename== 'index.html'){
			continue;
		}
		//循环插入其他页面内容
		$html = getHtml($url.$data[1][$i]);
		//下载资源
        downloadSource($url.$data[1][$i],$dir_time);
		file_put_contents("./{$dir_time}/{$filename}",$html);
	}
}









//创建压缩包
file_put_contents($dir_time.".zip","");

$zip=new ZipArchive();
if($zip->open($dir_time.'.zip', ZipArchive::OVERWRITE)=== TRUE){
	addFileToZip($dir_time, $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
	$zip->close(); //关闭处理的zip文件
}

var_dump($dir_time);
//删除文件夹
delDir($dir_time);

header("location:".$dir_time.".zip");

