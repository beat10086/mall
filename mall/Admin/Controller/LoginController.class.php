<?php
namespace  Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
   //显示登陆后台
   public  function  index () { 
       if(isset($_SESSION['admin'])){
           $this->redirect('Index/index');
       }
       session('login_num',0);
       $this->display();        
    }
    //登陆
    public function login () {
        if(IS_AJAX){
            $admin=D('Admin');
            $user_id=$admin->checkAdmin(I('post.username'),I('post.passwd'),I('post.verify'));
            echo $this->ajaxReturn($user_id);
        }else{
             $this->error('非法操作');
        }   
    }
    //生成二位码
    public function verity () {
         $verity=new Verify();
         $verity->entry();
         $verity->fontSize = 25;
         
    }
    
    //退出后台
    public function layout  () {
        session('admin',null);
        $this->redirect('Login/index');
    }
}

?>