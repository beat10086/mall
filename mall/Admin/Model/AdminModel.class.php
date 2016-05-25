<?php 
namespace  Admin\Model;
use Think\Model;
class AdminModel extends Model {
    //自动验证
    protected  $_validate=array(
        //用户名的长度5-20位
        array('username', '/^[a-zA-Z0-9]{5,20}$/i', -1, self::EXISTS_VALIDATE),
        //验证是否为空
        array('verify', 'require', -3),
        //-3,'验证码错误'
        array('verify', 'check_verify', -4, self::EXISTS_VALIDATE, 'function'),
    );
    //登陆后台
    public  function  checkAdmin ($username,$passwd,$verify=null) { 
        if($_SESSION['login_num']>3){
            $data=array(
                'username'=>$username,
                'passwd'  =>$passwd,
                'verify'  =>$verify
            );
        }else{
            $data=array(
                'username'=>$username,
                'passwd'  =>$passwd
            ); 
        }
        $map['username']=$username;
        $map['passwd']=md5($passwd);
        if($this->create($data)){
             $obj=$this->field('user_id,username,passwd')->where($map)->find();
             if($obj){
                 //数据写入session('user_id','username') 写入session
                 $admin=array(
                     'user_id'=>$obj['user_id'],
                     'username'=>$obj['username']
                 );
                 session('admin',$admin);
                 //更新数据
                 $update=array(
                     'user_id'=>$obj['user_id'],
                     'last_login'=>NOW_TIME,
                     'last_ip'   =>get_client_ip(1)
                 );
                 session('login_num',0);
                 $this->save($update);
                 $array=array(
                     "result"=>"true",
                     "code"=>$obj['user_id']
                 );
                 return $array;
             }else{
                  $_SESSION['login_num']++;
                  $array=array(
                      "result"=>"false",
                      "code"=>"-2",
                      "login_num"=>$_SESSION['login_num']
                  );
                  return $array;
             }
        }else{
            $array=array(
                "result"=>"false",
                "code"=>$this->getError()
            );
            return $array;
        }    
    }
   
}


?>