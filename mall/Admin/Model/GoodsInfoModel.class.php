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
    
}