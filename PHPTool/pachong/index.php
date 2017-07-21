<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/30
 * Time: 10:34
 */
header("Content-type:text/html;charset=utf-8");
function curl_string($url, $user_agent, $proxy)
{
    $ch = curl_init();
    //设置代理
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . "/cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . "/cookie.txt");
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

//$url_page = "https://post.mp.qq.com/group/v/0-0-40003222.html?&sig=d71cab361c1ee7c66a37ced348a7bc4c&article_id=40003222&time=1499335200&_wv=2281701505&rdm=a13c9b&puin=3440535741&mid=5539e5a8d1da85e5&mtype=11&from=qqpubnum";
//$url_page = "http://www.jq22.com/xz.aspx?wz=7114";
$url_page = "http://msnboy.pw/?fromuid=12723";
$user_agent = "Mozilla/5.0";
$proxy = "101.86.86.101:8118";//这个很快
//$proxy = "121.61.18.218:8118";

$string = curl_string($url_page, $user_agent, $proxy);
var_dump($string);
echo $string;
//$timer = filemtime("./test.txt");
//file_put_contents("./test.txt","");
//var_dump($timer);
//var_dump(time());
//var_dump(date("Y-m-d H:i:s",$timer));
//@unlink("./cookie.txt");
//$proxies = file_get_contents('http://api.xicidaili.com/free2016.txt');
//file_put_contents("./proxies.txt",$proxies);
//$proxies = explode("\n",$proxies);
//var_dump($proxies);
//$string = curl_string($url_page,$user_agent,"218.64.93.132:808");
//echo $string;


//preg_match_all("/<img/","<img src=>",$data);
//var_dump($data);


//$proxy = "59.54.224.169";
//$proxyport = "8118";
//$ch = curl_init("http://www.xiaodao.la");
//
//
//
//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//curl_setopt($ch,CURLOPT_PROXY,$proxy);
//curl_setopt($ch,CURLOPT_PROXYPORT,$proxyport);
//curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
//
//
//
//$result = curl_exec($ch);
//echo $result;
//
//curl_close($ch);

//$ctx = stream_context_create(array(  
//       'http' => array('timeout' => 5 ) 
//       'proxy' => 'tcp://60.175.203.243:8080',
//       'request_fulluri' => True)
//    )
//    ); 
//    $result = file_get_contents($url, False, $ctx);     
//    echo $result;  
//$ctx = stream_context_create(array(
//    'http'=>array(
//        'timeout'=>5,
//        'proxy'=>'http://222.82.222.242:9999',
//        'request_fulluri'=>true)
//));
//$result = file_get_contents('http://www.baidu.com',false,$ctx);
//echo $result;
//$url = "http://www.baidu.com";
//$ctx = stream_context_create(array(
//        'http' => array('timeout' => 5,
//            'proxy' => 'http://222.82.222.242:9999',
//            'request_fulluri' => True,)
//    )
//);
//$result = file_get_contents($url, False, $ctx);
//echo $result;