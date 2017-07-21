<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/8
 * Time: 9:33
 */
ignore_user_abort(true);
set_time_limit(0);
$time = 60*60*24;
while (true){
    $files = scandir("./");
    foreach ($files as $i){
        $arr = explode(".",$i);
        if(end($arr) == 'zip'){
            unlink($i);
        }
    }
    sleep($time);
}


