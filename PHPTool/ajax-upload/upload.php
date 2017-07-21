<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/6/27
 * Time: 16:44
 */
class File{
    public $name;
    public  $save_path = "./";
    public $type;
    private $ext;
    public  $size;
    public $tmp_name;
    function __construct($file){
        $this->name = $file['name'];
        $this->type = $file['type'];
        $arr = explode(".",$this->name);
        $this->ext = end($arr);
        $this->size = $file['size'];
        $this->tmp_name = $file['tmp_name'];
    }
    function save(){
        move_uploaded_file($this->tmp_name,$this->save_path."/".$this->name);
    }
}
$file = new File($_FILES['file']);
$file->save_path = "./file";
var_dump($file->size);
$file->save();