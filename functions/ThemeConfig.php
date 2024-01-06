<?php

/**

 * Azimiao.com PureLove Theme Config

 */

//配置类

class ThemeConfig {



    //网站域名

    public static $url = "*";

    //网站副标题

    public static $subtitle = "SubTitle1";



    //网站Logo路径

    public static $logoPicPath = "//unsplash.it/256/60";

    //右上图片路径

    public static $adPicPath = "//unsplash.it/280/78";

    //网站地图路径

    public static $siteMapPath = "./sitemap.html";



    //版权声明

    public static $copyRightText = "<p>·行1</p><p>·行2</p><p>·行3</p>";

    //我的介绍

    public static $aboutMe = "<p>·行1</p><p>·行2</p><p>·行3</p>";





    //是否开启首页幻灯片

    public static $isIndexSlider = true;

    //首页幻灯片路径

    public static $sliderPicPath = array(

		"https://unsplash.it/960/340?random=1",
		"https://unsplash.it/960/340?random=2"
		
    );


    //缩略图相关



    //是否开启缩略图裁剪？、否：文章列表将全部显示随机缩略图

    public static $isOpenThumbClip = true;

    //缩略图本地存放路径(一般不需要修改)

    public static $thumbLocalPath = "/Purelove_ThumPic/theme-thumbnail";

    //文章页是否显示缩略图(开启后，如有缩略图将在文章页顶部显示)

    public static $isSingleThumb = true;



    //缩略图是否上传七牛(如是，请填写下的七牛Access Key / Secret key)

    public static $isQiNiuUpLoad = false;

    //七牛key(如不开启七牛上传请留空)

    public static $qiNiuAK = "";

    public static $qiNiuCK = "";

     //七牛缩略图存储空间名

    public static $qiNiuBucketName = "";



    //是否返回七牛地址(如是，请填写下面的外链路径)

    public static $isQiNiuAddr = false;

    //七牛缩略图外链路径

    public static $thumbQiNiuPath = "";

    //七牛随机图片路径与图片前缀（10张，按照文章id截取最后一位做标识符 //piccdn.azimiao.com/random/tb1.jpg）

    public static $qiNiuRandomPath = "/random/tb";

    

    /* 缩略图七牛配置End */



    public static $views_meta_name = "views"; 





    public static function GetSubtitle($echo = true) {

        if ($echo) {

            echo self::$subtitle;

        } else {

            return self::$subtitle;

        }

    }

    public static function GetSiteMap($echo = true) {

        if ($echo) {

            echo self::$siteMapPath;

        } else {

            return self::$siteMapPath;

        }

    }

}

/*------------------------------------优化--------------------------------------------*/

//指定cookies的域名为网站主域名

define('COOKIE_DOMAIN', ThemeConfig::$url);

//隐藏管理条

add_filter('show_admin_bar', '__return_false');

//摘要字数

add_filter("excerpt_length", "theExcerpt_Length");


//摘要显示查看更多

add_filter("excerpt_more", "theExcerpt_more");

//激活后台友情链接

add_filter('pre_option_link_manager_enabled', '__return_true');

//禁止WordPress缩略图

add_filter('add_image_size', create_function('', 'return 1;'));

add_filter('wp_calculate_image_srcset', 'disable_srcset');

//移除自动添加图片的width或height属性

add_filter('post_thumbnail_html', 'fanly_remove_images_attribute', 10);

add_filter('image_send_to_editor', 'fanly_remove_images_attribute', 10);

//禁用WordPress Emoji表情

add_action('init', 'disable_emojis');


function get_excerpt($limit){

    $excerpt = get_the_excerpt();
    $excerpt = mb_substr($excerpt,0, $limit, 'utf-8');
    $excerpt = $excerpt.'<a href="'.get_permalink($post->ID).'">…</a>';
    return $excerpt;
}

//摘要字数

function theExcerpt_Length($length) {

    return 155;

}

