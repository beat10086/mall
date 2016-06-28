$(function(){
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
	
	$("#login").validate({
		submitHandler : function (form) {
			$('#login').ajaxSubmit({
				url: ThinkPHP['MODULE'] + '/Auth/login',
				type: 'POST',
				beforeSubmit: function(){
					$('#loading').dialog('open');
				},
				showErrors : function (errorMap, errorList) {
					this.defaultShowErrors();
				},
				success: function(responseText){
					if (responseText) {
						if(responseText>0){
							window.location.href=ThinkPHP.PREV_URL;
						}else{
							$('#loading').dialog('option', 'width',180).css('background', 'url(' + ThinkPHP['IMG'] + '/error.png) no-repeat 20px center').html('用户名和密码不正确...');
					    	 setTimeout(function () {
									$('#loading').dialog('close');
									$('#loading').dialog('option', 'width', 180).css('background', 'url(' + ThinkPHP['IMG'] + '/loading.gif) no-repeat 20px center').html('数据交互中...');
								}, 2000);
						}
					}
				}
			});	
		},
		rules : {
			username : {
				required : true,
				minlength : 2,
				maxlength : 20,
			},
			passwd:{
				required : true,
				minlength : 6,
				maxlength : 30,
			}
		},
		messages : {
			username : {
				required : '用户名不能为空',
				minlength : $.format('需大于{0}位'),
				maxlength : $.format('需小于{0}位！'),
			},
			passwd:{
				required : '必填',
				minlength : $.format('需大于{0}位'),
				maxlength : $.format('需小于{0}位'),
			}
		},
	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
})