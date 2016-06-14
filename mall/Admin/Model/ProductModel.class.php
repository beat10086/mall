<?php 
namespace  Admin\Model;
use Think\Model;
class ProductModel extends Model{
    //添加到product表
    public  function addProduct ($product,$good_id,$attr_list_str) {
          if(is_array($product)){
              $data=array(
                  'sku'=>$product['SKU'],
                  'goods_price'=>$product['goods_price'],
                  'goods_sn'=>$product['goods_sn'],
                  'attr_list'=>$attr_list_str,
                  'good_id'  =>$good_id             
              );
              if(!$this->add($data)){
                  return 0;
              } 
          }
    }
    
}