<?php
namespace app\model;

use think\Model;

class Product extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'product';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "name"     => "string",
        "top_price"      => "decimal",
        "bottom_price"      => "decimal",
        "category_id"      => "int",
        "company_id"      => "int",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    public function find_rows($category_id = 0, int $num = 9){
        return $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
    }
}