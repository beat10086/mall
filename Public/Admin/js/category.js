$(function(){
	 $("#addCategory").on('click',function(){
		 $("#goodCategorymodel").modal({
			 keyboard:false,
	         show:true
		 });	 
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