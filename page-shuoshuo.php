<?php /*
Template Name: 说说
author: yetu
url: http://azimiao.com
*/
get_header(); ?>
	<?php echo "<style>
			div.cbp_tmlabel  p{line-height:1.5 !important;margin:0 !important;}
			div.cbp_tmlabel  p img{max-width:100% !important;}
			div.pagination {padding: 0px; margin: 25px 0 40px; text-align: center; font-size: 15px;line-height:17px; position:relative;} 
			.pagination .pg-filler-1 { width:35%;}
			.pagination .pg-filler-2 { width:40%;}
			.pagination .pg-item a, .pagination .pg-item .current,.pagination .pg-dots, .pagination .pg-item .disabled{display:inline-block; color:#666; padding:9px 13px; border-radius:3px; -webkit-border-radius:3px; -moz-border-radius:3px; text-decoration:none; margin:0 1px; min-width:10px; }
			.pagination .pg-item a {-webkit-transition: background .2s linear;-moz-transition: background .2s linear;-ms-transition: background .2s linear;-o-transition:  background .2s linear;transition: background .2s linear;-webkit-backface-visibility: hidden;-moz-backface-visibility: hidden;}
			.pagination .pg-next { position:absolute;right:20px; }
			.pagination .pg-prev { position:absolute; left:20px;}
			.pg-nav-item { text-transform:uppercase;}
			.pagination .pg-item .current, .pagination .pg-item a:hover { background:#FF5E52; color:#fff;}
			div.pagination span.current, div.pagination a  {padding:0px;text-decoration:none;}  
			div.pagination a.navbutton {margin:0 2px;border: 1px solid #eaeaea;}
			</style>" 
	?>
	<div id="content">
	<link rel="stylesheet" href="//css.azimiao.com/shuoshuo.css" type="text/css">
        <div id="article">
			<h1><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            <div class="position">当前位置：<a href="<?php echo get_option('home'); ?>/">首页</a> &raquo; 说说</div>
             <div id="article_content">
			<ul class="cbp_tmtimeline"> 
				<?php 
					$temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query(); 
					$show_posts = 4;  //每页显示的页数
					$permalink = 'Post name'; // Default, Post name
					$post_type = 'shuoshuo';
					//Know the current URI
					$req_uri =  $_SERVER['REQUEST_URI'];  
					//Permalink set to default
					if($permalink == 'Default') {
					$req_uri = explode('paged=', $req_uri);
					if($_GET['paged']) {
					$uri = $req_uri[0] . 'paged='; 
					} else {
					$uri = $req_uri[0] . '&paged=';
					}
					//Permalink is set to Post name
					} elseif ($permalink == 'Post name') {
					if (strpos($req_uri,'page/') !== false) {
					$req_uri = explode('page/',$req_uri);
					$req_uri = $req_uri[0] ;
					
					}
					$uri = $req_uri . 'page/';
					}
					//Query
					//echo 'showposts='.$show_posts.'&post_type='. $post_type .'&paged='.$paged;
					$wp_query->query('showposts='.$show_posts.'&post_type='. $post_type .'&paged='.$paged); 
					//count posts in the custom post type
					$count_posts = wp_count_posts('projects');
  					while ($wp_query->have_posts()) : $wp_query->the_post(); 
					?>
						<li> 
							<time class="cbp_tmtime">
								<span><?php the_time('y-n-j'); ?></span>
							</time> 
    							<div class="cbp_tmlabel"> 
     								<p><?php the_content(); ?></p> 
    							</div> 
    						</li>
					<?php endwhile;?>
					</ul>
					<!-- 分页 -->
					<div class="pagination">
					<?php  by_pagenavi(); ?>
					</div>
					<?php
						function by_pagenavi( $before = '', $after = '', $p = 2 ) {
						    if ( is_singular() ) return;
						    global $wp_query, $paged;
						    $max_page = $wp_query->max_num_pages;
						    if ( $max_page == 1 )
						        return;
						    if ( empty( $paged ) )
						        $paged = 1;
						    echo $before;
						    if ( $paged > 1)
						        by_p_link( $paged - 1, '上一页', '<span class="pg-item pg-nav-item pg-prev">' ,'上一页' );
						    if ( $paged > $p + 1 )
						        by_p_link( 1, '首页','<span class="pg-item">',1 );
						    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
						        if ( $i > 0 && $i <= $max_page )
						            $i == $paged ? print "<span class='pg-item pg-item-current'><span class='current'>{$i}</span></span>" : by_p_link( $i,'', '<span class="pg-item">',$i);
						    }
						    if ( $paged < $max_page - $p ) by_p_link( $max_page,  '末页' ,'<span class="pg-item"> ... </span><span class="pg-item">',$max_page );
						    if ( $paged < $max_page ) by_p_link( $paged + 1,'下一页', '<span class="pg-item pg-nav-item pg-next">' , '下一页' );
						    echo $after;
						}
						function by_p_link( $i, $title = '', $linktype = '' , $prevnext='') {
						    if ( $title == '' ) $title ="浏览第{$i}页" ;
						    if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
						    echo "{$linktext}<a style = 'border-bottom:1px solid #eaeaea !important;' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}' class='navbutton'>{$prevnext}</a></span>";
						}
					?>
			
            </div>
			<?php comments_template(); ?>	
		</div>
	</div>
<?php get_sidebar('page'); ?>
<?php get_footer(); ?>