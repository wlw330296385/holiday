<?php
namespace app\model;

use think\Model;

class ProductCategory extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'product_category';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "name"  => "string",
        "pid"      => "int",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    protected static function init()
    {
        //TODO:初始化内容
    }

    public function find_rows($num = 100){

        $list = $this::order(['updated_at'=>'desc']) -> limit($num) -> select() -> toArray();
        $result = tree($list);
        return $result;
    }
}