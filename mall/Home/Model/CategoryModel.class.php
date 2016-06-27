<?php 
namespace  Home\Model;
use Think\Model;
class CategoryModel extends Model{
    /**
     * 获取栏目的所有父级栏目ID
     */
    public  function parentId ($category_id) {
        $id = array();
        $cate = $this->field('category_id,pid')->where('category_id = ' . $category_id)->find();
        $finished = false; //是否完成
        //还有父级
        if($cate['pid']>0){
            while ($finished == false) {
                $cate = $this->field('category_id,pid')->where('category_id = ' . $cate['pid'])->find();
                if ($cate) {
                    $id[] = $cate['category_id'];
                    if ($cate['pid'] == 0) {
                        $finished = true; //没有父级栏目了
                    }
                } else {
                    $finished = true; //没有相关栏目信息
                }
            }
        }
        return $id;
    }
    
   public   function category ($category_id, $field = '*',$nums='') {
       $category_str="";
       if(is_array($category_id)){
           $category_str=implode(',',$category_id);
           $map['category_id']=array('in',$category_str);
          return   $this->where($map)->field($field)->select();  
       }
   }
    
}