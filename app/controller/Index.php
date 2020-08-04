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
use think\facade\Db;

class Index extends BaseController
{

    public $setting;
    public function __construct(App $app)
    {
        parent::__construct($app);
        try {
            $setting = new \stdClass();
            // 网站基本设置
            $WebConfig = new WebConfig();
            $this -> setting = $WebConfig -> find_company_setting(1);
            if (!$this -> setting) {
                echo '<style>body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;}</style>
                <div style="padding: 24px 48px;"> <h1 style="color: #66CCCC">数据表数据丢失</h1><p> ' . date('Y-m-d H:i:s') . '<br/>
                <span style="font-size:30px;">华利达PAC</span></p><span style="font-size:25px;">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1303274598&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1303274598:53" alt="点我直接qq联系" title="点我直接qq联系"/>
                </a>
                </span>
                </div>';
                die();
            }
            $this-> setting -> contact = json_decode($this -> setting -> contact_obj);
            $this -> setting -> banner_list = json_decode($this -> setting -> banner_arr);
            $this -> setting -> image_list = json_decode($this -> setting -> image_obj);

            // 产品分类
            $ProductCategory = new ProductCategory();
            $product_category_list = $ProductCategory->find_trees();
            View::assign([
                'setting'               => $this -> setting,
                'product_category_list' => $product_category_list
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

        unlink('aa.txt');
        //友情链接    
        $FriendLink = new FriendLink();
        $friend_links = $FriendLink -> find_friend_links();

        //文章
        $News = new News();
        $news_list = $News -> find_news(6);
        //banner
        $Banner = new Banner();
        $banner_list = $Banner -> find_rows();

     

        //搜索关键词
        $keyword_list = Db::table('keyword') -> limit(6) ->select();
        //成功案例
        $SuccessCase = new \app\model\SuccessCase();
        $success_case_list = $SuccessCase->find_rows(7);


        return view('index',
            [
                'friend_links'      => $friend_links,
                'news_list'         => $news_list,
                'banner_list'       => $banner_list,
                'keyword_list'      => $keyword_list,
                'success_case_list' => $success_case_list
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
        $m = input('m', null, 'intval');
        $c_list = [];
        $ids = [];
        $Product = new Product();
        
        //类别:默认全部
        if (!$c_list) {
            //子分类
            $ProductCategory = new ProductCategory();
            if ($c) {
                $ids = $ProductCategory -> find_all_ids($c);
            }
        }
        $c_list = $ProductCategory -> find_rows(100 , $ids);

        //是否热门
        $sticky = $m;

        $keyword = input('param.keyword', null);
        if ($keyword) {
            $k = explode(' ', $keyword);
            $k1 = $k[0];
            $keyword = $k1;
        }

        //产品列表
        $p_list = $Product -> find_pages_by_ids( $ids, 9, $sticky, $keyword);

        $page = $p_list->render();
        return view('show', [
            'c_list' => $c_list,
            'p_list' => $p_list,
            'page'      => $page
        ]);
    }

    /**
     * @return \think\response\View
     * 产品内页
     */
    public function show_detail(){
        $id = input('param.id');
        if (!$id) {
            echo "参数错误";die;
        }
        $Product = new Product();
        $info = $Product -> find_row($id);
        if (!$info) {
            echo "产品丢失";die;
        }
        $c = $info -> category_id;
        $c_list = [];
        $ids = [];
        $ProductCategory = new ProductCategory();
        $ids = $ProductCategory -> find_all_ids($c);
        dump($ids);die;
        $c_list = $ProductCategory -> find_rows(100 , $ids);
        $this-> setting -> keyword .= $info -> name;
        return view('show-detail', [
            'info' => $info,
            'c_list' => $c_list
            ]);
    }
    /**
     * @return \think\response\View
     * 资讯中心
     */
    public function news(){
        $category_id = input('category_id');
        $News = new News();
        $p_list = $News -> find_pages(6, $category_id);
        $page = $p_list->render();
        return view('news', [
            'p_list' => $p_list,
            'page'      => $page
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

        $this-> setting -> keyword .= $info -> title;
        $this-> setting -> description .= $info -> sub_title;
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
