<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/30
 * Time: 11:46
 */
$requestUrl = 'http://www.xiaodao.la';
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $requestUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
curl_setopt($ch, CURLOPT_PROXY, "114.230.217.73"); //代理服务器地址
curl_setopt($ch, CURLOPT_PROXYPORT, 808); //代理服务器端口
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, ":"); //http代理认证帐号，username:password的格式
curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式
$file_contents = curl_exec($ch);
curl_close($ch);
echo $file_contents;