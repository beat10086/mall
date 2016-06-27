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
    //获取货号
    public function findAll ($goods_id) {
        $map['good_id']=$goods_id;
        return $this->where($map)->select();
    }
    //更新货号
    public  function updateProduct ($product_id,$filed,$value) {
         $data=array(
             $filed=>$value
         );
         $map['product_id']=$product_id;
         return $this->where($map)->save($data);
    }
    
}