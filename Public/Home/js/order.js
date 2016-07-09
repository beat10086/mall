$(function () {
	alert_window();
	$("select[name=province]").on('change',function(){
		  var _id=$(this).val();
		  var _that=$(this);
		  var city_str='';
		  var city_option_str='';
          $.get(Thinkphp.getCity,{"id":_id},function(data){
        	   if(data){
        		   if(data!=""){ 
        			   $("select[name=city]").remove();
        			   $("select[name=district]").remove();
        			   $.each(data,function(k){
        				   city_option_str+="<option value='"+data[k]['id']+"'>"+data[k]['area_name']+"</option>" 
        			   })
        			   city_str='<select class="form_select" name="city"><option value="">请选择市</option>'+city_option_str+'</select>';
        			   _that.after(city_str);
        		   }   
        	   }
          },'json')
	})
   //关闭
   $(".guanbi").on('click',function(){
	   $("#gray").hide();
		$("#popup").hide();
   })	
   $(".add_address").on('click',function(){
	    $("#gray").show();
		$("#popup").show();
		tc_center();	
   })
   $("#consignee-list li").hover(function(){
	     $(this).addClass('li_hover'); 
	     $(this).children().find('.op-btns').css('visibility','visible');
      },function(){
    	 $(this).removeClass('li_hover');  
    	 $(this).children().find('.op-btns').css('visibility','hidden');
   })
   $("#saveConsigneeTitleDiv").on('click',function(){
		 var consignee=$.trim($("input[name=consignee]").val());
		 var province=$("select[name=province]").val();
		 var city=$("select[name=city]").val();
		 var district=$("select[name=district]").val();
		 var address=$("input[name=address]").val();
		 var mobile=$("input[name=mobile]").val();
		 var tel=$("input[name=tele]").val();
		 var email=$("input[name=email]").val();
		 var address_name=$("input[name=address_name]").val();
		 var flage=true;
		 var btn_disabled=$(this).attr('date-check');
		 if(btn_disabled=="disabled"){
			 return false;
		 }
		 if(consignee==""){
			 alert("收货人不能为空！");
			 return false;
		 }
		 if(province==""||city==""||district==""){
			 alert("请完整的填写地区");
			 return false;
		 }
		 if(address==""){
			 alert("请输入详细地址！");
			 return false;
		 }
		 if(mobile==""){
			 alert("请输入手机号码");
			 return false;
		 }
		 var data={
				 'consignee':consignee,
				 'province'   :province,
				 'city'       :city,
				 'district'   :district,
				 'address'    :address,
				 'mobile'     :mobile,
				 'tele'       :tel!=""?tel:'',
				 'email'      :email!=""?email:'',	
				 'address_name':address_name!=""?address_name:''
		 }
		 if(btn_disabled ==""){
			 $(this).attr('date-check','disabled');
			 $.post(Thinkphp.add_address,data,function(data){
				 if(data){
					  if(data>0){
						 window.location.reload();
					  }
				 }
			})
		 }
		return false;
	})
	//提交订单
	$(".sub-order").on('click',function(){
	  var 	_data_checked=$(this).attr('data-checked');
	  if(_data_checked=='true'){
		  $(this).attr('data-checked','false');
		  var data={
				  'pay_id':$("input[name=pay_id]").val(),
				  'shipping_id':$("input[name=shipping_id]").val(),
				  'total_price':$("input[name=total_price]").val()
		  }
		  $.post(Thinkphp.addOrder,data,function(data){
			  
		  })
	   }
	})
	
	
})
$(document).on('change','select[name=city]',function(){
		var _id=$(this).val();
		var _that=$(this);
		var district_str='';
		var district_option_str='';
	    $.get(Thinkphp.getCity,{"id":_id},function(data){
     	   if(data){
     		   if(data!=""){ 
     			  $("select[name=district]").remove();
     			   $.each(data,function(k){
     				  district_option_str+="<option value='"+data[k]['id']+"'>"+data[k]['area_name']+"</option>" 
     			   })
     			   district_str='<select class="form_select" name="district"><option value="">请选择市</option>'+district_option_str+'</select>';
     			   _that.after(district_str);
     		   }   
     	   }
       },'json')
	})
function alert_window () {
	//查找ID为popup的DIV show()显示#gray
	if(Thinkphp.address_id==0){
		$("#gray").show();
		$("#popup").show();
	}
	tc_center();	
}
//窗口水平居中
$(window).resize(function(){
	tc_center();
});
function tc_center(){
	var _top=($(window).height()-$(".popup").height())/2;
	var _left=($(window).width()-$(".popup").width())/2;
	
	$(".popup").css({top:_top,left:_left});
}	