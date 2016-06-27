<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>电商后台</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">  
<link rel="shortcut icon" href="favicon.ico">
<link href="/mall/PUBLIC/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
<!-- Data Tables -->
<link href="/mall/PUBLIC/Admin/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/animate.min.css" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/style.min.css?v=4.0.0" rel="stylesheet">
<link href="/mall/PUBLIC/Admin/css/page.css?v=4.0.0" rel="stylesheet">

	    <link rel="stylesheet" href="/mall/PUBLIC/Admin/css/font-awesome.min.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" media="all" href="/mall/PUBLIC/Admin/css/daterangepicker-bs3.css" />
	  <link rel="stylesheet" href="/mall/PUBLIC/Admin/css/daterangepicker.css" rel="stylesheet">  
	  <link rel="stylesheet" href="/mall/PUBLIC/Admin/uploadify/uploadify.css">
	  <script type="text/javascript" charset="utf-8" src="/mall/PUBLIC/Admin/ueditor/ueditor.config.js"></script>
	  <script type="text/javascript" charset="utf-8" src="/mall/PUBLIC/Admin/ueditor/ueditor.all.min.js"></script>
	  <script type="text/javascript" charset="utf-8" src="/mall/PUBLIC/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
	  <style>
	     .hide{
	     	  display:none;
	     }
	     #show_pic-button{
				 background:#1ab394;
				 border:none;
				 border-radius:5px;
	
        }
        #gallery_pic-button{
        	    background:#1ab394;
				 border:none;
				 border-radius:5px;
        }
        #gallery_pic{
        	 margin-top:20px;
        }
        .mall_pic_box{
			min-width:350px;
			max-width:520px;
			overflow: hidden;
			background: none repeat scroll 0 0 white;
        }
        .mall_pic_header{
        	 height:30px;
			line-height:30px;
			color:#666;
			font-size:13px;
			background:#fafafa;
			text-indent:10px;
        } 
        .weibo_pic_info {
        	 float:left;
        }
        .mall_pic_list {
        	padding:15px 10px 10px 10px;
        	overflow:hidden;
        }
        .weibo_pic_content{
        	width:150px;
			height:150px;
			float:left;
			border:1px solid #eee;
			margin:-5px 4px 15px 4px;
			overflow:hidden;
			position:relative;
        }
        .weibo_pic_content .remove{
        	display:none;
			width:100%;
			height:25px;
			background:#000;
			position:absolute;
			bottom:0;
			left:0;
			z-index:2;
			opacity:0.7;
			filter:alpha(opacity=70);
			cursor:pointer;
        }
        .weibo_pic_content .text{
        	display:none;
			width:100%;
			height:25px;
			line-height:25px;
			text-align:center;
			position:absolute;
			bottom:0;
			left:0;
			z-index:3;
			cursor:pointer;
			color:#fff;
			font-size:13px;
        }
        .weibo_pic_img {
        	clear:both;
			margin:0 auto;
			position:relative;
			top:-5px;
        }
	  </style>
	  <script type="text/javascript" charset="utf-8">
	      var flage_type=false;
		  var Thinkphp={
		  	    ROOT:'/mall',
		  	    getTypeAttr:'<?php echo U("Goods/getTypeAttr");?>',
		  	    uploadify:'/mall/PUBLIC/Admin/uploadify',
		  	    IMAGEURL :'<?php echo U("File/upload_goods_img");?>',
		  	    GALLERY:'<?php echo U("File/upload_goods_gallery");?>',
		  	    IMG:'/mall/PUBLIC/Admin/img',
		  	    ADDGOODS:'<?php echo U("Goods/addGoods");?>',
		  	    delgallery:'<?php echo U("Goods/delGallery");?>',
		  	    getTypeAttrSelect:'<?php echo U("Goods/getTypeAttrSelect");?>',
		  	    goods_id:'<?php echo ($_GET['id']); ?>',
		  	    url:'<?php echo ($url); ?>'
		  }
	  </script>

