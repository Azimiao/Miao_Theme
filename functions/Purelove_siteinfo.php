<?php
class Purelove_siteinfo extends WP_Widget {
    function Purelove_siteinfo() {
        $widget_ops = array('description' => '网站统计功能');
        $this->WP_Widget('Purelove_siteinfo', 'Purelove_网站统计', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        echo $before_widget;
        $start=Purelove_get_firstpostdate();
?>
    <h3>网站统计</h3>
        <ul class="blogroll clearfix">
            <li>文章总数：<?php $count_posts = wp_count_posts();echo $published_posts = $count_posts->publish;?>篇</li>
            <li>评论总数：<?php $count_comments = get_comment_count();echo $count_comments['approved'];?>条</li>
            <li>页面总数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> 个</li>
            <li>分类总数：<?php echo $count_categories = wp_count_terms('category'); ?>个</li>
            <li>标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?>个</li>
            <li>网站运行：<?php echo floor((time()-strtotime($start))/86400); ?>天</li>
        </ul> 
<?php    
      echo $after_widget;
   }
    function form($instance) {
        global $wpdb;
?>
    <p>该工具没有选项!</p>
<?php
    }
}
add_action('widgets_init', 'Purelove_siteinfo_init');
function Purelove_siteinfo_init() {
    register_widget('Purelove_siteinfo');
}
?>