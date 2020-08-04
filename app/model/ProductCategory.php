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

    // 向下获取category_id
    public function find_all_ids(int $m = 0) {
        return  $this::where(['pid' => $m])->whereOr('id', $m)-> column('id');
    }

    // 向上获取category_id和同类
    public function find_all_pids(int $m = 0) {
        return  $this::where(['pid' => $m])->whereOr('id', $m)-> column('id');
    }

    public function find_rows(int $num = 100, array $ids = null){
        if ($ids) {
            $list = $this::where('id','in', $ids) -> order(['pid'=>'DESC', 'id' => 'asc']) -> limit($num) -> select() -> toArray();
        } else {
            $list = $this::where('pid', 0) ->order(['id'=>'asc']) -> limit($num) -> select() -> toArray();
        }
        // $result = tree($list);
        return $list;
    }

    public function find_trees(int $num = 100, array $ids = null){

        if ($ids) {
            $list = $this::where('id','in', $ids) -> order(['pid'=>'DESC', 'id' => 'asc']) -> limit($num) -> select() -> toArray();
        } else {
            $list = $this::order(['id'=>'asc']) -> limit($num) -> select() -> toArray();
        }
        $result = tree($list);
        return $result;
    }

    /**
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function cateTree()
    {
        $cate = self::select();

        $cate = $this->_sort($cate);

        return $cate;
    }

    private function _sort($data, $pid = 0, $level = 0)
    {
        static $arr = [];

        foreach ($data as $k => $v) {
            if ($v['pid'] == $pid) {
                $v->level = $level;
                $arr[] = $v->toArray();
                $this->_sort($data, $v['id'], $level + 1);
            }
        }

        return $arr;
    }
}