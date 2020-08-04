<?php
namespace app\model;

use think\Model;
use think\facade\Db;
class Product extends Model
{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'product';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    protected $url_prefix = '/storage/temp/product/';

    protected $url_sample = "/static/images/product-sample.png";

    // 设置字段信息
    protected $schema = [
        "id"        => "int",
        "name"     => "string",
        "top_price"      => "decimal",
        "bottom_price"      => "decimal",
        "category_id"      => "int",
        "company_id"      => "int",
        "updated_at"=> "datetime",
        "created_at"=> "datetime",
    ];

    public function find_rows($category_id = 0, int $num = 9){
        $list = $this::order(['updated_at'=>'desc']) -> limit($num) -> select();

        foreach ($list as $key => &$val) {
            if ($val -> image_obj) {
                $val -> image_url = $this -> url_prefix . $val ->image_obj;
            } else {
                $val -> image_url = $this -> url_sample;
            }

        }
        return $list;
    }



    public function find_row($id){
        $info =  $this::find($id);
        if (!$info) {
            return $info;
        }
        //图片
        $images = Db::table('product_images')->where(['product_id' => $info -> id])->order(['is_main'=>'DESC'])->column('image_obj');
        $images_url = [];
        foreach ($images as $key => $item) {
            if ($item) {
                $images_url[] = $this->url_prefix .'/' .$item;
            } else {
                $images_url[] = $this->url_sample;
            }
        }
        if (empty($images)) {
            $images_url = [$this->url_sample, $this->url_sample];
            $images = [null,null];
        }
        if (count($images) < 2) {
            $images_url[1] =  $this -> url_sample;
            $images[1] = null;
        }
        $info -> images_url = $images_url;
        $info -> images = $images;
        //其他属性
        $attr = Db::table('product_attribute') -> where(['product_id' =>  $info-> id]) -> find();
        $info -> attr = $attr;
        //分类
        $category_name = Db::table('product_category') -> where(['id' =>  $info-> category_id]) -> value('name');
        $info -> category_name = $category_name;
        return $info;
    }


    /**
     * @param int $category_id
     * @param int $num_per_page
     * @param null $sticky
     * @return mixed
     */
    public function find_pages(int $category_id = 0, int $num_per_page = 9, $sticky = null, $keyword = null ){
        $where = ['product.company_id' => 1];
        if ($category_id) {
           $where =  array_merge($where,['product.category_id' => $category_id]);
        }

        if ($keyword) {
            $list =  $this::field('product_images.image_obj,product.*')
                -> where($where)
                -> where("product.name", 'like', "%{$keyword}%")
                -> leftJoin('product_images','product_images.product_id = product.id and product_images.is_main=1')
                -> group('product.id')
                -> order(['product.sticky_at'=>'DESC','product.updated_at'=>'DESC','product_images.is_main'=>"DESC"])
                -> paginate($num_per_page);
        }else {
            $list =  $this::field('product_images.image_obj,product.*')
                -> where($where)
                -> leftJoin('product_images','product_images.product_id = product.id and product_images.is_main=1')
                -> group('product.id')
                -> order(['product.sticky_at'=>'DESC','product.updated_at'=>'DESC','product_images.is_main'=>"DESC"])
                -> paginate($num_per_page);
        }

        foreach ($list as $key => &$val) {
            if ($val -> image_obj) {
                $val -> image_url = $this -> url_prefix . $val ->image_obj;
            } else {
                $val -> image_url = $this -> url_sample;
            }

        }
        return $list;
    }


    /**
     * @param int $category_id
     * @param int $num_per_page
     * @param null $sticky
     * @return mixed
     */
    public function find_pages_by_ids(array $category_ids = [], int $num_per_page = 9, $sticky = null, $keyword = null ){
        if (!empty($category_ids)) {
           $list = $this::field('product.*, product_images.image_obj')
                -> where('product.company_id', 1)
                -> where('category_id', 'in', $category_ids)
                -> leftJoin('product_images','product_images.product_id = product.id and product_images.is_main = 1')
                -> group('product.id')
                -> order(['product.sticky_at'=>'DESC','product.updated_at'=>'DESC'])
                -> paginate($num_per_page);
        } else {
           $list = $this::field('product.*, product_images.image_obj')
                -> where('product.company_id', 1)
                -> leftJoin('product_images','product_images.product_id = product.id and product_images.is_main = 1')
                -> group('product.id')
                -> order(['product.sticky_at'=>'DESC','product.updated_at'=>'DESC'])
                -> paginate($num_per_page);
        }
        
        foreach ($list as $key => &$val) {
            if ($val -> image_obj) {
                $val -> image_url = $this -> url_prefix . $val ->image_obj;
            } else {
                $val -> image_url = $this -> url_sample;
            }

        }
        return $list;
    }
}