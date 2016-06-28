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
	//原来商品的数量
	$('input.item-nums').focus(function() {
        $(this).attr('old-nums', $(this).val());
    });
	$('input.item-nums').blur(function() {
        var nums = $(this).val();
        if (/^\d+$/.test(nums) == false) {
            alert('请输入一个数字!');
            $(this).val($(this).attr('old-nums'));
            return false;
        }
        var cart_id = $(this).parents('div.cart-item').attr('cart-id');
        updateCartNums(cart_id, nums);
    });
	$(".plus").on('click',function(){
		var nums = $(this).prev().val(); 
		var cart_id = $(this).parents('div.cart-item').attr('cart-id');
		nums++;
		$(this).prev().val(nums);
		updateCartNums(cart_id, nums);	
	})
	$(".minus").on('click',function(){
		var nums = $(this).next().val(); 
		var cart_id = $(this).parents('div.cart-item').attr('cart-id');
		if(nums==1){
			 return false;
		}
		nums--;
		$(this).next().val(nums);
		updateCartNums(cart_id, nums);
	})
	$(".del").on('click',function(){
		if (confirm("确认删除购物车中此商品？")) {
            var cart_id = $(this).parents('div.cart-item').attr('cart-id');
            delCartGoods(cart_id, $(this));
        }
		
	})
	
})
 function delCartGoods(cart_id, obj) {
                var del = false;
                $.get(Thinkphp.delCartGoods,{"data_id": cart_id},function(data) {
                    if (data.status) {
                        var item = obj.parents('div.cart-item');
                        item.fadeOut('slow', function() {
                            item.remove();
                            product_total();
                            product_subtotal();
                        });
                    }
                }, 'JSON');
}
 function updateCartNums(cart_id, nums) {
                $.post(Thinkphp.updateCartNums,{"cart_id": cart_id, "nums": nums},
                function(data) {
                   if (data.status == false) {
                        alert(data.message + '实际库存量剩余：' + data.sku);
                        var _input = $('div.cart-item[cart-id="' + cart_id + '"] input.item-nums');
                        _input.val(_input.attr('old-nums'));
                    } else {
                    	product_total();
                        product_subtotal();
                    }
                }, 'JSON');
 }
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
//计算小计
function  product_subtotal () {
	var cart_item=$(".cart-item");
	var subtotal=0;
	if(cart_item.length>0){
		$.each(cart_item,function (k){
		  var subtotal=parseFloat(cart_item.eq(k).find('.goods-price').html())*parseFloat(cart_item.eq(k).find('.item-nums').val())
		  cart_item.eq(k).find('.goods-total').html(subtotal.toFixed(2))
		})
		
	}
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
