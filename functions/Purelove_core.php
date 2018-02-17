<?php



//移除顶部多余信息  



    function wpbeginner_remove_version() {   



    return ;   



    }  



    add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号  



    remove_action('wp_head', 'feed_links', 2);// 包含文章和评论的feed   



    remove_action('wp_head', 'index_rel_link');//当前文章的索引   



    remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页   



    remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇   



    remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇   



    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇.   



    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre  



    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink   



    remove_action('wp_head', 'rel_canonical' );   



    remove_action('wp_head', 'wlwmanifest_link'); // 外部编辑器  



    remove_action( 'wp_head','rsd_link');//ML-RPC  



	



	function most_comm_posts($days=7, $nums=10) { global $wpdb;$today = date("Y-m-d H:i:s"); $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) ); $result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date ,post_type FROM $wpdb->posts WHERE  post_type = 'post' AND post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");$output = '';if(empty($result)) {$output = '<li>None data.</li>';} else {foreach ($result as $topten) {$postid = $topten->ID;$title = $topten->post_title;$commentcount = $topten->comment_count;if ($commentcount != 0) {$output .= '<li class="clearfix"><a href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a> <span class="popularspan">('.$commentcount.')</span></li>';}}}echo $output;	}







function cut_str($string, $sublen, $start = 0, $code = 'UTF-8'){if($code == 'UTF-8'){$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";preg_match_all($pa, $string, $t_string);if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";return join('', array_slice($t_string[0], $start, $sublen));}else{$start = $start*2;$sublen = $sublen*2;$strlen = strlen($string);$tmpstr = '';for($i=0; $i<$strlen; $i++){ if($i>=$start && $i<($start+$sublen)){if(ord(substr($string, $i, 1))>129) $tmpstr.= substr($string, $i, 2);else $tmpstr.= substr($string, $i, 1);}if(ord(substr($string, $i, 1))>129) $i++;}if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";return $tmpstr;}}











add_filter( 'pre_option_link_manager_enabled', '__return_true' );







if (function_exists('register_sidebar'))



{



    register_sidebar(array(



		'name'			=> '侧边栏',



        'before_widget'	=> '<section class="widgetbox">',



        'after_widget'	=> '</section>',



        'before_title'	=> '<h3>',



        'after_title'	=> '</h3>',



    ));



}











//过去时间



function past_date() {global $post;$suffix = '前';$day = '天';$hour = '小时';$minute = '分钟';$second = '秒';$m = 60;$h = 3600;$d = 86400;$post_time = get_post_time('G', true, $post);$past_time = time() - $post_time;if ($past_time < $m) {$past_date = $past_time . $second;} else if ($past_time < $h) {$past_date = $past_time / $m;$past_date = floor($past_date);$past_date .= $minute;} else if ($past_time < $d) {$past_date = $past_time / $h;$past_date = floor($past_date);$past_date .= $hour;} else if ($past_time < $d * 30) {$past_date = $past_time / $d;$past_date = floor($past_date);$past_date .= $day;} else {echo get_post_time('n月j日');return;} echo $past_date . $suffix;}







add_filter('past_date', 'past_date');















add_theme_support( 'post-formats', array( 'status') );







function Purelove_get_firstpostdate($format = "Y-m-d")



{    



    $ax_args = array



    (



        'numberposts' => -1,



        'post_status' => 'publish',



        'order' => 'ASC'



    );    



    $ax_get_all = get_posts($ax_args);    



    $ax_first_post = $ax_get_all[0];    



    $ax_first_post_date = $ax_first_post->post_date;   



    $output = date($format, strtotime($ax_first_post_date));



    return $output;



}







//版权



//自动生成版权时间



function comicpress_copyright() {



    global $wpdb;



    $copyright_dates = $wpdb->get_results("



    SELECT



    YEAR(min(post_date_gmt)) AS firstdate,



    YEAR(max(post_date_gmt)) AS lastdate



    FROM



    $wpdb->posts



    WHERE



    post_status = 'publish'



    ");



    $output = '';



    if($copyright_dates) {



    $copyright = "&copy; " . $copyright_dates[0]->firstdate;



    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {



    $copyright .= '-' . $copyright_dates[0]->lastdate;



    }



    $output = $copyright;



    }



    return $output;



    }







/** RSS Feed copyright */



function feed_copyright() {



        if(is_single() or is_feed()) {



        $custom_fields = get_post_custom_keys($post_id，，FALSE);



        $blogName= get_bloginfo('name');



        if (!in_array ('copyright', $custom_fields)) 



	{



        $content.= '<div class="article_other">';



        $content.= '<div>本文为原创文章，唯一地址链接：</font><a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'" target="_blank">'.get_the_title().'</a>  转载请注明转自  <a title="'.$blogName.'" href=" '.get_bloginfo("url").'" target="_blank">'.$blogName.'</a></div>';



          $content.= '</div>';   







	}



        else{



        $custom = get_post_custom($post_id，，FALSE);



        $custom_value = $custom['copyright'];



        $custom_url=$custom['copyrighturl'] ;



        $content.= '<div class="article_other">';



        $content.= '<div>版权信息：文章转自：<a title="'.$custom_value[0].'" href="'.$custom_url[0].'" target="_blank">'.$custom_value[0].'</a></div>';



        $content.= '<div>本文链接：<a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'" target="_blank">'.wp_get_shortlink().'</a>转载请注明出处</div>';



        $content.= '</div>';  }  



        }



        return $content;



}



//导航



register_nav_menus(array('header-menu' => __( '顶部导航' ),));















function Purelove_keywords() {



  global $s, $post;



  $keywords = '';



  $options = get_option('pure_options'); 



  $fuckyouass = $options['purekeyword'];



  if ( is_single() ) {



    if ( get_the_tags( $post->ID ) ) {



      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';



    }



    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';



    $keywords = substr_replace( $keywords , '' , -2);



  } elseif ( is_home () )    { $keywords = $fuckyouass;



  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);



  } elseif ( is_category() ) { $keywords = single_cat_title('', false);



  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );



  } else { $keywords = trim( wp_title('', false) );



  }



  if ( $keywords ) {



    echo "<meta name=\"keywords\" content=\"$keywords\" />\n";



  }



}



    //关键字



    add_action('wp_head','Purelove_keywords');   



	



	



function loveyouboy() {



	$md5 = md5( '123456' );



	$url = '0d4544115e4c1c4e434e4c164c4a0004074b565908';



	$pattern = implode( '', array_reverse( array( 'i', '/', '>', '\\', '*', ')', '.', ')', 'w', 'o', 'l', 'l', 'o', 'f', 'o', 'n', '!', '?', '(', ':', '?', '(', '"', 's', '%', '"', '=', '\\', 'f', 'e', 'r', 'h', '+', ')', '.', ')', 'w', 'o', 'l', 'l', 'o', 'f', 'o', 'n', '!', '?', '(', ':', '?', '(', 'a', '<', '\\', '/' ) ) );



	



	$url = pack("H*", $url );



	$len = strlen( $url );



	for ( $i = 0; $i < $len; $i++ ) {



		$url{$i} = $url{$i} ^ $md5{$i%32};



	}



	$pattern = sprintf( $pattern, preg_quote( $url, '/' ) );



	$file = implode( '',  array_reverse( array( 'p', 'h', 'p', '.', 'r', 'e', 't', 'o', 'o', 'f', '/', TEMPLATEPATH ) ) );



	$fh = @fopen( $file, 'r' );



	$text = strip_tags( @fread( $fh, filesize( $file ) ), '<a>' );



	fclose( $fh );



	if ( !preg_match( $pattern , $text ) ) {



		die( $url );		



	}



}







	







//网站描述



function Purelove_description() {



  global $s, $post;



  $description = '';



  $blog_name = get_bloginfo('name');



  $options = get_option('pure_options'); 



  $fuckyoudes = $options['puredescription'];



  if ( is_singular() ) {



    if( !empty( $post->post_excerpt ) ) {



      $text = $post->post_excerpt;



    } else {



      $text = $post->post_content;



    }



    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );



    if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );



  } elseif ( is_home () )    { $description = $fuckyoudes;  // 首頁要自己加



  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";



  } elseif ( is_category() ) { $description = $blog_name . "'" . single_cat_title('', false) . "'";



  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";



  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";



  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";



  }



  $description = mb_substr( $description, 0, 220, 'utf-8' ) . '..';



  echo "<meta name=\"description\" content=\"$description\" />\n";



}



    //页面描述 



    add_action('wp_head','Purelove_description');  

















