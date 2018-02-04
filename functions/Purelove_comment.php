<section class="widgetbox">
<h3>最新评论<span class="line"></span></h3>
						<?php
						global $wpdb;
						$limit_num = 4 ; 
						$my_email ="'" . $email . "'";
						$rc_comms = $wpdb->get_results("SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author_email != $my_email ORDER BY comment_date_gmt DESC LIMIT $limit_num ");
						$rc_comments = '';foreach ($rc_comms as $rc_comm) { $rc_comments .= "<li class='kcommentli clearfix'>" . get_avatar($rc_comm,$size='30') ."<a href='". get_permalink($rc_comm->ID) . "#comment-" . $rc_comm->comment_ID. "' title='在 " . $rc_comm->post_title .  " 发表的评论'>".cut_str(strip_tags($rc_comm->comment_content),15)."</a><br><span class='kcomtime'>" .$rc_comm->comment_date."</span></li>\n";}
						$rc_comments = convert_smilies($rc_comments);
						echo $rc_comments;
						?>	
</section>