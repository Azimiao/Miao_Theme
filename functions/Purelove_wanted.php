<?php  
//widget Purelove_wanted
add_action('widgets_init', create_function('', 'return register_widget("Purelove_wanted");'));
class Purelove_wanted extends WP_Widget {
	function Purelove_wanted() {
		global $prename;
		$this->WP_Widget('Purelove_wanted', $prename.'Purelove_置顶推荐 ', array( 'description' => '显示置顶文章' ));
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		echo $before_title.$title.$after_title; 
		echo '<ul>';
		echo Purelove_wantedlists( $limit );;
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '置顶推荐',
			'limit' => '10' 
			) 
		);
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
?>
		<p>
			<label>
				标题：
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
<?php
	}
}
function Purelove_wantedlists($limit){
	$sticky = get_option('sticky_posts');rsort( $sticky );$sticky = array_slice( $sticky, 0, $limit );
	query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );
	while (have_posts()) : the_post();
	echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
	endwhile; wp_reset_query();
}
?>