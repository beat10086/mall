$(function(){
	//loading提示
	$('#loading').dialog({
		width : 180,
		height : 40,
		closeOnEscape : false,
		modal : true,
		resizable : false,
		draggable : false,
		autoOpen : false,
	}).parent().find('.ui-widget-header').hide();
	//验证并提交数据
	$("#account").validate({
		submitHandler : function (form) {
			$('#account').ajaxSubmit({
				url: ThinkPHP['MODULE'] + '/Auth/saveUserInfo',
				type: 'POST',
				beforeSubmit: function(){
					$('#loading').dialog('open');
				},
				success: function(responseText){
					 if(responseText){
						  if(responseText>0){
							     $('#loading').dialog('option', 'width',240).css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('修改资料成功...');
							  setTimeout(function(){
								  $('#loading').dialog('close');
								  $('#loading').dialog('option', 'width', 240).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
							  },1000)
						  }else{
							  $('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('修改用户信息失败...');
						      setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);
						  } 
					 }
				}	
			})
		},
		highlight : function (element, errorClass) {
			$(element).css('border', '1px solid red');
			$(element).parent().find('span').removeClass('succ');
		},
		unhighlight : function (element, errorClass) {
			$(element).css('border', '1px solid #ccc');
			$(element).parent().find('span').addClass('succ');
		},
		rules : {
		    nickname:{
		    	required : true,
		    	minlength : 2,
				maxlength : 30,
		    },
		    realname:{
		    	required : true,
		    }
			
		},
		messages : {
		   nickname :{
			   required : '昵称不能为空',
			   minlength : $.format('账户名和登陆大于{0}位'),
			   maxlength : $.format('账户名和登陆小于{0}位！'),
		   },
		   realname:{
			   required : '真实姓名不能为空',
		   }
		},
	});
	
	
	
	
	
	
	
})