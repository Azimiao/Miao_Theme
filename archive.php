<?php get_header(); ?>
<?php if( is_search() && !have_posts() ) { echo '暂无搜索结果！'; }else{ ?>

	
	<section id="content">
	<article id="archive">
        <?php include(TEMPLATEPATH . '/functions/Purelove_post.php'); ?>	
    <div class="pagenavi">
			<?php include('functions/Purelove_paging.php'); ?>
	</div>
	</article>
    </section>
     <?php get_sidebar(); ?>
<?php } ?>
<?php get_footer(); ?>