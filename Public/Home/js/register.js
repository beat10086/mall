$(function(){
	var verifyimg = $("#captcha").attr('src');
	$("#captcha").on('click',function(){
		    	if (verifyimg.indexOf('?') > 0) {
		   			$(this).attr('src', verifyimg + '&random=' + Math.random());
		   		}else {
		   			$(this).attr('src', verifyimg + '?random=' + Math.random());
		   		}
	})
	//邮箱补全功能
	$('#email').autocomplete({
		delay : 0,
		autoFocus : true,
		source : function (request, response) {
			//获取用户输入的内容
			//alert(request.term);
			//绑定数据源的
			//response(['aa', 'aaaa', 'aaaaaa', 'bb']);
			
			var hosts = ['qq.com', '163.com', '263.com', 'sina.com.cn','gmail.com', 'hotmail.com'],
				term = request.term,		//获取用户输入的内容
				name = term,				//邮箱的用户名
				host = '',					//邮箱的域名
				ix = term.indexOf('@'),		//@的位置
				result = [];				//最终呈现的邮箱列表
				
				
			result.push(term);
			
			//当有@的时候，重新分别用户名和域名
			if (ix > -1) {
				name = term.slice(0, ix);
				host = term.slice(ix + 1);
			}
			
			if (name) {
				//如果用户已经输入@和后面的域名，
				//那么就找到相关的域名提示，比如bnbbs@1，就提示bnbbs@163.com
				//如果用户还没有输入@或后面的域名，
				//那么就把所有的域名都提示出来
				var findedHosts = (host ? $.grep(hosts, function (value, index) {
						return value.indexOf(host) > -1
					}) : hosts),
					findedResult = $.map(findedHosts, function (value, index) {
					return name + '@' + value;
				});
				
				result = result.concat(findedResult);
			}
			
			response(result);
		},	
	});
	//注册
	$("#register").validate({
		submitHandler : function (form) {
			$('#register').ajaxSubmit({
				url: ThinkPHP['MODULE'] + '/Auth/register',
				type: 'POST',
				data: {
					verify: $('#verify').val(),
				},
				beforeSubmit: function(){
					$('#loading').dialog('open');
				},
				showErrors : function (errorMap, errorList) {
					this.defaultShowErrors();
				},
				success: function(responseText){
					if (responseText) {
						  if(responseText>0){
							    $('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/success.gif) no-repeat 20px center').html('数据新增成功...');
							    setTimeout(function(){
									if (verifyimg.indexOf('?') > 0) {
										$('.captcha').attr('src', verifyimg + '&random=' + Math.random());
									}
									else {
										$('.captcha').attr('src', verifyimg + '?random=' + Math.random());
									}
									$('#loading').dialog('close');
									$('#register').resetForm();
									$('span.star').html('*').removeClass('succ');
									$('#loading').css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
								    if(ThinkPHP.PREV_URL){
								    	window.location.href=ThinkPHP.PREV_URL;
								    }else{
								    	window.location.href=ThinkPHP.INDEX;
								    }
									
							    }, 1000);
						  
						  }else if(responseText==-1){
						    	 $('#loading').dialog('option', 'width', 240).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('账号名和登陆名不正确...');
						    	 setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);	 
						     }else if(responseText==-2){
						    	 $('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('密码不正确...');
						    	 setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);
						     }else if(responseText==-3){
						    	 $('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('两次密码不正确...');
						    	 setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);
						     }else if(responseText==-4){
						    	 $('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('邮箱格式不正确...');
						    	 setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);
						     }else if(responseText==-5){
						    	 $('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('验证码不正确...');
						    	 setTimeout(function () {
										$('#loading').dialog('close');
										$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
									}, 2000);
						     }
					}
				}
			});
		},
		highlight : function (element, errorClass) {
			if($(element).attr('name')=='code'){
				 return false;
			}
			$(element).css('border', '1px solid red');
			$(element).parent().find('span').html('*').removeClass('succ');
		},
		unhighlight : function (element, errorClass) {
			if($(element).attr('name')=='code'){
				 return false;
			}
			$(element).css('border', '1px solid #ccc');
			$(element).parent().find('span').html('&nbsp;').addClass('succ');
		},
		rules : {
			username : {
				required : true,
				minlength : 2,
				maxlength : 20,
				inAt :true,
				remote : {
					url : ThinkPHP['MODULE'] + '/Auth/checkUserName',
					type : 'POST',
					beforeSend : function () {
						$('#username').parent().find('span').html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete : function (jqXHR) {
						if (jqXHR.responseText == 'true') {
							$('#username').parent().find('span').html('&nbsp;').removeClass('loading').addClass('succ');
						} else {
							$('#username').parent().find('span').html('*').removeClass('succ').removeClass('loading');
						}
					}
				},
			},
			passwd:{
				required : true,
				minlength : 6,
				maxlength : 30,
			},
			repasswd:{
				required : true,
				equalTo : '#passwd',
			},
			email:{
				required : true,
				email : true,
				remote : {
					url : ThinkPHP['MODULE'] + '/Auth/checkEmail',
					type : 'POST',
					beforeSend : function () {
						$('#email').next().html('&nbsp;').removeClass('succ').addClass('loading');
					},
					complete : function (jqXHR) {
						if (jqXHR.responseText == 'true') {
							$('#email').parent().find('span').html('&nbsp;').removeClass('loading').addClass('succ');
						} else {
							$('#email').parent().find('span').html('*').removeClass('succ').removeClass('loading');
						}
					}
				},
			},
		},
		messages : {
			username : {
				required : '账户名和登陆不能为空',
				minlength : $.format('账户名和登陆大于{0}位'),
				maxlength : $.format('账户名和登陆小于{0}位！'),
				inAt : '支持中文、字母、数字、“_”的组合，2-20个字符',
				remote:'帐号被占用！'
			},
			passwd:{
				required : '密码不能为空',
				minlength : $.format('密码不得小于{0}位！'),
				maxlength : $.format('密码不得大于{0}位！'),
			},
			repasswd:{
				required : '密码确认不得为空！',
				equalTo : '密码和密码确认必须一致！',
			},
			email:{
				required : '邮箱不得为空！',
				email : '邮箱格式不正确！',
				remote : '邮箱被占用！',
			},
		},
	});
	//自定义验证，不包含@
	$.validator.addMethod('inAt', function (value, element) {
		var text = /^[\u4E00-\u9FA5a-zA-Z0-9_]{2,20}$/;
		return this.optional(element) || (text.test(value));
	}, '存在@符号');
	//loading
	$('#loading').dialog({
		width : 180,
		height : 40,
		closeOnEscape : false,
		modal : true,
		resizable : false,
		draggable : false,
		autoOpen : false,
	}).parent().find('.ui-widget-header').hide();
})

