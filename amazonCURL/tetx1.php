<?php
header("Content-type: text/html; charset=utf-8");
// 连接mysql
mysql_connect('127.0.0.1','root','root');
// 用那个数据库
mysql_select_db('amazon');

$time=time();
$goods_name=$_GET['goods_name'];
$goods_price=$_GET['goods_price'];
$src=$_GET['src'];
$goods_url=$_GET['goods_url'];
// 连接mysql
mysql_connect('127.0.0.1','root','root');
// 用那个数据库
mysql_select_db('amazon');
$sql="insert into goods_order (goods_name,goods_price,goods_img,goods_url,addtime)
        values('$goods_name','$goods_price','$src','$goods_url','$time')";
// 执行sql
$res = mysql_query($sql);
if($res){
    echo 'ok';
}else{
    echo mysql_error();
}

