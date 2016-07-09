<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends CommonController {  
  //显示购物车页面  
  public  function  index (){
       if(isset($_SESSION['cart'])){
           $cart_info = $this->getCartInfo();
       }else{
           $cartmodel=D('cart');
           $cart_info=array();
           $totalprice=0;
           $allselect=true;
           $cartdata =$cartmodel->field('goods_id,price,spec,nums,goods_name,goods_thumb,spec_desc,sel,goods_attr')->where('user_id='.$_SESSION['user_auth']['id'])->select();
           foreach($cartdata as $k=>$v){
                   $cart_info[$cartdata[$k]['goods_attr']]=$v;
                   if($cartdata[$k]['sel']=='1'){
                     $totalprice+=($cartdata[$k]['nums'])*($cartdata[$k]['price']);
                   }
                   if($cartdata[$k]['sel']=='0'){
                       $allselect=false;
                   }
           }
           $this->assign('totalprice',number_format_fun($totalprice));
           $this->assign('allselect',$allselect);
       }
       $this->assign('cart_info',$cart_info);
       $this->display();
  }  
  //添加到购物车
  public  function  addToCart () {
      if(IS_AJAX){
         //判断商品是正常商品，还是变形商品
         $spec_id=empty(I('post.spec_id'))?array():implode(',',I('post.spec_id'));
         $num=I('post.nums');
         $goods_id =I('post.goods_id');
         //如果没有规格则从商品表取出商品数量，价格数据。
         $goods=D('Goods');
         $goodsOne=$goods->where('goods_id='.$goods_id)->find();
         if($goodsOne['is_on_sale']==0){
              $result=array(
                   'code'=>-1,
                    'message'=>'对不起，该商品已下架！'
              );
              $this->ajaxReturn($result);
         }
         if(empty($spec_id)){
            //普通商品 
            if($goodsOne['sku'] < $num ){
                $result=array(
                    'code'=>-2,
                    'message'=>'对不起，该商品库存量不足！'
                );
                $this->ajaxReturn($result);
            }
         }else{
           //变形商品(判断变形商品是否存在)
           $product=D('Product');
           $productOne=$product->where('attr_list="'.$spec_id.'," AND good_id ='.$goods_id)->find();
           if(empty($productOne)){
               $result=array(
                   'code'=>-3,
                   'message'=>'对不起，不存在该规格组合的商品！'
               );
               $this->ajaxReturn($result);
           }
           if ($productOne['sku'] < $num) {
               $result = array(
                   "code" => -4,
                   "message" => "对不起，该商品库存量不足！"
               );
               $this->ajaxReturn($result);
           }
         }
          /**
             * 添加到购物车
             * 数据保存到SESSION中的cart索引(登陆时放入数据库,没有登陆放入cookie)
         */
         $cart_key = $spec_id . ',' . $goods_id; //保存在cookie的键值（规格连接上商品ID）
         //商品价格(如果是变形产品,获取product的价格,普通商品goods的价格)
         $price = empty($spec_id) ? $goodsOne['goods_price'] : $productOne['goods_price'];
         //促销未过期，商品的价格是我们的促销价
         if ($goodsOne['is_promote'] && $goodsOne['promote_stime'] <= time() && $goodsOne['promote_stime'] > time()) { 
             $price = $goodsOne['promote_price'];
         }
         if(empty($_SESSION['user_auth']['id'])){
             //购物车中不存在该数据，则新加入。
             if (isset($_SESSION['cart'][$cart_key])) {
                 $_SESSION['cart'][$cart_key]['nums']+=$num;
             }else{
                 $item = array(
                     'goods_id' => $goods_id, //商品ID
                     'price' => $price, //商品价格
                     'spec' => $spec_id, //商品规格
                     'nums' => $num  //商品数量
                 );
                 $_SESSION['cart'][$cart_key]=$item;
             }
             $this->cartTotalPrice();
             $this->cartTotalItem();
             $result = array(
                 "code" => 1,
                 "cart_item" => count($_SESSION['cart']),
                 "message" => "添加到购物车成功！"
             );
         }else{
             $cartModel=D('cart');
             $where='goods_attr=\''.$cart_key.'\' AND user_id='.$_SESSION['user_auth']['id'];
             $cartOne=$cartModel->where($where)->find();
             if($cartOne){
                 $cartModel->where($where)->setInc('nums', $num);
             }else{
                 $cartArray=array();
                 $item = array(
                     'goods_id' => $goods_id, //商品ID
                     'price' => $price, //商品价格
                     'spec' => $spec_id, //商品规格
                     'nums' => $num  //商品数量
                 );
                 $cartArray['cart'][$cart_key]=$item;
                 $cateInfo=$this->getCartInfo($cartArray);
                 foreach($cateInfo as $k => $v){
                     $data=array(
                         'user_id'=>$_SESSION['user_auth']['id'],
                         'goods_id'=>$cateInfo[$k]['goods_id'],
                         'price'=>$cateInfo[$k]['price'],
                         'spec'=>$cateInfo[$k]['spec'],
                         'nums'=>$cateInfo[$k]['nums'],
                         'goods_name'=>$cateInfo[$k]['goods_name'],
                         'goods_thumb'=>$cateInfo[$k]['goods_thumb'],
                         'spec_desc'=>$cateInfo[$k]['spec_desc'],
                         'sel'=>1,
                         'goods_sn'=>$cateInfo[$k]['goods_sn'],
                         'goods_attr'=>$k,
                     );
                     $cartModel->add($data);       
                 }
             }
           $cateCount=$cartModel->where('user_id='.$_SESSION['user_auth']['id'])->count();
           $result = array(
                 "code" => 1,
                 "cart_item" => $cateCount,
                 "message" => "添加到购物车成功！"
             );   
         }  
         $this->ajaxReturn($result);
      }else{
           $this->error('非法操作！');
      }
  }
  //获取购物车的数据

  public   function  getCart () {
      //获取cart的id
      $cart_info=array();
      if(IS_AJAX){
          if(isset($_SESSION['cart'])){
              $cart_info=$this->getCartInfo(); 
          }else{
              $catemodel=D('Cart');
              $cate=$catemodel->field('goods_id,user_id,spec,nums,price,goods_name,goods_thumb,spec_desc,goods_attr')->where('user_id='.$_SESSION['user_auth']['id'])->select();
              foreach ($cate as $k=>$v){
                  $cart_info[$cate[$k]['goods_attr']]=$v;
              }
          }
          $this->ajaxReturn($cart_info);
      }else{
           $this->error('非法操作！');
      }   
  }

  //删除购物车
  public  function delCartGoods () {
      if(IS_AJAX){
          $cart_id = I('get.data_id');
          //购物车存在该货品
          if(isset($_SESSION['user_auth']['id'])){
               $cartModel=D('Cart');
               $map['goods_attr']=$cart_id;
               $map['user_id']=$_SESSION['user_auth']['id'];
               $cartid=$cartModel->where($map)->delete();
               if($cartid){
                   $totalprice=0;
                   $_cartNum=$cartModel->where('user_id='.$_SESSION['user_auth']['id'])->count();
                   $cartdata =$cartModel->field('goods_id,price,spec,nums,goods_name,goods_thumb,spec_desc,sel,goods_attr')->where('user_id='.$_SESSION['user_auth']['id'])->select();
                   foreach($cartdata as $k=>$v){
                       $cart_info[$cartdata[$k]['goods_attr']]=$v;  
                       $totalprice+=($cartdata[$k]['nums'])*($cartdata[$k]['price']);
                   }
                   $result=array(
                       'status'=>'true',
                       'product_num'=>$_cartNum,
                       'product_price'=>$totalprice
                   );
               }
          }else{
              if (isset($_SESSION['cart'][$cart_id])) {
                  unset($_SESSION['cart'][$cart_id]);
              }
              $result=array(
                  'status'=>'true',
                  'product_num'=>count($_SESSION['cart']),
                  'product_price'=>$this->cartTotalPrice()
              );
              $this->cartTotalPrice();
              $this->cartTotalItem();
              
          } 
          $this->ajaxReturn($result);
         }else{
           $this->error('非法操作！');
      }
  }  
  //更新购物车
  public  function updateCartNums () {
       if(IS_AJAX){
          $cart_id=I('post.cart_id');
          $nums=I('post.nums');
          $option=I('post.option');
          //购物车中有此货品
          if(empty($_SESSION['user_auth']['id'])){
              if(isset($_SESSION['cart'][$cart_id])){
                  //判断是否有规格
                  $spec = $_SESSION['cart'][$cart_id]['spec'];
                  $goods_id = $_SESSION['cart'][$cart_id]['goods_id'];
                  $product = D('product');
                  if(!empty($spec)){
                      $sku=$product->field('sku')->where('good_id='.$goods_id.' AND attr_list=\''.$spec.',\'')->find();
                  }else{
                      $sku=$product->table('ts_goods')->field('sku')->where('goods_id='.$goods_id)->find();
                  }
                  if($nums>$sku['sku']){
                      $result=array(
                          'status'=>false,
                          'code'=>1,
                          'message'=>"库存不足!",
                          'sku'=> $sku['sku']
                      );
                      $this->ajaxReturn($result);
                  }else{
                      $_SESSION['cart'][$cart_id]['nums'] = $nums;
                      $this->cartTotalPrice();
                      $this->cartTotalItem();
                      $result=array(
                          'status'=>true,
                          'total_price'=>$_SESSION['total_price']
                      );
                      $this->ajaxReturn($result);
                  }
              }
          }else{
              $cartmodel=D('Cart');
              $cartOne=$cartmodel->field('goods_id,price,spec,nums,goods_name,goods_thumb,spec_desc,sel,goods_attr')->where('goods_attr=\''.$cart_id.'\' AND user_id='.$_SESSION['user_auth']['id'])->find();
              $spec =$cartOne['spec'];
              $goods_id=$cartOne['goods_id'];
              $product = D('product');
              if(!empty($spec)){
                  $sku=$product->field('sku')->where('good_id='.$goods_id.' AND attr_list=\''.$spec.',\'')->find();
              }else{
                  $sku=$product->table('ts_goods')->field('sku')->where('goods_id='.$goods_id)->find();
              }
              if($nums>$sku['sku']){
                  $result=array(
                      'status'=>false,
                      'code'=>1,
                      'message'=>"库存不足!",
                      'sku'=> $sku['sku']
                  );
                  $this->ajaxReturn($result); 
              }else{
                  $where='goods_attr=\''.$cart_id.'\' AND user_id='.$_SESSION['user_auth']['id'];
                  if($option=='add'){
                      $cartmodel->where($where)->setInc('nums',1);
                  }elseif($option=='min'){
                      $cartmodel->where($where)->setDec('nums',1);
                  }else{
                      $data['nums']=$nums;
                      $cartmodel->where($where)->save($data);
                  }
                  $result=array(
                      'status'=>true
                  );
                  $this->ajaxReturn($result);
              }
          }
          
       }
  }
  //修改选中
  public  function modifly () {
       if(IS_AJAX){
           $cartmodel=D('Cart');
           $cart_id=I('post.cart_id');
           $select=I('post.select');
           $cart_str="";
           if(is_array($cart_id)){
               foreach($cart_id as $k=>$v){
                   $where='user_id='.$_SESSION['user_auth']['id'].' AND goods_attr in ("'.$v.'")';
                   $data['sel']=$select;
                   $cid=$cartmodel->where($where)->save($data);
                   if(!$cart_id){
                       echo  0;
                       return false;
                   }
               }
           }else{
               $where='user_id='.$_SESSION['user_auth']['id'].' AND goods_attr in ("'.$cart_id.'")';
               $data['sel']=$select;
               $cid=$cartmodel->where($where)->save($data);
           }
           
           echo  $cid;
         }else{
            $this->error('非法操作！');
       }
  }
  //显示订单页面
  public  function orderInfo () {
      if(!isset($_SESSION['user_auth'])){
          $this->redirect('Auth/login');
      }
      PRINT_R($_SESSION);
      //购物车购买
      if($_GET['act']=='cart'){
          $cartmodel=D('Cart');
          $cartdata =$cartmodel->field('goods_id,price,spec,nums,goods_name,goods_thumb,spec_desc,sel,goods_attr,goods_sn')->where('user_id='.$_SESSION['user_auth']['id'].' AND sel=1')->select();
          //如果数据库的价格改变,不能取购物车的数据
          $orderTotal=0;
          if(!empty($cartdata)){
              foreach($cartdata as $k=>$v){
                  if(empty($cartdata[$k]['spec'])){
                      $goodsdata=$cartmodel->table('ts_goods')->where('goods_id ='.$cartdata[$k]['goods_id'])->find();
                      if($goodsdata['goods_price']!=$cartdata[$k]['price']){
                          if($goodsdata['promote_stime']<time() && $goodsdata['promote_etime'] >time() && $goodsdata['is_promote']==1){
                              $cartdata[$k]['price']=$goodsdata['promote_price'];
                          }else{
                              $cartdata[$k]['price']=$goodsdata['goods_price'];
                          }
                          
                      }
                  }else{
                      $productdata=$cartmodel->table('ts_product')->where('good_id='.$cartdata[$k]['goods_id'].' AND attr_list=\''.$cartdata[$k]['spec'].',\'')->find();
                      $cartdata[$k]['price']=$productdata['goods_price'];
                  }
                  $orderTotal+=$cartdata[$k]['price'];
              }
              /**
               * 收货人信息
               * 1.先查看SESSION中有没有address_id （默认没有）
               * 2.如果没有则从订单表查找上一次购买商品的地址信息
               * 3.如果上一次也没有。则从user_address表中取出一条数据
               *
               */
              $city=D('City');
              $topCityData=$city->getTopCityData(0);
              $useraddress=D('UserAddress');
              $address_data=$useraddress->userAddressAll();
              foreach ($address_data as $k=>$v){
                  $address_data[$k]['province']=$city->get_area_name($v['province']);
                  $address_data[$k]['city']=$city->get_area_name($v['city']);
                  $address_data[$k]['district']=$city->get_area_name($v['district']); 
                  $address_data[$k]['mobile']=format_mobile($v['mobile']);
              }
              $this->assign('address_data',$address_data);
              $this->assign('topCityData',$topCityData);
              $this->assign('orderTotal',number_format_fun($orderTotal));
              $this->assign('cartdata',$cartdata);
          }else{
              $this->redirect('Index/index');
          }
      }else{
           $this->error('非法操作！');
      }

      $this->display();
  }
  //获取地区
  public  function  getCity () {
      $id=I('get.id');
      $city=D('City');
      $CityData=$city->getTopCityData($id);
      if($CityData){
         $this->ajaxReturn($CityData);   
      }else{
          echo '';
      }
  }
  //添加地址
  public  function  add_address () {
      $addressModel=D('UserAddress');
      $address_id=$addressModel->add_address(I('post.consignee'),
                                 I('post.province'),
                                 I('post.city'),
                                 I('post.district'),
                                 I('post.address'),
                                 I('post.mobile'),
                                 I('post.tele'),
                                 I('post.email'),
                                 I('post.address_name')
          );
      echo $address_id?$address_id:0;
  }
  //添加购物车
  public  function addOrder (){
       $pay_id=I('post.pay_id');
       $shipping_id=I('post.shipping_id');
       $total_price=I('post.total_price');
       $pay_allowed = array(1, 2, 3); //允许的支付方式
       $ship_allowed = array(1, 2, 3); //允许的快递公司
       if(!in_array($pay_id, $pay_allowed)){
           $this->error('不允许的支付方式！');
       }
       if (!in_array($shipping_id, $ship_allowed)) {
           $this->error('不允许的货运方式！');
       }
       //生成订单号
       $order_sn = $this->generateOrderNO();
       $time = $_SERVER['REQUEST_TIME'];
       /**
        * 订单状态
        * 1 未确认
        * 2 已确认
        * 3 已取消
        * 4 已完成
        */
       $confirm_time = $time;
       $order_status = 2; //已确认
       if (C('ORDER_CONFIRM')) {
           $confirm_time = 0;
           $order_status = 1;
       }
       /**
        * 物流状态
        1 => '未发货',
        2 => '配货中',
        3 => '已发货',
        4 => '已签收'
        */
       $UserAddress = D('UserAddress');
       $address=$UserAddress->field('consignee,province,city,district,address,zipcode,telephone,mobile')
                            ->where('address_id='.$_SESSION['user_auth']['address_id'])
                            ->find();
       //判断地址是否存在
       if (!$address) {
                $this->error('错误的收货地址');
       }
       $data = array(
           'order_sn' => $order_sn,
           'created' => $time,
           'confirm_time' => $confirm_time,
           'pay_time' => 0,
           'order_status' => $order_status,
           'pay_status' => 0,
           'ship_status' => 1,
           'ship_id' => 1,
           'pay_id' => 1,
           'ship_name' => '韵达快递',
           'pay_name' => '支付宝',
           'total_price' =>$total_price,
           'user_id' => $_SESSION['user_auth']['id'],
           'ship_price' => 0,
           'ship_time'   =>0,
           'order_goods' => array(),
           
       );
       $data = array_merge($data, $address);
       $order=D('Order');
       $order_id=$order->addOrder($data);
       if($order_id>0){
               $cartmodel=D('Cart');
               $cartdata =$cartmodel->field('goods_id,price,spec,nums,goods_name,goods_thumb,spec_desc,sel,goods_attr,goods_sn')
                                    ->where('user_id='.$_SESSION['user_auth']['id'].' AND sel=1')->select();
              $OrderGoods=D('OrderGoods');
              $OrderGoods->addOrderGoods($cartdata,$order_id);
              //清空购物车,跳转到支付页面
      }
      //echo $order_id;
  } 
  /**
   * 生成15位订单号
   */
  private function generateOrderNO() {
      $random1 = time() . $_SESSION['user_id'];
      $r_len = strlen($random1);
      $next_len = 15 - $r_len;
      $max = str_pad('9', $next_len, '9');
      $order_sn = $random1 . sprintf('%0' . $next_len . 'd', mt_rand(1, $max));
      return $order_sn;
  }
  private function cartTotalPrice() {
      $price = 0;
      if (isset($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $value) {
              $price+=($value['price'] * $value['nums']);
          }
      }
      $price = number_format($price, 2);
      $_SESSION['total_price'] = $price;
      return $price;
  }
  private function cartTotalItem() {
      $nums = 0;
      if (isset($_SESSION['cart'])) {
          $nums = count($_SESSION['cart']);
      }
      $_SESSION['total_item'] = $nums;
      return $nums;
  }
  
}