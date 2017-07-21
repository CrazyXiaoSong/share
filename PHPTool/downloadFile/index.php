<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/4
 * Time: 13:04
 */
/*function downfile()
{
    $filename=realpath("https://www.baidu.com/link?url=0AEbRJMXYT3n5eJrl8Yq8aHCUNbbqAVfzCSTCFmL5T5GU0U5WNkf-WHjyfu6Vch1NV0gDK-_OONA8QVt0tHkEJXiUnODvks8vFIvsIDSeeK&wd=&eqid=f1b7a14f000527c800000004595b226b"); //文件名
    $date=date("Ymd-H:i:m");
    Header( "Content-type:  application/octet-stream ");
    Header( "Accept-Ranges:  bytes ");
    Header( "Accept-Length: " .filesize($filename));
    header( "Content-Disposition:  attachment;  filename= {$date}.exe");
    echo file_get_contents($filename);
    readfile($filename);
}
downfile();*/
//$img = file_get_contents("https://20854390.github.io/Lemon/video/lemon_laugh1.mp4");
//file_put_contents("java.mp4",$img);

//echo httpcopy("https://20854390.github.io/Lemon/video/lemon_laugh1.mp4");

//function httpcopy($url, $file="", $timeout=60) {
//    $file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
//    $dir = pathinfo($file,PATHINFO_DIRNAME);
//    !is_dir($dir) && @mkdir($dir,0755,true);
//    $url = str_replace(" ","%20",$url);
//
//    if(function_exists('curl_init')) {
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        $temp = curl_exec($ch);
//        if(@file_put_contents($file, $temp) && !curl_error($ch)) {
//            return $file;
//        } else {
//            return false;
//        }
//    } else {
//        $opts = array(
//            "http"=>array(
//                "method"=>"GET",
//                "header"=>"",
//                "timeout"=>$timeout)
//        );
//        $context = stream_context_create($opts);
//        if(@copy($url, $file, $context)) {
//            //$http_response_header
//            return $file;
//        } else {
//            return false;
//        }
//    }
//}
$url = 'http://bs.baidu.com/wenku4/%2Fe43e6732eba84a316af36c5c67a7c6d6?sign=MBOT:y1jXjmMD4FchJHFHIGN4z:lfZAx1Nrf44aCyD6tJqJ2FhosLY%3D&time=1392893977&response-content-disposition=attachment;%20filename=%22php%BA%AF%CA%FD.xls%22&response-content-type=application%2foctet-stream';
$fp_output = fopen('./test.xls', 'w');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FILE, $fp_output);
curl_exec($ch);
curl_close($ch);
exec("libreoffice ./test.xls", $out, $status);