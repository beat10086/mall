<?php 
namespace  Admin\Model;
use Think\Model;
class CityModel extends Model{
    
    public  function getTopCityData ($id){
        return $this->field('id,area_name')->where('parent_id='.$id)->select();
    }
    public  function  get_area_name ($id) {
         $area_name=$this->field('area_name')->where('id='.$id)->find(); 
         return $area_name['area_name'];
    }
    
}