<?php
namespace app\controller;

use app\BaseController;
use app\middleware\Httpchk;
use think\Request;
use app\model\ProductCategory;
use think\facade\Db;
use think\facade\View;
use think\App;
use app\model\WebConfig;
class Admin extends BaseController
{
    public $setting;
    public function __construct(App $app)
    {
        parent::__construct($app);

        try {

            //验证登陆
            $user = session('user');
            if (!$user) {
                $this -> go_to_login();
            }
            // 网站基本设置
            $WebConfig = new WebConfig();
            $setting = $WebConfig -> find_company_setting(1);
            if (!$setting) {
                echo '<style>body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;}</style>
                <div style="padding: 24px 48px;"> <h1 style="color: #66CCCC">数据表数据丢失</h1><p> ' . date('Y-m-d H:i:s') . '<br/>
                <span style="font-size:30px;">华利达PAC</span></p><span style="font-size:25px;">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1303274598&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1303274598:53" alt="点我直接qq联系" title="点我直接qq联系"/>
                </a>
                </span>
                </div>';
                die();
            }
            $this -> setting = $setting;
            View::assign([
                'setting' => $this->setting,
                'user'      => $user
            ]);
        } catch (\Exception $e) {
            return json($e->getMessage());
        }
    }


    /**
     * @return \think\response\View
     * 网站设置
     */
    public function index()
    {
        if (request() -> isPost()) {
            $data = input();
            if (!isset($data['id'])) {
                $data['id'] = 999;
            }
            $contact = [
                'phone'         =>$data['phone'],
                'company_phone' =>$data['company_phone'],
                'email'         =>$data['email'],
                'qq'            =>$data['qq'],
                'wx'            =>$data['wx'],
            ];
            $data['contact_obj'] = json_encode($contact);
            WebConfig::update($data, ['id' => $data['id']], [
                                                            "company_name"
                                                            ,"title"
                                                            ,"keyword"
                                                            ,"description"
                                                            ,"contact_obj"
                                                            ,"location"
                                                            ,"copyright"
                                                            ]
            );
            echo "<script>alert('请点击一下右边[官网首页属性]查看更新');</script>";
        }
        return view();
    }

    /**
     * @return string|\think\response\View
     * banner列表
     */
    public function banner() {
        $num = 3;
        //原来的bannerlist
        $Banner = new \app\model\Banner();
        if ( request() -> isPost() ) {
            $data = input('param.');
            if (count($data['alt']) <> count($data['link_url'])) {
                echo "<script>alert('参数错误406')</script>";header("refresh: 0");return '';
            }
            $num = count($data['alt']);
            $banner_list = $Banner -> find_rows($num);
            foreach ($banner_list as $key => $vol) {
                $vol -> alt = $data['alt'][$key];
                $vol -> link_url = $data['link_url'][$key];
                $vol -> save();
            }
        } else {
            $banner_list = $Banner -> find_rows($num);
        }
        return view('banner', [
            'banner_list' => $banner_list,
        ]);
    }

    /**
     * @return \think\response\View
     * 新闻列表
     */
    public function news(Request $request) {
      
        $id = input('param.id');
        $News = new \app\model\News();
        if ($id) {
            $News -> update(['updated_at' => date('Y-m-d H:i:s')],['id'=>$id]);
        }
        $list = $News -> find_pages(7);

        return view('news',[
            'list' => $list
        ]);
    }

    /**
     * @return string|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 新闻编辑\展示
     */
    public function news_edit(Request $request){
        $id = input('param.id','1','intval');
        $News = new \app\model\News();
        $info = $News -> find_row($id);
        if (!$info) {
            echo "<script>alert('404路径错误');history.go(-1);</script>";;
        }
        if (request() -> isPost()) {
            $data = $request -> param();
            if (!empty($data['title'])) {
                $info -> title = $data['title'];
            }
            if (!empty($data['sub_title'])) {
                $info -> sub_title = $data['sub_title'];
            }
            if (!empty($data['content'])) {
                $info -> content = $data['content'];
            }
            if (!empty($data['inter_link'])) {
                $info -> inter_link = $data['inter_link'];
            }
            if (!empty($data['image_obj'])) {
                $info -> image_obj = $data['image_obj'];
            }

            $info -> updated_at = date('Y-m-d H:i:s');
            $info -> save();
            echo "<script>alert('修改成功')</script>";header("refresh: 0");return '';
        }
//        文章分类:
        $news_category = Db::table('news_category')->select();
        return view('news_edit',[
            'info'          => $info,
            'news_category' =>$news_category
        ]);
    }

