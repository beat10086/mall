<?php 
namespace  Admin\Model;
use Think\Model;
class GoodsAttrModel extends Model  {
    //自动验证
    protected  $_validate=array(
                 array('attr_name','require',-1),
                 array('attr_may_value','require',-2)
    );
    //显示类型参数和规格
    public  function showTypeAttr ($type,$typeId,$page,$rows) {
         if($type!=""){
             $map['attr_type']=$type;
             $map['goods_type_id']=$typeId;
         }else{
             $map['goods_type_id']=$typeId;
         } 
         return  $this->where($map)->limit($rows*($page-1),$rows)->order('sort DESC')->select();
    }
    //添加参数或规格
    public  function addTypeAttr ($attr_name,$attr_may_value,$attr_type,$sort,$type) {
         $data=array(
             'attr_name'=>$attr_name,
             'attr_may_value'=>$attr_may_value,
             'attr_type'=>$attr_type,
             'sort'=>$sort,
             'goods_type_id'=>$type
         );
         if($this->create($data)){
            return  $this->add();
         }else{
            return $this->getError();             
         }

    }
    //编辑参数或规格
    public  function editorTypeAttr ($attr_id,$sort=null,$type,$attr_name_editor=null,$attr_type_editor=null,$attr_may_value_editor=null)
    {
        if($type==0){
            $data=array(
                'sort'=>$sort
            ); 
        }else{
            $data=array(
                'attr_name'=>$attr_name_editor,
                'attr_type'=>$attr_type_editor,
                'attr_may_value'=>$attr_may_value_editor
            );
        }
        $map['goods_attr_id']=$attr_id;
        if($this->create($data)){
            return   $this->where($map)->save();
        }else{
           return    $this->getError();  
        }
    }
    //计算参数或规格
    public  function attrCount ($type,$typeId) {
          if($type!=""){
              $map['goods_type_id']=$typeId;
              $map['attr_type']=$type;
          }else{
              $map['goods_type_id']=$typeId;
          }
           return  $this->where($map)->count();           
    }
    //获取第一数据
    public function   getTypeAttr ($attr_id) {
         $map['goods_attr_id']=$attr_id;
         return  $this->where($map)->find();
        
    }
}