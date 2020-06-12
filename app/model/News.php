<?php
namespace app\model;

use think\Model;

class News extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'news';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "title"  => "string",
        "sub_title"      => "string",
        "content"      => "string",
        "inter_link"      => "string",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    public function find_news($num){
        return $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
    }
}