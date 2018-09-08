<?php




if (have_posts()):







    while (have_posts()):the_post(); ?>



<?php



    if (has_post_format('status')) { ?>



        <article class="post-status">



            <div class="aside-pointer">



            <?php echo get_avatar(get_the_author_email() , 55); ?>



    	        <div class="aside-time"><?php the_time('n-d') ?></div>



            </div>



            <div class="aside-entry"><?php the_content(); ?></div> 		



        </article>





<?php



    }else { ?>  



<!-- 首页文章 -->  



<article class="posts" itemscope itemtype="http://schema.org/Article">



<!-- 分类标签处 -->

<div class="label"><?php the_category(', ') ?><i class="label-arrow"></i></div>



<h2 class="entry-title">

   <!-- <i class="miao miao-align-left miao-fw"></i>-->



	<a itemprop="url" href="<?php the_permalink() ?>" rel="bookmark">



		<span itemprop="name"><?php the_title(); ?></span>



	</a>



</h2>





<div class="entry-meta">



	<span ><?php the_time('Y-n-d') ?></span> /



    Write by

	<span itemprop="author" itemscope itemtype="http://schema.org/Person">



		<span itemprop="name" class="fn"><?php the_author(); ?></span>



	</span> /



	<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">



	<span name="viewsNum" id= "viewsNum-<?php the_ID();  ?>" itemprop="ratingCount">...</span>人阅读 
        

	</span>



</div>







<div class="clearfix"></div>







<!-- pic -->



<div class="postspicbox">



	<div class="thumbnail">



		 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank">

	            <img src="<?php echo post_thumbnail(140,100); ?> " alt="<?php the_title(); ?>" >

		  </a>


	</div>

<!-- picFinished -->

</div>



<div class="postscontent entry-content" itemprop="articleBody">



<?php



            if (post_password_required($post)) {



                $output = get_the_password_form();



                echo $output;



            } else {



                //echo mb_substr(strip_tags(apply_filters('the_content', $post->post_content)) , 0, 200, 'utf-8');



                echo the_excerpt();



            }



?>



</div>



</article>



<?php



        } ?>



<?php



    endwhile;



endif; ?>



