/*
 * 相册上传插件
*/
$(function(){
	var galler_pic={
			uploadTotal:0,
			uploadLimit:8,
			uploadify:function(){
				 $("#gallery_pic").uploadify({
					 swf:Thinkphp.uploadify+'/uploadify.swf',
					 uploader:Thinkphp['GALLERY'],
					 width : 120,
				     height : 30,
				     buttonText : '上传商品图片',
					 buttonCursor : 'pointer',
					 fileTypeExts : '*.jpeg; *.jpg; *.png; *.gif',
					 fileSizeLimit : '1MB',
					 multi:true,
					 overrideEvents : ['onSelectError','onDialogClose','onSelect'],
					 onSelectError : function (file,errorCode, errorMsg) {
							switch(errorCode){
							   case -110:
								   parent.layer.msg('超过1024KB...');
							   break;  
							}
						},
					onUploadStart : function () {
					  if (galler_pic.uploadTotal == 8) {
						  $("#gallery_pic").uploadify('stop');
						  $("#gallery_pic").uploadify('cancel');
						  parent.layer.alert('限制为8张...'); 
						}else{
							$(".mall_pic_list").append('<div class="weibo_pic_content"><span class="remove"></span><span class="text">删除</span><img src="' + Thinkphp['IMG'] + '/loading_100.png" class="weibo_pic_img"></div>');
						}	
					},
					onUploadSuccess:function(file, data, response){
						    if(data){
						    	$('.mall_pic_list').append('<input type="hidden" name="images[]" value=' + data + '>');
						    	var imageUrl = $.parseJSON(data);
						    	galler_pic.thumb(imageUrl['unfold']);
						    	galler_pic.hover();
						    	galler_pic.remove();
						    	galler_pic.uploadTotal++;
						    	galler_pic.uploadLimit--;
						    	$(".weibo_pic_total").html(galler_pic.uploadTotal);
						    	$('.weibo_pic_limit').text(galler_pic.uploadLimit);
						    }
						}
					 
				 })
			},
			thumb:function(src){
				var img = $('.weibo_pic_img');
				var len = img.length;
				$(img[len - 1]).attr('src',Thinkphp['ROOT'] + src).hide();
				setTimeout(function () {
					if ($(img[len - 1]).width() > 100) {
						$(img[len - 1]).css('left', -($(img[len - 1]).width() - 100) / 2);
					}
					if ($(img[len - 1]).height() > 100) {
						$(img[len - 1]).css('top', -($(img[len - 1]).height() - 100) / 2);
					}
					$(img[len - 1]).attr('src', Thinkphp['ROOT'] + src).fadeIn();
				}, 50);
			},
			hover:function(){
				var content = $('.weibo_pic_content');
				var len = content.length;
				$(content[len - 1]).hover(function () {
					$(this).find('.remove').show();
					$(this).find('.text').show();
				}, function () {
					$(this).find('.remove').hide();
					$(this).find('.text').hide();
				});
			},
			remove:function(){
				var remove = $('.weibo_pic_content .text');
				var len = remove.length;
				$(remove[len - 1]).on('click',function(){
					$(this).parent().next('input[name="images"]').remove();
					$(this).parent().remove();
					galler_pic.uploadTotal--;
					galler_pic.uploadLimit++;
					$('.weibo_pic_total').text(galler_pic.uploadTotal);
					$('.weibo_pic_limit').text(galler_pic.uploadLimit);
				})	
			},
			init:function(){
				galler_pic.uploadify();
			}	
	}
	galler_pic.init();	 
})