    /**
     * @return \think\response\Redirect|\think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 发布新闻
     */
    public function news_add(Request $request){

        if (request() -> isPost()) {
            $News = new \app\model\News();
            $data = $request -> param();
            if (!empty($data['title'])) {
                $News -> title = $data['title'];
            }
            if (!empty($data['sub_title'])) {
                $News -> sub_title = $data['sub_title'];
            }
            if (!empty($data['content'])) {
                $News -> content = $data['content'];
            }
            if (!empty($data['inter_link'])) {
                $News -> inter_link = $data['inter_link'];
            }
            if (!empty($data['image_obj'])) {
                $News -> image_obj = $data['image_obj'];
            }
            $News -> created_at = date('Y-m-d H:i:s');
            $News -> updated_at = date('Y-m-d H:i:s');
            $News -> save();
            echo "<script>alert('添加成功')</script>";
            return redirect('news');
        }
        $news_category = Db::table('news_category')->select();
        return view('news_add',[
            'news_category' =>$news_category
        ]);
    }


    public function product() {

        $id = input('param.id');
        $Product = new \app\model\Product();
        if ($id) {
            $Product -> update(['updated_at' => date('Y-m-d H:i:s')],['id'=>$id]);
        }
        if (input('param.sticky')) {
            $list = $Product -> find_pages(0,7, 'sticky');
        } else {
            $list = $Product -> find_pages(0,7);
        }
        $category_list = Db::table('product_category') -> select();

        foreach ($list as $key => $item) {
            foreach ($category_list as $k => $i) {
                if ($item -> category_id == $i['id']) {
                    $item -> cate_name = $i['name'];
                }
            }
        }
        return view('product',[
            'list' => $list,
            'category_list' => $category_list
        ]);
    }


    public function product_edit(Request $request)
    {

        $id = input('param.id', 0, 'intval');
        $Product = new \app\model\Product();
        $info = $Product->find_row($id);
        if (!$info) {
            echo "<script>alert('404路径错误');history.go(-1);</script>";;
        }
        if (request()->isPost()) {
            //这里需要增加事务操作,错误回滚
            $data = $request -> param();
            $now = date('Y-m-d H:i:s');
            $info -> company_id = 1;
            $info -> name = $data['name']??'';
            $info -> category_id = $data['category_id']??'';
            $info -> updated_at = $now;
            $info -> save();
            //保存其他属性
            $attr = [];
            $attr['product_id'] = $info->id;
            $attr['marketing_sentence'] = $data['marketing_sentence']??'';
            $attr['promotion_sentence'] = $data['promotion_sentence']??'';
            $attr['gift_sentence'] = $data['gift_sentence']??'';
            $attr['content'] = $data['content']??'';
            $attr['content'] = $data['editorValue']??'';
            $attr['created_at'] = $now;
            //只要有修改,一律删除再插入
            Db::table('product_attribute') -> where(['product_id' => $info -> id]) -> delete();
            Db::table('product_attribute')-> insert($attr);
            //保存图片
            $images = $data['image_obj']??[];
            if ( !empty($images) ) {
                //只要有修改,一律删除再插入
                Db::table('product_images') -> where(['product_id' => $info -> id]) -> delete();
            }

            foreach ($images as $k => $item) {
                $is_main = 0;
                if ($k == 0) {
                    $is_main = 1;
                }
                Db::table('product_images') -> insert(['product_id' => $info -> id,'is_main' => $is_main,'image_obj' => $item,'created_at'=>$now]);
            }
           return redirect('product');
        } else {
            $attr = Db::table('product_attribute') -> where(['product_id' => $info -> id]) -> find();
        }

        if (!$attr) {
            $attr = [];
            $attr['marketing_sentence'] = '';
            $attr['promotion_sentence'] = '';
            $attr['gift_sentence'] = '';
            $attr['content'] = '';
        }
        $ProductCategory = new ProductCategory();
        $product_category = $ProductCategory->find_trees();
        return view('product_edit', [
            'info'              => $info,
            'product_category'  => $product_category,
            'attr'              => $attr
        ]);
    }


