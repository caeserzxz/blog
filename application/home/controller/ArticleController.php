<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\Article;
use think\Db;
use think\Request;

class ArticleController extends Controller{
    public $category = '';

    public function _initialize(){
        $model = new Article();
        //获取分类
        $category = $model->get_category();
        $this->category= $category ;
        $this->assign('category',$category);
        //用户信息
        $user_info_login = session('userinfo');
        $this->assign('user_info_login',$user_info_login);
    }

    //
    public function index(){
        $cid  = input('cid')?input('cid'):0;//分类id
        $page = input('page')?input('page'):1;//页码
        $model  = new Article();
        //商品
        $goods = $model->get_goods($cid,$page);

         //获取当前控制器名称
         $controller=request()->controller();
         //获取当前方法名
         $action=request()->action();
         $display_page = $model->page($controller,$action,$goods['pages'],$page,'',$cid);
         $this->assign('display_page',$display_page);
        
        return $this->fetch('',[
            'goods'=>$goods['data'],
            'page'=>$page,
            'cid'=>$cid
        ]);    
    }

    

    //关于
    public function about(){
        $cid = 100000;
        return $this->fetch('',[
            'cid'=>$cid
        ]);    
    }


    //详情
    public function detail(){
        $id = input('get.id');
        $model = new Article();
        //更新用户阅读量
         $model->save_reading_volume($id);
        //获取文章详情
        $data = $model->get_detail($id);
       

        return $this->fetch('',[
            'article'=>$data
        ]);
    }

    //搜索
    public function search(){
        $keyword = input('get.keyword');
        $page = input('page')?input('page'):1;//页码
      
        $model = new Article();
        //若存在关键字,则返回与关键字相关的内容,否则返回阅读量前20条的数据
        if($keyword){
            $data =  $model->search_keyword($keyword,$page);
            //获取当前控制器名称
            $controller=request()->controller();
            //获取当前方法名
            $action=request()->action();
          
            $display_page = $model->page($controller,$action,$data['pages'],$page,$keyword);
            $is_display = 1;
            $this->assign('display_page',$display_page);
        }else{
            $data =  $model->search_top();
            $is_display = 2;
        }
        
        return $this->fetch('',[
            'data'=>$data['data'],
            'page'=>$page,
            'is_display'=>$is_display,
        ]);
    }

    //写文章
    public function add_article(){
        $request = Request::instance();

        if($request->post()){
       
            $data = input('post.');
            if(empty($data['title'])){
                $this->error('标题不能为空');
                exit;
            }
            if(empty($data['content'])){
                $this->error('账户不存在');
                exit;
            }
            $model  = new Article();
            $ret = $model->save_article($data);
            if($ret['status']==1){
                $this->success('新增成功', 'Article/index');  
                exit;
            }else{
                $this->error('新增失败');  
                exit;
            }
        }else{
            return $this->fetch('',[]);
        }
       
    }
   
    //编辑文章
    public function edit_article(){
        $request = Request::instance();
        $model  = new Article();

        if($request->post()){
       
            $data = input('post.');
            
            if(empty($data['title'])){
                $this->error('标题不能为空');
                exit;
            }
            if(empty($data['content'])){
                $this->error('账户不存在');
                exit;
            }

            $ret = $model->save_article($data);

            if($ret['status']==1){
                $this->success('修改成功', 'Article/index');  
                exit;
            }else{
                $this->error('修改失败');  
                exit;
            }
        }else{
            $id = input('id');
            //获取文章详情
            $data = $model->get_detail($id);
            return $this->fetch('',[
                'article'=>$data
            ]);
        }
       
    }
}
