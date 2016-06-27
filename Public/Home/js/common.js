$(function(){
	//选中规格的处理
	$('.spec').live('click', function() {
		 //判断是否可以选择
	    if ($(this).hasClass('ban')) {
	        return false;
	    }
		//清楚父辈的样式
		$(this).siblings().removeClass('active');
		$(this).hasClass('active') ? $(this).removeClass('active') : $(this).addClass('active');
		//如果后边有选中的规格，清空选中的
		var next_spec_item = $(this).parents('.spec-item').nextAll('.spec-item');
		if(next_spec_item.length){
			next_spec_item.find('.active').removeClass('active');
		}
		var spec = active_spec();//当前选中的规格ID和值
		$.get(Thinkphp.getProduct,{"goods_id":Thinkphp.goods_id},function(data) {
			if(data){
				$('.seletc-spec strong').text('”' + spec.spec_value.join('“，”') + '“');
				 var spec_compose = {"compose": {}};//可以选择的组合
				 $.each(data, function(k, v) {
					    v.attr_list=v.attr_list.substr(0,v.attr_list.length-1)
		                spec_compose[v.attr_list] = v;
		                spec_compose['compose'][v.attr_list] = v.attr_list.split(',');
		            });
				 //console.log(JSON.stringify(spec_compose))
				 var allowd = allow_spec(spec_compose.compose, spec.spec_id);
				//当选择一个规格后，给不能选择的规格添加禁用样式
		         $('li.spec-item').each(function() {
		                if ($(this).find('.active').length == 0) {
		                    $('input', $(this)).each(function() {
		                        if ($.inArray($(this).val(), allowd) == -1) {
		                            $(this).parent().addClass('ban');
		                        } else {
		                            $(this).parent().removeClass('ban');
		                        }
		                    });
		                }
		            });
		         //为每个规格产品的不同价格做显示
		           var had_spec = spec.spec_id.join(',');
		           if (spec_compose[had_spec]) {
		                $('#SKU').text(spec_compose[had_spec]['sku']);
		                $('#goods-sn').text(spec_compose[had_spec]['goods_sn']);
		                $('div.shop-price').text(spec_compose[had_spec]['goods_price']);
		            }
			}	
		},'json')
	})	
	//我的购物车
	$("#shopping-cart").hover(function(){
      $(this).children('dl').addClass('hover');
      $("#shopping-cart dl dd").html("");
      $("#shopping-cart dl dd").html('<div class="loading"></div>');
	  $.get(think.getCart,function (data) {
		  $("#shopping-cart dl dd .loading").remove();
		  if(data){ 
				var cart_list_s="",cart_list_e="",cart_list_li="";
				    cart_list_s+='<p class="shopping-cart-p">最新加入的商品</p>\
                                 <div class="cart_list smc">\
                                 <ul>';
				 var product_num=0;
				 var product_price=0;
				 $.each(data,function(k,v){
					   cart_list_li+='<li class="cart_li"><div class="p-img fl">\
	               	  		<a target="_blank" href="'+think.Detail+'/id/'+v.goods_id+'">\
						   <img width="50" height="50" alt="" src="'+think.ROOT+v.goods_thumb+'"></a>\
	               	    </div><div class="p-name fl">\
						 <a target="_blank" title="" href="//item.jd.com/1288991128.html"></a></div>\
						 <div class="p-detail fr ar"><span class="p-price"><strong>￥'+v.price+'</strong>×'+v.nums+'</span><br/>\
						 <a href="javascript:void(0)" data-type="RemoveProduct" data-id="'+k+'" class="delete">删除</a>\
						 </div></li>';
					   product_num++;
					   product_price+=parseFloat(v.price);
				   })
				   cart_list_e+='</ul></div>\
					   <div class="smb ar">\
					       <div class="p-total">共<b class="product_num">'+product_num+'</b>件商品&#12288;共计<strong class="product_price">￥'+product_price+'</strong>\
					   </div>\
					    <a id="btn-payforgoods" title="去购物车" href="">去购物车</a></div>';  
		         $("#shopping-cart dl dd").append(cart_list_s+cart_list_li+cart_list_e);
		         $("#shopping-cart .icon-account span").html(product_num);
		  }else{		  
   	          $("#shopping-cart dl dd").append('<div class="nogoods"><b></b><span>购物车中还没有商品，赶紧选购吧！</span></div>');
   	          $("#shopping-cart .icon-account span").html(0);
		  }
	  })
	},function(){
		 $(this).children('dl').removeClass('hover');
	})
	
	
	
	
})
//删除购物车
$("#shopping-cart").on('click','.delete',function(){
	  var data_id=$(this).attr('data-id');
	  var _that=$(this)
	  $.get(think.delCartGoods,{"data_id":data_id},function(data){
		   if(data){
			   if(data.product_num>0){
				   _that.parents('cart_li').remove();
				   $("#shopping-cart .product_num").html(data.product_num);
				   $("#shopping-cart .product_price").html(data.product_price); 
				   $("#shopping-cart .icon-account span").html(data.product_num);
			   }else{
				   $("#shopping-cart dl dd").html("");
                   $("#shopping-cart dl dd").append('<div class="nogoods"><b></b><span>购物车中还没有商品，赶紧选购吧！</span></div>');
				   $("#shopping-cart .product_num").html(0);
				   $("#shopping-cart .product_price").html(0); 
				   $("#shopping-cart .icon-account span").html(0);
			   }   
		   }
	  })
})


