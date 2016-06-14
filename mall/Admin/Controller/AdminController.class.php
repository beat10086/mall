<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Admin\Controller\CommonController;
class AdminController extends CommonController {
    //显示log
    public  function showlog (){
         $adminlog=D('AdminLogView');
         $admin_log=$adminlog->showlog();
         foreach($admin_log as $k =>$v){    
           $admin_log[$k]['login_ip']=long2ip($admin_log[$k]['login_ip']);
         }
         $this->assign('admin_log',$admin_log);
         $this->display();
    }
}