var options={
		xzoom:400,
		yzoom:400,
	}
$(function(){
	$('.jqzoom').jqueryzoom(options);	
//	        相册左右移动
	$('.gallery-move').click(function() {
	    var move_left = $(this).hasClass('moveL'),
	            show = 5,
	            li_num = $('#thumblist li').length;
	    if (move_left) {
	        var _ul = $(this).next(),
	                _left = parseInt(_ul.css('left')) - 64;
	        _max = (li_num - show) * -60;
	        if (_left >= _max) {
	            _ul.animate({"left": _left + "px"}, 500);
	        }
	    } else {
	        var _ul = $(this).prev(),
	                _left = parseInt(_ul.css('left')) + 64;
	        if (_left <= 20) {
	            _ul.animate({"left": _left + "px"}, 500);

	        }
	    }
	});
	
})

function preview(img){
	    $("#thumblist  li img").removeClass('zoomThumbActive');
	    $(img).addClass('zoomThumbActive');
		$("#preview .jqzoom img").attr("src",$(img).attr("smallImage"));
		$("#preview .jqzoom img").attr("jqimg",$(img).attr("largeimage"));
	}
