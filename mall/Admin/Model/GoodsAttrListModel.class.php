<?php 
namespace  Admin\Model;
use Think\Model;
class GoodsAttrListModel extends Model{

    //添加相册
    public  function  addGoodsAttr ($attr,$goods_id) {
         if(is_array($attr)){
             foreach($attr as $key => $val){
                $data=array(
                     'attr_value'=> $val,
                     'goods_id'=>$goods_id,
                     'goods_attr_id'=>$key
                     
                 ); 
                if(!$this->add($data)){
                     return 0;
                }
             }
             return 1;
         }

    }
}

?>