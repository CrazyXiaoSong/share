<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/7
 * Time: 16:07
 */
header("Content-type:text/html;charset=utf-8");
$page = isset($_GET['p']) ? $_GET['p'] : 1;
$str = file_get_contents("http://www.jq22.com/jq" . $page . "-jq");

preg_match_all('/col-lg-4 col-md-3 col-sm-4[\s\S]+?src="(.+?)"[\s\S]+?href="(.+?)".+?<h4>(.+?)<\/h4>[\s\S]+?<small>(.+?)<\/small>[\s\S]+?<\/i>([\s\S]+?)</', $str, $data);
preg_match_all('/class=\'next\'/', $str, $has_nextPage);

preg_match_all('/class=\'previous\'/', $str, $has_prePage);

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

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <style>
        .img-link {
            display: block;
            overflow: hidden;
        }

        .img-link img {
            transition: 1s;
        }

        .img-link:hover img {
            transform: scale(1.1);
        }

        .info {
            display: block;
            line-height: 1.2;
            height: 30px;
            overflow: hidden;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row" style="margin: 20px 0">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Lemon</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav nav-titles">
                        <li class="home active"><a href="./index.php">首页</a></li>
                    </ul>
                    <form action="search.php" class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" name="sv" class="form-control search_value" placeholder="搜索...">
                        </div>
                        <button type="submit" class="btn btn-default search_btn">搜索</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-push-2 col-xs-10 col-xs-push-1">

            <div class="alert alert-info" role="alert" style="text-align: center">由JavaScript生成的图片链接不会自动下载，目前不支持！</div>
        </div>
    </div>

    <?php
    for ($i = 0; $i < count($data[0]); $i++) {
        $url = "./jq.php?info=" . $data[2][$i];

        ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail">
                <a class="img-link" href="<?php echo $url; ?>" target="_blank">
                    <img src="<?php echo $data[1][$i]; ?>" alt="<?php echo $data[3][$i]; ?>">
                </a>
                <a href="<?php echo $url; ?>" target="_blank">
                    <div class="caption">
                        <h4 style="text-overflow:ellipsis;overflow: hidden;white-space: nowrap;"><?php echo $data[3][$i]; ?></h4>
                        <small class="info"><?php echo $data[4][$i]; ?></small>
                    </div>
                </a>

            </div>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
    <nav>
        <ul class="pager">
            <li class="previous <?php echo count($has_prePage[0]) < 2 ? 'disabled' : ''; ?>"><a
                        href="<?php echo count($has_prePage[0]) < 2 ? 'javascript:' : '?p=' . ($page - 1); ?>"><span
                            aria-hidden="true">&larr;</span> 上一页</a></li>
            <li class="next <?php echo count($has_nextPage[0]) < 2 ? 'disabled' : ''; ?>"><a
                        href="<?php echo count($has_nextPage[0]) < 2 ? 'javascript:' : '?p=' . ($page + 1); ?>">下一页
                    <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>
</div>
</body>
</html>
