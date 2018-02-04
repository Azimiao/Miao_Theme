<?php 
//分页功能
$p = 3;
if ( is_singular() ) return;
global $wp_query, $paged;
$max_page = $wp_query->max_num_pages;
if ( $max_page == 1 ) return; 
if ( empty( $paged ) ) $paged = 1;
// echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; 
previous_posts_link('上一页');

if ( $paged > $p + 1 ) p_link( 1, '第一页' );
if ( $paged > $p + 2 ) echo "<span class='dots'>···</span>";
for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
	if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='current'>{$i}</span> " : p_link( $i );
}
if ( $paged < $max_page - $p - 1 ) echo "<span class='dots'> ... </span>";
if ( $paged < $max_page - $p ) p_link( $max_page, '&raquo;' );
next_posts_link('下一页');

function p_link( $i, $title = '' ) {
	if ( $title == '' ) $title = "第 {$i} 页";
	echo "<a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
}
?>