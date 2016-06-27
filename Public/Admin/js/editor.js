$(function(){
 	  	var uploadLimit='{$galleryData.limit}';
 	  	var uploadTotal='{$galleryData.total}';
 	  	window.uploadCount.uploadTotal(uploadLimit);
 	  	window.uploadCount.uploadLimit(uploadTotal);
 	  	show_arg($("select[name=goods_type_id]"));
 	  	//修改数据
 	  	$("#editorGoodsForm").bootstrapValidator({
 	         message: 'This value is not valid',
 	         feedbackIcons: {
 	            valid: 'glyphicon glyphicon-ok',
 	            invalid: 'glyphicon glyphicon-remove',
 	            validating: 'glyphicon glyphicon-refresh'
 	        }
 		 }).on('success.form.bv', function(e) {
 	            e.preventDefault();
 	            var $form = $(e.target);
 	            var bv = $form.data('bootstrapValidator');
 	            $.post($form.attr('action'), $form.serialize(), function(result) { 
 	            	 if(result>0){
 	            		window.location.href=Thinkphp.url;
 	            	 }
 	            }, 'json');  
 	        })
 	  	
})
 	  function show_arg  (obj) {
			var _good_type=obj.val();
			 $('tr.spec_list').remove();
			 $(".arg-item").remove();
			 $("#product-th").html("");
			 var goods_id=Thinkphp.goods_id;
			 $.get(Thinkphp.getTypeAttrSelect,{'good_type': _good_type,"goods_id":goods_id},function(data){
				  if(data){
					  var _spec_list=[],
		                 _spec_list_title=[],
		                 _arg_str='';
		                 if(data.param){
		                 	$.each(data.param,function(k,v){
		                 		var arg_select = ''; 
		                 		if(v.attr_may_value !=""){
		                 			v.attr_may_value=v.attr_may_value.replace(/，/g,',');
			                 		arg_select_array=v.attr_may_value.split(',');
			                 		arg_select+="<select class='form-control arg-select'><option value=''>请选择</option>"
						            		$.each(arg_select_array,function(k1,v1){
						            			   if(v1==v.attr_value){
						            			   	   arg_select+="<option selected='selected' value='"+v1+"'>"+v1+"</option>"
						            			   }else{
						            			   	   arg_select+="<option value='"+v1+"'>"+v1+"</option>"
						            			   }
						            			   
			                               });
						            arg_select+="</select>"
		                 		}
		                 		if(v.attr_value !=undefined){
		                 			_arg_str+='<div class="form-group arg-item">\
			            		         <label for="goods_type_id" class="col-sm-2 control-label">'+v.attr_name+':</label>\
			            		         <div class="col-sm-2"><input type="text" value="'+v.attr_value+'" name="attr['+v.goods_attr_id+']" id="" class="form-control arg_show" /></div>\
			            		         <div class="col-sm-2">'+arg_select+'</div>\
			            		   </div>';
		                 		}else{
		                 			_arg_str+='<div class="form-group arg-item">\
			            		         <label for="goods_type_id" class="col-sm-2 control-label">'+v.attr_name+':</label>\
			            		         <div class="col-sm-2"><input type="text"  name="attr['+v.goods_attr_id+']" id="" class="form-control arg_show" /></div>\
			            		         <div class="col-sm-2">'+arg_select+'</div>\
			            		   </div>';
		                 			
		                 		}
		                 		
		                 	})
		                 	$("#arg-title").after(_arg_str);                 	
		                 } 
		                 var _spec_tr='';
		                 if(data.product){
		                 	 $.each(data.spec,function(k,v){
		                 	 	_spec_list_title.push(v.attr_name);	
		                 	 	_spec_list.push(v);
		                 	 })
		                 	 var _spec_tr_th='';
		                 	     $.each(data.product,function(k,v2){
		                 	     	    _spec_tr+='<tr class="spec_list">';
						                 for(i=0;i<_spec_list_title.length;i++){
						                 	if(k==0){
						                 		 _spec_tr_th+='<th>'+_spec_list_title[i]+'</th>';
						                 	}
						                     _spec_list[i].attr_may_value=_spec_list[i].attr_may_value.replace(/，/g,',');
						                     var _spec_select=_spec_list[i].attr_may_value.split(",");
						                     _spec_tr+='<td>\
						                   	          <select name="spec['+k+'][spec_id]['+_spec_list[i].goods_attr_id+']" class="input-medium form-control">\
						                                 <option value="">请选择</option>';
						                     $.each(_spec_select,function(k,v){
						                     	_spec_tr+='<option'; 
						                     	 $.each(v2.select,function(k3,v3){
						                     	 	  if($.trim(v3.attr_value)==$.trim(v)){
						                     	 	  	  _spec_tr+=' selected="selected" '
						                     	 	  }
						                     	 })
					                              _spec_tr+=' value="'+$.trim(v)+'">'+$.trim(v)+'</option>';
						                     });
						                     _spec_tr+='</select></td>';
						                 }
				                            _spec_tr+='<td>\
				                                <input type="text" value="'+v2.goods_sn+'" name="spec[0][goods_sn]" id="" class="form-control" />\
				                            </td><td>\
				                            <input type="text" value="'+v2.goods_price+'" name="spec[0][goods_price]" id="" class="form-control" />\
				                            </td><td>\
				                            <input type="text" value="'+v2.sku+'" name="spec[0][SKU]" id="" class="form-control" /></td></tr>'; 	
		                 	     })
		                        
				                 _spec_tr_th+='<th>编号</th><th>价格</th><th>库存</th>';
				                  $('#product-th').html(_spec_tr_th);
		                          $('#product-th').after(_spec_tr);		
		                 }else{
		                	 $.each(data.spec,function(k,v){
			                 	 	_spec_list_title.push(v.attr_name);	
			                 	 	_spec_list.push(v);
			                 	 })
			                 	if(_spec_list_title.length > 0){
			      				  var _spec_tr_th='';
			                       _spec_tr+='<tr class="spec_list">';
			                       for(i=0;i<_spec_list_title.length;i++){
			                           _spec_tr_th+='<th>'+_spec_list_title[i]+'</th>';
			                           _spec_list[i].attr_may_value=_spec_list[i].attr_may_value.replace(/，/g,',');
			                           var _spec_select=_spec_list[i].attr_may_value.split(",");
			                           _spec_tr+='<td>\
			                         	          <select name="spec[0][spec_id]['+_spec_list[i].goods_attr_id+']" class="input-medium form-control">\
			                                       <option value="">请选择</option>';
			                           $.each(_spec_select,function(k,v){
			                               _spec_tr+='<option value="'+v+'">'+v+'</option>';
			                           });
			                           _spec_tr+='</select></td>';
			                       }
			                       _spec_tr+='<td>\
			                                      <input type="text" name="spec[0][goods_sn]" id="" class="form-control" />\
			                                  </td><td>\
			                                  <input type="text" name="spec[0][goods_price]" id="" class="form-control" />\
			                                  </td><td>\
			                                   <input type="text" name="spec[0][SKU]" id="" class="form-control" /></td></tr>';
			                       _spec_tr_th+='<th>编号</th><th>价格</th><th>库存</th>';
			                       $('#product-th').html(_spec_tr_th);
			                       $('#product-th').after(_spec_tr);	  
			      			  }
		                	 
		                 }
		                 
				  }
			 },'json')
}