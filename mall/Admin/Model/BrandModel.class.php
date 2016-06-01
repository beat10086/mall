<?php 
namespace  Admin\Model;
use Think\Model;
class BrandModel extends Model{
   protected  $_validate=array(
         array('brand_name','require',-1,),
         array('brand_name','',-2,2,'unique',1),
         array('brand_logo','require',-3)
         
     );
   //显示品牌
   public function showBrand  () {
       
       return  $this->order('sort DESC')->select();
       
   }
   //验证品牌的唯一性
    public  function check_brand  ($brand_name) {
          $data=array(
               'brand_name'=>$brand_name
          );
          if(!$this->create($data)){
               return $this->getError();
          }else{
               return 1;
          }
        
    }
    //添加品牌
    public function  addBrand($brand_name,$brand_name_en=null,$brand_logo_url=null,$website=null,$brand_status,$desc=null){
         $data=array(
              'brand_name'    =>$brand_name,
              'brand_name_en' =>$brand_name_en,
              'brand_logo'=>$brand_logo_url,
              'website'       =>$website,
              'status'  =>$brand_status,
              'desc'          =>$desc,
              'sort'          =>NextId('ts_brand')
         );
        if($this->create($data)){
            return   $this->add(); 
        }else{
            return   $this->getError();
        }  
    }
    //编辑品牌
    public  function  editBrand ($brand_id,$status,$type) {
        if($type==0){
            if($status==0){
                $status=1;
            }else if($status==1){
                $status=0;
            }
            $data=array(
                 'brand_id'=>$brand_id,
                 'status'  =>$status
            );
            return   $this->data($data)->save();
        }
    }
    //删除品牌
    public  function  delBrand ($brand_id) {
         $map['brand_id']=$brand_id;
         return  $this->where($map)->delete();
    }
}
?>