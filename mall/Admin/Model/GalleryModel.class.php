<?php 
namespace  Admin\Model;
use Think\Model;
class GalleryModel extends Model{
    
    //添加相册
    public  function  addGoodsgallery ($images,$goods_id) {
         if(is_array($images)){
              foreach($images as $key =>$val){
                  $data=array(
                      'goods_id'=>$goods_id,
                      'gallery_pic'=>$val,
                      'pic_name'=>''
                  );  
                  if(!$this->add($data)){
                       return 0;
                  }
              }    
              return 1;
         }
        
    }
    
}