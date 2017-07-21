<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/29
 * Time: 8:38
 */
//本例用来重定向用户页面到PHP的官方网站。
//header("location:http://www.baidu.com");
//file_put_contents("./test.txt","我还执行");

//header('Content-Disposition: attachment; filename="downloaded.pdf"');
//欲让用户每次都能得到最新的资料，而不是Proxy或cache中的资料，可以使用下列的标头。
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Cache-Control: no-cache");
//header("Pragma: no-cache");

//提供让用户下载文件的范例。提示用户保存一个生成的 PDF 文件(Content-Disposition 报头用于提供一个推荐的文件名，并强制浏览器显示保存对话框)：

//header("Content-type:application/php"); //文件将被称为 downloaded.pdf
//
//header("Content-Disposition:attachment;filename='downloaded.php'"); //PDF 源在 original.pdf 中
//
//readfile("test1.php");

//header('Content-type: application/image/pjpeg'); //输出的类型
//
//header('Content-Disposition: attachment; filename="downloaded.jpg"'); //下载显示的名字，注意格式。
//
//readfile('my.jpg');
//var_dump(uniqid());