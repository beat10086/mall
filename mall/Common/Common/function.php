<?php
function check_verify ($code) {
    $verify = new \Think\Verify();
    return $verify->check($code);
}