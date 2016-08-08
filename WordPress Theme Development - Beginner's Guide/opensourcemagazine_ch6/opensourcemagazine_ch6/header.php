<!DOCTYPE html>
<html lang="en" class='no-js'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!--for mobile ready-->	
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>

<link rel="apple-touch-icon" sizes="57x57" href="images/pngs/apple-touch-icon-57x57.png"/>
<link rel="apple-touch-icon" sizes="72x72" href="images/pngs/apple-touch-icon-72x72.png"/>
<link rel="apple-touch-icon" sizes="114x114" href="images/pngs/apple-touch-icon-114x114.png"/>

<title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" >

<!--//style sheets-->
<link media="all" rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<!--//javascripts-->
<script src="js/modernizr.custom.20796.js"></script>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link media="all" rel="stylesheet" type="text/css" href="css/style-ie.css" />
<![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class($class); ?>>
<div id="container">
<header class="">
<hgroup class="screen-reader-text">
	<h1 id="site-title"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
	<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
    </hgroup>
</header>

<nav id="mainNav" class="grd-vt-tertiary shdw-centered">
	<h2 class="screen-reader-text">Main Navigation:</h2>
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_class' => 'sfTab' ) ); ?>
</nav><!--//top_navlist-->