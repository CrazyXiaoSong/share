<?php
header("Content-type: text/html; charset=utf-8");
$asin=$_POST['asin'];
$trackingid=$_POST['trackingid'];
$keywords=$_POST['keywords'];
$url="https://www.amazon.com/gp/product/{$asin}/ref=as_li_qf_sp_asin_il_tl?ie=UTF8&tag={$trackingid}&&keywords={$keywords}";
$headers['CLIENT-IP'] = '202.103.229.40';
$headers['X-FORWARDED-FOR'] = '202.103.229.40';
$headerArr = array();
foreach( $headers as $n => $v ) {
    $headerArr[] = $n .':' . $v;
}
//初始化curl
$curl = curl_init();
// 设置你需要抓取的URL
curl_setopt($curl, CURLOPT_URL,$url);
curl_setopt ($curl, CURLOPT_HTTPHEADER , $headerArr );  //构造IP
curl_setopt ($curl, CURLOPT_REFERER, "http://www.163.com/ ");   //构造来路
// 设置header
 curl_setopt($curl, CURLOPT_HEADER, 1);
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//去掉SSL证书认证
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
//curl爬取过程中，设置CURLOPT_FOLLOWLOCATION为true，则会跟踪爬取重定向页面，否则，不会跟踪重定向页面。
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
// 运行cURL，请求网页
$data = curl_exec($curl);
if(curl_exec($curl) === false)
{
    echo 'Curl error: ' . curl_error($curl);
}
$data = str_replace('jsonp_reviews_list(','',$data);//去掉多余的字符串
$data = str_replace(')','',$data);
// 关闭URL请求
curl_close($curl);
//将获取到的内容存放到html页面生成文件
$fh=fopen("index.html",'w');
fwrite($fh,$data);
fclose($fh);
//-------------------图片及src地址-----------------------
preg_match_all('/<img alt="(.*?)" src="(.*?)" data-old-hires="(.*?)" .*?>/im', $data, $match);
foreach ($match[0] as $key => $value) {
    $img=$value;
    echo $img;
}
preg_match_all('/<img (.*?) src="(.+?)".*?>/',$img,$imges);
foreach ($imges[2] as $k=>$v){
    $src=trim($v);
}
//--------------------商品名称---------------------------
preg_match_all('/<span id="(productTitle)" class="(a-size-large)">(.*?)<\/span>/is',$data,$content);
foreach($content[0] as $key=>$value){
    $goods_name=$value;
}
//--------------------商品价格-------------------------------
preg_match_all('/<span id="(priceblock_saleprice)" class="(a-size-medium a-color-price)">(.*?)<\/span>/is',$data,$price);
    foreach ($price[0] as $key => $value) {
        $goods_price = $value;
    }
preg_match_all('/<span id="(priceblock_ourprice)" class="(a-size-medium a-color-price)">(.*?)<\/span>/is', $data, $price1);
        foreach ($price1[0] as $key => $value) {
            $goods_price = $value;
        }

preg_match_all('/<span id="(priceblock_dealprice)" class="(a-size-medium a-color-price)">(.*?)<\/span>/is', $data, $price1);
foreach ($price1[0] as $key => $value) {
    $goods_price = $value;
}


?>
<table class="order">
    <tr>
        <td class="img">
            <?php
            if($img==""){
                echo "商品图片获取失败重新提交";felse;
            }else {
                echo $src;
            }
                ?>
        </td>
    </tr>
    <tr>
        <th>商品名:</th>
        <td class="goods_name">
            <?php
            $goods_name=strip_tags("$goods_name");
            $goods_name=trim($goods_name);
            echo ltrim($goods_name);
            ?>
        </td>
        </tr>
    <tr>
        <th>商品价格:</th>
        <td class="goods_price">
            <?php
                $goods_price = strip_tags("$goods_price");
                echo trim($goods_price, '$');
            ?>
<!--            <input type="text" class="goods_price" name="price" value="" />
-->        </td>
    </tr>
    <tr>
        <th>商品链接:</th>
        <td class="goods_url">
                <?php
                    echo $url;
                        ?>
        </td>
    </tr>
    <tr>
        <th></th>
        <td align="right">
            <button id="sub">提交</button>
        </td>
    </tr>
</table>
<script src="jquery1.42.min.js"></script>
<script type="text/javascript">
    $("#sub").click(function(){
        var goods_name= $(".goods_name").html();
        var goods_price= $(".goods_price").html();
        var src=$(".img").html();
        var goods_url=$(".goods_url").html();
        $.ajax({
            url:'tetx1.php',
            data:{"goods_price":goods_price,"goods_name":goods_name,"src":src,"goods_url":goods_url},
            type:'get',
            success:function(e){
                alert(e);
                location.href="tetx.html";
            }
        });
    });

</script>
