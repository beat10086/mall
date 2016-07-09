<?php 
namespace  Home\Model;
use Think\Model;
class UserAddressModel extends Model{
    //添加地址
    public  function add_address ($consignee,$province,$city,$district,$address,$mobile,$tele,$email,$address_name) {
         $data=array(
             'consignee'=>$consignee,
             'province'=>$province,
             'city'=>$city,
             'district'=>$district,
             'address'=>$address,
             'mobile'=>$mobile,
             'telephone'=>$tele,
             'address_name'=>$address_name,
             'user_id'   =>$_SESSION['user_auth']['id']       
         );
         if($address_id=$this->add($data)){
             if($_SESSION['user_auth']['address_id']==0){
                 $_SESSION['user_auth']['address_id']=$address_id;
                 $data=array();
                 $data['address_id']=$address_id;
                 $this->table('ts_user')->where('user_id='.$_SESSION['user_auth']['id'])->save($data);
                 echo $this->getLastSql();
             }
             return  $address_id;
         }else{
              return 0; 
         }    
    }
    //获取地址
    public function userAddressAll () {
        $map['user_id']=$_SESSION['user_auth']['id'];
        return $this->where($map)->order('address_id desc')->select();
    }
}