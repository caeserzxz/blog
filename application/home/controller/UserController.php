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

     public function visit_zhouxuezhong_top(){
        $a = [30736,29935,29935,30727,30090,30243,30550,30316,30318,30329,30330,30334,30337,30337,29958,30707,30580,30581
,30250,30701,30724,30723,30158,30786,29898,29983,29892,29963,29958,29928,29899,29980,29897,29937,29941,29957,29946,29948,29983];
        $bb = array_unique($a);

        dump($bb);die;
        // file_get_contents('http://www.baidu.com');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://fuckgfw.zhouxuezhong.top");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回

        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ; // 在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回

        $data = curl_exec($ch);

        curl_close($ch);

        return $data;
    }
}