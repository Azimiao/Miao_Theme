<?php

/*

Template Name: Archives

*/

?>

<?php get_header(); ?>

	<section id="content">

        <article id="article" class="post-entry">

		<h1>文章归档</h1>

			<?php

    $previous_year = $year = 0;

    $previous_month = $month = 0;

    $ul_open = false;



    $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');



    foreach($myposts as $post) :

        setup_postdata($post);



        $year = mysql2date('Y', $post->post_date);

        $month = mysql2date('n', $post->post_date);

        $day = mysql2date('j', $post->post_date);



        if($year != $previous_year || $month != $previous_month) :

            if($ul_open == true) : 

                echo '</table>';

            endif;



            echo '<h3>'; echo the_time('Y年F'); echo '</h3>';

            echo '<table>';

            $ul_open = true;



        endif;



        $previous_year = $year; $previous_month = $month;

    ?>

        <tr>

            <td width="40" style="text-align:right;"><?php the_time('j'); ?>日</td>

            <td width="520"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>

            <td width="120"><a class="comm" href="<?php comments_link(); ?>" title="查看 <?php the_title(); ?> 的评论"><?php comments_number('0', '1', '%'); ?>人评论</a></td>

        </tr>

    <?php endforeach; ?>

    </table>

		

	</section>

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>