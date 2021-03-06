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
        "header_obj"=>"string",
        "image_obj"=>"string",
        "qrcode_obj"=>"string",
        "product_banner_obj"=>"string",
        "contact_obj"=>"string",
        "copyright"=>"string",
        "updated_at"=>"datetime",
        "created_at"=>"datetime",
    ];

    public function find_company_setting($company_id){
        $setting =  $this::where(['company_id' => $company_id]) -> find();
        if (!$setting) {
            return null;
        }
        $setting -> contact = json_decode($setting -> contact_obj);
        $setting -> image_list = json_decode($setting -> image_obj);
        $setting -> header_url = "/storage/images/header/" . $setting -> header_obj;
        $setting -> header_wap_url = "/storage/images/header/wap/" . $setting -> header_obj;
        $setting -> logo_url = "/storage/images/logo/" . $setting -> logo_obj;
        $setting -> qrcode_url = "/storage/images/qrcode/" . $setting -> qrcode_obj;
        return $setting;
    }

    public function update_row() {

    }
}