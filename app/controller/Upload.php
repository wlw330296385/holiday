<?php
namespace app\controller;
use app\BaseController;
use think\App;
class Upload extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);

        try {
            //验证登陆
            $user = session('user');
            if (!$user) {
                echo json(['code' => 403, 'msg' => "登陆过期, 请重新登录"]);die;
            }
        } catch (\Exception $e) {
            return json($e->getMessage());
        }
    }

    /**
     * layui 文件上传接口
     */
    public function img()
    {
        try {

            //图片上传保存映射:固定图片名是为了节省硬盘空间
            $rule = [
                'header' => ['header','header.jpg','single'],
                'header_wap' => ['header/wap','header.jpg','single'],
                'banner' => ['banner','banner.jpg','multiple'],
                'banner_wap' => ['banner/wap','banner_wap.jpg','multiple'],
                'logo' => ['logo','logo.jpg','single'],
                'logo_wap' => ['logo/wap','logo.jpg','single'],
                'qrcode' => ['qrcode','qrcode.jpg','single'],
                'news' => ['news',null,'single'],
                'product' => ['product',null,'single'],
                'success_case' => ['success_case',null,'single'],
                'other' => ['other',null,'single'],
            ];
            $c = input('param.c');//图片类型
            if (!array_key_exists($c, $rule)) {
                return json(['code' => 406, 'msg' => "不存在此类型图片"]);
            }
            $key = input('param.key',0);//多张图片的时候用的key,第几张图片,0开始;
            if (!is_numeric($key)) {
                return json(['code' => 406, 'msg' => "key不合法"]);
            }
            $dirs = ['images', 'temp'];
            $dir = input('param.dir');
            if (!in_array($dir,$dirs)) {
                return json(['code' => 406, 'msg' => "不存在此目录"]);
            }
            // file('文件域的字段名')
            $file = request()->file('file');


//            $check = validate(['image'=>['filesize'=>10485760]])->check($file);
            // 上传到本地服务器 返回文件存储位置
            // disk('磁盘配置名称') 该配置 在 config/filesystem.php中的 disks 中查看
            // disk('public') 代表使用的是 disks 中的 public 键名对应的磁盘配置
            // putFile('目录名', $file);
            // $savename 执行上传 返回文件存储位
            // 当前文件存储位置：public/storage/topic/当前时间/文件名
            $path = $rule[$c][0];
            if ($rule[$c][2] == 'multiple') {
                $path .= '/'.$key;
            }
            if (!$rule[$c][1]) {
                $name = input('param.name',date('Ymdhis').'.jpg');
            } else {
                $name = $rule[$c][1];
            }
            $savename = \think\facade\Filesystem::disk($dir)->putFileAs($path, $file, $name);

            // 将上传后的文件位置返回给前端
            return json(['code' => 0, 'path' => '/storage/'.$dir.'/'.$savename, 'msg'=>'success', 'name' => $name]);
        } catch (\Exception $e) {
            return json($e->getMessage());
        }

    }


    public function uploadimage(){
        $data = new \stdClass;
        $data -> imageUrl = 'http://localhost/storage/images/logo/logo.jpg';
        $data -> imagePath = '/storage/images/logo/logo.jpg';
        $data -> imageFieldName = '/logo.jpg';
        $data -> imageMaxSize = '2048';
        $data -> imageAllowFiles =  [".png", ".jpg", ".jpeg", ".gif", ".bmp"];
        return json($data);

    }

    public function ueditor_img(){
        $file = null;
        if (request()->isPost()) {
            if (empty($_FILES)) {
                return false;
            }
            foreach ($_FILES as $k => $i) {
                $upload_name = $k;//实在搞不明白为什么上传的name名叫/logo_jpg
                break;
            }
            $file = request() -> file($upload_name);
        }

        $data = new \stdClass();
        $data -> state = "SUCCESS";
        $data -> url = $_SERVER['HTTP_HOST'].'/storage/images/logo/logo.jpg'; //返回的图片路径
        $data -> title = "title of image";//图片title
        $data -> original = "alt of image"; //图片alt
        $data -> imageUrl = $_SERVER['HTTP_HOST'].'/storage/images/logo/logo.jpg';//没用的路径, 文档要求, 保留
        $data -> imagePath = '/storage/images/logo/logo.jpg';
        $data -> imageFieldName = '/logo.jpg';
        $data -> imageMaxSize = '2048';
        $data -> imageAllowFiles =  [".png", ".jpg", ".jpeg", ".gif", ".bmp"];
        if ($file) {
            $dir = input('param.dir')??'temp';
            $path = input('param.path')??'other';
            $name =  input('param.name')??date('Ymdhis').'.jpg';
            $savename = \think\facade\Filesystem::disk($dir)->putFileAs($path, $file, $name);

            $url = '/storage/'.$dir.'/'.$savename;
            $data -> state = "SUCCESS";
            $data -> url = $url; //返回的图片路径
            $data -> title = "title of image";//图片title
            $data -> original = "alt of image"; //图片alt
            $data -> imageUrl = $url;//没用的路径, 文档要求, 保留
            $data -> imagePath = '/storage/'.$dir.'/'.$savename;
            $data -> imageFieldName = $name;
            $data -> imageMaxSize = '2048';
            $data -> imageAllowFiles =  [".png", ".jpg", ".jpeg", ".gif", ".bmp"];
        }
        return json($data);
    }

}
