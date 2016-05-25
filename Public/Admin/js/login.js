$(function(){
	$("#loginForm").bootstrapValidator({
		   message: 'This value is not valid',
		   feedbackIcons: {
               valid: 'glyphicon glyphicon-ok',
               invalid: 'glyphicon glyphicon-remove',
               validating: 'glyphicon glyphicon-refresh'
           },
           fields: {
               username: {
                   message: 'The username is not valid',
                   validators: {
                       notEmpty: {
                           message: '用户名不能为空'
                       },
                       stringLength: {
                           min: 1,
                           max: 20,
                           message: '字符不能小于5,和字符不能大于20'
                       }
                   }
               },
               passwd: {
                   validators: {
                       notEmpty: {
                           message: '密码不能为空'
                       }
                   }
               },
               code:{
            	   validators: {
                       notEmpty: {
                           message: '验证不能为空'
                       }
                   }
               }
           }
       }) .on('success.form.bv', function(e) {
    	   e.preventDefault();
    	   var $form = $(e.target);
    	   var bv = $form.data('bootstrapValidator');
    	   $.post($form.attr('action'), $form.serialize(), function(result) {
    		   if(result.result=="true"){
    			   window.location.href=ThinkPHP.INDEX;   
    		   }else if(result.result=="false"){
    			   if(result.code=='-2'){
    				   $('#errors').html('用户名和密码不错').removeClass('hide');
                	   $('#loginForm').bootstrapValidator('disableSubmitButtons', false);
    			   }else if(result=='-1'){
    				   $('#errors').html('用户名长度5到20位字符').removeClass('hide');
                 	   $('#loginForm').bootstrapValidator('disableSubmitButtons', false);
    			   }else if(result.code=='-3'){
    				   $('#errors').html('验证码不能为空').removeClass('hide');
                 	   $('#loginForm').bootstrapValidator('disableSubmitButtons', false); 
    			   }else if(result.code=='-4'){
    				   $('#errors').html('验证码不正确').removeClass('hide');
                 	   $('#loginForm').bootstrapValidator('disableSubmitButtons', false);
    			   }   
    			   if(parseInt(result.login_num) >3){
    				    $(".show_code").addClass('show');
    			   }
    		   }
           }, 'json');  
       })	
       var verifyimg = $("#get_img").attr('src');
       $("#get_img").on('click',function(){
	    	if (verifyimg.indexOf('?') > 0) {
	   			$(this).attr('src', verifyimg + '&random=' + Math.random());
	   		}else {
	   			$(this).attr('src', verifyimg + '?random=' + Math.random());
	   		}
       })
})