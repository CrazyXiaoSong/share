<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/8
 * Time: 15:33
 */
include "./phpquery/phpQuery/phpQuery.php";
phpQuery::newDocumentFile("https://fm.qq.com/");
$main = pq('.col-wrap-inner');
$str_titles = $main->find('.title')->text();
$str_infoes = $main->find('.info')->text();
$image = $main->find('img');
$images = array();
foreach ($image as $key => $value) {
    $images[] = $value->getAttribute("src");
}
$str_a_arr = array();
foreach ($main->find('.cover-mask') as $key => $value) {
    $str_a_arr[] = $value->getAttribute("href");
}
$infoes = explode("\n", $str_infoes);
var_dump(count($infoes));

$titles = explode("\n", $str_titles);
//var_dump($infoes);


?>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <!--    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"-->
    <!--          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Lemon</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">精品推荐</a></li>
                    <li><a href="#">音乐电台</a></li>
                    <li><a href="#">情感生活</a></li>
                    <li><a href="#">有声小说</a></li>
                    <li><a href="#">综艺娱乐</a></li>
                    <li><a href="#">知识干货</a></li>
                    <li><a href="#">搞笑段子</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="row">
        <?php
        for ($i = 0; $i < count($infoes); $i++) {
            if (trim($infoes[$i]) == '') {
                continue;
            }
            $a = explode("/",$str_a_arr[$i]);
            $a_e = end($a);
            $url = "./show.php?i=".$a_e;
            ?>
            <a href="<?php echo $url ?>">
                <div class="col-xs-push-1 col-sm-push-0 col-xs-10 col-sm-6 col-lg-3 col-md-4">
                    <div class="thumbnail">

                        <img style="width: 240px;height: 240px" src="<?php echo $images[$i]; ?>"
                             alt="<?php echo $titles[$i]; ?>">
                        <div class="caption">
                            <h3 style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis"><?php echo $titles[$i]; ?></h3>
                            <p style="height: 40px;overflow: hidden"><?php echo $infoes[$i]; ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>


</div>


</body>
</html>
