<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/7
 * Time: 14:30
 */
include "tool.php";
header("Content-type:text/html;charset=utf-8");
$info = isset($_GET["info"])?$_GET['info']:exit("非法闯入");
preg_match_all('/\d.+/',$info,$data);
$number = $data[0][0];
$demo_url = "http://www.jq22.com/yanshi".$number;
$url = "http://www.jq22.com/".$info;
$str = file_get_contents($url);
preg_match_all('/project-content inad[\s\S]+?src="(.+?)"/',$str,$data_img);
$img = $data_img[1][0];


//设置post的数据
//$post = array (
//    'pwd' => 'admin',
//    'user' => '990313',
//);
$post = array (
    'em' => '20854390@qq.com',
    'pw' => 'chao5211314..',
);

//登录地址
$url = "http://www.jq22.com/emdl.aspx";
//设置cookie保存路径
$cookie = dirname(__FILE__) . '/cookie_oschina.txt';
//登录后要获取信息的地址
$url2 = "http://www.jq22.com/xz.aspx?wz=".$number;
//模拟登录
login_post($url, $cookie, $post);
//获取登录页的信息
$down_data = get_content($url2, $cookie);
//删除cookie文件
@ unlink($cookie);
//匹配页面信息
//var_dump($down_data);

//$str = file_get_contents($url);
//preg_match_all('//',$str);
$demo_str = file_get_contents($demo_url);
preg_match_all('/iframe.+src="(.+?)"/',$demo_str,$data_demo);


$demo = $data_demo[1][0];
if($down_data == '0'){
    $down = './pz/download.php?url='.$demo;
}else{
    $down = "http://www.jq22.com/".$down_data;
}

?>
<html>
<head>
    <title></title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <style>
        .tool{
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-8 col-sm-10 col-sm-push-1 col-md-push-2">
        <img width="100%" src="<?php echo $img ; ?>" alt="">
    </div>
    <div  class="col-xs-push-2 col-xs-8 col-sm-6 col-sm-push-3 tool clearfix">
        <a href="<?php echo $demo ?>" target="_blank" class="pull-left btn btn-success demo">查看演示</a>
        <a href="<?php echo $down ?>" target="_blank" class="pull-right btn btn-danger down">立即下载</a>
    </div>
</div>
</body>
</html>
