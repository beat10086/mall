<?php 
namespace  Admin\Model;
use Think\Model;
class GoodsTypeModel extends Model  {
    protected  $_validate=array(
         //类型名称不能为空-2
         array('type_name','require',-2),
         //类型名称唯一性 -3
         array('type_name','',-3,2,'unique',1)
    );
    
    //添加类型
    public  function  addType ($typename) {
         $data=array(
             'type_name'=>$typename
         );
         if($this->create($data)){
             return  $this->add();
         }else{
             return $this->getError();
         } 
    }
    //验证类型
    public  function checkType ($typename) {
        $data=array(
            'type_name'=>$typename
        );
       return $this->create($data)?1:$this->getError();
    }
    //获取所有类型
    public  function  allType ($page,$rows) {
        return  $this->field('goods_type_id,type_name')->limit($rows*($page-1),$rows)->select();
    }
    //删除类型
    public  function delType ($uid) {
         $map['goods_type_id']=$uid;
         return $this->where($map)->delete();
    }  
}
?>