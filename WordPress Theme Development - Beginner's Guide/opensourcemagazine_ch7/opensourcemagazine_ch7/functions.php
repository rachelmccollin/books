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
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
	register_sidebar (array(
		'name'          => __('Left Footer','osmag'),
		'id'            => "footer-left-widget-area",
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
	register_sidebar (array(
		'name'          => __('Right Footer','osmag'),
		'id'            => "footer-right-widget-area",
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>' )
		);
}
add_action('init', 'osmag_widgets_init');

// featured image support
add_theme_support( 'post-thumbnails' );

// theme customizer support
function add_theme_customizer( $wp_customize )
   {
	// SETTINGS
		$wp_customize->add_setting( 'content_link_color', array(
			'default' => '#088fff',
			'transport' => 'refresh',
			) );
	// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content_link_color', array(
			'label' => 'Content Link Color',
			'section' => 'colors',
			) ) );
 	}
add_action( 'customize_register', 'add_theme_customizer');
// generate live CSS from the theme customizer
function theme_customize_css()
	{
    ?>
         <style type="text/css">
             a { color:<?php echo get_theme_mod( 'content_link_color' ); ?>; }
         </style>
    <?php
	}
add_action( 'wp_head', 'theme_customize_css');
?>