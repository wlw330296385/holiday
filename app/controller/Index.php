<?php
namespace app\controller;

use app\BaseController;
use app\model\WebConfig;
use app\model\FriendLink;
use app\model\News;
use app\model\Banner;
use app\model\ProductCategory;
use app\model\Product;
use think\Facade\Db;
class Index extends BaseController
{
    /**
     * 首页
     * @return \think\response\View
     */
    public function index()
    {
        // 网站基本设置
        $WebConfig = new WebConfig();
        $setting = $WebConfig -> find_company_setting(1) -> toArray();
        //友情链接    
        $FriendLink = new FriendLink();
        $friend_links = $FriendLink -> find_friend_links();

        //文章
        $News = new News();
        $news_list = $News -> find_news(6);
        //banner
        $Banner = new Banner();
        $banner_list = $Banner -> find_banners();
        return view('index',
            [
                'setting'=>$setting,
                'friend_links' => $friend_links,
                'news_list' => $news_list,
                'banner_list' => $banner_list
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
        $c_list = session('product_category_list');
        if (!$c_list) {
            //分类
            $ProductCategory = new ProductCategory();
            $c_list = $ProductCategory -> find_rows();
            session('product_category_list', $c_list);
        }
        //类别:默认全部

        //产品列表
        $p_list = Db::name('product')
            -> alias('p')
            ->field('p.*, pi.image_obj')
            -> leftJoin('product_images pi','p.id = pi.product_id')
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
        return view();
    }

    /**
     * @return \think\response\View
     * 新闻内页
     */
    public function news_detail(){
        return view('news-detail');
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
