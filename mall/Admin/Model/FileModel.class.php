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
    /* 上传缩略图  大小54* 54  350 *350  记住不能用* */ 
    public  function upload_goods_img () {
        $upload=new Upload();
        $upload->autoSub = false;
        $upload->maxSize = 1000000 ;
        $upload->exts    = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $info   = $upload->upload();
        if($info){
            $saveName = $info['Filedata']['savename'];
            $imgPath = C('UPLOAD_PATH').$saveName;
            $Image=new Image();
            $Image->open($imgPath);
            $thumbPath = C('UPLOAD_PATH').'54_'.$saveName;
            $Image->thumb(54,54,\Think\Image::IMAGE_THUMB_CENTER)->save($thumbPath);
            $Image->open($imgPath);
            $unfoldPath = C('UPLOAD_PATH').'350_'.$saveName;
            $Image->thumb(350,350,\Think\Image::IMAGE_THUMB_CENTER)->save($unfoldPath);
            $Image->open($imgPath);
            $bigPath = C('UPLOAD_PATH').'800_'.$saveName;
            $Image->thumb(800,800,\Think\Image::IMAGE_THUMB_CENTER)->save($bigPath);
            $imageArr = array(
                'thumb'=>$thumbPath,
                'unfold'=>$unfoldPath,
                'big'   =>$bigPath,
                'source'=>$imgPath
            );
            return $imageArr;
        }else{
            return $Upload->getError();
        }
    }
    /* 上传相册 */
    public   function upload_goods_gallery () {
         $upload=new Upload();
         $upload->savePath= C('GALLERY_PATH');
         $upload->autoSub = false;
         $upload->maxSize = 1000000 ;
         $upload->exts    = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型  
         $info   = $upload->upload();
         if($info){
             $saveName = $info['Filedata']['savename']; 
             $imgPath=C('UPLOAD_PATH').'gallery/'.$saveName;
             $Image=new Image();
             $Image->open($imgPath);
             $thumbPath = C('UPLOAD_PATH').'gallery/'.'54_'.$saveName;
             $Image->thumb(54,54,\Think\Image::IMAGE_THUMB_CENTER)->save($thumbPath);
             $Image->open($imgPath);
             $unfoldPath = C('UPLOAD_PATH').'gallery/'.'350_'.$saveName;
             $Image->thumb(350,350,\Think\Image::IMAGE_THUMB_CENTER)->save($unfoldPath);
             $Image->open($imgPath);
             $bigPath = C('UPLOAD_PATH').'gallery/'.'800_'.$saveName;
             $Image->thumb(800,800,\Think\Image::IMAGE_THUMB_CENTER)->save($bigPath);
             $imageArr = array(
                 'thumb'=>$thumbPath,
                 'unfold'=>$unfoldPath,
                 'big'   =>$bigPath,
                 'source'=>$imgPath
             );
             return $imageArr;
            }else{
             return $Upload->getError();
         }
        
        
    }
    
}