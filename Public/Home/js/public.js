/*
 * 页面共用JS效果
 */
$(function(){


	//导航栏- 栏目分类
	$('#cate').hover(function(){
		if($('#cate-list').is(':hidden')){
			$('#cate-list').fadeIn(200);
		}else{
			$(this).attr('is-show','1');//默认就是显示的，如首页。
		}
	},function(){
		if(!$(this).attr('is-show')){
			$('#cate-list').hide();
		}
	});
$('#cate-list-show li').hover(function(){
	$(this).addClass('item-hover');
	$(this).children('.item-list').animate({"top":'5px'},600);
	var _this_top=$(this).position().top,
		_child_height=$(this).children('.item-list').height();
	if(_this_top>_child_height){
		$(this).children('.item-list').css('top',(_this_top+45-_child_height));
	}
},function(){
	$(this).removeClass('item-hover');
	$(this).children('.item-list').animate({"top":'-8px'},600);
});
$('#cate-list-show .item-list-close').click(function(){
	$(this).parent().hide();
	return false;
});

});