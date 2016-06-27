<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class  CommonController extends Controller {
    
    public function  _initialize () {
        //print_r($_SESSION['cart']);
        $_cartNum=isset($_SESSION['cart'])?count($_SESSION['cart']):0; 
        $this->assign('cateNum',$_cartNum);
        
    }
    
}