<?php 
namespace  Home\Model;
use Think\Model;
class OrderModel extends Model {
    public  function addOrder ($data) {
        $or_id= $this->add($data);
        return $or_id;
    }
    
}