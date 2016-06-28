<?php
namespace  Home\Model;
use Think\Model;
class UserModel extends Model{
    protected $_validate = array(
        //-1,'帐号长度不合法！'
        array('username', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
        //-2,'密码长度不合法！'
        array('passwd', '6,30', -2, self::EXISTS_VALIDATE,'length'),
        //-3,'密码和密码确认不一致！'
        array('repassword', 'passwd', -3, self::EXISTS_VALIDATE,'confirm'),
        //-4,邮箱格式不对
        array('email', 'email', -4, self::EXISTS_VALIDATE),
        //-5,'验证码错误'
        array('verify', 'check_verify', -5, self::EXISTS_VALIDATE, 'function'),
        array('username', '', -6, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
        //-7,'邮箱被占用！'
        array('email', '', -7, self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
        //-8,登录用户名长度不合法
        array('login_username', '2,20', -8, self::EXISTS_VALIDATE,'length'),
        //noemail,判断登录用户名是否是邮箱
        array('login_username', 'email', 'noemail', self::EXISTS_VALIDATE),
        
    );
    //用户表自动完成
    protected $_auto = array(
        array('passwd', 'md5', self::MODEL_BOTH, 'function'),
        array('created', 'time', self::MODEL_INSERT, 'function'),
    );
    //注册
    public  function register ($username,$passwd,$repasswd,$email,$code){
        $data = array(
            'username'=>$username,
            'passwd'=>$passwd,
            'repassword'=>$repasswd,
            'email'=>$email,
            'verify'=>$code,
        );
        if ($this->create($data)) {
            $uid = $this->add();
            return $uid ? $uid : 0;
        } else {
            return $this->getError();
        }
    }
    //验证用户的唯一
    public function checkfeild ($field,$type){
        switch ($type){
            case 'username':
                $data['username'] = $field;
                break;
            case 'email':
                $data['email'] = $field;
                break;
            
        }
        return $this->create($data)?1:$this->getError();
    }
    //登陆
    public  function login ($username,$passwd,$autologin){
         $data = array(
			'login_username'=>$username,
			'passwd'=>$passwd,
		 );
         if($this->create($data)){
             //这里采用邮箱登录方式
             $map['email'] = $username;
         }else{
             if ($this->getError() == 'noemail') {
                 //这里采用帐号登录方式
                   $map['username'] = $username;
                } else {
                 return $this->getError();
             }
         }
         $user = $this->field('user_id,username,passwd,face')->where($map)->find();
         //登陆成功
         if($user['passwd']==md5($passwd)){
             //登录验证后写入登录信息
             $update = array(
                 'user_id'=>$user['user_id'],
                 'last_login'=>NOW_TIME,
                 'last_ip'=>get_client_ip(1),
             );
             $this->save($update);
             //将记录写入到cookie和session中去
             $auth = array(
                 'id'=>$user['user_id'],
                 'username'=>$user['username'],
                 'face'=>json_decode($user['face']),
                 'last_login'=>NOW_TIME,
             );
             //写入到session
             session('user_auth', $auth);
             //将用户名加密写入cookie
             if ($autologin == '1') {
                 cookie('auto', encryption($user['username'].'|'.get_client_ip()), 3600 * 24 * 30);
             }
             return $user['user_id'];
            }else{
                
             return -9;		//密码不正确
        }
        
        
    }
       
}