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
//全部完毕，恭喜~.........................................
?>