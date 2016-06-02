$(function(){
	 $("#addCategory").on('click',function(){
		 $("#goodCategorymodel").modal({
			 keyboard:false,
	         show:true
		 });	 
	 })
	 //添加筛选条件
	 $(".filter_btn").on('click',function(){
		 var category_id=$(this).parents('tr').attr('data-category-id');
		 $.get(ThinkPHP.filter,{"cid":category_id},function(data){
			 if(data){
				 $(".fiter-modal-body").html("");
				 $(".fiter-modal-body").append(data);
				 $("#goodCategoryFiltermodel").modal({
					  keyboard:false,
				      show:true
				  })
		       $(".add-filter").on('click',function(){
		           var has_empty=0;
		           $(".filter_attr").each(function(){
		        	   if($(this).val()==""){
		        		   has_empty=1;
		        	   }  
		           })
		           if(has_empty){
		        	   parent.layer.alert('还有选项为空的筛选条件,你可以直接更改为空的筛选条件！', {
		        		    skin: 'layui-layer-molv' //样式类名
		        		}, function(index){
		        			 layer.close(index);
		        		});
		        	   return false;   
		           }
		           var fiter_add_div=$(this).parents('.fiter_add_div').prev();
		           $(this).parents('.fiter_add_div').before(fiter_add_div.clone()); 
		       })
			 }			 
		 },'html')
	 })
	 //不能选择相同的类型
	 $(".fiter-modal-body").on('change','.filter_attr',function(){
		    var arr_num=[];
		    $(".filter_attr").each(function(){
		    	arr_num.push($(this).val());
		    })
		    if(isRepeat(arr_num)){
		    	alert("已近选择该参数作为筛选条件！");
		    	$(this).val("");
		    	return false;
		    } 
	 })
	 
	 $(".fiter-modal-body").on('click','.del-filter',function(){
		 if($(".filter-grounp").length==1){
			  return false;
		 }
		 var filer_gounp=$(this).parents('.filter-grounp')
		 filer_gounp.fadeOut('slow',function(){
			 filer_gounp.remove();
		 }) 
	 })
	 $("select[name=pid]").on('change',function(){
		 var  _path=$(this).find(':selected').attr('path');
		 var  _val=$(this).val();
		 if(_val==0){
			  $(this).next().val(0);
		 }else{
			 _depath=_path+'-'+$(this).val();
			 $(this).next().val(_depath);
		 }
	 })
	 $(".del_category_btn").on('click',function(){
		 var _this=$(this);
		 parent.layer.confirm('你确定要删除商品栏目？', {
 		    btn: ['确定','取消'], //按钮
 		    shade:true, //不显示遮罩
 		    skin: 'layer-ext-moon',
 		    title:'商品类型'
 		   }, function(index){
 			   if(index>0){
 			     var category_id=_this.parents('tr').attr('data-category-id');
 			     parent.layer.close(index);
 			     var load = parent.layer.load(1, {
		    	    shade: [0.5,'#000'] //0.1透明度的白色背景
		    	 });
 			    $.post(ThinkPHP.DELETE, {"data_id":category_id},function(data){
	    	          if(data.result==true){
		    	           parent.layer.close(load);
		    	        	  parent.layer.msg('删除商品栏目成功',{
	              	    	  icon:1,
	              	    	  time:2000, //2秒关闭（如果不配置，默认是3秒）
	              	    	  shift:6
	              	    	});
		    	         setTimeout(function(){
	               	    	  window.location.reload();
	               	     },2000)
	    	          }else if(data.result==false){
	    	        	  parent.layer.close(load);
	    	        	  if(data.code==-1){
	    	        		  parent.layer.msg('删除失败,本栏目下还有子栏目，请删除子栏目',{
	               	    	     icon:2,
	               	    	     time:3000, //2秒关闭（如果不配置，默认是3秒）
	               	    	     shift:6
	               	    	 }); 
	    	        	  }else if(data.code==-2){
	    	        		  parent.layer.msg('删除失败,服务器错误',{
		               	    	     icon:2,
		               	    	     time:3000, //2秒关闭（如果不配置，默认是3秒）
		               	    	     shift:6
		               	    	 }); 
	    	        		  
	    	        	  }else{
	    	        		  parent.layer.msg('未知的错误',{
		               	    	     icon:2,
		               	    	     time:3000, //2秒关闭（如果不配置，默认是3秒）
		               	    	     shift:6
		               	    	 });
	    	        	  }
	    	          }
	    	          
	    	    });
 			}
 		})
	 })
	 $("#change-category").on('change',function(){
		  var cid=$(this).val();
		  if($(this).val()=='all'){
			  window.location.href=ThinkPHP.CONTROLLER+'/index/';
		  }else{
			  window.location.href=ThinkPHP.CONTROLLER+'/index/cid/'+cid;
		  }
          
		 
	 })
	 $("#goodCategoryFilterForm").bootstrapValidator({
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
                	  window.location.reload();
                 }
            }, 'json');  
        })   
	 $("#goodCategoryForm").bootstrapValidator({
         message: 'This value is not valid',
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
         fields: {
        	 category_name: {
                  message: 'The username is not valid',
                  validators: {
                      notEmpty: {
                          message: '栏目名称不能为空'
                      },
                      stringLength: {
                          min: 2,
                          max: 20,
                          message: '字符不能小于2,和字符不能大于10'
                      },
                      remote:{
                   	      type: 'POST',
                      	  url: ThinkPHP.CheckCategory,
                      	  message:'栏目名称已添加',
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
                   if(result.status==true){
                	    window.location.reload();
                   }else{
                	   if(result.code==-1){
                 		  $('#errors').html('栏目名称不能为空').removeClass('hide');
                      	  $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false); 
                 	    }else if(result.code==-2){
                 	      $('#errors').html('栏目名称已添加过').removeClass('hide');
                           $('#goodTypeAttrForm').bootstrapValidator('disableSubmitButtons', false);
                 	 }
                   }
              }, 'json');  
          })   
	 
})


