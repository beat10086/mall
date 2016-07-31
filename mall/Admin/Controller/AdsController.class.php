<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class AdsController extends CommonController{ 
    public $ads_type = array(
        1 => '文字',
        2 => '图片'
    );
    //显示广告列表 
    public  function index () {
        $adsPosition=D('AdsPosition');
        $adsPositionData=$adsPosition->select();
        foreach($adsPositionData as $k=>$v){
            $adsPositionData[$k]['type']=$this->ads_type[$adsPositionData[$k]['type']];
        }
        $cate_str='select category_id,category_name,pid,is_nav,status,CONCAT(path,'-',category_id) as depath,path,goods_type_id from ts_category order by depath ASC';
        $cateModel=D('Category');
        //$category=$adsPosition->query($cate_str);
        $category=$cateModel->showCategory();
        $this->assign('adsposition',$adsPositionData);
        $this->assign('category',$category);
        $this->assign('add_type',$this->ads_type);
        $this->display();      
    }
    //广告位
    public function action () {
        
    }
    //添加广告位
    public function addAdvert (){
        if($_POST){
             $adsPosition=D('AdsPosition');
             $data=array(
                 'title'=>I('post.ads_title'),
                 'pname'=>I('post.ads_call'),
                 'type' =>I('post.type'),
                 'is_sys'=>1
             );
             $position_id=$adsPosition->add($data);
             if($position_id){
                 $this->success('添加广告位成功！');
             }
          }else{
              $this->error('非法操作！');
        }
    }
    
}
