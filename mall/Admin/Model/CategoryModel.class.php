<?php 
namespace  Admin\Model;
use Think\Model;
class CategoryModel extends Model {
    protected  $_validate=array(
           array('category_name','require',-1),
           array('category_name','',-2,2,'unique',1)
     );
    //验证栏目的唯一性
    public  function  CheckCategory ($category_name) {
         $data=array(
              'category_name'=>$category_name
         );
         return $this->create($data)?1:$this->getError(); 
    }
    //添加栏目
    public function  addCategory ($category_name,$pid,$goods_type_id,$price_nums,$path,$is_nav,$status,$keywords,$desc) {
         $data=array(
             'category_name'=>$category_name,
             'pid'=>$pid,
             'goods_type_id'=>$goods_type_id,
             'price_nums' =>$price_nums,
             'path' =>$path,
             'is_nav'=>$is_nav,
             'keywords'=>$keywords,
             'desc'   =>$desc,
             'sort'   =>NextId('ts_category'),
             'status' =>$status
         );
         if($this->create($data)){
              return $this->add();
         }else{
             return $this->getError();
         }
    }
    //显示栏目
    public  function  showCategory ($field) {
       return  $this->field($field)->select();
    }
    
    
}