//摘要显示查看更多

function theExcerpt_more($more) {

    global $post;

    return "<a href='" . get_permalink($post->ID) . "'>……</a>";

}

//关闭feed

function disable_our_feeds() {

    wp_die(__('<strong>Error:</strong> RSS是什么？能吃吗？'));

}

//禁止WordPress缩略图

function disable_srcset($sources) {

    return false;

}

//移除自动添加图片的width或height属性

function fanly_remove_images_attribute($html) {

    $html = preg_replace('/width="(\d*)"\s+height="(\d*)"\s+class=\"[^\"]*\"/', "", $html);

    $html = preg_replace('/  /', "", $html);

    return $html;

}

//禁用WordPress Emoji表情

function disable_emojis() {

    remove_action('wp_head', 'print_emoji_detection_script', 7);

    remove_action('admin_print_scripts', 'print_emoji_detection_script');

    remove_action('wp_print_styles', 'print_emoji_styles');

    remove_action('admin_print_styles', 'print_emoji_styles');

    remove_filter('the_content_feed', 'wp_staticize_emoji');

    remove_filter('comment_text_rss', 'wp_staticize_emoji');

    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');

}

function disable_emojis_tinymce($plugins) {

    if (is_array($plugins)) {

        return array_diff($plugins, array(

            'wpemoji'

        ));

    } else {

        return array();

    }

}




//编辑器实时预览

// function dmeng_theme_add_editor_styles() {

// add_editor_style('style.css');

// }



/*-----------------------------------优化End--------------------------------------------*/

/*------------------------------------功能--------------------------------------------*/

//黑幕效果

add_shortcode('heimu', 'heimu_style');

//add_action('admin_print_footer_scripts', 'heimu_tag');

//说说

add_action('init', 'my_custom_init');

// 注册缩略图存储路径

if (!defined('THEME_THUMBNAIL_PATH')) define('THEME_THUMBNAIL_PATH', ThemeConfig::$thumbLocalPath);

//注册缩略图外链路径

if (!defined('THEME_QINIU_THUMB_PATH')) define('THEME_QINIU_THUMB_PATH', ThemeConfig::$thumbQiNiuPath);

//黑幕效果

function heimu_style($atts, $content = "") {

    return '<span class="heimu" title="你知道的太多了">' . $content . '</span>';

}

//编辑器添加喵·黑幕按钮

function heimu_tag() { ?>

	<script type="text/javascript" charset="utf-8">

		edButtons[edButtons.length] = new edButton( 'button', '喵·黑幕', '[heimu]', '[/heimu]', '' );

	</script> <?php

}

//显示页面查询次数、加载时间和内存占用 From wpdaxue.com

function performance($visible = false) {

    $stat = sprintf('共 %d 次请求耗费 %.3f 秒, 使用 %.2fMB 内存', get_num_queries() , timer_stop(0, 3) , memory_get_peak_usage() / 1024 / 1024);

    echo $visible ? $stat : "<!-- {$stat} -->";

}

//首页幻灯片

function MyIndexSlider() {

    if (!ThemeConfig::$isIndexSlider) {

        return;

    }

    if (is_home() || is_front_page()) { ?>

		<script src="<?php

        echo get_template_directory_uri() ?>/js/responsiveslides.min.js"></script>

		<script>

		jQuery(document).ready(function($){

			//幻灯片

			$("#slider").responsiveSlides({

				auto:true,

				pager:false,

				nav:true,

				speed:500,

				pauseControls:true,

				pager:true,

				manualControls:"auto",

				namespace:"slide"

				});

			//幻灯片导航

			$(".mySliderBar").hover(function(){$(".slide_nav").fadeIn(200)},function(){$(".slide_nav").fadeOut(200)});

		});

		</script>

		<div class="mySliderBar">

		<ul class="rslides" id="slider">

		<?php

        foreach (ThemeConfig::$sliderPicPath as $value) { ?>

				<li><img src='<?php

            echo $value ?>'></li>

		<?php

        } ?>

		</ul>

		</div>

	<?php

    }

}


