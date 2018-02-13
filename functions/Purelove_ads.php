<?php
//widget Purelove_ads
add_action('widgets_init', create_function('', 'return register_widget("Purelove_ads");'));
class Purelove_ads extends WP_Widget {
    function Purelove_ads() {
        global $prename;
        $this->WP_Widget('Purelove_ads', $prename . '广告 ', array('description' => '显示一个侧栏广告'));
    }
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = apply_filters('widget_name', $instance['title']);
        $code = $instance['code'];
        echo $code;
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['code'] = $new_instance['code'];
        return $instance;
    }
    function form($instance) {
        $instance = wp_parse_args((array)$instance, array('title' => '广告 ' . date('Y-m-d'), 'code' => '<a target="_blank" href="链接"><img src="图片地址"></a>'));
        $title = $instance['title'];
        $code = $instance['code'];
?>


		<p>


			<label>


				广告名称：


				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" class="widefat" />


			</label>


		</p>


		<p>


			<label>


				广告代码：


				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="10" style="font-family:Courier New;"><?php echo attribute_escape($code); ?></textarea>


			</label>


		</p>


		<p>广告预览：</p>


		<p style="text-align:center">


			<?php echo $code; ?>


		</p>


<?php
    }
}
?>