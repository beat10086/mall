<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class DetailController extends CommonController {
    public function index(){
        //判断ID是否存在
        if(!empty($_GET['id'])){
            $goods_id=$_GET['id'];
            //获取商品信息
            $goods=D('Goods');
            $goodsOne=$goods->findOneGood($goods_id);
            if(!$goodsOne){
                $this->error("抱歉没有找到你想要的商品！");
            }
            if(!$goodsOne['is_on_sale']){
                $this->error("此商品已下架！");
            }
            //加入历史记录,登陆状态cookie暂时没有考虑
            if($_SESSION['user_auth']['id']){
                 $history=D('History');
                 //判断该商品，是否加载过
                 $map=array(
                      'goods_id'=>$goods_id,
                      'user_id' =>$_SESSION['user_auth']['id']
                 );
                 $his_id=$history->field('his_id')->where($map)->find();
                 if($his_id==""){
                     $data=array(
                         'user_id'=>$_SESSION['user_auth']['id'],
                         'goods_id'=>$goods_id,
                         'add_time'=>time()
                     );
                     $history->add($data);
                 }     
            }  
            //获取商品描述
            $goods_info = $goods->goods_info($goods_id);
            $goods_info['content']=htmlspecialchars_decode($goods_info['content']);
            //获取商品相册
            $gallery = $goods->gallery($goods_id);
            //获取商品的规格
            $specs = $goods->specList($goods_id);
            //获取商品属性
            $attrs = $goods->attrList($goods_id);
            $category=D('Category');
            $parent_id =$category->parentId($goodsOne['category_id']);
            $parent_id[]=$goodsOne['category_id'];
            $ur_here = $category->category($parent_id, 'category_name,category_id');
            //格式化配图JSON(注意的地方json_decode转化数组和对象，记住要去掉反斜杠) htmlspecialchars_decode 去掉反斜杠(输出的时候 反转义)
            //这个很重要
            //json_last_error_msg() 输出json的错误信息
            $thunb_pic=htmlspecialchars_decode($goodsOne['thunb_pic']);
            $goodsOne['thunb_pic']=json_decode($thunb_pic,true);
            foreach ($gallery as $k =>$v){
                $gallery[$k]['gallery_pic']=json_decode(htmlspecialchars_decode($v['gallery_pic']),true);
            
            }
            $this->assign('attrs',$attrs);
            $this->assign('specs',$specs);
            $this->assign('goodsOne',$goodsOne);
            $this->assign('gallery',$gallery);
            $this->assign('ur_here',$ur_here);
            $this->assign('goods_info',$goods_info);
            $this->display();
        }else{
             $this->error("缺少必要的参数!");
        }   
    }
   //总的商品数,总的价格
   private function save() {
        $this->cartTotalItem();
        $this->cartTotalPrice();
   }
   /**
    * 计算购物车中商品数量
    */
   private function cartTotalItem() {
       $nums = 0;
       if (isset($_SESSION['cart'])) {
           $nums = count($_SESSION['cart']);
       }
       $_SESSION['total_item'] = $nums;
       return $nums;
   }
   /**
    * 计算购物车中商品价格
    */
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
   public  function getProduct () {
       if(IS_AJAX){
           $product=D('Product');
           $data=$product->where('good_id = '.$_GET['goods_id'])->select();
           $this->ajaxReturn($data);
          }else{
            $this->error('非法操作！');
       }
       
   }
    
}