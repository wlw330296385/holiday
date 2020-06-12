<?php
namespace app\model;

use think\Model;

class FriendLink extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'friend_link';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "link_url"  => "string",
        "name"      => "string",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    public function find_friend_links(){
        return $this::order(['updated_at'=>'desc']) -> select();
    }
}