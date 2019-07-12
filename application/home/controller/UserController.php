<?php
namespace app\home\controller;
use think\Controller;
use app\home\model\Article;
use think\Db;
use think\Request;

class UserController extends Controller{
    //登录
    public function login(){
        $request = Request::instance();
        $a = encryption_password(147852);
    
        if($request->post()){
            $data = input('post.');
    
            $user_name = $data['UserName'];
            $password = $data['Password'];
            if(empty($user_name)||empty($password)){
                $this->error('请输入正确的账户与密码');
                exit;
            }

            $model  = new Article();
            $user_info = $model->get_user_info($user_name);
           
            if(empty($user_info)){
                $this->error('账户不存在');
                exit;
            }else{
                $re_password = encryption_password($password);
                
                if($re_password!=$user_info['password']){
                    $this->error('密码错误');
                }else{
                    session('userinfo', $user_info);
                    $this->redirect('home/article/index');
                }
            }
            
            
        }else{
            return $this->fetch('',[]);    
        }
       
    }
}