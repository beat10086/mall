<?php 
namespace  Admin\Model;
use Think\Model\RelationModel;
class OrderModel extends RelationModel{
    protected $_link = array(
        'extend'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'foreign_key'   => 'user_id',
            'class_name'    => 'user',
            'mapping_fields'=>'username',
          )
    );
    public  function getAllOrder (){
        $orderInfo=$this ->order('created desc')->select();
        $orderInfo=$this->format_order($orderInfo,'index');
        return $orderInfo;
    }
    //获取一条订单
    public  function getOneOrder ($id) {
        $map['order_id']=$id;
        $orderOneInfo=$this->where($map)->relation(true)->find();
        $orderOneInfo=$this->format_order($orderOneInfo,'info');
        return $orderOneInfo;
    }
    private  function format_order ($arr,$type) {
       if($type=='index'){ 
            if(is_array($arr)){
                foreach($arr as $k =>$v){
                    $ordersratus=C('orderStatus');
                    $shipStatus=C('shipStatus');
                    $payStatus=C('payStatus');
                    foreach($ordersratus as $k1=>$v1){
                        if($arr[$k]['order_status']==$k1){
                            $arr[$k]['order_status']=$v1;
                        } 
                    }
                    foreach($payStatus as $k3=>$v3){
                        if($arr[$k]['pay_status']==$k3){
                            $arr[$k]['pay_status']=$v3;
                        }
                    }
                    foreach($shipStatus as $k2=>$v2){
                        if($arr[$k]['ship_status']==$k2){
                            $arr[$k]['ship_status']=$v2;
                        }
                    }
                    $city=D('City');
                    $arr[$k]['province']=$city->get_area_name($v['province']);
                    $arr[$k]['city']=$city->get_area_name($v['city']);
                    $arr[$k]['district']=$city->get_area_name($v['district']);
                    $arr[$k]['created']=date('Y-m-d H:i:s',$v['created']);
                    $arr[$k]['confirm_time']=date('Y-m-d H:i:s',$v['confirm_time']);
                }
            }
       }else if($type=='info'){
           $ordersratus=C('orderStatus');
           $shipStatus=C('shipStatus');
           $payStatus=C('payStatus');
           foreach($ordersratus as $k1=>$v1){
               if($arr['order_status']==$k1){
                   $arr['order_status']=$v1;
               }
           }
           foreach($payStatus as $k3=>$v3){
               if($arr['pay_status']==$k3){
                   $arr['pay_status']=$v3;
               }
           }
           foreach($shipStatus as $k2=>$v2){
               if($arr['ship_status']==$k2){
                   $arr['ship_status']=$v2;
               }
           }
           $city=D('City');
           $arr['province']=$city->get_area_name($arr['province']);
           $arr['city']=$city->get_area_name($arr['city']);
           $arr['district']=$city->get_area_name($arr['district']);
           $arr['created']=date('Y-m-d H:i:s',$arr['created']);
           $arr['confirm_time']=date('Y-m-d H:i:s',$arr['confirm_time']);
           
       }
       return $arr;
    }
}
