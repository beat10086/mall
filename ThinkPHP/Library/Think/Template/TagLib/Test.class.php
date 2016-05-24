<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think\Template\TagLib;
use Think\Template\TagLib;
defined('THINK_PATH') or exit();
/**
 * Test测试标签
 */
class Test extends TagLib  {
    // 标签定义
    protected $tags = array(
        'mytest'=> array('attr'=>'color,border','close'=>1)
    );
    public  function _mytest($tag,$content) {
        $color = '';
        $border = '';
        if ( isset($tag['color'])) {
            $color = 'color:'.$tag['color'];
        }
        if ( isset($tag['border'])) {
            $border = 'border:'.$tag['border'].'px solid #ccc';
        }
        $css = $color.';'.$border;
        return '<div style="'.$css.'">'.$content.'</div>';
    }   
}




?>