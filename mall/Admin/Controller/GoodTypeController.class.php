<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
use Think\Page;
class GoodTypeController extends CommonController{
    //显示商品类型模板
    public function index () {
             $goods_type=D('Goods_type');
             $count=$goods_type->count();
             $Page=new Page($count, C(PAGE_SIZE));
             $show       = $Page->show();// 分页显示输出
             $page=I('get.p');
             if(ceil($count/C(PAGE_SIZE)) < $page){
                 $page=ceil($count/C(PAGE_SIZE));
             }
             $page=!empty($page)?$page:1;
             $this->assign('type',$goods_type->allType($page,C(PAGE_SIZE)));
             $this->assign('page',$show);// 赋值分页输出
             $this->display();
    }
    //添加商品类型
    public function  add () {
       if(IS_AJAX){
           $goods_type=D('Goods_type');
           $uid=$goods_type->addType(I('post.type_name'));
           echo $uid;
       }else{
            $this->error('非法操作');
       }
      
    }
    //验证类型的唯一行
    public  function checkType (){
        if(IS_AJAX){
            $goods_type=D('Goods_type');
            $uid=$goods_type->checkType(I('post.type_name'));
            if($uid>0){
                $valid=true;
            }else{
                $valid=false;
            }
            echo json_encode(array(
                'valid' => $valid,
            ));
        }
    }
    //删除类型
    public function delType () {
         if(IS_AJAX){
             $goods_type=D('Goods_type');
             $typeId=$goods_type->delType(I('post.data_id'));
             echo $typeId?$typeId:0;
         }else{
              $this->error('非法操作！');
         }
    }
   
}
?>