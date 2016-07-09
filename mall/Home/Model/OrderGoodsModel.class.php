<?php 
namespace  Home\Model;
use Think\Model;
class OrderGoodsModel extends Model {
    
    public  function addOrderGoods ($cartdata,$order_id){
        if(is_array($cartdata)){
            foreach ($cartdata as $value) {
                 $data= array(
                    'goods_id' => $value['goods_id'],
                    'price' => $value['price'],
                    'attr_list' => $value['spec']?$value['spec']:'',
                    'nums' => $value['nums'],
                    'goods_name' => $value['goods_name'],
                    'goods_sn' => $value['goods_sn'],
                    'spec_value' => $value['spec_desc']?$value['spec_desc']:'',
                    'order_id'   => $order_id
                );
                if(!$this->add($data)){
                     echo $this->getlastsql();
                     return 0;
                }
            }
        }  
    }
      
}