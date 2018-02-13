<section class="widgetbox">

<div id="aio_swc">

<span id="aio_tab1" class="on">评论</span>

<span id="aio_tab2">最热</span>

<span id="aio_tab3">随机</span>

</div>	

<section class="aio_box">

		<ul class="aio_tab1">

											<?php

						global $wpdb;

						$limit_num = 4 ; 

						$my_email ="'" . $email . "'";

						$rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");

						$rc_comments = '';foreach ($rc_comms as $rc_comm) { $rc_comments .= "<li class='kcommentli clearfix'>" . get_avatar($rc_comm,$size='30') ."<a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title='在 " . $rc_comm->post_title .  " 发表的评论'>".cut_str(strip_tags($rc_comm->comment_content),15)."</a><br><span class='kcomtime'>" .$rc_comm->comment_date."</span></li>\n";}

						$rc_comments = convert_smilies($rc_comments);

						echo $rc_comments;

						?>		

		</ul>

		

		<ul class="aio_tab2">

		<?php $posts = query_posts($query_string . "orderby=date&showposts=5()" ); ?>  

				<?php while(have_posts()) : the_post(); ?> 

                <li class="clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li> 

        <?php endwhile; wp_reset_query(); ?>

		</ul>

		

		<ul class="aio_tab3">

		<?php $posts = query_posts($query_string . "orderby=rand&showposts=5()" ); ?>  

				<?php while(have_posts()) : the_post(); ?> 

                <li class="clearfix"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li> 

        <?php endwhile; wp_reset_query(); ?>

		</ul>

</section>

</section>