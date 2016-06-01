$(function(){
	$("#brandType").on('click',function(){
		 $("input[name=brand_name]").val("");
		 $("input[name=brand_name_en]").val("");
		 $("input[name=brand_logo_url]").val("");
		 $("input[name=website]").val("");
		 $("textarea[name=desc]").val("");
		 $("#brandmodel").modal({
             keyboard:false,
             show:true
        });
	})
    $("#brand_logo").uploadify({
		swf:Think.uploadify+'/uploadify.swf',
		uploader:Think['IMAGEURL'],
		width : 120,
		height : 30,
		buttonText : '上传图片LGOO',
		buttonCursor : 'pointer',
		fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
		fileSizeLimit : '1MB',
		overrideEvents : ['onSelectError','onDialogClose','onSelect'],
		onSelectError : function (file,errorCode, errorMsg) {
			switch(errorCode){
			   case -110:
				   parent.layer.msg('超过1024KB...');
			   break;  
			}
		},
		onUploadSuccess:function(file, data, response){
		     $("input[name=brand_logo_url]").val(data);
		}	
	})
	//验证品牌
	 $("#brandForm").bootstrapValidator({
                      message: 'This value is not valid',
                      feedbackIcons: {
                         valid: 'glyphicon glyphicon-ok',
                         invalid: 'glyphicon glyphicon-remove',
                         validating: 'glyphicon glyphicon-refresh'
                     },
                      fields: {
                    	  brand_name: {
                               message: 'The username is not valid',
                               validators:{
                                   notEmpty: {
                                       message: '品牌名称不能为空'
                                   },
                                  stringLength: {
                                	  min: 2,
                                      max: 45,
                                      message: '字符不能小于2,和字符不能大于45'  
                                  },
                                  remote:{
                                	  type: 'POST',
                                   	  url: Think.checkBrand,
                                   	  message:'品牌已添加',
                                      delay: 1000
                                   },
                               }
                           },
                           brand_name_en:{
                        	   message: 'The username is not valid',
                        	   validators:{
                                   notEmpty: {
                                       message: '品牌英文名称不能为空'
                                   },
                               }
                           },
                           website:{
                        	   validators:{
                        		   uri: {
                                       message: '不是url地址'
                                   },
                               }
                           }
 
                       }
                       }) .on('success.form.bv', function(e) {
                           e.preventDefault();
                           var $form = $(e.target);
                           var bv = $form.data('bootstrapValidator');
                           $.post($form.attr('action'), $form.serialize(), function(result) {
                        	    if(result.result==true){
                        	    	  window.location.reload();
                        	    }else if(result.result==false){
                        	    	if(result.code==-3){
                        	    	   $('#errors').html('请上传图片的LOGO').removeClass('hide');
                                  	   $('#brandForm').bootstrapValidator('disableSubmitButtons', false);
                        	    	}else if(result.code==-1){
                        	    		$('#errors').html('请输入品牌名称').removeClass('hide');
                                    	$('#brandForm').bootstrapValidator('disableSubmitButtons', false);
                        	    	}else if(result.code==-2){
                        	    		$('#errors').html('品牌已添加').removeClass('hide');
                                    	$('#brandForm').bootstrapValidator('disableSubmitButtons', false);
                        	    	}	
                        	    }
                           }, 'json');  
                       })
       $(".show_status").on('click',function(){
    	    var data_status=$(this).attr('data-status');
    	    var _that=$(this);
    	    var data_brand_id=$(this).parents('tr').attr('data-brand-id');
    	    var data={
    	    	'brand_id':data_brand_id,
    	    	'status':data_status,
    	    	'type':0
    	    }
    	    $.post(Think.editBrand,data,function(data){
    	    	 if(data>0){
    	    		if(data_status==0){
    	    			_that.attr('data-status',1);
    	    			_that.html("显示");
    	    		}else{
    	    			_that.attr('data-status',0);
    	    			_that.html("隐藏");
    	    		}
    	    	 }
    	    },'json')
       })
      $(".edit_brand_btn").on('click',function(){
    	   alert('后期开发中');
      })
      $(".del_brand_btn").on('click',function(){
    	  var data_brand_id=$(this).parents('tr').attr('data-brand-id');
    	  var _tr=$(this).parents('tr');
    	  var data={
      	    	'brand_id':data_brand_id
      	  }
    	  $.post(Think.delBrand,data,function(data){
 	    	 if(data>0){
 	    		 _tr.fadeOut('slow',function(){
                     _tr.remove();
                 });
 	    	 }
 	    },'json')
    	  
    	  
      })
})