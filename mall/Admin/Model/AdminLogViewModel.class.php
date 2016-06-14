<?php 
namespace  Admin\Model;
use Think\Model;
use Think\Model\ViewModel;

class AdminLogViewModel extends ViewModel {
    public $viewFields=array(
        'AdminLog'=>array('created_time','con','user_id','login_ip'),
        'Admin'    =>array('username'=>'admin_username','_on'=>'AdminLog.user_id=Admin.user_id')
        
    );
   
    /* 显示日志 */
    public  function showlog () { 
        return   $this->order('created_time desc')->select();
      
    }
    
}
