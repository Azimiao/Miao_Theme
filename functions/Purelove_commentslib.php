<?php

//评论者近期评论数目
function WelcomeCommentAuthorBack($email = '') {
    if (empty($email)) {
        return;
    }
    global $wpdb;
    $past_30days = gmdate('Y-m-d H:i:s', ((time() - (24 * 60 * 60 * 90)) + (get_option('gmt_offset') * 3600)));
    $sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments



          WHERE comment_approved = '1'



          AND comment_author_email = '$email'



          AND comment_date >= '$past_30days'";
    $times = $wpdb->get_results($sql);
    $times = ($times[0]->times) ? $times[0]->times : 0;
    $message = $times ? sprintf(__('Hi，一个月内您吐槽了<strong>%1$s</strong>次，继续加油哦！'), $times) : '您很久都没有吐槽了，怎么能这样呢~';
    return $message;
}
//评论样式
function comments_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $commentcount, $wpdb, $post;
    if (!$commentcount) { //初始化楼层计数器
        $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
        $cnt = count($comments); //获取主评论总数量
        $page = get_query_var('cpage'); //获取当前评论列表页码
        $cpp = get_option('comments_per_page'); //获取每页评论显示数量
        if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page == ceil($cnt / $cpp))) {
            $commentcount = $cnt + 1; //如果评论只有1页或者是最后一页，初始值为主评论总数
            
        } else {
            $commentcount = $cpp * $page + 1;
        }
    }
    echo '<li ';
    comment_class();
    echo ' id="comment-' . get_comment_ID() . '">';
    //楼层
    if (!$parent_id = $comment->comment_parent) {
        echo '<div class="coms_floor"><a href="#comment-' . get_comment_ID() . '">';
        printf('%1$s楼', --$commentcount);
        echo '</a></div>';
    }
    //头像
    echo '<div class="coms_avatar">';
    if (($comment->comment_author_email) == get_bloginfo('admin_email')) {
        echo '<img src="' . get_bloginfo('template_directory') . '/images/admin.gif" class="avatar" />';
    } else {
        echo get_avatar($comment->comment_author_email, $size = '36', $default = get_bloginfo('template_directory') . '/images/default.gif');
    }
    echo '</div>';
    //内容
    echo '<div class="coms_main" id="div-comment-' . get_comment_ID() . '">';
    //信息
    echo '<div class="coms_meta">';
    echo '<span class="coms_author"><a href="';
    echo comment_author_url();
    echo '" target="_blank" rel="external nofollow" class="url">';
    echo comment_author();
    echo get_author_class($comment->comment_author_email, $comment->user_id);
    if (user_can($comment->user_id, 1)) {
        echo "<a title='博主认证' class='vip'></a>";
    };
    echo '</a></span>';
    echo get_comment_time('m-d H:i ');
    echo time_ago();
    if ($comment->comment_approved !== '0') {
        echo comment_reply_link(array_merge($args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])));
        echo edit_comment_link(__('(编辑)'), ' - ', '');
    }
    echo '</div>';
    if ($comment->comment_approved == '0') {
        echo '<span class="coms_approved">您的评论将在审核后显示~</span><br />';
    } else {
        echo comment_text();
    }
    echo '</div>';
}

function comments_new($commentauthor, $limit) {
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, 



  SUBSTRING(comment_content,1,45) AS com_excerpt 



  FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' 



  AND comment_type = '' 



  AND comment_author $commentauthor 



  AND post_password = '' 



  ORDER BY comment_date_gmt DESC LIMIT $limit ";
    $comments = $wpdb->get_results($sql);
    foreach ($comments as $comment) {
        $output.= "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . "上的评论\"><em>></em>" . get_avatar($comment->comment_author_email, $size = '36', $default = get_bloginfo('template_directory') . '/images/default.gif') . "<strong>" . strip_tags($comment->comment_author) . "：</strong>" . strip_tags($comment->com_excerpt) . "</a></li>";
    }
    echo $output;
};


//阻止站内文章Pingback
function comments_ping(&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link) if (0 === strpos($link, $home)) unset($links[$l]);
}
add_filter('pre_ping', 'comments_ping');
function time_ago($type = 'commennt', $day = 7) {
    $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
    if (time() - $d('U') > 60 * 60 * 24 * $day) return;
    echo ' (', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前)';
}

//评论回应邮件通知
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
        $message = '<div style="background-color:#fff; border: 1px solid rgb(221, 221, 221); color:#111; font-size:12px; width: 600px; margin:0 auto; margin-top:10px;font-family:微软雅黑, Arial;">



<div style="background: rgb(245, 245, 245); width:100%; height: 30px; color: rgb(113, 62, 221);">



<span style="height: 30px; line-height: 30px;  font-size:12px;margin-left: 190px;">



您在<a style="text-decoration:none; color: rgb(149, 136, 219);font-weight:600;"



href="' . get_option('home') . '">' . get_option('blogname') . '



</a>博客上的留言有回复啦！</span></div>



<div style="width:90%; margin:0 auto">



<p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>



<p>您曾在 [' . get_option("blogname") . '] 的文章



《' . get_the_title($comment->comment_post_ID) . '》 上发表评论:



<p style="margin: 15px 0;background-color: rgb(241, 238, 238);  padding: 10px;">' . nl2br(get_comment($parent_id)->comment_content) . '</p>



<p>' . trim($comment->comment_author) . ' 给您的回复如下:



<p style="margin: 15px 0;background-color: rgb(241, 238, 238);  padding: 10px;">' . nl2br($comment->comment_content) . '</p>



<p>您可以点击 <a style="text-decoration:none; color:#00bbff"



href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复的完整內容</a></p>



<p>欢迎再次光临 <a style="text-decoration:none; color:#00bbff"



href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>



<p style="background: rgb(245, 242, 242);padding: 10px;text-align: right;">©2017 梓喵出没</p>



</div>



</div>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
        //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
        
    }
}
// add_action('comment_post', 'comment_mail_notify');

//获取访客VIP样式
function get_author_class($comment_author_email, $user_id) {
    global $wpdb;
    $author_count = count($wpdb->get_results("SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
    /*如果不需要管理员显示VIP标签，就把下面一行的”//“去掉*/
    $adminEmail = get_option('admin_email');
    if ($comment_author_email == $adminEmail) return;
    if ($author_count >= 10 && $author_count < 20) echo '<a class="vip1" title="评论达人 LV.1"></a>';
    else if ($author_count >= 20 && $author_count < 40) echo '<a class="vip2" title="评论达人 LV.2"></a>';
    else if ($author_count >= 40 && $author_count < 80) echo '<a class="vip3" title="评论达人 LV.3"></a>';
    else if ($author_count >= 80 && $author_count < 160) echo '<a class="vip4" title="评论达人 LV.4"></a>';
    else if ($author_count >= 160 && $author_count < 320) echo '<a class="vip5" title="评论达人 LV.5"></a>';
    else if ($author_count >= 320 && $author_count < 640) echo '<a class="vip6" title="评论达人 LV.6"></a>';
    else if ($author_count >= 640) echo '<a class="vip7" title="评论达人 LV.7"></a>';
}
?>