</head>  
<body>
	
  <form  action="<?php echo U('Goods/editor');?>" method="POST" id="editorGoodsForm" class="form-horizontal" enctype="multipart/form-data">
	<div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>商品管理</li>
                              <li class="active">编辑商品</li>
                       </ol>
                    </div>
                    <div>
                          <a href="<?php echo ($url); ?>" class="btn btn-primary  pull-right">
                              <span class="glyphicon glyphicon-backward"></span> 返回
                          </a>
                    </div>
                    <div class="ibox-content">
                    	  <ul class="nav nav-tabs" role="tablist">
							    <li role="presentation" class="active">
							    	<a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">基本信息</a>
							    </li>
							    <li role="presentation">
							    	<a href="#desc" aria-controls="desc" role="tab" data-toggle="tab">商品描述</a>
							    </li>
							    <li role="presentation">
							    	<a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">商品相册</a>
							    </li>
							    <li role="presentation">
							    	<a href="#attr" aria-controls="attr" role="tab" data-toggle="tab">参数</a>
							    </li>
							    <li role="presentation">
							    	<a href="#product" aria-controls="product" role="tab" data-toggle="tab">货品</a>
							    </li>
							    <li role="presentation">
							    	<a href="#meta" aria-controls="meta" role="tab" data-toggle="tab">META信息</a>
							    </li>
                         </ul>
                         <div class="tab-content" style="margin-top:10px;">
							    <div role="tabpanel" class="tab-pane fade in active" id="basic">
							    	 <div class="form-group" style="margin-top:30px;">
	                                    <label for="goods_name" class="col-sm-2 control-label">商品名称：</label>
	                                    <div class="col-sm-2">
	                                        <input type="text" class="form-control" value="<?php echo ($goodsone["goods_name"]); ?>" id="goods_name" style="width:230px;"  name="goods_name"  
	                                        autocomplete="off" placeholder="商品名称">    
	                                    </div>
	                                    <div class="col-sm-2">
	                                    	<label class="checkbox-inline">
	                                    		   <?php if(($goodsone["style"]["bold"]) == "1"): ?><input type="checkbox" name="style[bold]" checked="checked" value="1" style="margin-top:3px;">加粗
                                                     <?php else: ?>
                                                        <input type="checkbox" name="style[bold]" value="1" style="margin-top:3px;">加粗<?php endif; ?>
                                            </label>
                                            <label class="checkbox-inline">
                                            	 <?php if(($goodsone["style"]["italic"]) == "1"): ?><input type="checkbox" name="style[italic]" checked="checked" value="1" style="margin-top:3px;">倾斜
                                                   <?php else: ?>
                                                      <input type="checkbox" name="style[italic]" value="1" style="margin-top:3px;">倾斜<?php endif; ?>
                                            </label>
                                            <label class="checkbox-inline">
                                            	  <?php if(($goodsone["style"]["color"]) == "1"): ?><input type="checkbox" name="style[color]" checked="checked" value="1" style="margin-top:3px;">描红
                                                      <?php else: ?>
                                                         <input type="checkbox" name="style[color]" value="1" style="margin-top:3px;">描红<?php endif; ?>
                                            </label>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="promote_word" class="col-sm-2 control-label">推广词：</label>
	                                    <div class="col-sm-4">
	                                        <input type="text" class="form-control" id="promote_word"  name="promote_word"  value="<?php echo ($goodsone["promote_word"]); ?>"
	                                        autocomplete="off" placeholder="推广词">
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="category_id" class="col-sm-2 control-label">商品栏目：</label>
	                                    <div class="col-sm-4">
	                                         <select name="category_id" class="form-control">
	                                         	  <option value="">请选择</option>
	                                         	  <?php if(is_array($categorys)): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categoryadd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($categoryadd["category_id"]); ?>" path="<?php echo ($categoryadd["path"]); ?>"   <?php if(($goodsone["category_id"]) == $categoryadd["category_id"]): ?>selected="selected"<?php endif; ?> >
                                           	   	   	 <?php if($categoryadd["path"] == '0' ): ?>├─<?php echo ($categoryadd["category_name"]); ?>
                                           	   	   	 <?php else: ?>
                                           	   	   	     <?php
 $nums=substr_count($categoryadd['path'],'-'); echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$nums).'└'; echo str_repeat('─',$nums).$categoryadd['category_name']; endif; ?>
                                           	   	   </option><?php endforeach; endif; else: echo "" ;endif; ?>
	                                         </select>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="brand_id" class="col-sm-2 control-label">品牌：</label>
	                                    <div class="col-sm-4">
	                                         <select name="brand_id" class="form-control">
	                                         	  <option value="">请选择</option>
	                                         	  <?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$brands): $mod = ($i % 2 );++$i;?><option value="<?php echo ($brands["brand_id"]); ?>" <?php if(($goodsone["brand_id"]) == $brands["brand_id"]): ?>selected="selected"<?php endif; ?> >
	                                         	  	  	  <?php echo ($brands["brand_name"]); ?>
	                                         	  	  </option><?php endforeach; endif; else: echo "" ;endif; ?>
	                                         </select>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="goods_sn" class="col-sm-2 control-label">货号：</label>
	                                    <div class="col-sm-4">
	                                         <input type="text" class="form-control" value="<?php echo ($goodsone["goods_sn"]); ?>" id="goods_sn"  name="goods_sn"  autocomplete="off" placeholder="商品货号">
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="sku" class="col-sm-2 control-label">总库存：</label>
	                                    <div class="col-sm-4">
	                                       <div class="row">
		                                    	<div class="col-sm-4">
		                                           <input type="text" value="<?php echo ($goodsone["sku"]); ?>" class="form-control" id="sku"  name="sku"  autocomplete="off" placeholder="库存">
		                                        </div>
		                                        <div class="col-sm-4">
			                                         <select name="unit" class="form-control">
			                                         	    <option value="件"<?php if(($goodsone["unit"]) == "件"): ?>selected="selected"<?php endif; ?> >件</option>
								                            <option value="台"<?php if(($goodsone["unit"]) == "台"): ?>selected="selected"<?php endif; ?> >台</option>
								                            <option value="部"<?php if(($goodsone["unit"]) == "部"): ?>selected="selected"<?php endif; ?> >部</option>
								                            <option value="箱"<?php if(($goodsone["unit"]) == "箱"): ?>selected="selected"<?php endif; ?> >箱</option>
								                            <option value="份"<?php if(($goodsone["unit"]) == "份"): ?>selected="selected"<?php endif; ?> >份</option>
								                            <option value="个"<?php if(($goodsone["unit"]) == "个"): ?>selected="selected"<?php endif; ?> >个</option>
			                                         </select>
			                                    </div>
		                                   </div>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label for="goods_price" class="col-sm-2 control-label">商店价：</label>
	                                    <div class="col-sm-4">
	                                         <input type="text" class="form-control" id="goods_price" value="<?php echo ($goodsone["goods_price"]); ?>"  name="goods_price"  autocomplete="off" placeholder="商店价">
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label  class="col-sm-2 control-label">促销：</label>
	                                    <div class="col-sm-4">
	                                       <label class="checkbox-inline" id="is_promote" >
	                                       	  <?php if(($goodsone["is_promote"]) == "1"): ?><input type="checkbox" name="is_promote" checked="checked" value="1" style="margin-top:3px;">促销
                                                 <?php else: ?>
                                                    <input type="checkbox" name="is_promote" value="1" style="margin-top:3px;">促销<?php endif; ?>
                                           </label>
	                                    </div>
                                     </div>
                                     <div class="promote_ele hide form-group">
	                                    <label for="promote_price" class="col-sm-2 control-label">促销价：</label>
	                                    <div class="col-sm-4">
	                                         <input type="text" class="form-control" id="promote_price" value="<?php echo ($goodsone["promote_price"]); ?>"  name="promote_price"  autocomplete="off" placeholder="促销价">
	                                    </div>
                                     </div>
                                     <div class="promote_ele hide form-group">
	                                    <label for="promote_price" class="col-sm-2 control-label">促销日期：</label>
	                                    <div class="col-sm-4"> 
	                                    	  <div class="input-prepend input-group">
                                                   <span class="add-on input-group-addon">
                                                       <i class="glyphicon glyphicon-calendar"></i>
                                                   </span>
                                                   <input id="reservation" value="<?php echo ($goodsone["promote_stime"]); ?>-<?php echo ($goodsone["promote_etime"]); ?>" class="form-control" autocomplete="off" type="text"  value="" name="reservation"  style="width: 200px" readonly="readonly">
                                                   <input type="hidden" name="promote_stime" autocomplete="off" value="<?php echo ($goodsone["promote_stime"]); ?>">
                                                   <input type="hidden" name="promote_etime" autocomplete="off" value="<?php echo ($goodsone["promote_etime"]); ?>">
                                              </div>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label  class="col-sm-2 control-label">加入推荐：</label>
	                                    <div class="col-sm-4">
	                                       <label class="checkbox-inline" id="is_hot" >
	                                          <?php if(($goodsone["is_hot"]) == "1"): ?><input type="checkbox" name="is_hot" checked="checked" value="1" style="margin-top:3px;">热卖
                                                 <?php else: ?>
                                                    <input type="checkbox" name="is_hot" value="1" style="margin-top:3px;">热卖<?php endif; ?>
                                           </label>
                                           <label class="checkbox-inline" id="is_well" >
                                           	   <?php if(($goodsone["is_well"]) == "1"): ?><input type="checkbox" name="is_well" checked="checked" value="1" style="margin-top:3px;">人气
                                                  <?php else: ?>
                                                     <input type="checkbox" name="is_well" value="1" style="margin-top:3px;">人气<?php endif; ?>
                                           </label>
                                           <label class="checkbox-inline" id="is_first" >
                                           	    <?php if(($goodsone["is_first"]) == "1"): ?><input type="checkbox" name="is_first" checked="checked" value="1" style="margin-top:3px;">首发
                                                   <?php else: ?>
                                                     <input type="checkbox" name="is_first" value="1" style="margin-top:3px;">首发<?php endif; ?>
                                           </label>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label  class="col-sm-2 control-label">商品展示图：</label>
	                                    <div class="col-sm-4">
	                                    	  <input type="file" name="show_pic" id="show_pic"/>
	                                    	     <?php if(empty($goodsone["unfold"])): ?><img src="/mall/PUBLIC/Admin/img/thumb.jpg"  class="thumb_img" width="170" height="170"/>
	                                    	        <?php else: ?>
	                                    	          <img src="/mall/<?php echo ($goodsone["unfold"]["unfold"]); ?>"  class="thumb_img" width="170" height="170"/><?php endif; ?>
	                                    	  <br/>
	                                    	  <input type="hidden" name="thunb_pic" autocomplete="off" value="<?php echo ($goodsone["thunb_pic"]); ?>"/>
	                                    </div>
                                     </div>
                                     <div class="form-group">
	                                    <label  class="col-sm-2 control-label">查看次数：</label>
	                                    <div class="col-sm-4">
	                                    	   <input type="text" style="width:60px;" name="view" class="form-control" value="<?php echo ($goodsone["view"]); ?>" class="input-mini" />
	                                    </div>
                                     </div>
							    </div>
							    <div role="tabpanel" class="tab-pane fade" id="desc">
							    	  <script id="editor" type="text/plain" name="content" style="width:100%;height:400px;"><?php echo ($goodsinfo["content"]); ?></script>
							    </div>
							    <div role="tabpanel" class="tab-pane fade" id="gallery">
							    	   <div class="mall_pic_box" id="pic_box">
							    	   	    <div class="mall_pic_header">
					                            <span class="weibo_pic_info">共 <span class="weibo_pic_total"><?php echo ($galleryData["limit"]); ?></span> 张，还能上传 <span class="weibo_pic_limit"><?php echo ($galleryData["total"]); ?></span> 张（按住ctrl可选择多张）</span>
				                            </div>
							    	   	    <div class="mall_pic_list">
							    	   	       <?php if(is_array($galleryData["data"])): $i = 0; $__LIST__ = $galleryData["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gallery): $mod = ($i % 2 );++$i;?><div class="weibo_pic_content" data-gallery="<?php echo ($gallery["gallery_id"]); ?>">
														<span class="remove" style="display: none;"></span>
														<span class="text" style="display: none;">删除</span>
														<img class="weibo_pic_img" width="150" height="150" src="/mall/<?php echo ($gallery["gallery"]["unfold"]); ?>" style="display: inline;">
													</div>
													<input type="hidden" value="<?php echo ($gallery["gallery_pic"]); ?>" name="images[]"><?php endforeach; endif; else: echo "" ;endif; ?>
							    	   	    </div>
							    	   	    <input type="file" name="file" id="gallery_pic">
							    	   </div>
							    </div>
							    <div role="tabpanel" class="tab-pane fade" id="attr">
							    	 <div class="form-group">
	                                    <label for="goods_type_id" class="col-sm-2 control-label">商品类型：</label>
	                                    <div class="col-sm-4">
	                                         <select name="goods_type_id" class="form-control">
	                                         	  <option value="">请选择</option>
	                                         	  <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$types): $mod = ($i % 2 );++$i;?><option value="<?php echo ($types["goods_type_id"]); ?>" <?php if(($types["goods_type_id"]) == $goodsone["goods_type_id"]): ?>selected='selected'<?php endif; ?>  >
	                                         	  	  	<?php echo ($types["type_name"]); ?>
	                                         	  	  </option><?php endforeach; endif; else: echo "" ;endif; ?>
	                                         </select>
	                                    </div>
                                     </div>
                                   <div class="form-group" id="arg-title">
	                                     <label for="goods_type_id" class="col-sm-6 control-label" style="text-align:center;">参数列表</label>
	                               </div>     
	                              <!-- <?php if(is_array($goodsattrall)): $i = 0; $__LIST__ = $goodsattrall;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attrall): $mod = ($i % 2 );++$i;?><div class="form-group arg-item">
					            		         <label for="goods_type_id" class="col-sm-2 control-label"><?php echo ($attrall["attr_name"]); ?></label>
					            		         <div class="col-sm-2"><input type="text" value="<?php echo ($attrall["attr_value"]); ?>" name="attr[<?php echo ($attrall["goods_attr_id"]); ?>]" id="" class="form-control arg_show" /></div>
					            		         <div class="col-sm-2">
					            		         	<select class='form-control arg-select'>
					            		         		 <option value=''>请选择</option>
					            		         		 <?php if(is_array($attrall["attr_may_value"])): foreach($attrall["attr_may_value"] as $key=>$v): ?><option value='<?php echo ($v); ?>' <?php if(($v) == $attrall["attr_value"]): ?>selected='selected'<?php endif; ?>  ><?php echo ($v); ?></option><?php endforeach; endif; ?>
					            		         	</select>	
					            		         </div>
			            		              </div><?php endforeach; endif; else: echo "" ;endif; ?>-->
							   </div>
							   <div role="tabpanel" class="tab-pane fade" id="product">
							   	   <table class="table">
						                <tr id="product-th">
						                	    <th>选择容量</th>
												<th>网络制式</th>
												<th>颜色</th>
												<th>套餐</th>
												<th>编号</th>
												<th>价格</th>
												<th>库存</th>
						                </tr>
						                <tr class="spec_list">
						                	<td>
						                		<select class="input-medium form-control" name="spec[0][spec_id][64]">  
	                                                <option value="">请选择</option>
	                                                <option value="16G">16G</option>
	                                                <option value="54G">54G</option>
	                                                <option value="64G">64G</option>
                                                </select>
                                            </td>
                                            <td> 
                                                <select class="input-medium form-control" name="spec[0][spec_id][63]">
													<option value="">请选择</option><option value="GSM/WCDMA">GSM/WCDMA</option>
													<option value="GSM/CDMA">GSM/CDMA</option>
													<option value="GSM/TD-SCDMA">GSM/TD-SCDMA</option>
                                                </select>
                                             </td>
                                             <td>
                                                 <select class="input-medium form-control" name="spec[0][spec_id][62]">
                                                 	  <option value="">请选择</option><option value="红色">红色</option>
                                                 	  <option value="蓝色">蓝色</option><option value="绿色 ">绿色 </option>
                                                 	  <option value="粉红色">粉红色</option>
                                                 </select>
                                             </td>
                                             <td> 
                                                 <select class="input-medium form-control" name="spec[0][spec_id][60]"> 
                                                 	   <option value="">请选择</option>
                                                 	   <option value="套餐一">套餐一</option>
                                                 	   <option value="套餐二">套餐二</option>
                                                 	   <option value="套餐三">套餐三</option>
                                                 	   <option value="套餐四">套餐四</option>
                                                 	   <option value="套餐五">套餐五</option>
                                                 	   <option value="套餐六">套餐六</option>
                                                 	   </select>
                                                 </td>
                                            <td> 
                                                <input type="text" class="form-control" id="" name="spec[0][goods_sn]">
                                            </td>
                                            <td>
                                            	<input type="text" class="form-control" id="" name="spec[0][goods_price]">
                                            </td>
                                            <td>
                                            	<input type="text" class="form-control" id="" name="spec[0][SKU]">
                                            </td>
                                         </tr>
                                         <tr class="well">
						                    <td colspan="7">
						                        <a href="javascript:void(0)" id="add-product"><i class="icon-plus"></i> 增加一项</a>
						                    </td>
						                </tr>
                                  </table>
							   </div>
							   <div role="tabpanel" class="tab-pane fade" id="meta">
							   	   <div class="form-group">
	                                    <label for="keywrod" class="col-sm-2 control-label">关键字：</label>
	                                    <div class="col-sm-4">
	                                       <input type="text" class="form-control" id="keywrod"  name="keywrod"  
	                                        autocomplete="off" placeholder="关键字" value="<?php echo ($goodsinfo["keywords"]); ?>">
	                                    </div>
                                   </div>
                                   <div class="form-group">
	                                    <label for="description" class="col-sm-2 control-label">描述：</label>
	                                    <div class="col-sm-4">
	                                       <input type="hidden" class="form-control" id="description"  name="description"  
	                                        autocomplete="off" placeholder="描述" value="<?php echo ($goodsinfo["description"]); ?>">
	                                    </div>
                                   </div>
							   </div>
                         </div>
                    </div>
                    <p style="margin-top:10px;margin-left:170px;">  
                    	 <input type="hidden" value="<?php echo ($goodsone["goods_id"]); ?>" name="goods_id">
						 <input type="submit"  value="修改商品" class="btn btn-primary">
					</p>
                </div>
            </div>
        </div>
    </div>
  </form>

	<script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrapValidator.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/common.js"></script>

	<script src="/mall/PUBLIC/Admin/js/jquery.uploadify.min.js"></script>
	<script src="/mall/PUBLIC/Admin/js/moment.min.js"></script>
	<script src="/mall/PUBLIC/Admin/js/daterangepicker.js"></script>
 	<script src="/mall/PUBLIC/Admin/js/goods.js"></script>
 	<script src="/mall/PUBLIC/Admin/js/gallery.js"></script>
 	<script src="/mall/PUBLIC/Admin/js/editor.js"></script>

</body>
</html>