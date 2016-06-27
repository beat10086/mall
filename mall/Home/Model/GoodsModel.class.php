<?php 
namespace  Home\Model;
use Think\Model\RelationModel;
class GoodsModel extends RelationModel{
    protected $_link = array(
        'brand'=>array(
              'mapping_type'=> self::BELONGS_TO,
              'foreign_key' => 'brand_id',
              'mapping_name'=> 'brand_name',
              'class_name'    => 'brand',
              'mapping_fields'=>'brand_name',
         ),     
    );
    //获取商品的某条数据
    public function findOneGood ($goods_id) {
        $map['goods_id']=$goods_id;
        $goodObj=$this->relation(true)->where($map)->find();
        return $goodObj;
    }
    //获取商品的关键字
    public function goods_info  ($goods_id) {
        $map['goods_id']=$goods_id;
        return $this->table('ts_goods_info')->where($map)->find();  
    }
    public  function gallery ($goods_id) {
        $map['goods_id']=$goods_id;
        return $this->table('ts_gallery')->where($map)->select();
    }
    //获取商品的规格
    public  function specList ($goods_id) {
        $sql="select GAL.attr_list_id,GAL.goods_attr_id,GAL.goods_id,GA.attr_name,GAL.attr_value from ts_goods_attr_list as GAL JOIN ts_goods_attr as GA on GAL.goods_attr_id=GA.goods_attr_id AND goods_id in (".$goods_id.") AND GA.attr_type=1 ORDER BY GA.goods_attr_id DESC";
        $data=$this->query($sql);
        $specs = array();
        if ($data) {
            foreach ($data as $value) {
                $specs[$value['goods_attr_id']]['spec_name'] = $value['attr_name'];
                $specs[$value['goods_attr_id']]['spec_value'][$value['attr_list_id']] = $value['attr_value'];
            }
        }
        return $specs;
    }
   //获取商品的属性
   public  function attrList ($goods_id) {
       return $this->query('SELECT attr_list_id,attr_name,attr_value FROM ts_goods_attr_list AS GAL LEFT JOIN  ts_goods_attr AS GA ON GAL.goods_attr_id=GA.goods_attr_id WHERE goods_id=' . $goods_id . ' AND attr_type=0');
   }
}