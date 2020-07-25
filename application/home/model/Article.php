<?php
namespace app\home\model;
use think\Model;
use think\Db;


class Article  extends Model{

    //获取文章
    public function get_goods($cid,$page){
        if($cid==0){
         
        }else{
            $where = array('a.cid'=>$cid);
        }
        $pagesize = 20;
        $start = ($page-1)*$pagesize;

        $where['a.is_del'] = 1;
        $data['data'] = Db::name('article')
                ->field('a.*,b.class_name,b.style,b.color')
                ->alias('a')
                ->join('classify b','a.cid = b.id')
                ->where($where)
                ->order('add_time','desc')
                ->limit($start,$pagesize)
                ->select();
        $count = Db::name('article')
        ->field('a.*,b.class_name,b.style,b.color')
        ->alias('a')
        ->join('classify b','a.cid = b.id')
        ->where($where)
        ->count();

        $pages = ceil($count/$pagesize);
        $data['pages'] = $pages;
        return $data;
    }

    //获取分类
    public function get_category(){
        $data = Db::name('classify')
            ->where(array('is_del'=>1))
            ->select();
        return $data;
    }

    //获取文章详情
    public function get_detail($id){
      
        $data = Db::name('article')
        ->where('id',$id)
        ->find();
        return $data;
    }

    //搜索内容
    public function search_keyword($keyword,$page){
        $pagesize = 20;
        $start = ($page-1)*$pagesize;
      
        $where['a.title'] = array('like',"%".$keyword."%");
        $where['a.is_del'] = 1;
       
        $data['data'] = Db::name('article')
                ->field('a.*,b.class_name,b.style,b.color')
                ->alias('a')
                ->join('classify b','a.cid = b.id')
                ->where($where)
                ->order('add_time','desc')
                ->limit($start,$pagesize)
                ->select();

        $count = Db::name('article')
        ->field('a.*,b.class_name,b.style,b.color')
        ->alias('a')
        ->join('classify b','a.cid = b.id')
        ->where($where)
        ->count();
        $pages = ceil($count/$pagesize);
        $data['pages'] = $pages;

        return $data;
    }

    //获取阅读量前20条的数据
    public function search_top($page=1){
        $pagesize = 20;
        $start = ($page-1)*$pagesize;

        $data['data'] = Db::name('article')
        ->field('a.*,b.class_name,b.style,b.color')
        ->alias('a')
        ->join('classify b','a.cid = b.id')
        ->where($where)
        ->order('reading_volume','desc')
        ->limit($start,$pagesize)
        ->select();

     
        return $data;
    }


    //分页
    public function page($controller,$action,$pages,$page,$keyword,$cid){
        $content = '';
        if(!empty($keyword)){
          // $href = "{:url('".$controller."/".$action."')}?keyword=".$keyword;
          $href = "".$action."?keyword=".$keyword;
        }
        
        if(isset($cid)){
          // $href = "{:url('".$controller."/".$action."')}?cid=".$cid;
          $href = "/".$controller."/".$action."?cid=".$cid;
        }
       
        for ($i=1; $i <($pages+1); $i++) { 
          
          if($page==$i){
            $str = "<li class='page-item active'><span class='page-link'>".$i."</span></li>";
          }else{
            $str_href = $href.'&page='.$i;
            $str = "<li class='page-item'><a class='page-link' href='".$str_href."'>".$i."</a></li>";
          }
          $content = $content.$str;
        
        }
        

       //上一页
      if($page==1){
        $upper = "<li class='page-item disabled'><span class='page-link'>&laquo;</span></li>";
      }else{
  
        $upper_page = $page-1;
        $upper_href = $href.'&page='.$upper_page;
  
        $upper = "<li class='page-item'><a class='page-link' href='".$upper_href."'>&laquo;</a></li>";
      }
      
      //下一页
      if($page==$pages){
        $lower = "<li class='page-item disabled'><span class='page-link'>&raquo;</span></li>";
      }else{
        
        $lower_page = $page+1;
        $lower_href = $href.'&page='.$lower_page;
       
        $lower = "<li class='page-item'><a class='page-link' href='".$lower_href."'>&raquo;</a></li>";
      }
      
      $display_page = $upper.$content.$lower;
      return  $display_page;
    }

    //获取用户信息
    public function get_user_info($user_name){

        $where['user_name'] = $user_name; 

        $data = Db::name('user')
        ->where($where)
        ->find();

        return $data;
    }

    //添加修改文章
    public function save_article($data){
      
      $save['title'] = $data['title'];
      $save['content'] = $data['content'];
      $save['cid'] = $data['cid'];
      $save['is_del'] = $data['is_del'];

      if($data['id']){
        $save['save_time'] = date('Y-m-d H:i:s',time());
        $where['id'] = $data['id'];
        $res = Db::name('article')->where($where)->update($save);
      }else{
        $save['add_time'] = date('Y-m-d H:i:s',time());
        $res = Db::name('article')->insert($save);
      }

      if($res){
        $return['status'] = 1;
      }else{
        $return['status'] = -1;
      }
      return $return;
    }

    //更新阅读量
    public function save_reading_volume($id){
        $data = Db::name('article')->where(array('id'=>$id))->find();
        
        $save['reading_volume'] = $data['reading_volume']+1;
        $where['id'] = $id;
        $res = Db::name('article')->where($where)->update($save);
        if($res){
          $status = 1;
        }else{
          $status = -1;
        }

        return $status;
    }
}