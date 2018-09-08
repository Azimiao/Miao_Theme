</section>
</div>
<span class="clearfix"></span>
<div id="bak_top"></div>
</div>
<footer class="footer">
<div class="inner clearfix">
	<div class="fotbox">
		<h3>标签云</h3>
			<?php
				wp_tag_cloud( array(
        				'unit' => 'px',
        				'smallest' => 12,
        				'largest' => 12,
        				'number' => 20,
        				'format' => 'flat',
        				'orderby' => 'count',
        				'order' => 'DESC'
				    )
				);

			?>
	</div>


	<div class="fotbox link">
		<h3>版权声明</h3>
		<?php echo ThemeConfig::$copyRightText; ?>
	</div>
	<div class="fotbox2">

	       <h3>我の介绍</h3>
		<?php echo ThemeConfig::$aboutMe; ?>
	</div>
</div>


<div class="copry clearfix">
	<div class="maxt">
    	       <span id="mt"><a href="//cn.wordpress.org" rel="external" target="_blank"><i class="miao miao-wordpress miao-fw"></i></a> <a href="//creativecommons.org/licenses/by-nc-sa/3.0/cn/legalcode" target="_blank"><i class="miao miao-cc miao-fw"></i></a>Theme Purelove by <a href="//www.wysafe.com" target="_blank">梦月酱</a></span>
		<div id="copyright">
			<?php $options = get_option('pure_options'); ?>
			<i class="miao miao-copyright miao-fw"></i>2014-2017 <?php bloginfo('name'); ?> | <a href="<?php ThemeConfig::GetSiteMap() ?>" target="_blank">[网站地图]</a> |  <?php echo($options['beianhao']); ?> <?php echo($options['tongjicode']); ?> 
		</div>
	</div>
</div>


</footer>




<?php if( is_single() || is_page() && comments_open() ){ ?>

<script src="<?php  echo get_template_directory_uri(); ?>/js/comments.js" ></script>
<script type="text/javascript" src="<?php  echo get_template_directory_uri(); ?>/colorbox/jquery.colorbox-min.js" ></script>



<!-- activity-power-mode 打字效果 -->
<script src='<?php  echo get_template_directory_uri() ?>/js/activity-power-mode.min.js' ></script>

<script>
POWERMODE.colorful = true;
POWERMODE.shake = false;
document.body.addEventListener('input', POWERMODE);
</script>

<!-- 打字效果End -->
<?php }; ?>


<script src="<?php  echo get_template_directory_uri(); ?>/js/purelove.js" ></script>


<!-- 标题变化 -->
<script>
eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('g(0).h(e(){e d(){0.9=0[b]?" :( 别走,嘛去?再待会儿~ ":a}f b,c,a=0.9;"2"!=4 0.8?(b="8",c="k"):"2"!=4 0.5?(b="5",c="j"):"2"!=4 0.6&&(b="6",c="l"),("2"!=4 0.7||"2"!=4 0[b])&&0.7(c,d,!1)});',22,22,'document||undefined||typeof|mozHidden|webkitHidden|addEventListener|hidden|title|||||function|var|jQuery|ready|Hi|mozvisibilitychange|visibilitychange|webkitvisibilitychange'.split('|'),0,{}))
</script>
<!-- 标题变化End -->



<!-- 消息框 -->
<!--
<script src="//js.azimiao.com/zi_MessageBox_0_0_4.js" ></script>
<script>init_Message_Box("newpink","welcome");</script>
-->
<script src="<?php  echo get_template_directory_uri(); ?>/js/zi_message2.js" type="text/javascript" charset="utf-8"></script>
<script>
	zi_welcome.checkCookie();
</script>
<script src="http://localhost.azimiao.com/wp-content/themes/PureLove/js/responsiveslides.min.js"></script>
<!-- 消息框End -->


<?php wp_footer(); ?>

<?php 

	//显示调试信息
	if(function_exists('performance')) performance(false) ;

?>

</body>

</html>