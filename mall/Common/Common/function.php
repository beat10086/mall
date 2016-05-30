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