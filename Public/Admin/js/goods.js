$(function(){
	window.UEDITOR_CONFIG.initialFrameHeight=400;
	var ue = UE.getEditor('editor');
	$('#reservation').daterangepicker({
		format : 'YYYY-MM-DD',
		locale : {
			applyLabel : '确定',
			cancelLabel : '取消',
			fromLabel : '起始时间',
			toLabel : '结束时间',
			daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
			monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
			firstDay : 1	
		}
	},function(start,end,label){
		$("input[name=reservation]").val(start.format('YYYY-MM-DD')+' - '+end.format('YYYY-MM-DD'));
		$("input[name=promote_stime]").val(start.format('YYYY-MM-DD'));
		$("input[name=promote_etime]").val(end.format('YYYY-MM-DD'));
	});
	$("input[name=is_promote]").on('click',function(){
		change_promote();
	})
	$("select[name=goods_type_id]").on('change',function(){
		show_arg($(this));
		 
	})	
	$('#add-product').click(function(){
        var _tr=$(this).parents('tr'),
        _index = $('#product tr').length-2;
        new_tr = _tr.prev().html().replace(/name="spec\[\d+\]/g,'name="spec\['+_index+'\]');
        _tr.before('<tr class="spec_list">'+new_tr+'</tr>');
        return false;
    });
	//上传缩略图
	$("#show_pic").uploadify({
		swf:Thinkphp.uploadify+'/uploadify.swf',
		uploader:Thinkphp['IMAGEURL'],
		width : 120,
		height : 30,
		buttonText : '上传商品图片',
		buttonCursor : 'pointer',
		fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
		fileSizeLimit : '1MB',
		multi:false,
		overrideEvents : ['onSelectError','onDialogClose','onSelect'],
		onSelectError : function (file,errorCode, errorMsg) {
			switch(errorCode){
			   case -110:
				   parent.layer.msg('超过1024KB...');
			   break;  
			}
		},
		onUploadSuccess:function(file, data, response){
		    if(data){
		    	$("input[name=thunb_pic]").val(data);
		    	var data= JSON.parse(data); 
		    	$(".thumb_img").attr('src',Thinkphp.ROOT+data.unfold);
		    	
		    }
		}	
	})
	//提交商品的数据
	$("#addGoodsForm").bootstrapValidator({
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
                	  parent.layer.msg('上传商品成功！');
                	  setTimeout(function(){
                		  window.location.href=Thinkphp.ADDGOODS;
               	     },2000)     	  
                }else{
                	if(result==-1){
                		parent.layer.msg('请输入商品名称');
                		$('#addGoodsForm').bootstrapValidator('disableSubmitButtons', false);
                	}else if(result==-2){
                		parent.layer.msg('请输入商品栏目');
                		$('#addGoodsForm').bootstrapValidator('disableSubmitButtons', false);
                	} 	 
                 }
            }, 'json');  
        })
	change_promote ();
	show_arg($("select[name=goods_type_id]"));
})

$(document).on('change','.arg-select',function(){
	var _val=$(this).val();
	$(this).parents('.arg-item').find('.arg_show').val(_val);
})
function change_promote () {
	  var is_checked=$("input[name=is_promote]").prop('checked');
	  if(is_checked){
		  $(".promote_ele").removeClass('hide');
		  $("#promote_price").attr('disabled',false);
		  $("input[name=reservation]").attr('disabled',false);
	  }else{
		  $(".promote_ele").addClass('hide');
		  $("#promote_price").attr('disabled',true);
		  $("input[name=reservation]").attr('disabled',true);
	  }
}
function show_arg  (obj) {
	var _good_type=obj.val();
	 $('tr.spec_list').remove();
	 $(".arg-item").remove();
	 $("#product-th").html("");
	 $.get(Thinkphp.getTypeAttr,{'good_type': _good_type},function(data){
		  if(data){
			  var _spec_list=[],
                 _spec_list_title=[],
                 _arg_str='';
			  $.each(data,function(k,v){
			    	  //1.代表规格 0.代表参数
			    	  if(v.attr_type==1){
			    		  _spec_list.push(v);
			    		  _spec_list_title.push(v.attr_name);
			               }else{
			            	var arg_select = ''; 	   
			            	if(v.attr_may_value !=""){
			            		v.attr_may_value=v.attr_may_value.replace(/，/g,',');
			            		arg_select_array=v.attr_may_value.split(',');
			            		arg_select+="<select class='form-control arg-select'><option value=''>请选择</option>"
			            		$.each(arg_select_array,function(k,v){
			            			arg_select+="<option value='"+v+"'>"+v+"</option>"
                               });
			            		arg_select+="</select>"
			            	}   
			            	_arg_str+='<div class="form-group arg-item">\
			            		         <label for="goods_type_id" class="col-sm-2 control-label">'+v.attr_name+':</label>\
			            		         <div class="col-sm-2"><input type="text" name="attr['+v.goods_attr_id+']" id="" class="form-control arg_show" /></div>\
			            		         <div class="col-sm-2">'+arg_select+'</div>\
			            		       </div>';
			    	  }	  
			   })
			  $("#arg-title").after(_arg_str);
			  var _spec_tr='';
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
	 },'json')
}
