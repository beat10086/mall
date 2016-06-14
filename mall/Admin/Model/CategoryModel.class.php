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
    public  function  showCategory ($where) {
       if($where != ''){
           return  $this->query("select category_id,category_name,pid,is_nav,status,CONCAT(path,'-',category_id) as depath,path,goods_type_id from ts_category ".$where." order by depath ASC");
       }else{
           return   $this->query("select category_id,category_name,pid,is_nav,status,CONCAT(path,'-',category_id) as depath,path,goods_type_id from ts_category order by depath ASC");
       }
       
     }
    //栏目的ID
    public  function  sonCategoryId ($pid) {
        static  $sonId=array();
        $cate=$this->field('category_id')->where('pid='.$pid)->find();
        if($cate){
            if(is_array($cate)){
                    $sonId[]=$cate['category_id'];
                    $this->sonCategoryId($cate['category_id']);
                }
        }    
        return $sonId;
    }
    //删除栏目
    public  function  DeleCategory ($category_id) {
         $map['category_id']=$category_id;
         return  $this->where($map)->delete();
    }
    //获取某一条栏目
    public  function getCategoryOne ($cid) {
        $map['category_id']=$cid;
        return $this->where($map)->find(); 
    }
    public function addFilter ($cid,$filter_attr) {
         $data=array(
             'fiter_attr'=>$filter_attr
         );
         $map['category_id']=$cid; 
         return $this->where($map)->save($data);
        
    }
    
    
}