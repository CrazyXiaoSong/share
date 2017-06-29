<?php

/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/28
 * Time: 16:25
 */
class Mysql{
    private $user;
    private $pwd;
    private $port = 3306;
    private $host = 'localhost';
    private $dbname;
    private $charset = "utf8";
    private $conn;
    private $table;
    private $sql = '';
    function __construct($user, $pwd, $dbname, $host = "localhost", $port = 3306, $charset = "utf8"){
        $this->user = $user;
        $this->pwd = $pwd;
        $this->dbname = $dbname;
        $this->host = $host;
        $this->port = $port;
        $this->charset = $charset;
        echo "数据打开了！";
        $conn = new mysqli($this->host,$this->user,$this->pwd,$this->dbname,$this->port);
        $conn->set_charset($this->charset);
        $this->conn = $conn;
    }
   /* public function execute($sql){
        $rs = $this->conn->query($sql);
        $arr = array();
        while ($r = $rs->fetch_object()){
            array_push($arr,$r);
        }
        return $arr;
    }*/
    private function check($str){
        return str_replace("'","\\'",$str);
    }
    /*private function joinWhere($arr, $str){
        $where = '';
        foreach ($arr as $key=>$value){
            if ($value == $str){
                break;
            }
            $where .= $key." $str ".self::check($value);
        }
    }*/

    /**
     * @param $sql string 通过 ？替换后面数组的字符
     * @param array $arr 与前面sql语句所匹配的数组
     * @return array 返回查询数据
     */
    public function query($sql,$arr = []){
         $count = preg_match_all("/\?/",$sql);
         $returnArr = [];
         if($count){
             if($count != count($arr)){
                 die( "长度不匹配");
             }
             foreach ($arr as $value){
                 $sql = preg_replace("/\?/", self::check($value),$sql,1);
             }

             $rs = $this->conn->query($sql);
             while ($r = $rs->fetch_object()){
                 $returnArr[] = $r;
             }
         }
         return $returnArr;

    }

    public function table($table){
        $this->table = $table;
    }

    public function find($filed, $table){
        $this->sql .= "SELECT $filed FROM `$table`";
    }
    public function where($where){
        $this->sql .= "WHERE {$where}";
    }

    /*public function select($table,$query = "*",$where = array("key"=>"value")){

        var_dump(array_keys($where));
        var_dump(array_values($where));
        $endValue = end($where);
        switch (strtolower(trim(end($where)))){
            case 'and':
        }
        var_dump($endValue);
//        $sql = "SELECT {$query} FROM `$table` WHERE {$where}";
    }*/
    function __destruct(){
        echo "数据库关闭了！";
        $this->conn->close();

    }
}
$sql = new Mysql("root","","ccc");
$r = $sql->query("SELECT * FROM `excel` WHERE id=? or id=?",[1,4]);
var_dump($r);
//$r = $sql->execute("SELECT * FROM `excel`");
//$sql->select("excel");
//$str = "asfd?safd?asf?asf?";
//$arr = array(1,2,3);
//$r = preg_replace(array('/\?/','/\?/','/\?/'),$arr,$str);
//var_dump($r);
//$r =
//var_dump($r);




















