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
    //显示商品类型参数和规格
    public function typeAttr () {
         if(isset($_GET['typeid'])){
            $typeId= $_GET['typeid'];
         }else{
            $this->error('缺少必须的参数');
          }
          $type=isset($_GET['type'])?$_GET['type']:"";
          $goods_typeAttr=D('Goods_attr');
          $goods_type=D('Goods_type');
          $count=$goods_typeAttr->attrCount($type,$typeId);
          $Page=new Page($count, C(PAGE_SIZE));
          $show       = $Page->show();// 分页显示输出
          $page=I('get.p');
          if(ceil($count/C(PAGE_SIZE)) < $page){
              $page=ceil($count/C(PAGE_SIZE));
          }
          $page=!empty($page)?$page:1;
          $this->assign('typeAttr',$goods_typeAttr->showTypeAttr($type,$typeId,$page,C(PAGE_SIZE)));
          $this->assign('type',$type);
          $this->assign('good_type',$goods_type->allType());
          $this->assign('page',$show);// 赋值分页输出
          $this->display();
    }
    //添加商品类型参数和规格
    public  function addTypeAttr () {
        if(IS_AJAX){
            $goods_typeAttr=D('Goods_attr');
            $typeAttId=$goods_typeAttr->addTypeAttr(I('post.attr_name'),I('post.attr_may_value'),I('post.attr_type'),NextId('ts_goods_attr'),I('post.type'));
            if($typeAttId>0){
                $result=array(
                    'status'  =>true,
                    'typeId'  =>I('post.type'),
                    'name'    =>I('post.name'),
                    'type'    =>I('post.attr_type'),
                    'code'    =>$typeAttId
                 );
                $this->ajaxReturn($result);
            }else{
                 $result=array(
                    'status'  =>false,
                    'code'    =>$typeAttId
                 );
                $this->ajaxReturn($result);
            }    
        }else{
               $this->error('非法操作!');
        }
    }
   //编辑参数或规格
   public  function editorTypeAttr  () {
      if(IS_AJAX){
          $goods_typeAttr=D('Goods_attr');
          $editorId=$goods_typeAttr->editorTypeAttr(I('post.goods_attr_id'),I('post.sort'),I('post.type'),I('post.attr_name_editor'),I('post.attr_type_editor'),I('post.attr_may_value_editor'));
          if($editorId >0 ){
              $result=array(
                  'status'  =>true,
                  'code'    =>$editorId
              );
              $this->ajaxReturn($result);
          }else{
              $result=array(
                  'status'  =>false,
                  'code'    =>$editorId
              );
              $this->ajaxReturn($result);
          }
      
      }else{
           $this->error('非法操作!');
       }
   }
   //获取数据
   public  function getTypeAttr () {
       if(IS_AJAX){
           $goods_typeAttr=D('Goods_attr');
           $data=$goods_typeAttr->getTypeAttr(I('post.goods_attr_id'));
           if($data>0){
               $data['result']=true;
           }else{
               $data['result']=false;
           }
           $this->ajaxReturn($data);
         }else{
           $this->error('非法操作!');
       }
   }
   
}
?>