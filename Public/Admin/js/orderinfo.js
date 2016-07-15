function check_order_opt (){
	var action_note=$("textarea[name=action_note]").val();
	if(action_note==""){
		alert('请输入操作内容!');
		return false;
	}
	return true;
}