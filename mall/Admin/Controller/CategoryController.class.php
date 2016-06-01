<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class CategoryController extends CommonController{
    
    public  function  index () {
         $type=D('Goods_type');
         $category=D('Category');
         $this->assign('type',$type->allType());
         $this->assign('category',$category->showCategory('category_id,category_name,path'));
         $this->display();
    }
    //添加栏目
    public  function addCategory () {
        $result=array();
        $Category=D('Category');
        $category_id=$Category->addCategory(I('post.category_name'),I('post.pid'),I('post.goods_type'),I('post.price_nums'),I('post.path'),I('post.is_nav'),I('post.status'),I('post.keywords'),I('post.desc'));
        if($category_id>0){
            $result=array(
                 'status'=>true,
                 'code'  =>$category_id
            );
        }else{
            $result=array(
                'status'=>false,
                'code'  =>$category_id
            );
        }
        echo $this->ajaxReturn($result);
    }
    //验证栏目
    public  function  CheckCategory () {
          $category=D('Category');
          $category_id=$category->CheckCategory(I('post.category_name'));
          if($category_id>0){
              $valid=true;
          }else{
              $valid=false;
          }
          echo json_encode(array(
              'valid' => $valid,
          ));
    }
}