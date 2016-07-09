$(function(){
	$(".ban-click").on('click',function(){
		  var _val=$(this).find('span').attr('value');
		  var _type=$(this).find('span').attr('type');
		  var _user_id=$(this).parents('.user_tr').attr('data-id');
		  if(_val==0){
			  $("#userFiltermodel").modal({
					 keyboard:false,
			         show:true
				 });
			  $("#banAttr").on('click',function(){
				    var ban_reason=$("textarea[name=ban_reason]").val();
				    updateAttr(_user_id,_type,_val,ban_reason);
				    return false;
			  })
		  }else{
			  updateAttr(_user_id,_type,_val,null);
		  }
	})
	
	$('#created_time').daterangepicker({
		format : 'YYYY-MM-DD',
		locale : {
			applyLabel : '确定',
			cancelLabel : '取消',
			fromLabel : '起始时间',
			toLabel : '结束时间',
			daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
			monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月' ],
			firstDay : 1	
		}
	},function(start,end,label){
		$("#created_time").val(start.format('YYYY-MM-DD')+' - '+end.format('YYYY-MM-DD'));
		$("input[name=created_start]").val(start.format('YYYY-MM-DD'));
		$("input[name=created_end]").val(end.format('YYYY-MM-DD'));
	});
})
function  updateAttr ($user_id,$type,$value,$con){
	 var data={
		  'user_id':$user_id,
		  'type':$type,
		  'value' :$value,
		  'con':$con
	 }
	$.post(Thinkphp.updateAttr,data,function(data){
		 if(data){
			 if(data>0){
					 location.href=location.href;
			 }
		 }
	})
}
