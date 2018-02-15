<?php /*
Template Name: 友情链接
author: yetu
url: http://azimiao.com
*/
?>



<?php get_header(); ?>







	<style type="text/css">

		/*圆形友链头像*/



.link-content li{float:left;text-align: center;width: 100px;font-size:15px;margin:0 10px 10px 10px;list-style-type:none !important;border:1px solid gray;border-radius: 5px;box-shadow: 0 0 5px gray;transition:background,box-shadow,border 0.5s,0.5s,0.5s}



.link-content li img{max-width: 100% !important;margin-bottom: 5px !important;border-top-right-radius: 4px;border-top-left-radius: 4px;}

.link-content li span{display:block}

.link-content li:hover{border-color: #ff8c83;background-color: #ff8c83;color:#fff;box-shadow: 0 0 5px red;}

.link-content li a {color:gray;}

.link-content li:hover a{color:white !important;}

	</style>

	<div id="content">



        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="article">







			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>







            <div class="position">当前位置：<a href="<?php echo get_option('home'); ?>/">首页</a> &raquo; 喵·友链</div>







             <div id="article_content">







			



			<?php $bookmarks=get_bookmarks();

  if ( !empty($bookmarks) ){

    echo '<ul class="link-content clearfix">';

    foreach ($bookmarks as $bookmark) {

      echo '<li><a href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >'. get_avatar($bookmark->link_notes,128) . '<span class="sitename">'. $bookmark->link_name .'</span></a></li>';

    }

    echo '</ul>';

  }

?>



<?php the_content(); ?>



            </div>







			<?php comments_template(); ?>	







		</div>



<?php endwhile; else: ?>



    <?php endif; ?>



	</div>







<?php get_sidebar('page'); ?>







<?php get_footer(); ?>