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

    /**
     * @param $num
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function find_news($num){
        return $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
    }

    /**
     * @param int $id
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function find_row(int $id){
        return $this::find($id);
    }

    /**
     * @param int $num
     * @param string $category_id
     * @return mixed
     */
    public function find_groups_news(int $num,string $category_id = null){
        if ($category_id) {
            return $this::where(['category_id' => $category_id]) -> order(['updated_at'=>'desc']) -> limit($num) -> select();
        } else {
            return $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
        }
    }
}