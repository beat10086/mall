<?php
function check_verify ($code) {
    $verify = new \Think\Verify();
    return $verify->check($code);
}
function  NextId($table){
    $Model = M();
    $_stmt=$Model->query("SHOW TABLE STATUS LIKE '".$table."'");
    return $_stmt[0][Auto_increment];  
}
//获取网整的URL地址
function get_url() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
    return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
}
//返回上一个url
function PREV_URL (){
    if(!empty($_SERVER["HTTP_REFERER"])){
         return $_SERVER["HTTP_REFERER"];
    }  
}
//转化为字符串
function db_create_in ($arr) {
    $str='';
    if(is_array($arr)){
       foreach($arr as $k=>$v){
           $str.=$v.',';
       }   
    }
    return substr($str,0,strlen($str)-1);
}
//cookie加密
function encryption($username, $type = 0) {
    $key = sha1(C('COOKIE_key'));

    if (!$type) {
        return base64_encode($username ^ $key);
    }

    $username = base64_decode($username);
    return $username ^ $key;
}
function  number_format_fun  ($price_format){
    return number_format($price_format,2);
}
function format_mobile ($mobile) {
   return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$mobile);
}

