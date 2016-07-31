//验证登陆广告
function checkAdsPosition (){
	 var ads_title=$("input[name=ads_title]").val();
	 var ads_call=$.trim($("input[name=ads_call]").val());
	 var regexp=/^[a-z]+$/i;
	 if(ads_title==""){
		  layer.msg('广告位名称不能为空！');
		  return false;
	 }
	 if(ads_call==""){
		  layer.msg('调用名称不能为空！');
		  return false;
	 }
	 if(!regexp.test(ads_call)){
		 layer.msg('调用名称字母格式不对！');
		 return false;
	 }
	 return true;
}