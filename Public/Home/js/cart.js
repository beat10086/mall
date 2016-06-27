$(function(){
	select_all('cart-list');
	$("input[name=select-name]").on('click',function(){
		var cart_len=$(".cart-item").length;
		if($(this).prop('checked')){
			 $(this).parents('.cart-item').addClass('checked');
		   }else{
			 $(this).parents('.cart-item').removeClass('checked');	
		}
		if($(".checked").length==cart_len){
			 $(".select-all").prop('checked',true);
		   }else{
			 $(".select-all").prop('checked',false);
		}
		product_total();
	})
})
function select_all (id,class_name,name) {
	 var class_name = class_name || 'select-all',name = name || 'select-name';
	 $("."+class_name).on('click',function(){
		  if($(this).prop('checked')){
			  $('.'+class_name).prop('checked',true);
              $('#'+id+' :checkbox[name="'+name+'"]').prop('checked',true);
              $(".cart-item").addClass('checked');
              product_total();
		  }else{
			  $('.'+class_name).prop('checked',false);
              $('#'+id+' :checkbox[name="'+name+'"]').prop('checked',false);
              $(".cart-item").removeClass('checked');
              product_total();
		  }
	 })	
}

//计算商品的价格
function  product_total  ()　{
	var _checked=$(".cart-content .checked");
	var _price_total=0;
	if(_checked.length>0){
		$.each(_checked,function(k){
			_price_total+=parseFloat(_checked.eq(k).find('.goods-price').html())*parseFloat(_checked.eq(k).find('.item-nums').val())
		})
		$(".total-price p span b").html(_price_total.toFixed(2));
	  }else{
		 $(".total-price p span b").html("0.00");
	}
}
