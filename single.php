<?php get_header(); ?>

<section id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!--文章区域-->
<article id="article" class="post-entry">

<header class="entry-header" itemscope itemtype="http://data-vocabulary.org/Person">

<h1 class="entry-title" itemtype="http://schema.org/Article"><a itemprop="url" href="<?php the_permalink() ?>" rel="bookmark"><span itemprop="name"><?php the_title(); ?></span></a></h1>

<div class="entry-meta">
<span>📅</span>
<span ><?php the_time('Y-n-d') ?></span> /🏸

<span itemprop="articleSection"><?php the_category(', ') ?></span> /📌

<span itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name" class="fn"><?php the_author(); ?></span></span>
<!-- 	/

<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><span id ="viewsNum" name="<?php //the_ID();  ?>" itemprop="ratingCount">...</span>人阅读 -->

<span class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">位置：<a href="<?php echo get_option('home'); ?>/">首页</a> &raquo; <?php the_category(', ') ?> &raquo; <a href="<?php the_permalink() ?>" rel="bookmark" itemprop="url">本页</a></span>

</div>

</header>

<div id="article_content" class="entry-content" itemtype="http://schema.org/Article" itemprop="articleBody" >

  <!-- 设置缩略图显示-->

  <?php getSingleThumb(); ?>

<?php the_content();?>

</div>

<div id="heart" style="text-align: center;"><embed src="<?php  echo get_template_directory_uri(); ?>/images/heart1.svg" width="64" height="64" 

type="image/svg+xml"

pluginspage="http://www.adobe.com/svg/viewer/install/" /></div>


<span class="poststags clearfix"><?php echo the_tags('',''); ?></span>

<div class="article_previous"><?php if (get_previous_post()) { previous_post_link('%link','%title');}  ?></div>

<div class="article_next"><?php if (get_next_post()) { next_post_link('%link','%title');} ?></div>

<div class="clearfix"></div>

<div id="related">

<h3 class="coms_underline">你可能也喜欢</h3>

<ul>

<?php

global $post;

$cats = wp_get_post_categories($post->ID);

if ($cats) {

    $args = array(

          'category__in' => array( $cats[0] ),

          'post__not_in' => array( $post->ID ),

          'showposts' => 6,

          'caller_get_posts' => 1

      );

  query_posts($args);



  if (have_posts()) {

    while (have_posts()) {

      the_post(); update_post_caches($posts); ?>

  <li> <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,20); ?></a></li>

<?php

    }

  } 

  else {

    echo '<li>暂无相关文章</li>';

  }

  wp_reset_query(); 

}

else {

  echo '<li>暂无相关文章</li>';

  wp_reset_query(); 

}

?>

</ul>

</div>

<?php comments_template( '', true ); ?>   



</article>

<!-- 文章区域结束 -->

<?php endwhile; endif;?>  

</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>