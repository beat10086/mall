<?php 
namespace  Admin\Controller;
use Think\Controller;
class FileController extends Controller {
    //上传logo
    public  function image () {
           $File=D('File');
           echo $File->get_logo_url(); 
    }
    //上传缩略图
    public  function  upload_goods_img () {
             $File=D('File');
             $this->ajaxReturn($File->upload_goods_img());            
    }
    //上传相册
    public  function upload_goods_gallery () {
             $File=D('File');
             $this->ajaxReturn($File->upload_goods_gallery());
    }

}
?>