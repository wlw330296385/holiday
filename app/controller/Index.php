<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\model\WebConfig;
use app\model\FriendLink;
use app\model\News;
use app\model\Banner;
use app\model\ProductCategory;
use app\model\Product;
use think\App;
use think\Facade\Db;
class Index extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        try {

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
            $setting -> contact = json_decode($setting -> contact_obj);
            $setting -> banner_list = json_decode($setting -> banner_arr);
            $setting -> image_list = json_decode($setting -> image_obj);

            View::assign([
                'setting' => $setting,
            ]);
        } catch (\Exception $e) {
            return json($e->getMessage());
        }
    }

    public function error_page(){
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style>
        <div style="padding: 24px 48px;"> <h1>:) 2020新春快乐</h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/>
        <span style="font-size:30px;">数据表数据丢失</span></p><span style="font-size:25px;">联系qq:1303274598</span></div>
        <script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script>
        <script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
        die();
    }

    /**
     * 首页
     * @return \think\response\View
     */
    public function index()
    {
        //友情链接    
        $FriendLink = new FriendLink();
        $friend_links = $FriendLink -> find_friend_links();

        //文章
        $News = new News();
        $news_list = $News -> find_news(6);
        //banner
        $Banner = new Banner();
        $banner_list = $Banner -> find_banners();

        //前两个产品
        //最新产品
        $product_list = Product::join('product_images pi', 'product.id = pi.product_id')
            -> field("product.*, pi.image_obj")
            -> order(['product.sticky_at' => "DESC", "product.updated_at" => 'DESC'])
            -> limit(7)
            -> select();
        return view('index',
            [
                'friend_links' => $friend_links,
                'news_list' => $news_list,
                'banner_list' => $banner_list,
                'product_list' => $product_list
            ]);
    }
    /**
     * 生产工艺
     * @return \think\response\View
     */
    public function product(){
        return view();
    }
    /**
     * 产品展示
     * @return \think\response\View
     */
    public function show(){
        $c = input('c', 0, 'intval');
        $m = input('m', 0, 'intval');
        $c_list = session('product_category_list');
        if (!$c_list) {
            //分类
            $ProductCategory = new ProductCategory();
            $c_list = $ProductCategory -> find_rows();
            session('product_category_list', $c_list);
        }
        //类别:默认全部
        if ($c) {
            $where1 = ['product.category_id' => $c];
        } else {
            $where1 = '2=2';
        }
        //是否热门
        if ($m) {
            $where2 = "sticky_at is not null";
        } else {
            $where2 = '1=1';
        }
        //产品列表
        $p_list = Db::name('product')
            -> alias('p')
            ->field('p.*, pi.image_obj')
            -> leftJoin('product_images pi','p.id = pi.product_id')
            -> where($where1)
            -> where($where2)
            -> order('p.updated_at', 'desc')
            -> paginate(9, true);
        return view('show', [
            'c_list' => $c_list,
            'p_list' => $p_list
        ]);
    }

    /**
     * 产品展示2
     * @return \think\response\View
     */
    public function show1()
    {
        $c_list = cookie('product_category_list');
        if (!$c_list) {
            //分类
            $ProductCategory = new ProductCategory();
            $c_list = $ProductCategory->find_rows();
            cookie('product_category_list', $c_list);
        }
    }
    /**
     * 产品展示2
     * @return \think\response\View
     */
    public function show2(){
        $c_list = cookie('product_category_list');
        if (!$c_list) {
            //分类
            $ProductCategory = new ProductCategory();
            $c_list = $ProductCategory -> find_rows();
            cookie('product_category_list', $c_list);
        }

        //产品列表

        return view('show', [
            'c_list' => $c_list,
            'product_list' => []
        ]);
    }

    /**
     * @return \think\response\View
     * 新闻内页
     */
    public function show_detail(){
        return view('show-detail');
    }
    /**
     * @return \think\response\View
     * 资讯中心
     */
    public function news(){
        $category_id = input('category_id_');

        //文章
        $p_list = Db::name('news')
            -> alias('n')
//            ->field('p.*, pi.image_obj')
//            -> leftJoin('product_images pi','p.id = pi.product_id')
            -> order('n.updated_at', 'desc')
            -> paginate(6, true);
        return view('news', [
            'p_list' => $p_list
        ]);
    }

    /**
     * @return \think\response\View
     * 新闻内页
     */
    public function news_detail(){
        $id = input('id/d','1','intval');
        $News = new News();
        $info = $News -> find_row($id);
        //上一篇和下一篇
        if ($id > 1) {
            $pre_id = $id - 1;
        } else {
            $pre_id = 0;
        }
        $nxt_id = $id + 1;
        $p_list = $News::where('id','in',"$pre_id, $nxt_id") -> select();

        return view('news-detail', [
            'info' => $info,
            'p_list' => $p_list
        ]);
    }
    /**
     * @return \think\response\View
     * 关于我们
     */
    public function about(){
        return view();
    }

    /**
     * @return \think\response\View
     * 常见问题
     */
    public function issue(){
        return view();
    }

    /**
     * @return \think\response\View
     * 样品领取
     */
    public function sample(){
        return view();
    }

    /**
     * @return \think\response\View
     * 联系我们
     */
    public function contact(){
        return view();
    }

}
