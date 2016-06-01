<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class BrandController extends CommonController{
    //显示品牌页面
    public  function index () {
        $brand=D('Brand');
        $this->assign('brand',$brand->showBrand());
        $this->display();
    }
    //检验品牌是否唯一
    public  function  check_brand () {
        $brand=D('Brand');
        $uid=$brand->check_brand(I('post.brand_name'));
        if($uid>0){
            $valid=true;
        }else{
            $valid=false;
        }
        echo json_encode(array(
            'valid' => $valid,
        ));
    }
    //修改品牌
    public  function editBrand (){
       if(IS_AJAX){
               $brand=D('Brand');
               echo $brand->editBrand(I('post.brand_id'),I('post.status'),I('post.type'));
            }else{
               $this->error('非法操作！');
        }   
    }
    //添加品牌
    public  function addBrand () {
        $brand=D('Brand');
        $brandId=$brand->addBrand(I('post.brand_name'),I('post.brand_name_en'),I('post.brand_logo_url'),I('post.website'),I('post.brand_status'),I('post.desc'));   
        if($brandId>0){
            $resule=array(
                 'result'=>true
            );
        }else{
            $resule=array(
                'result'=>false,
                'code'  =>$brandId
            );
        }
        echo $this->ajaxReturn($resule);
    }
    //删除品牌
    public  function  delBrand () {
        $brand=D('Brand');
        echo   $brand->delBrand(I('post.brand_id'));
    }
}


?>