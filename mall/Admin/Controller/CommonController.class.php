<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller  {
    
    /* 判断用户是否登陆 */
    public function  _initialize () {
       if(!isset($_SESSION['admin'])){
           $this->redirect('Login/index');
       }    
    }
    /* 写入日志 */
    public  function  admin_log ($con) {
        $adminlog=D('AdminLog');
        $adminlog->add_admin_log($con);  
    }
    
    
}
?>