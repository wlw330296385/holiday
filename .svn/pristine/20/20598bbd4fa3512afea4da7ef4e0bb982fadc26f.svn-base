<?php
namespace app\model;

use think\Model;

class User extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'user';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "username"  => "string",
        "password"      => "string",
        "role"      => "string",
        "is_available"      => "int",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    protected static function init()
    {
        //TODO:初始化内容
    }

    public function find_row($username, $password) {

        $row = $this::where(['username' => $username, 'password' => sha1($password)]) -> find();

        return $row;
    }

    //创建用户
    public function create_row($username, $password, $role) {
        $row = $this::create(['username' => $username, 'password' => sha1($password), 'role' => $role]);

        return $row;
    }
}