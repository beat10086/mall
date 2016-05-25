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
    
}
?>