//说说

function my_custom_init() {

    $labels = array(

        'name' => '说说',

        'singular_name' => '说说',

        'add_new' => '发表说说',

        'add_new_item' => '发表说说',

        'edit_item' => '编辑说说',

        'new_item' => '新说说',

        'view_item' => '查看说说',

        'search_items' => '搜索说说',

        'not_found' => '暂无说说',

        'not_found_in_trash' => '没有已遗弃的说说',

        'parent_item_colon' => '',

        'menu_name' => '说说'

    );

    $args = array(

        'labels' => $labels,

        'public' => true,

        'publicly_queryable' => true,

        'show_ui' => true,

        'show_in_menu' => true,

        'exclude_from_search' => true,

        'query_var' => true,

        'rewrite' => true,

        'capability_type' => 'post',

        'has_archive' => false,

        'hierarchical' => false,

        'menu_position' => null,

        'supports' => array(

            'editor',

            'author',

            'title',

            'custom-fields'

        )

    );

    register_post_type('shuoshuo', $args);

}

//获取缩略图

function post_thumbnail($width = 140, $height = 100) {

    global $post;

    if (ThemeConfig::$isOpenThumbClip) {

        //如果有特色图片则取特色图片

        if (has_post_thumbnail($post->ID)) {

            $thumbnail_ID = get_post_thumbnail_id($post->ID);

            $thumbnailsrc = wp_get_attachment_image_src($thumbnail_ID, 'full');

            $thumbnailsrc = $thumbnailsrc[0];

            return Bing_crop_thumbnail($thumbnailsrc, $width, $height);

        } else {

            $content = $post->post_content;

            preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);

            if (count($strResult[1]) > 0) {

                return Bing_crop_thumbnail($strResult[1][0], $width, $height);

            } else {

                if (ThemeConfig::$isQiNiuAddr) {

                    $randomurl = THEME_QINIU_THUMB_PATH . ThemeConfig::$qiNiuRandomPath . substr($post->ID, -1, 1) . '.jpg';

                } else {

                    $randomurl = get_template_directory_uri() . '/images/random/' . 'tb' . substr($post->ID, -1, 1) . '.jpg';

                }

                return $randomurl;

            }

        }

    } else {

        if (ThemeConfig::$isQiNiuAddr) {

            $randomurl = THEME_QINIU_THUMB_PATH . ThemeConfig::$qiNiuRandomPath . substr($post->ID, -1, 1) . '.jpg';

        } else {

            $randomurl = get_template_directory_uri() . '/images/random/' . 'tb' . substr($post->ID, -1, 1) . '.jpg';

        }

        return $randomurl;

    }

}

//缩略图上传到七牛

function UpLoadPic($picname, $picpath) {

    //加载七牛上传库

    require_once (TEMPLATEPATH . '/functions/FileUpLoadToQiNiu.php');

    //生成上传类对象

    $inputer = new FileUpLoadToQN(ThemeConfig::$qiNiuAK, ThemeConfig::$qiNiuCK, "image/jpeg");

    //上传

    $str = $inputer->UpLoadFile($picname, $picpath, ThemeConfig::$qiNiuBucketName);

    //返回图片url

    return THEME_QINIU_THUMB_PATH . "/" . $picname;

}

//裁剪缩略图

