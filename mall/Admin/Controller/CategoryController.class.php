<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class CategoryController extends CommonController{
    
    public  function  index () {
         $type=D('Goods_type');
         $category=D('Category');
         $pid=isset($_GET['cid'])?$_GET['cid']:'';
         if($pid != "" ){
             $sonId=$category->sonCategoryId($pid);
             $where=implode(',',$sonId)?'where category_id in ('.implode(',',$sonId).')': 'where pid="'.$pid.'"';
             $this->assign('category',$category->showCategory($where));
         }else{
             $this->assign('category',$category->showCategory());
         }
         $this->assign('type',$type->allType());
         $this->assign('categoryOne',$category->showCategory());
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
            parent::admin_log('添加栏目:'.I('post.category_name').'成功');
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
    //删除栏目
    public  function DeleCategory () {
        //判断是否有子栏目,判断这个栏目下是否有商品
        if(IS_AJAX){
            $category=D('Category');
            $sonId=$category->sonCategoryId(I('post.data_id'));
            if(empty($sonId)){
                $cate_id=$category->DeleCategory(I('post.data_id'));
                if($cate_id>0){
                    $result=array(
                        'result'=>true,
                    );
                 parent::admin_log('删除栏目成功！');
                }else{
                    $result=array(
                        'result'=>false,
                        'code'=>-2
                    );
                 parent::admin_log('删除栏目失败！');
                }
                echo $this->ajaxReturn($result);
            }else{
                $result=array(
                    'result'=>false,
                    'code'  =>-1
                );
                echo $this->ajaxReturn($result);
            }
        }else{
             $this->error('非法操作');
        }   
    }
    //获取属性
    public  function filter () {
         if(IS_AJAX){
             $cid=isset($_GET['cid'])?$_GET['cid']:0;
             $category=D('Category');
             $cate=$category->getCategoryOne($cid);
             $cate_has_filter=array_filter(explode(',',$cate['fiter_attr']));
             $type_attr=$category->query("select goods_attr_id,attr_name from ts_goods_attr where goods_type_id=".$cate['goods_type_id']);
             $this->assign('cid',$cid);
             $this->assign('type_attr',$type_attr);
             $this->assign('cate_filter',$cate_has_filter);
             $this->display(); 
         }else{
              $this->error('非法操作！');
         }
               
    }
    public  function  addFilter () {
        if(IS_AJAX){
            $category=D('Category');
            $filter_attr=implode(',',I('post.filter_attr'));
            echo $cate_id=$category->addFilter(I('post.cid'),$filter_attr);
        }else{
            $this->error('非法操作！');
        }
        
        
    }
    
}