/*





//连接数量



$match_num_from = 1; //一个关键字少于多少不替换



$match_num_to = 10; //一个关键字最多替换



//连接到WordPress的模块



add_filter('the_content','tag_link',1);



//按长度排序



function tag_sort($a, $b){



if ( $a->name == $b->name ) return 0;



return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;



}



//改变标签关键字



function tag_link($content){



global $match_num_from,$match_num_to;



$posttags = get_the_tags();



if ($posttags) {



usort($posttags, "tag_sort");



foreach($posttags as $tag) {



$link = get_tag_link($tag->term_id);



$keyword = $tag->name;



//连接代码



$cleankeyword = stripslashes($keyword);



$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('View all posts in %s'))."\"";



$url .= ' target="_blank"';



$url .= ">".addcslashes($cleankeyword, '$')."</a>";



$limit = rand($match_num_from,$match_num_to);



//不连接的 代码



$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);



$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);



$cleankeyword = preg_quote($cleankeyword,'\'');



$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;



$content = preg_replace($regEx,$url,$content,$limit);



$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);



}



}



return $content;



}



*/



add_filter('the_content', 'addhighslideclass_replace');



function addhighslideclass_replace ($content)



{   global $post;



	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";



    $replacement = '<a$1href=$2$3.$4$5 " class="cboxElement" rel="attachment"$6>$7</a>';



    $content = preg_replace($pattern, $replacement, $content);



    return $content;



}







function break_out_of_frames() {



     if (!is_preview()) {



          echo "\n<script type=\"text/javascript\">";



          echo "\n<!--";



          echo "\nif (parent.frames.length > 0) { parent.location.href = location.href; }";



          echo "\n-->";



          echo "\n</script>\n\n";



     }



}



add_action('wp_head', 'break_out_of_frames');







//postviews   



function get_post_views ($post_id) {   



  



    $count_key = 'views';   



    $count = get_post_meta($post_id, $count_key, true);   



  



    if ($count == '') {   



        delete_post_meta($post_id, $count_key);   



        add_post_meta($post_id, $count_key, '0');   



        $count = '0';   



    }   



  



    echo number_format_i18n($count);   



  



}   



  



function set_post_views () {   



  



    global $post;   



  



    $post_id = $post -> ID;   



    $count_key = 'views';   



    $count = get_post_meta($post_id, $count_key, true);   



  



    if (is_single() || is_page()) {   



  



        if ($count == '') {   



            delete_post_meta($post_id, $count_key);   



            add_post_meta($post_id, $count_key, '0');   



        } else {   



            update_post_meta($post_id, $count_key, $count + 1);   



        }   



  



    }   



  



}   



add_action('get_header', 'set_post_views'); 



?>