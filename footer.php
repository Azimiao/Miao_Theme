</section>
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
		1.您可自由分发和演绎本站内容，只需保留本站署名且非商业使用(CC BY-NC-SA 3.0 CN)。<br/>
        	2.本站引用资源会尽最大可能标明出处及著作权所有者，但不能保证对所有资源都可声明上述内容。侵权请联络admin|AT|azimiao.com。<br/>
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
<script src="//js.azimiao.com/zi_MessageBox_0_0_4.js" ></script>
<script>init_Message_Box("newpink","welcome");</script>
<!-- 消息框End -->



<!-- 雪花 -->
<script>
var myDate = new Date();
var todayDate = new Date();
var month=todayDate.getMonth()+1;
var date=todayDate.getDate(); 
jQuery(document).ready(function($){
	if((month == 12 && date >= 21 && date <= 25) || (month == 2 && date >=13 && date <= 18))
	{
		$("body").append("<link rel=\"stylesheet\" href=\"//css.azimiao.com/Snow-1.css\">");
		$("body").append("<canvas id=\"Snow\"></canvas>");
		(function() {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame ||
    function(callback) {
        window.setTimeout(callback, 1000 / 60);
    };
    window.requestAnimationFrame = requestAnimationFrame;
})();

var flakes = [],

    canvas = document.getElementById("Snow"),

    ctx = canvas.getContext("2d"),

    flakeCount = 200,

    mX = -100,

    mY = -100



canvas.width = window.innerWidth;

canvas.height = window.innerHeight;



function snow() {

    ctx.clearRect(0, 0, canvas.width, canvas.height);



    for (var i = 0; i < flakeCount; i++) {

        var flake = flakes[i],

            x = mX,

            y = mY,

            minDist = 150,

            x2 = flake.x,

            y2 = flake.y;



        var dist = Math.sqrt((x2 - x) * (x2 - x) + (y2 - y) * (y2 - y)),

            dx = x2 - x,

            dy = y2 - y;



        if (dist < minDist) {

            var force = minDist / (dist * dist),

                xcomp = (x - x2) / dist,

                ycomp = (y - y2) / dist,

                deltaV = force / 2;



            flake.velX -= deltaV * xcomp;

            flake.velY -= deltaV * ycomp;



        } else {

            flake.velX *= .98;

            if (flake.velY <= flake.speed) {

                flake.velY = flake.speed

            }

            flake.velX += Math.cos(flake.step += .05) * flake.stepSize;

        }



        ctx.fillStyle = "rgba(255,255,255," + flake.opacity + ")";

        flake.y += flake.velY;

        flake.x += flake.velX;

            

        if (flake.y >= canvas.height || flake.y <= 0) {

            reset(flake);

        }





        if (flake.x >= canvas.width || flake.x <= 0) {

            reset(flake);

        }



        ctx.beginPath();

        ctx.arc(flake.x, flake.y, flake.size, 0, Math.PI * 2);

        ctx.fill();

    }

    requestAnimationFrame(snow);

}



function reset(flake) {

    flake.x = Math.floor(Math.random() * canvas.width);

    flake.y = 0;

    flake.size = (Math.random() * 3) + 2;

    flake.speed = (Math.random() * 1) + 0.5;

    flake.velY = flake.speed;

    flake.velX = 0;

    flake.opacity = (Math.random() * 0.5) + 0.3;

}



function init() {

    for (var i = 0; i < flakeCount; i++) {

        var x = Math.floor(Math.random() * canvas.width),

            y = Math.floor(Math.random() * canvas.height),

            size = (Math.random() * 3) + 2,

            speed = (Math.random() * 1) + 0.5,

            opacity = (Math.random() * 0.5) + 0.3;



        flakes.push({

            speed: speed,

            velY: speed,

            velX: 0,

            x: x,

            y: y,

            size: size,

            stepSize: (Math.random()) / 30,

            step: 0,

            angle: 180,

            opacity: opacity

        });

    }



    snow();

}



document.addEventListener("mousemove", function(e) {

    mX = e.clientX,

    mY = e.clientY

});

window.addEventListener("resize", function() {

        canvas.width = window.innerWidth;

        canvas.height = window.innerHeight;

});

init();



		

	}

});

</script>

<!-- 雪花End -->





<?php wp_footer(); ?>

<?php 

	//显示调试信息
	if(function_exists('performance')) performance(false) ;

?>

</body>

</html>