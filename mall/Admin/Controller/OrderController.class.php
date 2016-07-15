<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class OrderController extends CommonController{
    //显示订单
    public  function index () {
         $order=D('Order');
         $allorder=$order->getAllOrder();
         $this->assign('allorder',$allorder);
         $this->display();
    }
   //订单详情
   public  function OrderInfo (){
       if(isset($_GET['id'])){
           $order=D('Order');
           $id=intval($_GET['id']);
           $allorder=$order->getOneOrder($id);
           $goodInfo=$order->query('select TOG.order_goods_id,TOG.goods_id,TOG.goods_name,TOG.attr_list,TOG.spec_value,TOG.goods_sn,TOG.price,TOG.nums,TG.thunb_pic from ts_order_goods as TOG left JOIN   ts_goods as TG  ON TOG.goods_id=TG.goods_id WHERE TOG.order_id='.$id);
           foreach ($goodInfo as  $k=>$v){
               $goodInfo[$k]['thunb_pic']=json_decode(htmlspecialchars_decode($v['thunb_pic']),true);
               if(empty($goodInfo[$k]['spec_value'])){
                   $sku=$order->query('select sku from ts_goods where goods_id='.$goodInfo[$k]['goods_id']);
                   foreach ($sku as $k1=>$v1){
                       $goodInfo[$k]['sku']=$v1['sku'];
                   } 
               }else{
                   $sku=$order->query('select sku from ts_product where good_id='.$goodInfo[$k]['goods_id'].' AND attr_list="'.$goodInfo[$k]['attr_list'].',"');
                   foreach ($sku as $k2=>$v2){
                       $goodInfo[$k]['sku']=$v2['sku'];
                   }  
               }
               $goodInfo[$k]['totol_price']=number_format_fun($goodInfo[$k]['price']*$goodInfo[$k]['nums']);
           };
           $orderlog=$order->table('ts_order_log')->where('order_id='.$id)->order('created desc')->select();
           foreach($orderlog as $k=>$v){
               $orderlog[$k]['created']=date('Y-m-d H:i:s',$v['created']);
               $orderlog[$k]['order_status']=C('orderStatus')[$v['order_status']];
               $orderlog[$k]['pay_status']=C('payStatus')[$v['pay_status']];
               $orderlog[$k]['ship_status']=C('shipStatus')[$v['ship_status']];
           }
           $this->assign('orderlog',$orderlog);
           $this->assign('goodInfo',$goodInfo);
           $this->assign('order',$allorder);
           $this->assign('url',PREV_URL());
           $this->display();
       }
   }
   //订单操作
   public function addOrderLog (){
       if(IS_POST){
           //判断订单是否存在
           $order=D('Order');
           $way=I('post.way');
           $order_id = intval($_POST['order_id']);
           $orderOne=$order->where('order_id='.$order_id)->find();
           if($orderOne){
             $log=array(
                 'username'=>$_SESSION['admin']['username'],
                 'admin_id'=>$_SESSION['admin']['user_id'],
                 'opt_note'=>I('post.action_note'),
                 'order_status'=>2,
                 'created' => time(),
                 'order_id' => $order_id
                 
             );
             //付款
             if($way=='payPrice'){
                 $update = array(
                     'pay_status' => 1,
                     'pay_time' =>time()
                 );
                 $res = $order->where('order_id = ' . $order_id)->save($update);
                 if ($res) {
                     $log['pay_status'] = 1;
                     $log['ship_status'] = 1;
                     $order->table('ts_order_log')->add($log);
               }   
            //配货中
             }elseif($way=='sendGoods'){
                 $update = array(
                     'ship_status' => 2,
                 );
                 $res = $order->where('order_id = ' . $order_id)->save($update);
                 if($res){
                     $log['pay_status'] = 1;
                     $log['ship_status'] = 2;
                     $order->table('ts_order_log')->add($log);    
                 }
             //发货
            }elseif($way=='hadRecive'){
                $update = array(
                    'ship_status' => 4,
                );
                $res = $order->where('order_id = ' . $order_id)->save($update);
                if($res){
                    $log['pay_status'] = 1;
                    $log['ship_status'] = 4;
                    $order->table('ts_order_log')->add($log);
                }
            }else if($way=='readySend'){
                $update = array(
                    'ship_status' => 3,
                );
                $res = $order->where('order_id = ' . $order_id)->save($update);
                if($res){
                    $log['pay_status'] = 1;
                    $log['ship_status'] = 3;
                    $order->table('ts_order_log')->add($log);
                }
            }
               $this->redirect('Order/OrderInfo', array('id' => $order_id), 2, '操作成功...');
           }else{
               $this->error('参数发生错误！');
           }
           exit();
       }
   }
   
   
}