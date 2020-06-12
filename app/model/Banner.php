<?php
namespace app\model;

use think\Model;

class Banner extends Model
{
    protected $url_prefix = "/static/frontend/temp/";
    // 设置当前模型对应的完整数据表名称
    protected $table = 'banner';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "alt"  => "string",
        "image_obj"      => "string",
        "link_url"      => "string",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    protected static function init()
    {
        //TODO:初始化内容
    }

    public function find_banners($num = 3){
        $list = $this::order(['updated_at'=>'desc']) -> limit($num) -> select() -> toArray();
        foreach ($list as &$item) {
            $item['url'] = ($this -> url_prefix).$item['image_obj'];
        }
        return $list; 
    }
}