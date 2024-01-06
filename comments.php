<?php

defined('ABSPATH') or die('This file can not be loaded directly.');

global $comment_ids; $comment_ids = array();

foreach ( $comments as $comment ) {

	if (get_comment_type() == "comment") {

		$comment_ids[get_comment_id()] = ++$comment_i;

	}

} 



if ( comments_open() ) { 

?>

<div id="respond">

	<h3 class="coms_underline">

		<?php comment_form_title('我来吐槽', '吐槽 %s'); ?>

	</h3>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>

	<h3 class="queryinfo">

		<?php printf('想吐槽您必须先<a href="%s">登录</a>！', wp_login_url( get_permalink() ) );?>

	</h3>

	<?php } else { ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) { ?>

		<div id="author-info" class="user-logged">

			<?php printf('欢迎绅士 %s ~~', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php echo '换马甲 &raquo;'; ?>"><?php echo '退出 &raquo;'; ?></a>

		</div>

		<?php } else { ?>

		<div id="comment-author-info" <?php if ( !empty($comment_author) ) echo 'style="display:none"'; ?>>

			<p><label for="author">昵称</label><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="14" tabindex="1" /><em>*</em></p>

			<p><label for="email">邮箱</label><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="25" tabindex="2" /><em>*</em></p>

			<p class="comment-author-url" style="display:none;" ><label for="url">空间</label><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="36" tabindex="3" /></p>

		</div>

		<?php if ( !empty($comment_author) ) { ?>

		<div id="author-info">

			<span class="author-info-r"><a id="tab-author" href="javascript:;">换马甲</a></span>

			<?php echo $comment_author ?>

		</div>

		<?php } } ?>

		<div class="post-area">
			<div id="smileys"><?php comments_smilies();?></div>
			<div class="comment-editor">
			
			   <a id="comment-smiley" href="javascript:;">表情</a><a href="javascript:SIMPALED.Editor.pre()">代码</a><a href="//www.appinn.com/markdown/" target="_blank">MD语法参考</a>

			</div>

			
			

			<textarea name="comment" id="comment" cols="100%" rows="7" tabindex="4" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>

		</div>

		<div class="subcon">

			<input class="btn primary" type="submit" name="submit" id="submit" tabindex="5" value="吐槽一下（Ctrl+Enter）" />

			<a rel="nofollow" id="cancel-comment-reply-link" href="javascript:;">取消</a>

			<?php comment_id_fields(); do_action('comment_form', $post->ID); ?>

		</div>

	</form>

	<?php } ?>

</div>

<?php } else { ?>

	<h3 class="queryinfo">本文评论已经关闭</h3>

<?php } 



if ( have_comments() ) { 

	$my_email = get_bloginfo ( 'admin_email' );

	$str = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = '' AND comment_author_email";

	$count_t = $post->comment_count;

	$count_v = $wpdb->get_var("$str != '$my_email'");

	$count_h = $wpdb->get_var("$str = '$my_email'");

?>

<div id="postcomments">

	<h3 class="coms_underline" id="comments">

		<span><a href="#"></a></span><strong><span class="count"><?php echo $count_v; ?></span></strong>位绅士参与评论

	</h3>

	<div id="loading-comments"></div>

	<ol class="commentlist">

		<?php wp_list_comments('type=comment&callback=comments_list') ?>

	</ol>

	<div class="pagenav">

		<?php paginate_comments_links('prev_next=0');?>

	</div>

</div>

<?php 

} 

?>

