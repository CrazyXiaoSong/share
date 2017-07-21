<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="tetx.html">添加商品</a>
<table>
    <tr><th>商品名</th><th>图片</th><th>价格</th><th>跳转amazon</th></tr>
<?php
header("Content-type: text/html; charset=utf-8");
mysql_connect('127.0.0.1','root','root');
mysql_select_db('amazon');
$sql="select * from goods_order";
$res = mysql_query($sql);
echo "<pre>";
while ($row = mysql_fetch_assoc($res)){
    echo"<tr><td>".$row["goods_name"]."</td><td>"."<img src='".$row["goods_img"]."'>"."</td><td>$".$row["goods_price"]."</td><td>"."<a href='".$row["goods_url"]."'>amazon</a>"."</td><tr>";
}
?>
    </table>


</body>
<script>

    </script>
</html>