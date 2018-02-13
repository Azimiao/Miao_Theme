<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="article">

			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>

            <div class="position">当前位置：<a href="<?php echo get_option('home'); ?>/">首页</a> &raquo; 本页</div>

             <div id="article_content">

			<?php the_content(); ?>

			<?php wp_link_pages(); ?>

            </div>

			<?php comments_template(); ?>	

		</div>

    <?php endwhile; else: ?>

    <?php endif; ?>

	</div>

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>