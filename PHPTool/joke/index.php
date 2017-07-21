<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/7/5
 * Time: 11:22
 */
$str_data = file_get_contents("http://api.laifudao.com/open/xiaohua.json");
//$data = eval($str_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

</body>
<script>
    <?php echo "var str = '$str_data'"?>;
    var data = eval("("+str+")");
    console.log(data)

</script>
</html>