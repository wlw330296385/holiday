<?php
namespace app\model;

use think\Model;

class Banner extends Model
{
    protected $url_prefix = "/storage/temp/banner/";
    // 设置当前模型对应的完整数据表名称
    protected $table = 'banner';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "alt"  => "string",
        "image_obj"      => "string",
        "mobile_image_obj"      => "string",
        "link_url"      => "string",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    protected static function init()
    {
        //TODO:初始化内容
    }

    public function find_rows($num = 3){
        $list = $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
        foreach ($list as $key => &$item) {
            $item -> url = ($this -> url_prefix). ($key+1) . '/' .$item -> image_obj;
            $item -> mobile_url = ($this -> url_prefix).'wap/'. ($key+1) . '/' .$item ->mobile_image_obj;
        }
        return $list; 
    }
}