/**
 * 计算当选择规格后，能够选择的值
 * all：所有的规格组合
 * select:当前选中的值
 */
function allow_spec(all, select) {
    var allow = [];
    $.each(all, function(k, v) {
        if (aBelongB(select, v)) {
            $.each(v, function(a_k, a_v) {
                if ($.inArray(a_v, allow) == -1 && $.inArray(a_v, select) == -1) {
                    allow.push(a_v);
                }
            });
        }
    });
    return allow;
}
/**
 * 判断 a数组是不是b数组的子集
 *
 */
function aBelongB(a, b) {
    var flag = true;
    for (i = 0; i < a.length; i++) {
        if ($.inArray(a[i], b) == -1) {
            flag = false;
            break;
        }
    }
    return flag;
}

/**
 * 获取以选中的规格值ID和值
 */
function active_spec() {
    var spec = {
        "spec_value": [],
        "spec_id": []
    };
    $('ul.goods-spec a.active').each(function() {
        spec.spec_value.push($(this).attr('title'));
        spec.spec_id.push($(this).children('input').val());
    });
    return spec;
}
/**
 * 添加商品到购物车
 * @param {type} gid 商品ID
 * @param {type} list 是否在列表页
 * @returns {undefined}
 */
function addToCart (gid,list) {
	//如果在列表页，发送Ajax查询商品的规格。
	if(list){
		
	}else{
		checkAddToCart(gid);	
	}
}
/**
 * 验证商品到购物车
 */
function checkAddToCart (goods_id) {
	//判断商品是否需要货号allowd_spec大于0，代表商品需要货号,小于0不要货号
	var spec_list = active_spec(),
	    nums = $('#buy-number').val(),
	    allowd_spec = $('li.spec-item').length;
	var num_preg=/^[1-9][0-9]*$/;
	//内容页
	if(allowd_spec  && spec_list.spec_id==""){
		alert('请选择商品规格后,再次添加到购物车！');
		return false;
	}
	if(!num_preg.test(nums)){
		alert("商品的数量的格式不对");
		return false;
	}
	if (nums < 1) {
        alert("至少需要购买一件商品！");
        $('#buy-number').val('1');
        return false;
    }
	var data={
			"spec_id": spec_list.spec_id, 
			"nums": nums, 
			"goods_id": goods_id
	}
	//加入购物车
	$.post(Thinkphp.addToCart,data,function(data) {
	        if(data){
	        	if(data.code>0){
	        		$(".icon-account span").html(data.cart_itemq);
	        		alert(data.message);
	        	}else{
	        		alert(data.message);
	        	}
	        	
	        }
	    }, 'JSON');
		
}
