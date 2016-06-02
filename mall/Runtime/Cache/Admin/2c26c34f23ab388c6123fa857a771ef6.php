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

<script>
	 var ThinkPHP={
	 	  'CheckCategory':'<?php echo U("Category/CheckCategory");?>',
	 	  'CONTROLLER':'/mall/Admin/Category',
	 	  'DELETE':'<?php echo U("Category/DeleCategory");?>',
	 	  'filter':'<?php echo U("Category/filter");?>'
	 }
</script>

</head>  
<body>
	
    <div  class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <ol class="breadcrumb">
                              <li>商品管理</li>
                              <li class="active">商品栏目</li>
                       </ol>
                    </div>
                    <div id="addGoods">
                    	  <select id="change-category" class="form-control pull-left" style="width:200px;padding:3px 0;height:25px;font-size:12px;margin-left:10px;">
	                    	  	     <option value="all">全部</option>
	                    	  	     <?php if(is_array($categoryOne)): $i = 0; $__LIST__ = $categoryOne;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category_select): $mod = ($i % 2 );++$i; if($category_select["pid"] == '0' ): ?><option value="<?php echo ($category_select["category_id"]); ?>" <?php if(($category_select["category_id"]) == $_GET['cid']): ?>selected='selected'<?php endif; ?> >
		                    	  	          	         <?php echo ($category_select["category_name"]); ?>
		                    	  	          </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	                      </select>
                          <button type="button" class="btn btn-primary btn-xs pull-right" id="addCategory">
                              <span class="glyphicon glyphicon-plus"></span>添加栏目
                          </button>
                    </div>
                    <div class="ibox-content">
                    	 <table class="table table-condensed table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                	<th>序号</th>
                                    <th>栏目名称</th>
                                    <th>状态</th>
                                    <th>导航栏显示</th>
                                    <th style="width:190px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>   
                            	  <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category_show): $mod = ($i % 2 );++$i;?><tr data-category-id="<?php echo ($category_show["category_id"]); ?>">
                            	  	  <td><?php echo ($i); ?></td>
                            	  	  <td>
                            	  	  	<?php if($category_show["pid"] == '0'): ?>├─<?php echo ($category_show["category_name"]); ?>(ID:<?php echo ($category_show["category_id"]); ?>)
                            	  	      <?php else: ?>
                            	  	         <?php
 $nums=substr_count($category_show['path'],'-'); echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$nums).'└'; echo str_repeat('─',$nums).$category_show['category_name'].'(ID:'.$category_show['category_id'].')'; endif; ?>	
                            	  	  </td>
                            	  	  <td>
                            	  	  	<?php if($category_show["status"] == '1' ): ?><span class="label label-primary ">显示</span>
                            	  	  		 <?php else: ?>
                            	  	  		   <span class="label label-danger">隐藏</span><?php endif; ?>
                            	  	  </td>
                            	  	  <td>
                            	  	  	 <?php if($category_show["is_nav"] == '1' ): ?><span class="label label-primary ">显示</span>
                            	  	  		 <?php else: ?>
                            	  	  		   <span class="label label-danger">隐藏</span><?php endif; ?>
                            	  	  </td>
                            	  	  <td>
                            	  	  	 <button type="button" class="btn btn-primary btn-xs filter_btn">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>筛选条件
                                          </button>
                            	  	  	 <button type="button" class="btn btn-primary btn-xs edit_category_btn">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>编辑
                                         </button>
                                         <button type="button" class="btn btn-danger btn-xs del_category_btn">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
                                         </button>
                            	  	  </td>
                            	  	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="goodCategorymodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('Category/addCategory');?>" method="POST" id="goodCategoryForm" class="form-horizontal">
                    <div class="modal-content">
        			      <div class="modal-header">
        			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			        <h4 class="modal-title" id="myModalLabel">添加栏目</h4>
        			      </div>
        			      <div class="modal-body">
        			      	  <ul class="nav nav-tabs" role="tablist">
          									    <li role="presentation" class="active">
          									    	<a href="#home" aria-controls="home" role="tab" data-toggle="tab">基本信息</a>
          									    </li>
          									    <li role="presentation">
          									    	<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">META</a>
          									   </li>
                        </ul>
                        <div class="tab-content">
                             	<div role="tabpanel" class="tab-pane active" id="home">
                                  <div class="form-group" style="margin-top:10px;">
                                      <label for="category_name" class="col-sm-3 control-label">栏目名称</label>
                                      <div class="col-sm-9">
                                         <input type="text" class="form-control" id="category_name"  name="category_name"  
                                           autocomplete="off" placeholder="栏目名称">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label">顶级分类</label>
                                      <div class="col-sm-9">
                                           <select name="pid"  class="form-control">
                                           	   <option value="0" path="0">上级分类</option>	
                                           	   <?php if(is_array($categoryOne)): $i = 0; $__LIST__ = $categoryOne;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$categoryadd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($categoryadd["category_id"]); ?>" path="<?php echo ($categoryadd["path"]); ?>">
                                           	   	   	 <?php if($categoryadd["path"] == '0' ): ?>├─<?php echo ($categoryadd["category_name"]); ?>
                                           	   	   	 <?php else: ?>
                                           	   	   	     <?php
 $nums=substr_count($categoryadd['path'],'-'); echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$nums).'└'; echo str_repeat('─',$nums).$categoryadd['category_name']; endif; ?>
                                           	   	   </option><?php endforeach; endif; else: echo "" ;endif; ?>   
                                           </select>
                                           <input type="hidden" name="path" id="path" value="0" />
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label">商品类型</label>
                                      <div class="col-sm-9">
                                           <select name="goods_type"  class="form-control">
                                           	   <option value="">请选择</option>
                                           	   <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type["goods_type_id"]); ?>"><?php echo ($type["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?> 
                                           </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="price_nums" class="col-sm-3 control-label">价格区间个数</label>
                                      <div class="col-sm-9">
                                         <input type="text" class="form-control" id="price_nums"  name="price_nums"  
                                           autocomplete="off" placeholder="价格区间个数">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label" style="line-height:15px;">导航栏</label>
                                      <div class="col-sm-9">
	                                        <label style="margin-right:20px;">
													     <input type="radio" name="is_nav"  value="1" checked>开启
											</label>
											<label>
													     <input type="radio" name="is_nav"  value="0">关闭
											</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label  class="col-sm-3 control-label" style="line-height:15px;">栏目</label>
                                      <div class="col-sm-9">
	                                        <label style="margin-right:20px;">
													     <input type="radio" name="status"  value="1" checked>显示
											</label>
											<label>
													     <input type="radio" name="status"  value="0">隐藏
											</label>
                                      </div>
                                  </div>
                             	</div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                	<div class="form-group" style="margin-top:10px;">
	                                	 <label for="keywords" class="col-sm-3 control-label">关键字</label>
	                                	 <div class="col-sm-9">
	                                	    <textarea class="form-control" autocomplete="off" rows="3" style="resize:none;" name="keywords" id="keywords"></textarea>
	                                     </div>
                                   </div>
                                   <div class="form-group">
	                                	 <label for="desc" class="col-sm-3 control-label">栏目描述</label>
	                                	 <div class="col-sm-9">
	                                	    <textarea class="form-control" autocomplete="off" rows="3" style="resize:none;" name="desc" id="desc"></textarea>
	                                     </div>
                                  </div>
                                </div>
                          </div>
                          <div id="errors" style="color:#c90000;"></div>
        			      </div>
        			      <div class="modal-footer">
        			        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        			        <button type="submit" class="btn btn-primary" id="add_good_typeAttr">确定</button>
        			      </div>
                  </div>
                </form>
            </div>
    </div>
    <div class="modal fade" id="goodCategoryFiltermodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                 <form action="<?php echo U('Category/addFilter');?>" method="POST" id="goodCategoryFilterForm" class="form-horizontal">
                    <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">筛选属性</h4>
                    </div>
                    <div class="modal-body fiter-modal-body">
                    	 
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                      <button type="submit" class="btn btn-primary" id="add_good_typeAttr">确定</button>
                    </div>
                  </div>
                </form>
            </div>
    </div>

	<script src="/mall/PUBLIC/Admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/layer/layer.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="/mall/PUBLIC/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="/mall/PUBLIC/Admin/js/bootstrapValidator.min.js"></script>
<script src="/mall/PUBLIC/Admin/js/common.js"></script>

	<script src="/mall/PUBLIC/Admin/js/category.js"></script>

</body>
</html>