<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class  AuthController extends CommonController {    
    //登陆页面
    public function login () {
        if(isset($_SESSION['user_auth']['username'])){
            $this->redirect('Index/index');
            exit();
        }
         if(IS_AJAX){
             $user=D('User');
             $uid=$user->login(I('post.username'), I('post.passwd'), I('post.autologin'));
             if($uid>0){
                 if(!empty($_SESSION['cart'])){
                     $cart=$this->getCartInfo();
                     $cartmodel=D('Cart');
                     foreach ($cart as $k=>$v){
                         $where='goods_attr=\''.$k.'\' AND user_id='.$_SESSION['user_auth']['id'];
                         $cartOne=$cartmodel->where($where)->find();
                         if(empty($cartOne)){
                             $data=array(
                                   'user_id'=>$_SESSION['user_auth']['id'],
                                   'goods_id'=>$cart[$k]['goods_id'],
                                   'price'=>$cart[$k]['price'],
                                   'spec'=>$cart[$k]['spec'],
                                   'nums'=>$cart[$k]['nums'],
                                   'goods_name'=>$cart[$k]['goods_name'],
                                   'goods_thumb'=>$cart[$k]['goods_thumb'],
                                   'spec_desc'=>$cart[$k]['spec_desc'],
                                   'sel'=>1,
                                   'goods_sn'=>$cart[$k]['goods_sn'],
                                   'goods_attr'=>$k,
                             );    
                             $cartmodel->add($data);
                         }else{
                             $cartmodel->where($where)->setInc('nums',$cart[$k]['nums']);
                         }
                     }
                     $_SESSION['total_price']=0;
                     $_SESSION['total_item']=0;
                     session('cart',null);    
                 }   
                 echo $uid;
             }else{
                 echo $uid;
             }
            
             exit();
         }
         $this->assign('PREV_URL',PREV_URL());
         $this->display();
    }
    //注册页面
    public  function register (){
        if(isset($_SESSION['user_auth']['username'])){
            $this->redirect('Index/index');
            exit();
        }
        if(IS_AJAX){
             $user=D('User');
             $uid=$user->register(I('post.username'),I('post.passwd'),I('post.repasswd'),I('post.email'),I('post.code'));
             if($uid){
                 $auth = array(
                     'id'=>$uid,
                     'username'=>I('post.username')
                 );
                 //写入到session
                 session('user_auth', $auth);
             }
             echo $uid;
             exit();
         }
         $this->assign('PREV_URL',PREV_URL());
         $this->display(); 
    }
    //用户界面
    public  function account () {
          if(!isset($_SESSION['user_auth']['username'])){
            $this->redirect('Auth/login');
            exit();
          }
          $user=D('User');
          $userFindDate=$user->where('user_id='.$_SESSION['user_auth']['id'])->find();
          $this->assign('userFindDate',$userFindDate);
          $this->display();
    }
    
    //生成二位码
    public function verity () {
        $verity=new Verify();
        $verity->entry();
        $verity->fontSize = 25;    
    }   
    //退出登陆
    public function layout (){
        //清理session
        session('user_auth',null);
        //清除自动登录的cookie
        cookie('auto', null);
        //跳转到正确跳转页
        $this->redirect('Auth/login');
    }
    //验证用户的唯一性
    public function checkUserName (){
         if(IS_AJAX){
              $user=D('User');
              $uid=$user->checkfeild(I('post.username'),'username');
              if($uid>0){
                   echo 'true';
              }else{
                   echo 'false';
              }
            }else{
             $this->error("非法操作！");
         }
        
    } 
    //验证邮箱
    public  function checkEmail (){
        if(IS_AJAX){
            $user=D('User');
            $uid=$user->checkfeild(I('post.email'),'email');
            if($uid>0){
                echo 'true';
            }else{
                echo 'false';
            }
        }else{
            $this->error("非法操作！");
        }
    }
    public function saveUserInfo () {
        if(IS_AJAX){
            $user=D('User');
            $uid=$user->saveUserInfo(I('post.nickname'),I('post.realname'),I('post.gender'));
            echo $uid;
           }else{
            $this->error('非法操作！');
        }      
    }
    
}