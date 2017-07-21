<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/6
 * Time: 10:30
 */
$kw = $_GET['kw'];
$page = isset($_GET['page'])?$_GET['page']:1;
$data_url = "http://se.qidian.com/?kw=".$kw."&page=".$page;
$data_str = file_get_contents($data_url);
for($i = 0;$i < 100;$i++){
//    var_dump("http://");
}
preg_match_all('/data-rid.+?href="(.+?)".+?src="(.+?)".+?book-mid-info.+?<a.+?>(.+?)<.+?<p.+?>(.+?)<\/p>.*?<.+?>(.+?)</', $data_str, $json_data);
var_dump($json_data);
?>
<!--<html>-->
<!--<head>-->
<!--    <title></title>-->
<!--    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->-->
<!--    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
<!--          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
<!---->
<!--    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->-->
<!--    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->
<!--          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->
<!---->
<!--    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->-->
<!--    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"-->
<!--            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"-->
<!--            crossorigin="anonymous"></script>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div class="container">-->
<!--    <div class="col-ms-5">-->
<!---->
<!--    </div>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->
