<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
use Think\Page;
class UserController extends CommonController{
    //显示用户
    public  function index (){
          $user=D('User');
          if(isset($_GET['username'])){
              $username=$_GET['username'];
              $this->assign('username',$username);
          }
          if(!empty($_GET['created_start']) && !empty($_GET['created_end'])){
              $created_start=$_GET['created_start'];
              $created_end=$_GET['created_end'];
              $this->assign('created_start',$created_start);
              $this->assign('created_end',$created_end);
          }
          $count=$user->countNum($username,$created_start,$created_end);
          $Page=new Page($count, C(PAGE_SIZE));
          $show= $Page->show();// 分页显示输出
          $page=I('get.p');
          if(ceil($count/C(PAGE_SIZE)) < $page){
              $page=ceil($count/C(PAGE_SIZE));
          }
          $page=!empty($page)?$page:1;
          $userall=$user->getList($username,$created_start,$created_end,$page,C(PAGE_SIZE));
          $this->assign('userall',$userall);
          $this->assign('page',$show);// 赋值分页输出
          $this->display();
    }
    //修改禁用
    public  function  updateAttr (){
        $user=D('User');
        $uid=$user->updateAttr(I('POST.user_id'),I('POST.type'),I('POST.value'),I('POST.con'));
        echo $uid;
    }
    
}