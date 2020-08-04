<?php
namespace app\model;

use think\Model;

class SuccessCase extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'success_case';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    protected $url_prefix = '/storage/temp/success_case/';

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "name"  => "string",
        "image_obj"      => "string",
        'url_link'  => "string",
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
    public function find_rows($num){
        $list =  $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
        foreach ($list as &$item) {
            $item -> image_url = ($this -> url_prefix).$item -> image_obj;
        }
        return $list;
    }

    /**
     * @param int $id
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function find_row(int $id){
        $info = $this::find($id);
        $info -> image_url = ($this -> url_prefix).$info -> image_obj;
        return $info;
    }


    /**
     * @param $num 每页多少条
     */
    public function find_pages($num) {
        $list = $this::order(['updated_at'=>'DESC']) -> paginate($num);
        foreach ($list as &$item) {
            $item -> image_url = ($this -> url_prefix).$item -> image_obj;
        }
        return $list;
    }
}