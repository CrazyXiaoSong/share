<?php
/**
 * Created by PhpStorm.
 * User: Lemon
 * Date: 2017/6/30
 * Time: 11:42
 */
preg_match_all("/<img/", "<img src=>", $data);
var_dump($data[0]);
