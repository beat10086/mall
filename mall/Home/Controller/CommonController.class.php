<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class  CommonController extends Controller {
    
    public function  _initialize () {
        if(isset($_SESSION['cart'])){
            $_cartNum=isset($_SESSION['cart'])?count($_SESSION['cart']):0;
        }else{
            $cartmode=D('Cart');   
            $_cartNum=$cartmode->where('user_id='.$_SESSION['user_auth']['id'])->count();
        }
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
                $userObj = $User->field('user_id,username,face,address_id')->where($map)->find();
        
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
                    'address_id'=>$userObj['address_id'],
                    'last_login'=>NOW_TIME,
                );
                	
                //写入到session
                session('user_auth', $auth);
            }
        }
  }
  //获取购物车信息
  public  function getCartInfo ($arr){
      $goods_id=array();
      if(!empty($_SESSION['cart'])){
          $goods_id = $this->getCartGoodsId();
      }else if(isset($arr) && is_array($arr)){ 
          $goods_id = $this->getCartGoodsId($arr);
      }
      $goods=D('Goods');
      $str_in=db_create_in($goods_id);
      $goods_res=$goods->where('goods_id in ('.$str_in.')')->select();
      if ($goods_res) {
          foreach ($goods_res as $value) {
              $goods_info[$value['goods_id']] = $value;
              $goods_info[$value['goods_id']]['thunb_pic']=json_decode(htmlspecialchars_decode($goods_info[$value['goods_id']]['thunb_pic']),true);
          }
      }
      if(isset($_SESSION['cart'])&&!empty($_SESSION['cart'])){
          foreach ($_SESSION['cart'] as $key => $value) {
              $cart_info[$key] = $value;
              $cart_info[$key]['goods_name'] = $goods_info[$value['goods_id']]['goods_name'];
              $cart_info[$key]['goods_sn'] = $goods_info[$value['goods_id']]['goods_sn'];
              $cart_info[$key]['goods_thumb'] = $goods_info[$value['goods_id']]['thunb_pic']['thumb'];
              $cart_info[$key]['spec_desc'] = '';
              if ($value['spec']) {
                  $spec_res = $goods->query('SELECT attr_name,attr_value FROM ts_goods_attr_list AS GAL LEFT JOIN ts_goods_attr AS GA ON GAL.goods_attr_id=GA.goods_attr_id WHERE GA.attr_type=1 AND GAL.attr_list_id IN(' . $value['spec'] . ') ORDER BY GA.goods_attr_id DESC');
                  $spec_desc = '';
                  foreach ($spec_res as $spec) {
                      $spec_desc.='<strong>' . $spec['attr_name'] . '</strong>：' . $spec['attr_value'] . '， ';
                  }
                  $spec_desc = mb_substr($spec_desc, 0, -2, 'utf-8');
                  $cart_info[$key]['spec_desc'] = $spec_desc;
              }
          }
      }else if(isset($arr) && is_array($arr)){
          foreach ($arr['cart'] as $key => $value) {
              $cart_info[$key] = $value;
              $cart_info[$key]['goods_name'] = $goods_info[$value['goods_id']]['goods_name'];
              $cart_info[$key]['goods_sn'] = $goods_info[$value['goods_id']]['goods_sn'];
              $cart_info[$key]['goods_thumb'] = $goods_info[$value['goods_id']]['thunb_pic']['thumb'];
              $cart_info[$key]['spec_desc'] = '';
              if ($value['spec']) {
                  $spec_res = $goods->query('SELECT attr_name,attr_value FROM ts_goods_attr_list AS GAL LEFT JOIN ts_goods_attr AS GA ON GAL.goods_attr_id=GA.goods_attr_id WHERE GA.attr_type=1 AND GAL.attr_list_id IN(' . $value['spec'] . ') ORDER BY GA.goods_attr_id DESC');
                  $spec_desc = '';
                  foreach ($spec_res as $spec) {
                      $spec_desc.='<strong>' . $spec['attr_name'] . '</strong>：' . $spec['attr_value'] . '， ';
                  }
                  $spec_desc = mb_substr($spec_desc, 0, -2, 'utf-8');
                  $cart_info[$key]['spec_desc'] = $spec_desc;
              }
          } 
      }
      
      return $cart_info;
  }
  /**
   * 获取购物车中的全部商品ID（排除重复的）
   */
  private function getCartGoodsId($arr) {
      $goods_id = array();
      if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $value) {
              $goods_id[$value['goods_id']] = $value['goods_id'];
          }
      }else if(isset($arr) && is_array($arr)){
          foreach ($arr['cart'] as $value) {
              $goods_id[$value['goods_id']] = $value['goods_id'];
          }
 
      }
      return $goods_id;
  }
}