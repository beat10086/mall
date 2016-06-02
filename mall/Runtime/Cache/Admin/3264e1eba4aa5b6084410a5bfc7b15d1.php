<?php if (!defined('THINK_PATH')) exit(); if($cate_filter): if(is_array($cate_filter)): foreach($cate_filter as $key=>$cate_filter_1): echo ($cate_filter_1); ?>
		  <div class="form-group filter-grounp"> 
                    	<div class="col-sm-2">
                    	  	  	  	  <button type="button" class="btn btn-primary del-filter">
                                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                      </button>
                         </div>
                         <div class="col-sm-10 ">
                    	  	  	  	  <select name="filter_attr[]" class="form-control filter_attr">
                    	  	  	  	  	  <option value="">请选择</option>
                    	  	  	  	  	  <?php if(is_array($type_attr)): $i = 0; $__LIST__ = $type_attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_attr_1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type_attr_1["goods_attr_id"]); ?>" <?php if(($type_attr_1["goods_attr_id"]) == $cate_filter_1): ?>selected='selected'<?php endif; ?>  ><?php echo ($type_attr_1["attr_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    	  	  	  	  </select>
                    	 </div>
         </div><?php endforeach; endif; ?>
<?php else: ?>
<div class="form-group filter-grounp"> 
                    	<div class="col-sm-2">
                    	  	  	  	  <button type="button" class="btn btn-primary del-filter">
                                          <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                      </button>
                         </div>
                         <div class="col-sm-10 ">
                    	  	  	  	  <select name="filter_attr[]" class="form-control filter_attr">
                    	  	  	  	  	  <option value="">请选择</option>
                    	  	  	  	  	  <?php if(is_array($type_attr)): $i = 0; $__LIST__ = $type_attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type_attr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($type_attr["goods_attr_id"]); ?>"><?php echo ($type_attr["attr_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    	  	  	  	  </select>
                    	 </div>
</div><?php endif; ?>
<div class="form-group fiter_add_div"> 
                        	<div class="col-sm-12">
                        		<button type="button" class="btn btn-primary pull-right add-filter">
                                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                        	</div>
</div>
<input type="hidden" name="cid" value="<?php echo ($cid); ?>">