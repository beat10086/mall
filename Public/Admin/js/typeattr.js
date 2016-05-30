$(function(){
	$("#addGoodTypeAttr").on('click',function () {
		$("input[name=attr_name]").val("");
		$("textarea[name=attr_may_value]").val("");
		$("#goodtypeAttrmodel").modal({
			keyboard:false,
            show:true
		})		
	})
	check_fun($("#goodTypeAttrForm"));
	check_editor_fun($("#editorTypeAttrForm"));
	//修改排序
    var old_sort="";
	$(".attr_sort").focus(function(){
		old_sort=$(this).val();
	})
	
	$(".attr_sort").blur(function(){
		var new_sort=$(this).val();
		var goods_attr_id=$(this).parents('tr').attr('data-goods-attr');
		var _that=$(this);
		if(old_sort != new_sort){
			var data={
				  'goods_attr_id':goods_attr_id,
				  'sort':new_sort,
				  'type':0
			}
			$.post(ThinkPHP.CONTROLLER+'/editorTypeAttr',data,function(data){
				 if(data.status==true){
					 window.location.reload();
				 }else{
					 _that.val(old_sort);
				 }
			})
		}
		
	})
	$(".edit_attr_btn").on('click',function(){
		var goods_attr_id=$(this).parents('tr').attr('data-goods-attr');
		var data={
				  'goods_attr_id':goods_attr_id	  
			}
		$.post(ThinkPHP.CONTROLLER+'/getTypeAttr',data,function(data){
			 if(data.result==true){
				 $("input[name=attr_name_editor]").val(data.attr_name);
				 $("input[name=attr_type_editor]").attr('checked',false);
				 $("input[name=attr_type_editor]").eq(data.attr_type).prop('checked',true);
				 $("textarea[name=attr_may_value_editor]").val(data.attr_may_value);
				 $("input[name=goods_attr_id]").val(data.goods_attr_id);
				 $("#editortypeAttrmodel").modal({
						keyboard:false,
			            show:true
					})		
			 }else{
				 parent.layer.msg('服务器发生错误!',{
	       	    	  icon:2,
	       	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
	       	    	  shift:6
     	    	});
			 }
		},'json')
	})
	$("#change-type").on('change',function(){
		window.location.href=ThinkPHP.CONTROLLER+'/typeAttr/typeid/'+$(this).val()+'/name/'+$(this).find(':selected').text(); 
	})
	$("#change-param").on('change',function(){
		var type=$(this).val();
		if(type==""){
			window.location.href=ThinkPHP.CONTROLLER+'/typeAttr/typeid/'+ThinkPHP.typeid+'/name/'+ThinkPHP.name;	
		}else if(type==0){
			window.location.href=ThinkPHP.CONTROLLER+'/typeAttr/typeid/'+ThinkPHP.typeid+'/name/'+ThinkPHP.name+'/type/0';	
		}else{
			window.location.href=ThinkPHP.CONTROLLER+'/typeAttr/typeid/'+ThinkPHP.typeid+'/name/'+ThinkPHP.name+'/type/1';	
		}
	})
})
function check_fun (formObj) {
	formObj.bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
       },
        fields: {
        	attr_name: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '参数名称不能为空'
                    }
                }
            },
            attr_may_value:{
            	message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '可选值不能为空'
                    }
                }
            }
        }
         }) .on('success.form.bv', function(e) {
             e.preventDefault();
             var $form = $(e.target);
             var bv = $form.data('bootstrapValidator');
             $.post($form.attr('action'), $form.serialize(), function(result) {
                 if(result.status==true){
                	   if(result.code >0){
                		   var href_target=ThinkPHP.CONTROLLER+'/typeAttr/typeid/'+result.typeId+'/name/'+result.name+'/type/'+result.type;
                		   parent.layer.msg('商品类型参数或规格成功',{
                 	    	  icon:1,
                 	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
                 	    	  shift:6
                 	    	});
                		   setTimeout(function(){
                			   window.location.href=href_target;
                		   },2000)
                	   }
                    }else{
                	 if(result.code==-1){
                		  $('#errors').html('参数名称不能为空').removeClass('hide');
                     	  $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false); 
                	    }else if(result.code==-2){
                	      $('#errors').html('预可选值不能为空').removeClass('hide');
                          $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false);
                	 } 
                 }
             }, 'json');  
         })   
}
function check_editor_fun (formObj) {
	formObj.bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
           valid: 'glyphicon glyphicon-ok',
           invalid: 'glyphicon glyphicon-remove',
           validating: 'glyphicon glyphicon-refresh'
       },
        fields: {
        	attr_name_editor: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '参数名称不能为空'
                    }
                }
            },
            attr_may_value_editor:{
            	message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: '可选值不能为空'
                    }
                }
            }
        }
         }) .on('success.form.bv', function(e) {
             e.preventDefault();
             var $form = $(e.target);
             var bv = $form.data('bootstrapValidator');
             $.post($form.attr('action'), $form.serialize(), function(result) {
            	 if(result.status==true){
                	   if(result.code>0){
                		   parent.layer.msg('修改商品类型参数或规格成功',{
                 	    	  icon:1,
                 	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
                 	    	  shift:6
                 	    	});
                		   setTimeout(function(){
                			   window.location.reload();
                		   },2000)
                	   }
                    }else{
                	 if(result.code==-1){
                		  $('#errors').html('参数名称不能为空').removeClass('hide');
                     	  $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false); 
                	    }else if(result.code==-2){
                	      $('#errors').html('预可选值不能为空').removeClass('hide');
                          $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false);
                	 }else if(result.code==0){
                		 $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false);
                	 } 
                 }
             }, 'json');  
         })   
	
	
	
	
}
