$(function(){
       $("#addGoodType").on('click',function(){
    	       $("input[name=type_name]").val("");
               $("#goodtypemodel").modal({
                      keyboard:false,
                      show:true
               });
          })
        $("#goodTypeForm").bootstrapValidator({
                      message: 'This value is not valid',
                      feedbackIcons: {
                         valid: 'glyphicon glyphicon-ok',
                         invalid: 'glyphicon glyphicon-remove',
                         validating: 'glyphicon glyphicon-refresh'
                     },
                      fields: {
                           type_name: {
                               message: 'The username is not valid',
                               validators: {
                                   notEmpty: {
                                       message: '用户名不能为空'
                                   },
                                   stringLength: {
                                       min: 2,
                                       max: 10,
                                       message: '字符不能小于2,和字符不能大于10'
                                   },
                                   remote:{
                                	  type: 'POST',
                                   	  url: ThinkPHP.CheckType,
                                   	  message:'类型名称已添加',
                                   	  delay: 1000
                                   }
                               }
                           }
                       }
                       }) .on('success.form.bv', function(e) {
                           e.preventDefault();
                           var $form = $(e.target);
                           var bv = $form.data('bootstrapValidator');
                           $.post($form.attr('action'), $form.serialize(), function(result) {
                               if(result>0){
                            	     parent.layer.msg('添加商品类型成功',{
                            	    	  icon:1,
                            	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
                            	    	  shift:6
                            	    	});
                            	     setTimeout(function(){
                            	    	 window.location.href=ThinkPHP.INDEX;
                            	     },2000)
                            	     
                               }else{
                            	   $('#errors').html('添加商品类型失败').removeClass('hide');
                             	   $('#goodTypeForm').bootstrapValidator('disableSubmitButtons', false);
                               }
                           }, 'json');  
                       })   
           //删除类型
           $(".deltype").on('click',function(){
        	   var data_id=$(this).attr('data-id');
        	   parent.layer.confirm('你确定要删除商品类型？', {
        		    btn: ['确定','取消'], //按钮
        		    shade:true, //不显示遮罩
        		    skin: 'layer-ext-moon',
        		    title:'商品类型'
        		}, function(index){
        		    if(index>0){
        		    	parent.layer.close(index);
        		    	var load = parent.layer.load(1, {
        		    	    shade: [0.5,'#000'] //0.1透明度的白色背景
        		    	});
        		    	//parent.layer.close(load); 
        		    	$.post(ThinkPHP.DELETE, {"data_id":data_id},function(data){
        		    	          if(data>0){
        		    	        	  parent.layer.close(load);
        		    	        	  parent.layer.msg('删除商品类型成功',{
                            	    	  icon:1,
                            	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
                            	    	  shift:6
                            	    	});
        		    	        	 setTimeout(function(){
                             	    	 window.location.reload();
                             	     },2000)
        		    	          }else{
        		    	        	  parent.layer.close(load);
        		    	        	  parent.layer.msg('删除商品类型失败',{
                            	    	  icon:1,
                            	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
                            	    	  shift:6
                            	    	}); 
        		    	          }
        		    	          
        		    	    });
        		    }
        		});        	   
           })            
     $(".param_btn").on('click',function(){
    	 var data_url=$(this).attr('data-url');
    	 window.location.href=data_url;
     })    
     $(".Spec_btn").on('click',function(){
    	 var data_url=$(this).attr('data-url');
    	 window.location.href=data_url;
     })
   })