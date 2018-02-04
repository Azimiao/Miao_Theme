<?php
/*
Template Name: Tags
*/
?>
<?php get_header(); ?>
	<div id="content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="article" class="fluid post-entry">
			<h1><?php echo get_the_title(); ?><strong>All Tags</strong>（共计<?php echo $count_tags = wp_count_terms('post_tag'); ?>个标签）</h1>
            <div class="position">当前位置：<a href="<?php echo get_option('home'); ?>/">首页</a> &raquo; 本页</div>
	<ul class="tag-clouds">
		<?php $tags_list = get_tags('orderby=count&order=DESC');
		if ($tags_list) { 
			foreach($tags_list as $tag) {
				echo '<li><a class="tag-link" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong><p class="tag-posts">'; 
				$posts = get_posts( "tag_id=". $tag->term_id ."&numberposts=1" );
				if( $posts ){
					foreach( $posts as $post ) {
						setup_postdata( $post );
						echo '<a href="'.get_permalink().'">'.get_the_title().'</a></p><em>'.get_the_time('Y-m-d').'</em>';
					}
				}
				echo '</li>';
			} 
		} 
		?>
	</ul>
		</article>
    <?php endwhile; else: ?>
    <?php endif; ?>
	</div>
<?php get_sidebar('page'); ?>
<?php get_footer(); ?>