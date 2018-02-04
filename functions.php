<?php
/*
模版名称：Purelove
模版版本：2.0
作者：梦月酱
授权：仅供使用
官方网站： http://www.wysafe.com
QQ群：253775761
*/

//全局加载.........................................

//加载自定义配置
require_once(TEMPLATEPATH . '/functions/ThemeConfig.php');

if (function_exists('register_sidebar_widget')) {
    register_sidebar_widget('Purelove-综合挂件', 'Purelove_allinone');
    register_sidebar_widget('Purelove-文章评论', 'Purelove_comment');
}

function Purelove_allinone() {
    include (TEMPLATEPATH . '/functions/Purelove_allinone.php');
}

function Purelove_comment() {
    include (TEMPLATEPATH . '/functions/Purelove_comment.php');
}

include (TEMPLATEPATH . '/functions/Purelove_wanted.php');
include (TEMPLATEPATH . '/functions/Purelove_ads.php');
include (TEMPLATEPATH . '/functions/Purelove_commentslib.php');
include (TEMPLATEPATH . '/functions/Purelove_siteinfo.php');
include_once (TEMPLATEPATH . '/functions/Purelove_options.php');
require_once (TEMPLATEPATH . '/functions/Purelove_core.php');

if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}



//部署完毕加载前端库.........................................
if (!is_admin()) { //不在后台加载
    function my_init_method() {
        wp_deregister_script('jquery'); //取消原来的jquery加载
        wp_register_script('jquery', '//libs.baidu.com/jquery/1.8.3/jquery.min.js', '', '1.8.3'); //自定义jquery加载
        
    }
    add_action('template_redirect', 'my_init_method');
}

//全部完毕，恭喜~.........................................



?>