    public function product_add(Request $request)
    {

        if (request()->isPost()) {

            $data = $request -> param();
            $now = date('Y-m-d H:i:s');
            $Product = new \app\model\Product();
            $Product -> company_id = 1;
            $Product -> name = $data['name']??'';
            $Product -> category_id = $data['category_id']??'';
            $Product -> updated_at = $now;
            $Product -> created_at = $now;
            $Product -> save();

            if ($Product -> id) {
                $attr = [];
                $attr['product_id'] = $Product->id;
                $attr['marketing_sentence'] = $data['marketing_sentence']??'';
                $attr['promotion_sentence'] = $data['promotion_sentence']??'';
                $attr['gift_sentence'] = $data['gift_sentence']??'';
                $attr['content'] = $data['content']??'';
                Db::table('product_attribute') -> insert($attr);
                //保存图片
                $images = $data['image_obj']??[];
                foreach ($images as $k => $item) {
                    $is_main = 0;
                    if ($k == 0) {
                        $is_main = 1;
                    }
                    Db::table('product_images') -> insert(['product_id' => $Product -> id,'is_main' => $is_main,'image_obj' => $item,'created_at'=>$now]);
                }
                echo "<script>alert('添加成功');</script>";
                return  redirect("product_edit?id={$Product -> id}",200);
            }
        }
        $ProductCategory = new ProductCategory();
        $product_category = $ProductCategory->find_trees();

        return view('product_add',[
            'product_category'  => $product_category
        ]);
    }


    public function keyword(){
        $list = Db::table('keyword') -> limit(6) ->select();
        if (request()->isPost()) {
            $data = request() -> param();
            if(!isset($data['keyword'])){
                echo "非法参数";die;
            }
            foreach ($data['keyword'] as $key => $item) {

                Db::table('keyword') -> where(['id' => $key+1]) ->update([
                    'name' => $item
                ]);
            }
            header("refresh: 0");return '';
        }
        return view('keyword',[
            'list'  => $list
        ]);
    }

    public function success_case(){

        $SuccessCase = new \app\model\SuccessCase();
        $list = $SuccessCase -> find_pages(7);
        return view('success_case',[
            'list'  => $list
        ]);
    }

    public function success_case_add(){
        if (request() -> isPost()) {
            $SuccessCase = new \app\model\SuccessCase();
            $data = input('param.');
            if (!empty($data['name'])) {
                $SuccessCase -> name = $data['name'];
            }
            if (!empty($data['inter_link'])) {
                $SuccessCase -> inter_link = $data['inter_link'];
            }
            if (!empty($data['image_obj'])) {
                $SuccessCase -> image_obj = $data['image_obj'];
            }
            $SuccessCase -> created_at = date('Y-m-d H:i:s');
            $SuccessCase -> updated_at = date('Y-m-d H:i:s');
            $SuccessCase -> save();
            echo "<script>alert('添加成功')</script>";
            return redirect('success_case');
        }

        return view('success_case_add');
    }



    public function success_case_edit(){
        $id = input('param.id','1','intval');
        $SuccessCase = new \app\model\SuccessCase();
        $info = $SuccessCase -> find_row($id);
        if (!$info) {
            echo "<script>alert('404路径错误');history.go(-1);</script>";;
        }
        if (request() -> isPost()) {
            $data = input('param.');
            if (!empty($data['name'])) {
                $info -> name = $data['name'];
            }
            if (!empty($data['url_link'])) {
                $info -> url_link = $data['url_link'];
            }
            if (!empty($data['image_obj'])) {
                $info -> image_obj = $data['image_obj'];
            }

            $info -> updated_at = date('Y-m-d H:i:s');
            $info -> save();
            echo "<script>alert('修改成功')</script>";header("refresh: 0");return '';
        }
        return view('success_case_edit',[
            'info'          => $info,
        ]);
    }


    public function friend_link(){
        $list = Db::table('friend_link') -> limit(10) ->select();
        if (request()->isPost()) {
            $data = request() -> param();
            if(!isset($data['name'])){
                echo "非法参数1";die;
            }
            if(!isset($data['url'])){
                echo "非法参数2";die;
            }
            if (count($data['url'])<>count($data['name'])) {
                echo "非法参数3";die;
            }
            $name = $data['name'];
            $url = $data['url'];
            foreach ($name as $key => $item) {

                Db::table('friend_link') -> where(['id' => $key+1]) ->update([
                    'name' => $item,
                    'link_url'   => $url[$key]
                ]);
            }
            header("refresh: 0");return '';
        }
        return view('friend_link',[
            'list'  => $list
        ]);
    }

    public function test()
    {
        $User = new \app\model\User();
        $row = $User -> create_row('admin', '12345', '超级管理员');
        return $row;
    }



    public function clear() {
        session(null);
        redirect('/login/login');
    }

    public function go_to_login() {
        redirect('/login/login')->send();
    }




}
