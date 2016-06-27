<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
use Org\Util\Date;
class GoodsController extends CommonController{ 
    function _initialize  ()  {
        $category=D('Category');
        $this->assign('categorys',$category->showCategory('where status=1'));
        $brand=D('Brand');
        $this->assign('brands',$brand->showBrand());
    }
    
    
    //显示商品信息
    public function index () {
        $where="";
        if(!empty(I('get.category_id'))){
            $where.="category_id =".I('get.category_id') ." AND ";
            $this->assign('category_id',I('get.category_id'));
        }
        if(!empty(I('get.brand_id'))){
            $where.="brand_id=".I('get.brand_id')." AND ";
            $this->assign('show_brand',I('get.brand_id'));
        }
        if(!empty(I('get.promote_type'))){
            $where.=I('get.promote_type')."=1 AND "; 
            $this->assign('promote_type',I('get.promote_type'));
        }
        if(I('get.is_on_sale')!=""){
            $where.="is_on_sale=".I('get.is_on_sale')." AND ";
            $this->assign('is_on_sale',I('get.is_on_sale'));
        }
        if(!empty(I('get.keywords'))){
            $where.="goods_name like '%".I('get.keywords')."%' AND ";
            $this->assign('keywords',I('get.keywords'));
        }
        $url=get_url();
        $where=substr($where,0,strlen($where)-5);
        $goods=D('Goods');
        $this->assign('goods',$goods->findAllGoods($where));
        $this->assign('url',$url);
        $this->display();
        
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
              //添加商品的内容
              $goodsinfo=D('GoodsInfo');
              $goodsinfo->addGoodsInfo(I('post.keywrod'),I('post.description'),I('post.content'),$good_id);
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
        $type=D('Goods_type');
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
    //删除商品(这里要注意，要删除相册表,产品表，属性表)
    public  function delGoods () {
         if(IS_AJAX){
             $goods=D('Goods');
             $del=$goods->delGoods(I('get.goods_id'));
             if($del>0){
                $result=array(
                         'status'=>true
                    );
            }else{
                $result=array(
                    '  status'=>false
                );
            };
                $this->ajaxReturn($result);
         }else{
              $this->error("非法操作？");
         }
        
    }
    //修改商品推广信息，如热卖、人气、首发、上下架
    public  function modifyPromote () {
        if(IS_AJAX){
            $goods=D('Goods');
            $ids=$goods->modifyPromote(I('get.type'),I('get.value'),I('get.goods_id'));
            if($ids>0){
                $result=array(
                    'status'=>true
                );
            }else{
                $result=array(
                    '  status'=>false
                );
            };
            $this->ajaxReturn($result);
           }else{
            $this->error("非法操作？");
        }
    }
    //显示货号
    public function  goodsProduct () {
        if(!empty(I('get.id'))){
            $goods_id=I('get.id');
            //商品表
            $goods=D('Goods');
            //显示1条数据
            $goods=$goods->findOne($goods_id);
            //货号表
            $product=D('Product');
            $products=$product->findAll($goods_id);
            if(is_array($products)){
               foreach ($products as $k=>$v){
                   $v['attr_list']=substr($v['attr_list'],0,mb_strlen($v['attr_list'],'UTF8')-1);
                   $sql="select attr_name,attr_value from ts_goods_attr_list as GAL JOIN  ts_goods_attr as GA  ON GAL.goods_attr_id=GA.goods_attr_id where attr_list_id in (".$v['attr_list'].") order by sort desc ";
                   $pesc=$product->query($sql);
                   $spec_str = '';
                   foreach ($pesc as $s) {
                       $spec_str.=('<b>' . $s['attr_name'] . '</b>：' . $s['attr_value'] . '&nbsp;&nbsp;&nbsp;');
                   }
                   $products[$k]['spec'] = $spec_str;
               }
            } 
            //获取所有的货号
            $goods_attr=D('GoodsAttr');
            $specs=$goods_attr->showTypeAttr(1,$goods['goods_type_id']);
            $this->assign('specs', $specs);
            $this->assign('goods', $goods);   
            $this->assign('products', $products);
            $this->assign('url',PREV_URL());
            $this->display();
        }else{
             $this->error("非法操作！");
        }
        
    }
    //更新货号
    public function updateProduct () {
        if(IS_AJAX){
            $Product=D('Product');
            $uid=$Product->updateProduct(I('post.product_id'),I('post.filed'),I('post.value'));
            if($uid>0){
                $result=array(
                    'status'=>true,
                );
            }else{
                $result=array(
                    'status'=>false,
                );
            }
            $this->ajaxReturn($result);
        }else{
            $this->error("非法操作！");
        }    
    }
    //编辑
    public  function editor () {
        if(IS_AJAX){
            $goods=D('Goods');
            $goods_id=I('post.goods_id');
            $style_name=$this->execGoodsBasic($_POST);
            //处理商品推广信息的更改
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
            $good_id=$goods->editor(
                        $goods_id,
                        I('post.brand_id'),
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
            if($good_id>0){            
                    //编辑商品的内容
                    $goodsinfo=D('GoodsInfo');
                    $goodsinfo->editorGoodsInfo(I('post.keywrod'),I('post.description'),I('post.content'),$goods_id);     
                    //编辑商品相册
                    $goodsgallery=D('Gallery');
                    $goodsgallery->editorGoodsgallery(I('post.images'),$goods_id);
                    //编辑商品属性
                    /*
                     * 处理商品参数
                     * 1.更新已经有的参数
                     * 2.插入新的参数
                     * 3.删除为空的参数
                     */
                    if(!empty($_POST['attr'])){
                        $goodsattrlist=D('GoodsAttrList');
                        $_POST['attr'] = array_filter($_POST['attr']); //过滤掉为空的参数
                        foreach($_POST['attr'] as $goods_attr_id =>$attr){
                            $where_attr = array(
                                'goods_id' => $goods_id,
                                'goods_attr_id' => $goods_attr_id
                            );
                            //参数是否已插入
                            if($goodsattrlist->where($where_attr)->find()){
                                //如果新的值为空，说明需要删除
                                if($attr==""){
                                    $goodsattrlist->where($where_attr)->delete();
                                }else{
                                    $goodsattrlist->where($where_attr)->save(array('attr_value' => $attr));
                                }       
                            }else{
                                    $data=array(
                                         'attr_value'=>$attr,
                                         'goods_id'  =>$goods_id,
                                         'goods_attr_id'=>$goods_attr_id
                                    );
                                    $goodsattrlist->add($data);
                                }                            
                        }
                    } 
                    //编辑商品规格
                    if(!empty($_POST['spec'])){
                       foreach ($_POST['spec'] as $k=>$v){
                          $spec=array_map('trim',array_filter($v['spec_id']));
                          $_POST['spec'][$k]['spec_id'] = $spec;
                          if(empty($spec)){
                                unset($_POST['spec'][$k]);
                            }
                          $goodsattrlist=D('GoodsAttrList');
                          //删除规格
                          $spec1=$goodsattrlist->table('ts_product')->where('good_id='.$goods_id)->select();
                          foreach($spec1 as $k =>$v){
                              $attr_list_1=explode(',',substr($v['attr_list'],0,strlen($v['attr_list'])-1));
                              foreach ($attr_list_1 as $k1=>$v2){
                                  $goodsattrlist->table('ts_goods_attr_list')->where('attr_list_id='.$v2)->delete();
                              }
                              
                          }
                           /* 当两条或多条规格一样的时候,怎么去掉重复的规格 */
                          foreach($spec as $spec_k=>$spec_v){
                                if(!in_array($spec_v.$spec_k, $has_spec_value)){
                                    //需要查看规格是否存在
                                    $where_attr = array(
                                        'goods_id' =>$goods_id,
                                        'goods_attr_id' =>$spec_k,
                                        'attr_value'=>$spec_v
                                    );
                                    $data=array(
                                        'goods_id'=>$goods_id,
                                        'goods_attr_id'=>$spec_k,
                                        'attr_value'=>$spec_v
                                    );   
                                    $id = $goodsattrlist->add($data);
                                    $goods_spec_id[$spec_v.$spec_k]=$id;
                                    
                                }
                                $has_spec_value[]=$spec_v.$spec_k;
                            } 
                        } 
                        $product=D('Product');
                        $product->where('good_id='.$goods_id)->delete();
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
                            $product->addProduct($v,$goods_id,$attr_list_str);
                        }
                    }        
            }
            parent::admin_log('修改商品 '.I('post.goods_name').' 成功!');
            echo $good_id;
            exit();   
        }
        $goods_id=I('get.id');
        $goods=D('Goods');
        $goodOne=$goods->findOne($goods_id);
        $goodOne=$this->formatGoodsBasc($goodOne);
        $goodsinfo=D('GoodsInfo');
        $goodInfoOne=$goodsinfo->findOneInfo($goods_id);
        $goodInfoOne['content']=htmlspecialchars_decode($goodInfoOne['content']);
        $gallery=D('Gallery');
        $galleryall=$gallery->findAllGallery($goods_id);
        foreach($galleryall as $k=>$v){
            $galleryall[$k]['gallery']=json_decode(htmlspecialchars_decode($v['gallery_pic']),true);            
        }
        $galleryData=array();
        $galleryData['data']=$galleryall;
        $galleryData['limit']=count($galleryall);
        $galleryData['total']=C('UPLOAD_NUM')-$galleryData['limit'];
        $type=D('GoodsType');
        //获取参数
        $this->assign('types',$type->select());
        $this->assign('goodsone',$goodOne);
        $this->assign('goodsinfo',$goodInfoOne);
        $this->assign('galleryData',$galleryData);
        $this->assign('url',PREV_URL());
        $this->display();
    }
   public function formatGoodsBasc ($goods) {
       if(is_array($goods)){
           $goods_style_name=$goods['goods_style_name'];
           if($goods_style_name){
               if(strpos($goods_style_name, 'bold')){  
                   $goods['style']['bold']=1;
                  }else{
                   $goods['style']['bold']=0;
               }
               if(strpos($goods_style_name, 'italic')){
                   $goods['style']['italic']=1;
                  }else{
                   $goods['style']['italic']=0;
               }
               if(strpos($goods_style_name, 'color')){
                   $goods['style']['color']=1;
               }else{
                   $goods['style']['color']=0;
               }
           }else{
               $goods['style']['bold']=0;
               $goods['style']['italic']=0;
               $goods['style']['color']=0;
           }
           $goods['unfold']=json_decode(htmlspecialchars_decode($goods['thunb_pic']),true);
           $goods['promote_stime']=empty($goods['promote_stime'])?'':Date('Y-m-d',$goods['promote_stime']);
           $goods['promote_etime']=empty($goods['promote_etime'])?'':Date('Y-m-d',$goods['promote_etime']);
       }    
       return $goods;
   }  
   public  function  delGallery () {
         $gallery=D('Gallery');
         echo $gallery->delGallery(I('post.gallery_id'));
   }
   //选择属性
   public function getTypeAttrSelect () {
       if(IS_AJAX){
           //规格
           $good_type=I('get.good_type');
           $goods_id=I('get.goods_id');
           if($good_type >0){
               $attr=array();
               $gooods=D('Goods');
               $paramsql="select GA.goods_attr_id,GA.attr_name,GA.attr_may_value,GAL.attr_value from ts_goods_attr as GA Left outer JOIN  ts_goods_attr_list as GAL  ON GAL.goods_attr_id=GA.goods_attr_id where GA.goods_type_id=".$good_type." and GA.attr_type=0 AND goods_id=".$goods_id;
               $param=$gooods->query($paramsql);
               if(!empty($param)){
                   $attr['param']=$param;
               }else{
                   $paramsql="select GA.goods_attr_id,GA.attr_name,GA.attr_may_value from  ts_goods_attr as GA  where GA.goods_type_id=".$good_type." and GA.attr_type=0 order by sort desc" ;
                   $param=$gooods->query($paramsql);
                   $attr['param']=$param;
               }
               $specsql="select goods_attr_id,attr_may_value,attr_name from ts_goods_attr where goods_type_id=".$good_type." and attr_type=1 order by sort desc";
               $spec=$gooods->query($specsql);
               if($spec){
                   $product=D('product');
                   $productAll=$product->where('good_id='.$goods_id)->select();
                   foreach($productAll as $k=>$v){
                       $v['attr_list']=substr($v['attr_list'],0,strlen($v['attr_list'])-1);
                       $sql="select attr_name,attr_value from ts_goods_attr_list as GAL JOIN  ts_goods_attr as GA  ON GAL.goods_attr_id=GA.goods_attr_id where attr_list_id in (".$v['attr_list'].")";
                       $productAll[$k]['select']=$product->query($sql);
               
                   }
               }else{
                   $productAll="";
               }
               $attr['spec']=$spec;
               $attr['product']=$productAll;
               $this->ajaxReturn($attr);
           }
       }else{
            $this->error('非法操作！');
       } 
   }
}