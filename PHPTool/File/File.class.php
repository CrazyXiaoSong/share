<?php

/**
 * Created by PhpStorm.
 * User: Lemon
 * Date: 2017/6/28
 * Time: 13:20
 */


class File{

    private $name;
    private $ext;
    private $size;
    private $basename;
    private  $content;
    private $absolute;

    function __construct($file){
        if (!is_file($file)) {
            file_put_contents($file, "");
        }
        $this->basename = basename($file);
        $this->name = pathinfo($file)['filename'];
        $this->file = $file;
        $this->absolute = __DIR__ . "/" . $file;
        $this->size = filesize($file);
        $this->ext = pathinfo($file, PATHINFO_EXTENSION);
        $this->content = file_get_contents($file);
    }

    /**
     * @param $content string 追加的字符串
     * @return bool|int 成功返回追加字符串的大小，失败返回false
     */
    public function add($content){
        $this->content = $this->content.$content;
        return file_put_contents($this->absolute, $content, FILE_APPEND);
    }

    /**
     * @param $searchValue string 查找的字符串
     * @param $str string 修改后的内容
     * @param $total boolean true为查找并替换全部,false为替换一个
     * @return int 返回替换的个数
     */
    public function update($searchValue, $str, $total = false){
        $content = file_get_contents($this->file);
        $count = 1;
        if($total){
            str_replace($searchValue, $str, $content, $count);
        }else{
            preg_replace("/$searchValue/", $str, $content,1);
        }
        return $count;
    }

    /**
     * @param $path string 复制到指定路径
     * @param $name string 新的文件名，不指定则默认是原文件名
     * @return bool 复制成功返回true 失败则返回false
     */
    public function copy($path, $name = null){
        return isset($name)?copy($this->file, $path."/".$this->basename):copy($this->file, $path."/".$name);
    }

    /**
     * @return bool 成功返回true 失败false
     */
    public function delete(){
        return unlink($this->file);
    }

    /**
     * 保存当前的内容到文件
     * @return bool|int
     */
    public function save(){
        return file_put_contents($this->absolute,$this->content);
    }

    /**
     * @param $str string 设置当前file对象的内容
     * @return bool|int
     */
    public function setContent($str){
        $this->content = $str;
    }
}

$file = new File("../File/test2.txt");
$file->add("哈哈哈");
$file->setContent("哈哈哈哈");
$file->save();