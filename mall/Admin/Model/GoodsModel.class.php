<?php 
namespace  Admin\Model;
use Think\Model\RelationModel;
class GoodsModel extends RelationModel{
    protected  $_validate=array(
         //-1.为商品名称
         array('goods_name','require',-1),
         //-2.商品栏目
         array('category_id','require',-2)
          
        
    );
    public function findAllGoods($where) {
       $findAllGoods=$this->field('goods_id,goods_name,goods_price,goods_sn,is_on_sale,is_hot,is_well,is_first,sku')
                      ->where($where)
                      ->order('created DESC')
                      ->select();   
        return $findAllGoods;
    }
    protected $_link = array(
        'gallery' =>array(
             'mapping_type'=>self::HAS_MANY,
             'foreign_key' =>'goods_id'           
          ),
        'goods_attr_list'=>array(
             'mapping_type'=>self::HAS_MANY,
             'foreign_key' =>'goods_id'     
         ),
        'product' => array(
            'mapping_type' => self::HAS_MANY,
            'foreign_key' => 'goods_id'
        ),
        'goods_info' => array(
            'mapping_type' => self::HAS_ONE,
            'foreign_key' => 'goods_id'
        ),  
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
    //删除商品
    public  function delGoods ($goods_id) {
        $del=$this->relation(true)->delete($goods_id);
        return $del;
    }
    //修改产品
    public  function  editor ($goods_id,$brand,$goods_type_id,$goods_name,$style_name,$promote_word,$goods_sn,$sku,$unit,$goods_price,$is_promote,$promote_stime,$promote_etime,$promote_price,$is_hot,$is_first,$is_well,$is_on_sale,$view,$category_id,$thunb_pic,$goods_sn,$goods_type_id) {
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
            $map['goods_id']=$goods_id;
            $uid= $this->where($map)->save();
            return $uid;
        }else{
            return $this->getError();
        }
        
    }
    
    
    //修改商品推广信息，如热卖、人气、首发、上下架
     public   function  modifyPromote ($type,$value,$goods_id){
         $goods_array = explode(",", $goods_id);
         foreach ($goods_array as $v){
             $map['goods_id']=$v;
             $data=array(
                 $type=>$value
             );
             $ids=$this->where($map)->save($data);  
             if($ids <0){
                  return 0;
             }
        }
         return 1;
        
     }
     //查找一条数据
     public function findOne ($id) {
         $map['goods_id']=$id;
         return $this->where($map)->find();
     }
     
}
?>