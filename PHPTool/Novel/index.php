<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/5
 * Time: 16:08
 */
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$data_url = "http://a.qidian.com/?page=" . $page;
$data_str = file_get_contents($data_url);
$count_str = file_get_contents("http://a.qidian.com/");
preg_match_all('/<div class="pagination fr" data-eid="qd_C44" id="page-container" data-pageMax="(.+?)" data-page="1"><\/div>/', $count_str, $pages);
$pages = $pages[1][0];

preg_match_all('/ <li data-rid=".+?">.+?href="(.+?)".+?src="(.+?)".+?<a.+?>(.+?)<.+?<p class="author">(.+?)<\/p>.*?<p class="intro">(.+?)<\/p>.+?<span >(.+?)<\/span>/', $data_str, $json_data);

function removeHref($str)
{
    return preg_replace('/href="[http:\/\/|\/\/|https:\/\/].+?"/', 'href="javascript:"', $str);
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

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .item {
            padding: 20px 0 10px;
            border-bottom: 1px solid #e6e6e6;
            height: 176px;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .item-img {
            width: 118px;
            margin-right: 16px;
        }

        .item-img a {
            display: block;
            width: 102px;
            height: 136px;
            overflow: hidden;
        }

        .item-img a img {
            width: 102px;
            height: 136px;
            transition: transform .4s ease-out;
        }

        .item-img a:hover img {
            transform: scale(1.1);
        }

        .item-content {
            width: 100%;

        }

        .item-content h4 {
            overflow: hidden;
            height: 24px;
            margin: 0 0 8px 0;
            cursor: pointer;
        }

        .item-content h4 a {
            color: #262626;
        }

        .item-content h4 a:hover {
            color: #ed4259;
            text-decoration: none;
        }

        .author {
            font-size: 12px;
            color: #a6a6a6;
        }

        .author img {
            width: 14px;
            height: 14px;
            margin: 1px 5px 0 0;;
        }

        .author a {
            color: #a6a6a6;
        }

        .intro {
            font-size: 14px;
            line-height: 24px;
            overflow: hidden;
            height: 48px;
            margin-bottom: 8px;
            color: #666;
        }
    </style>
</head>
<body>
<header style="height: 30px">

</header>
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-push-3">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="请输入关键字">
                <span class="input-group-btn">
        <button class="btn btn-default" type="button">搜索</button>
      </span>
            </div><!-- /input-group -->
        </div>
    </div>

    <div class="clearfix" style="margin-bottom: 20px">
        <?php for ($i = 0; $i < count($json_data[0]); $i++) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="item">
                    <div class="float-left item-img">
                        <a href="<?php echo $json_data[1][$i]; ?>" target="_blank">
                            <img src="<?php echo $json_data[2][$i]; ?>" alt="sss">
                        </a>
                    </div>
                    <div class=" item-content">
                        <h4><a href="<?php echo $json_data[1][$i]; ?>"
                               target="_blank"><?php echo $json_data[3][$i]; ?></a></h4>
                        <p class="author">
                            <?php echo removeHref($json_data[4][$i]); ?>
                        </p>
                        <p class="intro">
                            <?php echo $json_data[5][$i]; ?>
                        </p>
                        <p class="update">
                            <span><?php echo $json_data[6][$i]; ?></span>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="col-md-8 col-xs-12 col-md-push-4">
        <div class="paging" style="text-align: center">
            <?php if ($page <= 4) { ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="<?php echo $page == 1 ? "disabled" : ""; ?>">
                            <a href=" <?php echo $page == 1 ? "javascript:" : "?page=" . ($page - 1); ?> "
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="<?php echo $page == 1 ? "active" : ""; ?>"><a href="?page=1">1</a></li>

                        <li class="<?php echo $page == 2 ? "active" : ""; ?>"><a href="?page=2">2</a></li>

                        <li class="<?php echo $page == 3 ? "active" : ""; ?>"><a href="?page=3">3</a></li>
                        <!--  中间页   -->
                        <li class="<?php echo $page == 4 ? "active" : ""; ?>"><a href="?page=4">4</a></li>
                        <li><a href="?page=5">5</a></li>
                        <li><a href="?page=6">6</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="?page=<?php echo $pages; ?>"><?php echo $pages ?></a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php } else if ($page >= $pages - 3) { ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="<?php echo $page == 1 ? "disabled" : ""; ?>">
                            <a href=" <?php echo $page == 1 ? "javascript:" : "?page=" . ($page - 1); ?> "
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <li><a href="?page=1">1</a></li>
                        <li><a href="javascript:">...</a></li>
                        <li><a href="?page=<?php echo $pages - 5; ?>"><?php echo $pages - 5; ?></a></li>

                        <li><a href="?page=<?php echo $pages - 4; ?>"><?php echo $pages - 4; ?></a></li>

                        <li class="<?php echo $page == $pages - 3 ? "active" : ""; ?>"><a
                                    href="?page=<?php echo $pages - 3; ?>"><?php echo $pages - 3; ?></a></li>
                        <li class="<?php echo $page == $pages - 2 ? "active" : ""; ?>"><a
                                    href="?page=<?php echo $pages - 2; ?>"><?php echo $pages - 2; ?></a></li>
                        <li class="<?php echo $page == $pages - 1 ? "active" : ""; ?>"><a
                                    href="?page=<?php echo $pages - 1; ?>"><?php echo $pages - 1; ?></a></li>

                        <li class="<?php echo $page == $pages ? "active" : ""; ?>"><a
                                    href="?page=<?php echo $pages; ?>"><?php echo $pages; ?></a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php } else { ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="">
                            <a href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a href="?page=1">1</a></li>
                        <li><a href="javascript:">...</a></li>

                        <li class=""><a href="?page=<?php echo $page - 2; ?>"><?php echo $page - 2; ?></a></li>

                        <li><a href="?page=<?php echo $page - 1; ?>"><?php echo $page - 1; ?></a></li>
                        <!--  中间页   -->
                        <li class="active"><a href="javascript:"><?php echo $page; ?></a></li>
                        <li><a href="?page=<?php echo $page + 1; ?>"><?php echo $page + 1; ?></a></li>
                        <li><a href="?page=<?php echo $page + 2 ?>"><?php echo $page + 2; ?></a></li>
                        <li><a href="javascript:">...</a></li>
                        <li><a href="?page=<?php echo $pages; ?>"><?php echo $pages; ?></a></li>
                        <li>
                            <a href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php } ?>

        </div>

    </div>
</div>

</body>

</html>


