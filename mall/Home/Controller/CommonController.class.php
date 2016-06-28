<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class  CommonController extends Controller {
    
    public function  _initialize () {
        $_cartNum=isset($_SESSION['cart'])?count($_SESSION['cart']):0; 
        $this->assign('cateNum',$_cartNum);
        $this->checkAutoLogin();
    }
    //用户的自动登陆
    public  function  checkAutoLogin  () {
        //处理自动登录，当cookie存在，且session不存在的情况下，生成session
        if (!is_null(cookie('auto')) && !session('?user_auth')) {
            $value = explode('|', encryption(cookie('auto'), 1));
            list($username, $ip) = $value;     	
            if ($ip == get_client_ip()) {
                $map['username'] = $username;
                $User = D('User');
                $userObj = $User->field('user_id,username,face')->where($map)->find();
        
                //自动登录验证后写入登录信息
                $update = array(
                    'id'=>$userObj['user_id'],
                    'last_login'=>NOW_TIME,
                    //'last_ip'=>get_client_ip(1),
                );
                $User->save($update);
        
                //将记录写入到cookie和session中去
                $auth = array(
                    'id'=>$userObj['user_id'],
                    'username'=>$userObj['username'],
                    'face'=>json_decode($userObj['face']),
                    'last_login'=>NOW_TIME,
                );
                	
                //写入到session
                session('user_auth', $auth);
            }
        }
    }
}