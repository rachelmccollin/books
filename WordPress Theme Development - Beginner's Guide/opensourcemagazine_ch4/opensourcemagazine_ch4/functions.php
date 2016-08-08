<?php
//register menus
function register_my_menus() {
  register_nav_menus(
    array( 'header-menu' => __( 'Header Menu' ) )
  );
}
add_action( 'init', 'register_my_menus' );
// register widgets
function osmag_widgets_init() {
	register_sidebar (array(
		'name'          => __('Sidebar','osmag'),
		'id'            => "sidebar-widget-area",
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
	register_sidebar (array(
		'name'          => __('Left Footer','osmag'),
		'id'            => "footer-left-widget-area",
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
	register_sidebar (array(
		'name'          => __('Right Footer','osmag'),
		'id'            => "footer-right-widget-area",
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
}
add_action('init', 'osmag_widgets_init');
// featured image support
add_theme_support( 'post-thumbnails' );
?>