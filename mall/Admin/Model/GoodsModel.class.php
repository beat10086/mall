<?php 
namespace  Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    protected  $_validate=array(
         //-1.为商品名称
         array('goods_name','require',-1),
         //-2.商品栏目
         array('category_id','require',-2)
          
        
    );
    //添加商品信息
    public  function addGoods ($brand,$goods_type_id,$goods_name,$style_name,$promote_word,$goods_sn,$sku,$unit,$goods_price,$is_promote,$promote_stime,$promote_etime,$promote_price,$is_hot,$is_first,$is_well,$is_on_sale,$view,$category_id,$thunb_pic,$goods_sn,$goods_type_id) {
         $data=array(
             'user_id'=>$_SESSION['admin']['user_id'],
             'brand_id'=>$brand,
             'goods_type_id'=>$goods_type_id,
             'goods_name'=>$goods_name,
             'goods_style_name'=>$style_name,
             'promote_word'=>$promote_word,
             'goods_sn'=>$goods_sn,
             'sku'=>$sku,
             'unit'=>$unit,
             'goods_price'=>$goods_price,
             'is_promote'=>$is_promote,
             'promote_stime'=>strtotime($promote_stime),
             'promote_etime'=>strtotime($promote_etime),
             'promote_price'=>$promote_price,
             'is_hot'=>$is_hot,
             'is_first'=>$is_first,
             'is_well'=>$is_well,
             'is_on_sale'=>$is_on_sale,
             'view'=>$view,
             'category_id'=>$category_id,
             'thunb_pic'=>$thunb_pic,
             'created'=>time(),
             'updated'=>time(),
             'goods_sn'=>$goods_sn,
             'goods_type_id'=>$goods_type_id
         );
         if($this->create($data)){
            return  $this->add();
         }else{
            return $this->getError();
         }
        
        
    }
}
?>