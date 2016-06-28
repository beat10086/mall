<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends CommonController {  
  //显示购物车页面  
  public  function  index (){
       $cart_info = $this->getCartInfo();
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
         //购物车中不存在该数据，则新加入。
         if (isset($_SESSION['cart'][$cart_key])) {
             $_SESSION['cart'][$cart_key]['nums']+=$num;
         }else{
             $item = array(
                 'goods_id' => $goods_id, //商品ID
                 'price' => $price, //商品价格
                 'spec' => $spec_id, //商品规格
                 'nums' => $num//商品数量
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
         $this->ajaxReturn($result);
      }else{
           $this->error('非法操作！');
      }
  }
  //获取购物车的数据
  /**
   * 获取购物车中的全部商品ID（排除重复的）
   */
  private function getCartGoodsId() {
      $goods_id = array();
      if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $value) {
              $goods_id[$value['goods_id']] = $value['goods_id'];
          }
      }
      return $goods_id;
  }
  public   function  getCart () {
      //获取cart的id
      if(IS_AJAX){
          $cart_info=$this->getCartInfo();
          $this->ajaxReturn($cart_info);
      }else{
           $this->error('非法操作！');
      }   
  }
  //获取购物车信息
  public  function getCartInfo (){
      $goods_id=array();
      if(!empty($_SESSION['cart'])){
          $goods_id = $this->getCartGoodsId();
          $goods=D('Goods');
          $str_in=db_create_in($goods_id);
          $goods_res=$goods->where('goods_id in ('.$str_in.')')->select();
          if ($goods_res) {
              foreach ($goods_res as $value) {
                  $goods_info[$value['goods_id']] = $value;
                  $goods_info[$value['goods_id']]['thunb_pic']=json_decode(htmlspecialchars_decode($goods_info[$value['goods_id']]['thunb_pic']),true);
              }
          }
          foreach ($_SESSION['cart'] as $key => $value) {
              $cart_info[$key] = $value;
              $cart_info[$key]['goods_name'] = $goods_info[$value['goods_id']]['goods_name'];
              $cart_info[$key]['goods_sn'] = $goods_info[$value['goods_id']]['goods_sn'];
              $cart_info[$key]['goods_thumb'] = $goods_info[$value['goods_id']]['thunb_pic']['thumb'];
              $cart_info[$key]['spec_desc'] = '';
              if ($value['spec']) {
                  $spec_res = $goods->query('SELECT attr_name,attr_value FROM hd_goods_attr_list AS GAL LEFT JOIN hd_goods_attr AS GA ON GAL.goods_attr_id=GA.goods_attr_id WHERE GA.attr_type=1 AND GAL.attr_list_id IN(' . $value['spec'] . ') ORDER BY GA.goods_attr_id DESC');
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
  //删除购物车
  public  function delCartGoods () {
      if(IS_AJAX){
          $cart_id = I('get.data_id');
          //购物车存在该货品
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
          //购物车中有此货品
          if(isset($_SESSION['cart'][$cart_id])){
              //判断是否有规格
              $spec = $_SESSION['cart'][$cart_id]['spec'];
              $goods_id = $_SESSION['cart'][$cart_id]['goods_id'];
              $product = D('product');
              if(!empty($spec)){
                  $sku=$product->field('sku')->where('good_id='.$goods_id)->find();
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
       }
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