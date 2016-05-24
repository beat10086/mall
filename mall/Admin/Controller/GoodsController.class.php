<?php 
namespace  Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    //显示商品列表
    public function index  () {
         $this->display();       
    }
    //添加商品
    public function addGoods () {
         $this->display();
    }
    //商品类型
    public function  goodType (){
        $this->display();
        
    }
    
}

?>