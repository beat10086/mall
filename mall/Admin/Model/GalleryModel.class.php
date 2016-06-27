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
    public  function findAllGallery ($goods_id) {
        $map['goods_id']=$goods_id;
        return $this->where($map)->select();
    }
    //删除相册图片
    public function  delGallery ($galler_id) {
        $map['gallery_id']=$galler_id;
        return $this->where($map)->delete();    
    }
    //编辑相册图片
    public  function  editorGoodsgallery ($images,$goods_id) {
        if(is_array($images)){
            $map['goods_id']=$goods_id;
            $this->where($map)->delete();
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