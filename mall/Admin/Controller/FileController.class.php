<?php 
namespace  Admin\Controller;
use Think\Controller;
class FileController extends Controller {
    public  function image () {
           $File=D('File');
           echo $File->get_logo_url();
        
    }

}
?>