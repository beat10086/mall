<?php 
namespace  Admin\Model;
use Think\Model;
class UserModel extends Model{
    
    //获取用户
    public  function getList ($username,$created_start=null,$created_end=null,$page=null,$rows=null){
        if ($username) {
            $map['username'] = array('like', '%'.$username.'%');
        }
        if ($created_start && $created_end) {
            $map['created'] = array(array('egt', strtotime($created_start)), array('elt', strtotime($created_end)));     
        }
        if(!empty($page)){
            $userall=$this->where($map)->limit($rows*($page-1),$rows)->order('last_login desc,created desc')->select();
        }else{
            $userall=$this->where($map)->order('last_login desc,created desc')->select();
        }
      
        foreach($userall as $k=>$v){
            $userall[$k]['created']=date('Y-m-d H:i:s',$v['created']);
            $userall[$k]['last_login']=date('Y-m-d H:i:s',$v['last_login']);
            $userall[$k]['last_ip']= long2ip($value['last_ip']);
        }
        return $userall;
    }
    //获取有条件的数目
    public  function countNum ($username,$created_start=null,$created_end=null) {
        if ($username) {
            $map['username'] = array('like', '%'.$username.'%');
        }
        if ($created_start && $created_end) {
            $map['created'] = array(array('egt', strtotime($created_start)), array('elt', strtotime($created_end)));
        }
        return  $this->where($map)->count();
    }
    //
    public  function updateAttr ($user_id,$type,$value,$con=null){
        $map['user_id']=$user_id;
        if(!empty($con)){
           $data['ban_reason']=$con;    
        }
        $data[$type]=$value;
        return $this->where($map)->save($data);
    }
    
}