<?php
namespace  Admin\Controller;
use Admin\Controller\CommonController;
class DbController extends CommonController{
    private $ds = "\n\r\n\r";
    public  function index () {
        $M = M();
        $tabs = $M->query('SHOW TABLE STATUS');
        $total = 0;
        $list= array();
        foreach ($tabs as $k => $v) {
            $list[]=array(
                'table'   =>$v['Name'],
                'type'    =>$v['Engine'],
                'rec_num' =>$v['Rows'],
                'rec_size' =>sprintf(" %.2f KB", $v['Data_length'] / 1024),
                'rec_index' => $v['Index_length'],
                'rec_chip' => $v['Data_free'], 
                'charset' => $v['Collation'], 
            );
        }
        $this->assign('list',$list);
        $this->display();
    }
  //备份数据库
  public function backup (){
      $this->display();
  }
  public   function byteFormat($bytes) {
        $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
        return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
    }
  /**
     * 数据库备份
     * 参数：备份哪个表(可选),备份目录(可选，默认为backup),分卷大小(可选,默认2048，即2M)
     *
     * @param string $dir
     * @param int $size
     * @param array $tablename
  */
  public  function export () {
      $tablename=I("table");
      $dir = C("DB_BACKUP");
      $size = C("DB_BACKUP_SIZE");
      //判断目录是否存在,不存在创建目录
      $M=M();
      $msg="";
      if(!is_dir($dir)){
          mkdir($dir,0777,true) or die('创建目录失败！');
      }
      $size = C("DB_BACKUP_SIZE");
      if($tables = $M->query( "show table status from " .C("DB_NAME"))){
          $msg .= "读取数据库结构成功！<br />";
      }else{
          exit ( "读取数据库结构失败！<br />" );
      }
      // 插入dump信息
      $sql .= $this->_base ();
      // 文件名前面部分
      $filename = date ( 'YmdHis' ) . "_all";
      $tables = $M->query ( 'SHOW TABLES' );
      // 第几分卷
      $p = 1;
      // 循环所有表
      foreach  ($tables as $value) {
          foreach ($value as $v) {
              // 获取表结构
              $sql .= $this->_insert_table_structure ( $v );
              // 单条记录
              $sql .= $this->_insert_record ( $v );
          }
      }
      // 如果大于分卷大小，则写入文件
      if (strlen ( $sql ) >= $size * 1024) {
          $file = $filename . "_v" . $p . ".sql";
          // 写入文件
          if ($this->_write_file ( $sql, $file, $dir )) {
              $msg .= "-卷-" . $p . "-数据备份完成,生成备份文件<span style='color:#f00;'>$dir$file</span><br />";
          } else {
              $msg .= "备份卷-" . $p . "-失败<br />";
              return false;
          }
          $p ++;
      }
      if ($sql != "") {
          $filename .=  ".sql";
          if ($this->_write_file ( $sql, $filename, $dir )) {
              $msg .= "数据库-" . C("DB_NAME") . "-卷-" . $p. '<br />'. "-数据备份完成,生成备份文件 <span style='color:#f00;'>$dir$filename</span><br />";
          } else {
              $msg .= "备份卷-" . $p . "-失败<br />";
              return false;
          }      
      }
      echo $msg;
      $this->redirect('Db/backup','',5);
      exit();
  }
  /**
   * 写入文件
   *
   * @param string $sql
   * @param string $filename
   * @param string $dir
   * @return boolean
   */
  private function _write_file($sql, $filename, $dir) {
      $dir = C("DB_BACKUP");
      // 创建目录
      if (! is_dir ( $dir )) {
          mkdir ( $dir, 0777, true );
      }
      $re = true;
      if (! @$fp = fopen ( $dir . $filename, "w+" )) {
          $re = false;
          $msg .= "打开文件失败！";
      }
      if (! @fwrite ( $fp, $sql )) {
          $re = false;
          $msg .= "写入文件失败，请文件是否可写";
      }
      if (! @fclose ( $fp )) {
          $re = false;
          $msg .= "关闭文件失败！";
      }
      return $re;
  }
  /**
   * 插入语句构造
   *
   * @param string $table
   * @return string
   */
  private function _insert_record($table) {
      // sql字段逗号分割
      $M=M();
      $res = $M->query ( 'select * FROM `' . $table . '`' );
      // 循环每个子段下面的内容
      foreach ($res as $val){
          $comma = 0;
          $insert .= "INSERT INTO `" . $table . "` VALUES(";
          foreach ($val as $v){
              $insert.=$comma == 0 ? "" : ",";
              $insert.= ( "'" . mysql_escape_string ( $v ) . "'");
              $comma++;
  
          }
          $insert .= ");" . $this->ds;
      }
      return $insert;
  }
  /**
   * 插入表结构
   *
   * @param unknown_type $table
   * @return string
   */
  private function _insert_table_structure($table) {
      $sql = '';
      $sql .= "--" . $this->ds;
      $sql .= "-- 表的结构" . $table .$this->ds."--" .$this->ds;
      $M = M();
      // 如果存在则删除表
      $sql .= "DROP TABLE IF EXISTS `" . $table . '`' . $this->sqlEnd . $this->ds;
      // 获取详细表信息
      $res = $M->query ( 'SHOW CREATE TABLE `' . $table . '`' );
      $sql .= $res [0]["Create Table"];
      $sql .= $this->sqlEnd . $this->ds;
      // 加上
      $sql .= $this->ds;
      $sql .= "--" . $this->ds;
      $sql .= "-- 转存表中的数据 " . $table . $this->ds;
      $sql .= "--" . $this->ds;
      $sql .= $this->ds;
      return $sql;
  }
  /**
   * 插入数据库备份基础信息
   *
   * @return string
   */
  private function _base() {
      $value = '';
      $value .= '-- MySQL database dump' . $this->ds;
      $value .= '-- Created by DBAction class, Power By TaoTao. ' . $this->ds;
      $value .= '-- http://blog.kisscn.com ' . $this->ds;
      $value .= '--' . $this->ds;
      $value .= '-- 主机: ' . $_SERVER['SERVER_NAME'] . $this->ds;
      $value .= '-- 生成日期: ' . date ( 'Y' ) . ' 年  ' . date ( 'm' ) . ' 月 ' . date ( 'd' ) . ' 日 ' . date ( 'H:i' ) . $this->ds;
      $value .= '-- MySQL版本: ' . mysql_get_server_info () . $this->ds;
      $value .= '-- PHP 版本: ' . phpversion () . $this->ds;
      $value .= $this->ds;
      $value .= '--' . $this->ds;
      $value .= '-- 数据库: `' . C("DB_NAME") . '`'. $this->ds;
      $value .= '--' . $this->ds ;
      $value .= '-- -------------------------------------------------------';
      $value .= $this->ds . $this->ds;
      return $value;
  }
    
}