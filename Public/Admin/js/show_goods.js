$(function(){
	//全选
	select_all('goods');
	$(".confirm-opt").on('click',function(){
		 var goods_id=get_select_value('goods'),
	        _select=$(this).prev().val();
		 if(goods_id.length==0){
			 alert("请选择你要操作的商品！");
	         return false;
		 }
		 if(_select==''){
			 alert("请选择你需要进行的操作！");
	         return false;
		 }
		 //执行删除
		 if(_select=='del'){
			 del_goods(goods_id);
		 }else{
			 var arg=$(this).prev().find(':selected').attr('arg');
			 if(typeof goods_id !='string'){
				   goods_id=goods_id.join(',');
			   }
			 $.get(Thinkphp.modifyPromote,{"type":_select,'value':arg,'goods_id':goods_id},function(data){
			                if(data.status){
			                    location.href=location.href;
			                }
			      },'json')
			 
		 } 
	})
	//执行删除(单条数据)
	$(".del_brand_btn").on('click',function(){
		  var _goods_id=$(this).parents('tr').attr('data-id');
		  $("input[name=select-name]").prop('checked',false);
		  $(".select-all").prop('checked',false);
		  $(this).parents('tr').find("input[name=select-name]").prop('checked',true);
		  del_goods(_goods_id)
	})
	$(".promote-click span").on('click',function(){
		var _goods_id=$(this).parents('tr').attr('data-id');
		var _select=$(this).attr('type');
		var _arg=$(this).attr('value');
		var _that=$(this);
		$.get(Thinkphp.modifyPromote,{"type":_select,'value':_arg,'goods_id':_goods_id},function(data){
             if(data.status){
            	 location.href=location.href;
             }
         },'json')
	})
	//跳转到货号页面
	$(".goodsProduct").on('click',function(){
		var data_href=$(this).attr("data-href");
		window.location.href=data_href;	
	})
})

function del_goods(goods_id){
	   parent.layer.confirm('确定要删除选中的商品？', {icon: 2, title:'提示'}, function(index){
		   parent.layer.close(index);
		   if(typeof goods_id !='string'){
			   goods_id=goods_id.join(',');
		   }
		   $.get(Thinkphp.delGoods,{"goods_id":goods_id},
		            function(data){
		                if(data.status){
		                	var _tr=$("input[name=select-name]:checked").parents('tr');
		                    _tr.fadeOut('slow',function(){
		                        _tr.remove();
		                    });
		                }else{
		                  $("input[name=select-name]").prop('checked',false);
		          		  $(".select-all").prop('checked',false);
		                }
		            },'json')
		 });
}
function get_select_value(id,name){
        var name = name || 'select-name',
        id_list=[];
        $('#'+id+' :checkbox[name="'+name+'"]:checked').each(function(){
            id_list.push($(this).val());
        });
        return id_list;
    }
function select_all (id,class_name,name) {
	 var class_name = class_name || 'select-all',name = name || 'select-name';
	 $("."+class_name).on('click',function(){
		  if($(this).prop('checked')){
			  $('.'+class_name).prop('checked',true);
              $('#'+id+' :checkbox[name="'+name+'"]').prop('checked',true);
		  }else{
			  $('.'+class_name).prop('checked',false);
              $('#'+id+' :checkbox[name="'+name+'"]').prop('checked',false);
		  }
	 })
	
}


