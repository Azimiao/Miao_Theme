<!DOCTYPE html>

<html lang="zh-hans">

<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<meta name="theme-color" content="#ff8c83">

<title><?php wp_title('|', true, 'right'); echo get_option('blogname'); if (is_home ()) echo "-", get_option('blogdescription'); if ($paged > 1) echo '-Page ', $paged; ?></title>

<?php if ( is_home() ) { ?>

<link rel="canonical" href="<?php bloginfo("url"); ?>" />

<?php } ?>

<?php if( is_singular() ){ ?>

<link rel="canonical" href="<?php the_permalink(); ?>" />

<?php } ?>
<link rel="icon" href="<?php  echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php  echo get_template_directory_uri(); ?>/style.css">
<script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php  echo get_template_directory_uri(); ?>/css/notify2.css" />


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
<div id = "mainContent">
<div id="navigation">

	<div class="inner clearfix">
	<button 
		class="menu-toggle" 
		onclick="onClickMenuBtn()"
	>主要菜单</button>
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