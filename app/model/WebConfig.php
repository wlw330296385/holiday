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
        "news_banner_obj"=>"string",
        "product_banner_obj"=>"string",
        "company_phone"=>"string",
        "phone"=>"int",
        "home_img1"=>"string",
        "home_img2"=>"string",
        "home_img3"=>"string",
        "copyright"=>"string",
        "updated_at"=>"datetime",
        "created_at"=>"datetime",
    ];

    public function find_company_setting($company_id){
        return $this::where(['company_id' => $company_id]) -> find();
    }
}