function Bing_crop_thumbnail($url, $width, $height = null) {

    //裁剪图片

    $width = (int)$width;

    $height = empty($height) ? $width : (int)$height;

    $hash = md5($url);

    $file_path = "./wp-content" . THEME_THUMBNAIL_PATH . "/{$hash}-{$width}-{$height}.jpg";

    $file_url = content_url(THEME_THUMBNAIL_PATH . "/{$hash}-{$width}-{$height}.jpg");





    if (is_file($file_path)) {

        if (ThemeConfig::$isQiNiuAddr) {

            return THEME_QINIU_THUMB_PATH . "/{$hash}-{$width}-{$height}.jpg";

        } else {

            return $file_url;

        }

    }

$localPicUrl = $_SERVER['DOCUMENT_ROOT'] . str_replace(home_url(),"",$url);

    $editor = wp_get_image_editor($localPicUrl);

    if (is_wp_error($editor)) {     

	return $url;

    }

    $size = $editor->get_size();

    $dims = image_resize_dimensions($size['width'], $size['height'], $width, $height, true);

    $cmp = min($size['width'] / $width, $size['height'] / $height);

    if (is_wp_error($editor->crop($dims[2], $dims[3], $width * $cmp, $height * $cmp, $width, $height))) {

        return $url;

    }

    //本地保存

    $imageUrl = is_wp_error($editor->save($file_path, 'image/jpg')) ? $url : $file_url;



    //七牛路径

    $qiNiuimageUrl = "";

    if (ThemeConfig::$isQiNiuUpLoad&&ThemeConfig::$qiNiuAK!=""&&ThemeConfig::$qiNiuCK!="") {

        //上传到七牛

        $qiNiuimageUrl = UpLoadPic("{$hash}-{$width}-{$height}.jpg", "./wp-content" . THEME_THUMBNAIL_PATH . "/{$hash}-{$width}-{$height}.jpg");

    }

    if (ThemeConfig::$isQiNiuAddr) {

        return $qiNiuimageUrl == "" ? $imageUrl : $qiNiuimageUrl;

    } else {

        return $imageUrl;

    }

}



//输出文章缩略图

function getSingleThumb()

{

    if (ThemeConfig::$isSingleThumb) {



        if(has_post_thumbnail()){



              ?>



                <script>console.log("发现缩略图");</script>



                <span class="thumc"><?php the_post_thumbnail( 'full',array('alt' => get_the_title(),'title' => get_the_title(),) ); ?></span>



              <?php



        }



        else{ ?>



            <script>console.log("未发现缩略图");</script>



          <?php 



        }

    }

}



//获取浏览计数

    function GetVisitors()

    {

        $post_ID = $_GET["post_id"];



        if($post_ID != "")

        {
			echo json_encode("n/a");
			die();
            $post_views = (int)get_post_meta($post_ID,ThemeConfig::$views_meta_name,true);

            if($post_views == "")

            {

                //删除错误字段

                delete_post_meta($post_ID,ThemeConfig::$views_meta_name);

                //重新添加字段

                add_post_meta($post_ID,ThemeConfig::$views_meta_name,1,true);

            }

            echo json_encode($post_views);

        }

        else

        {

            echo json_encode(0);

        }

        //退出当前脚本

        die();

    }

    

    //绑定

    add_action("wp_ajax_nopriv_GetVisitors","GetVisitors");

    add_action("wp_ajax_GetVisitors","GetVisitors");



    //增加并返回浏览计数

    function SetVisitors()

    {

        $post_ID = $_GET["post_id"];



        if($post_ID != "")

        {
			echo json_encode("n/a");
			die();
            $post_views = (int)get_post_meta($post_ID,ThemeConfig::$views_meta_name,true);

            //计数+1

            if(!update_post_meta($post_ID,ThemeConfig::$views_meta_name,$post_views + 1))

            {

                //删除错误字段

                delete_post_meta($post_ID,ThemeConfig::$views_meta_name);

                //重新添加字段

                add_post_meta($post_ID,ThemeConfig::$views_meta_name,1,true);

            }

            //返回增加后的计数

            echo json_encode($post_views+1);

        }

        else

        {

            echo json_encode(0);

        }



        //退出当前脚本

        die();

    }

    

    add_action("wp_ajax_nopriv_SetVisitors","SetVisitors");

    add_action("wp_ajax_SetVisitors","SetVisitors");





/*-----------------------------------功能End--------------------------------------------*/
