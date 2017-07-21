<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/8
 * Time: 9:53
 */

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

//downloadSource("http://www.jq22.com/demo/dtree201707051201/index.html","test");