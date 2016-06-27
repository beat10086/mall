$(function(){
	var old_name="";
	$("#product-list input").on('focus',function(){
		  old_name=$(this).val();
	})
	$("#product-list input").on('blur',function(){
		  if(old_name != $(this).val()){
			  var product_id=$(this).parents('tr').attr('product-id'),
	              name=$(this).attr('name'),
	              _this=$(this);
			  $.post(Thinkphp.updateProduct,{"product_id":product_id,filed:name,value:$(this).val()},
			            function(data){
			                if(!data.status){
			                    _this.val(name_old);
			                }
			            },'JSON');	  
		  }
	})
	
	
})