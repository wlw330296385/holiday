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

        // 网站基本设置
        $WebConfig = new WebConfig();
        $setting = $WebConfig -> find_company_setting(1) -> toArray();
        View::assign([
            'setting' => $setting,
        ]);
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
