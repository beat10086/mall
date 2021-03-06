<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class  AuthController extends CommonController {    
    //登陆页面
    public function login () {
        if(isset($_SESSION['user_auth']['username'])){
            $this->redirect('Index/index');
            exit();
        }
         if(IS_AJAX){
             $user=D('User');
             $uid=$user->login(I('post.username'), I('post.passwd'), I('post.autologin'));
             if($uid>0){
                 if(!empty($_SESSION['cart'])){
                     $cart=$this->getCartInfo();
                     $cartmodel=D('Cart');
                     foreach ($cart as $k=>$v){
                         $where='goods_attr=\''.$k.'\' AND user_id='.$_SESSION['user_auth']['id'];
                         $cartOne=$cartmodel->where($where)->find();
                         if(empty($cartOne)){
                             $data=array(
                                   'user_id'=>$_SESSION['user_auth']['id'],
                                   'goods_id'=>$cart[$k]['goods_id'],
                                   'price'=>$cart[$k]['price'],
                                   'spec'=>$cart[$k]['spec'],
                                   'nums'=>$cart[$k]['nums'],
                                   'goods_name'=>$cart[$k]['goods_name'],
                                   'goods_thumb'=>$cart[$k]['goods_thumb'],
                                   'spec_desc'=>$cart[$k]['spec_desc'],
                                   'sel'=>1,
                                   'goods_sn'=>$cart[$k]['goods_sn'],
                                   'goods_attr'=>$k,
                             );    
                             $cartmodel->add($data);
                         }else{
                             $cartmodel->where($where)->setInc('nums',$cart[$k]['nums']);
                         }
                     }
                     $_SESSION['total_price']=0;
                     $_SESSION['total_item']=0;
                     session('cart',null);    
                 }   
                 echo $uid;
             }else{
                 echo $uid;
             }
            
             exit();
         }
         $this->assign('PREV_URL',PREV_URL());
         $this->display();
    }
    //注册页面
    public  function register (){
        if(isset($_SESSION['user_auth']['username'])){
            $this->redirect('Index/index');
            exit();
        }
        if(IS_AJAX){
             $user=D('User');
             $uid=$user->register(I('post.username'),I('post.passwd'),I('post.repasswd'),I('post.email'),I('post.code'));
             if($uid){
                 $auth = array(
                     'id'=>$uid,
                     'username'=>I('post.username')
                 );
                 //写入到session
                 session('user_auth', $auth);
             }
             echo $uid;
             exit();
         }
         $this->assign('PREV_URL',PREV_URL());
         $this->display(); 
    }
    //用户界面
    public  function account () {
          if(!isset($_SESSION['user_auth']['username'])){
            $this->redirect('Auth/login');
            exit();
          }
          $user=D('User');
          $userFindDate=$user->where('user_id='.$_SESSION['user_auth']['id'])->find();
          $this->assign('userFindDate',$userFindDate);
          $this->display();
    }
    
    //生成二位码
    public function verity () {
        $verity=new Verify();
        $verity->entry();
        $verity->fontSize = 25;    
    }   
    //退出登陆
    public function layout (){
        //清理session
        session('user_auth',null);
        //清除自动登录的cookie
        cookie('auto', null);
        //跳转到正确跳转页
        $this->redirect('Auth/login');
    }
    //验证用户的唯一性
    public function checkUserName (){
         if(IS_AJAX){
              $user=D('User');
              $uid=$user->checkfeild(I('post.username'),'username');
              if($uid>0){
                   echo 'true';
              }else{
                   echo 'false';
              }
            }else{
             $this->error("非法操作！");
         }
        
    } 
    //验证邮箱
    public  function checkEmail (){
        if(IS_AJAX){
            $user=D('User');
            $uid=$user->checkfeild(I('post.email'),'email');
            if($uid>0){
                echo 'true';
            }else{
                echo 'false';
            }
        }else{
            $this->error("非法操作！");
        }
    }
    public function saveUserInfo () {
        if(IS_AJAX){
            $user=D('User');
            $uid=$user->saveUserInfo(I('post.nickname'),I('post.realname'),I('post.gender'));
            echo $uid;
           }else{
            $this->error('非法操作！');
        }      
    }
    //显示订单
    public function orders () {
        $s=$_GET['s'];
        if($s>0 && $s<4){
            $order=D('order');
            //获取订单
            if($s==1){
                $orderAll=$order->where('user_id='.$_SESSION['user_auth']['id'].' AND pay_status=0')->order('created desc')->select();
            }else if($s==2){
                $orderAll=$order->where('( user_id='.$_SESSION['user_auth']['id'].' AND pay_status=1) AND (ship_status=0 OR ship_status=1 OR ship_status=2)')->order('created desc')->select();
            }
            //根据订单获取商品
            if(!empty($orderAll)){
                foreach ($orderAll as $k=>$v){
                    $orderAll[$k]['created']=date('Y-m-d H:i:s',$v['created']);
                    $orderAll[$k]['order_goods']=$order->query('SELECT OG.goods_name,OG.goods_id,OG.nums,G.thunb_pic FROM ts_order_goods AS OG LEFT JOIN ts_goods AS G ON OG.goods_id=G.goods_id WHERE order_id=' . $v['order_id']);
                    $orderAll[$k]['order_num']=count($orderAll[$k]['order_goods']);
                    foreach($orderAll[$k]['order_goods'] as $k1=>$v2){
                        $orderAll[$k]['order_goods'][$k1]['thunb_pic']=json_decode(htmlspecialchars_decode($v2['thunb_pic']),true);
                    }
                }
            }
            $curr=$s;
        }else{
            $order=D('order');
            //获取订单
            $orderAll=$order->where('user_id='.$_SESSION['user_auth']['id'])->order('created desc')->select();
            //根据订单获取商品
            if(!empty($orderAll)){
                foreach ($orderAll as $k=>$v){
                    $orderAll[$k]['created']=date('Y-m-d H:i:s',$v['created']);
                    $orderAll[$k]['order_goods']=$order->query('SELECT OG.goods_name,OG.goods_id,OG.nums,G.thunb_pic FROM ts_order_goods AS OG LEFT JOIN ts_goods AS G ON OG.goods_id=G.goods_id WHERE order_id=' . $v['order_id']);
                    $orderAll[$k]['order_num']=count($orderAll[$k]['order_goods']);
                    foreach($orderAll[$k]['order_goods'] as $k1=>$v2){
                        $orderAll[$k]['order_goods'][$k1]['thunb_pic']=json_decode(htmlspecialchars_decode($v2['thunb_pic']),true);
                    }
                }
            }
            $curr="";
        }
        //print_r($orderAll);
        $this->assign('curr',$curr);
        $this->assign('orderAll',$orderAll);
        $this->display();
    }
}