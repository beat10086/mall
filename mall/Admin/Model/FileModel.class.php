<?php 
namespace  Admin\Model;
use Think\Model;
use Think\Upload;
use Think\Image;
class FileModel extends Model {
    public  function  get_logo_url () {
        $upload=new Upload();
        $upload->savePath= C('LOGO_PATH');
        $upload->autoSub = false;
        $upload->maxSize = 1000000 ;
        $upload->exts    = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info   = $upload->upload();
        if($info){
            $savePath = $info['Filedata']['savepath'];
            $saveName = $info['Filedata']['savename'];
            $imgPath = C('UPLOAD_PATH').'logo/'.$saveName;
            $Image=new Image();
            $Image->open($imgPath);
            $Image->thumb(138,46,\Think\Image::IMAGE_THUMB_CENTER)->save($imgPath);
            return   $imgPath;
        }
    }
}