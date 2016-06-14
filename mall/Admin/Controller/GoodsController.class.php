<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class GoodsController extends CommonController{ 
    //显示商品信息
    public function index () {
        
        echo '111';
        
    }
    /* 添加商品 */
    public  function addGoods () {
        if(IS_AJAX){
          $goods=D('Goods');
          $style_name=$this->execGoodsBasic($_POST);
          $is_promote=isset($_POST['is_promote'])?1:0;
          $is_hot=isset($_POST['is_hot'])?1:0;
          $is_first=isset($_POST['is_first'])?1:0;
          $is_well=isset($_POST['is_well'])?1:0;
          $is_on_sale=1;
          if(!empty($_POST['goods_sn'])){
              $goods_sn=$_POST['goods_sn'];     
          }else{
              $goods_sn=$this->trade_no();
          }
          //添加goods表
          $good_id=$goods->addGoods(I('post.brand_id'),
                           I('post.goods_type_id'),
                           I('post.goods_name'),
                           $style_name,
                           I('post.promote_word'),
                           I('post.goods_sn'),
                           I('post.sku'),
                           I('post.unit'),
                           I('post.goods_price'),
                           $is_promote,
                           I('post.promote_stime'),
                           I('post.promote_etime'),
                           I('post.promote_price'),
                           $is_hot,
                           $is_first,
                           $is_well,
                           $is_on_sale,
                           I('post.view'),
                           I('post.category_id'),
                           I('post.thunb_pic'),
                           $goods_sn,
                           I('post.goods_type_id')
                    
          );
          if($good_id >0){
              if(!empty(I('post.keywrod')) && !empty(I('post.description')) && !empty(I('post.content'))){
                  //添加商品的内容
                  $goodsinfo=D('GoodsInfo');
                  $goodsinfo->addGoodsInfo(I('post.keywrod'),I('post.description'),I('post.content'),$good_id);
              }
              if(!empty(I('post.images'))){
                  //添加商品相册
                  $goodsgallery=D('Gallery');
                  $goodsgallery->addGoodsgallery(I('post.images'),$good_id);  
              }  
              if(isset($_POST['attr']) && !empty($_POST['attr'])){
                  //组合参数插入数据
                  $_POST['attr'] = array_filter($_POST['attr']); //过滤掉为空的参数
                  $goodsattrlist=D('GoodsAttrList');
                  $goodsattrlist->addGoodsAttr($_POST['attr'],$good_id); 
              }
              $goods_spec_id=array();
              if(isset($_POST['spec']) && !empty($_POST['spec'])){
                  //处理商品货号
                   foreach ($_POST['spec'] as $k=>$v){
                       //除去为空的组合
                       $spec=array_map('trim',array_filter($v['spec_id']));
                       $_POST['spec'][$k]['spec_id'] = $spec;
                       if(empty($spec)){
                           unset($_POST['spec'][$k]);
                       }
                       $goodsattrlist=D('GoodsAttrList');
                       /* 当两条或多条规格一样的时候,怎么去掉重复的规格 */
                       foreach($spec as $spec_k=>$spec_v){
                           if(!in_array($spec_v.$spec_k, $has_spec_value)){
                               $data=array(
                                   'goods_id'=>$good_id,
                                   'goods_attr_id'=>$spec_k,
                                   'attr_value'=>$spec_v
                               );
                               $id = $goodsattrlist->add($data);
                               $goods_spec_id[$spec_v.$spec_k]=$id;
                           } 
                           $has_spec_value[]=$spec_v.$spec_k;
                       }       
                   }   
                   //将商品插入product
                   foreach($_POST['spec']  as $v){
                       $attr_list_str='';
                       foreach($v['spec_id']  as $s_k =>$s_v){
                           $attr_list_str.= $goods_spec_id[$s_v.$s_k].',';
                       }
                       if(empty($v['goods_sn'])){
                           $v['goods_sn']=$this->trade_no();
                       }
                       $product=D('Product');
                       $product->addProduct($v,$good_id,$attr_list_str);
                   }
              } 
              parent::admin_log('添加商品 '.I('post.goods_name').' 成功!');
              echo $good_id;
          }else{
              parent::admin_log('添加商品 '.I('post.goods_name').' 失败!');
              echo $good_id;
          }
          exit();   
        }
        $category=D('Category');
        $brand=D('Brand');
        $type=D('Goods_type');
        $this->assign('categorys',$category->showCategory('where status=1'));
        $this->assign('brands',$brand->showBrand());
        $this->assign('types',$type->allType());
        $this->display();
    }
    //获取属性
    public function getTypeAttr () {
        if(IS_AJAX){
              $goodsAttr=D('GoodsAttr');
              $attr =$goodsAttr->showTypeAttr(null,I('get.good_type'),null,null);
              $this->ajaxReturn($attr);
            }else{
             $this->error("非法操作！");
        }     
    }   
    //生成货号
    public function  trade_no () { 
        return 'ECS'.uniqid();      
    }
    
    //处理商城名称样式
    public  function execGoodsBasic ($style_name) {
        $goods_style_name="";
        if(isset($style_name['style']['bold'])){
            $goods_style_name.="font-weight:bold;";
        }
        if (isset($style_name['style']['italic'])) {
            $goods_style_name.='font-style:italic;';
        }
        if (isset($style_name['style']['color'])) {
            $goods_style_name.='color:#f00;';
        }
        if ($goods_style_name != '') {
            $goods_style_name = 'style="' . $goods_style_name . '"';
        }
        return $goods_style_name;
    }
}