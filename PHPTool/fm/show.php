<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/8
 * Time: 17:26
 */

include "./phpquery/phpQuery/phpQuery.php";
$i = isset($_GET['i'])?$_GET['i']:exit("非法闯入");
$get_url = 'https://fm.qq.com/show/'.$i;
phpQuery::newDocumentFile($get_url);
$main = pq('.col-wrap-inner');