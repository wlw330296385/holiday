<?php
namespace app\model;

use think\Model;

class News extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'news';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    protected $url_prefix = '/storage/temp/news/';

    protected $url_sample = "/static/images/news-sample.png";

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "title"  => "string",
        "sub_title"      => "string",
        "content"      => "string",
        "image_obj"      => "string",
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
        $list =  $this::order(['updated_at'=>'desc']) -> limit($num) -> select();
        foreach ($list as &$item) {
            if ($item -> image_obj) {
                $item -> cover_url = ($this -> url_prefix).$item -> image_obj;
            } else {
                $item -> cover_url = $this -> url_sample;
            }
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
        if ($info -> image_obj) {
            $info -> cover_url = ($this -> url_prefix).$info -> image_obj;
        } else {
            $info -> cover_url = $this -> url_sample;
        }
        return $info;
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

    /**
     * @param $num 每页多少条
     */
    public function find_pages($num, $category_id = null) {
        if ($category_id) {
            $list = $this::where(['category_id' => $category_id]) -> order(['updated_at'=>'DESC']) -> paginate($num);
        } else {
            $list = $this::order(['updated_at'=>'DESC']) -> paginate($num);
        }
        foreach ($list as &$item) {
            if ($item -> image_obj) {
                $item -> cover_url = ($this -> url_prefix).$item -> image_obj;
            } else {
                $item -> cover_url = $this -> url_sample;
            }
        }
        return $list;
    }
}