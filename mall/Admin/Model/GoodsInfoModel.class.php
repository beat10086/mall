<?php 
namespace  Admin\Model;
use Think\Model;
class GoodsInfoModel extends Model{
    //添加到goods_info表
    public  function addGoodsInfo($keywrod,$description,$content,$good_id) {
          $data=array(
              'keywords'=>$keywrod,
              'description'=>$description,
              'content'=>$content,
              'goods_id'=>$good_id
          );
          if(!$this->add($data)){
              return 0;
          }        
    }
    public  function  findOneInfo ($goods_id) {
        $map['goods_id']=$goods_id;
        return $this->where($map)->find(); 
    }
    //编辑商品信息
    public function  editorGoodsInfo ($keywrod,$description,$content,$good_id) {
        $data=array(
            'keywords'=>$keywrod,
            'description'=>$description,
            'content'=>$content,
            'goods_id'=>$good_id
        );
        $map['goods_id']=$good_id;
        if(!$this->where($map)->save($data)){
            return 0;
        }
    }
}