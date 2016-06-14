<?php
namespace  Admin\Model;
use Think\Model;
class AdminLogModel extends Model {
    /* 写入日志 */
    public function add_admin_log ($con) {
        $data=array(
            'created_time'=>time(),
            'con' =>$con,
            'user_id'=>$_SESSION['admin']['user_id'],
            'login_ip'=>get_client_ip(1)
        );
        $this->add($data);
    } 
}