<?php
namespace app\model;

use think\Model;

class WebConfig extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'web_config';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    // 设置字段信息
    protected $schema = [
        "id"=>"int",
        "company_id" => "int",
        "title"=>"string",
        "keyword"=>"string",
        "description"=>"string",
        "company_name"=>"string",
        "logo_obj"=>"string",
        "head_obj"=>"string",
        "image_obj"=>"string",
        "banner_arr"=>"string",
        "product_banner_obj"=>"string",
        "contact_obj"=>"string",
        "copyright"=>"string",
        "updated_at"=>"datetime",
        "created_at"=>"datetime",
    ];

    public function find_company_setting($company_id){
        return $this::where(['company_id' => $company_id]) -> find();
    }
}