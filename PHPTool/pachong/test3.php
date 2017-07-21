<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/30
 * Time: 11:50
 */
header("Content-type:text/html;charset=gbk");
ignore_user_abort(true);
set_time_limit(0);
while (true){
    sleep(5*60);
    $str = file_get_contents("http://www.xiaodao.la");
    file_put_contents("./xiaodao.html",$str);
}
