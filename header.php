<?php header('X-Frame-Options: deny'); ?>

<!DOCTYPE html>

<html lang="zh-hans">

<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta charset="UTF-8" />

<link rel="dns-prefetch" href="//pic.azimiao.com">

<link rel="dns-prefetch" href="//piccdn.azimiao.com">

<link rel="dns-prefetch" href="//js.azimiao.com">

<link rel="dns-prefetch" href="//hm.baidu.com">

<link rel="dns-prefetch" href="https://cdn.v2ex.com">

<meta name = "viewport" content ="initial-scale=1.0,user-scalable=no">

<meta name="theme-color" content="#ff8c83">

<title><?php wp_title('|', true, 'right'); echo get_option('blogname'); if (is_home ()) echo "-", get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>

<?php if ( is_home() ) { ?>

<link rel="canonical" href="<?php bloginfo("url"); ?>" />

<?php } ?>

<?php if( is_singular() ){ ?>

<link rel="canonical" href="<?php the_permalink(); ?>" />

<?php } ?>

<link rel="stylesheet" href="<?php  echo get_template_directory_uri(); ?>/style.css">

<script src="//libs.baidu.com/jquery/1.8.3/jquery.min.js"></script>

<link rel="icon" href="<?php  echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />

<?php wp_head(); ?>

</head>

<body>

<div id="allwrap">

<header class="header">

<div id="navbar">

<div class="inner clearfix">

	<div id="caption">
		<div id="title"><a href="<?php bloginfo("url"); ?>">
			<img src="<?php echo ThemeConfig::$logoPicPath ?>" alt="logo">
		</a></div>
		<div id="tagline" style="color:#ff8c83;padding:0"><?php ThemeConfig::GetSubtitle() ?></div>

	</div>

<div class="navpic">



<img src="<?php echo ThemeConfig::$adPicPath  ?>" alt="Happy2018">

</div>

</div>

</div>

</header>

<div id="navigation">

	<div class="inner clearfix">

	<div id="menus" class="mynav" >

		<?php wp_nav_menu( array( 'theme_location' => 'header-menu',)); ?>

	</div>

<div class="navsearch">

<form action="<?php bloginfo("url"); ?>" method="get" id="searchform">

<input name="s" type="text" class="searchtext" value="输入关键词并回车"  onFocus="if (value =='输入关键词并回车'){value =''}" onBlur="if (value ==''){value='输入关键词并回车'}"/>

<input id="searchbtn" type="submit" class="button" value="搜索">

</form>

</div>

</div>

</div>

<section id="container">