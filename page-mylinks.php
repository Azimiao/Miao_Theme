<?php /*
Template Name: 友情链接
author: yetu
url: http://azimiao.com
 */
?>
<?php get_header();?>
	<div id="content">
        <?php if (have_posts()): while (have_posts()): the_post();?>
		        <div id="article">
			<h1>
		        <a href="<?php the_permalink()?>" rel="bookmark"><?php the_title();?></a>
		    </h1>
			<div class="position">当前位置：<a href="<?php echo get_option('home');
				       ?>/">首页</a> &raquo; 喵·友链</div>
		    <div id="article_content">
		<?php
            $bookmarks = get_bookmarks();
            if (!empty($bookmarks)) {
                echo '<ul class="link-content clearfix">';
                foreach ($bookmarks as $bookmark) {
                    echo '<li><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >' . get_avatar($bookmark->link_notes, 128) . '<span class="sitename">' . $bookmark->link_name .'</span></a></li>';
                }
                echo '</ul>';
            }
		?>
		<?php the_content();?>
	</div>
        <?php comments_template();?>
</div>
<?php endwhile;else: ?>
<?php endif;?>
</div>
<?php get_sidebar('page');?>
<?php get_footer();?>