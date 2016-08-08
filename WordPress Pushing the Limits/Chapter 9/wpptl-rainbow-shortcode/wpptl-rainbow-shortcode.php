<?php
/*
Plugin Name: WordPress Pushing the Limits Rainbow Shortcode Plugin
Plugin URI: http://rachelmccollin.co.uk/wordpress-pushing-the-limits/rainbow-plugin
Description: Plugin used for demonstration in the book ‘WordPress Pushing the Limits’. This plugin adds functionality for a [rainbow] shortcode with a color parameter.
Version: 1.0
Author: Rachel McCollin
Author URI: http://rachelmccollin.co.uk
License: GPLv2
*/

function wpptl_rainbow_colors( $atts ) {
 extract(shortcode_atts(array(
		'color' => 'red',
	), $atts ));
 return '<span class="rainbow ' . $color . '">' . $color . '</span>';
}
add_shortcode('rainbow', 'wpptl_rainbow_colors' );

function wpptl_add_rainbow_stylesheet() {
 wp_register_style( 'wpptl-rainbow-styles', plugins_url('/css/wpptl-rainbow-styles.css', __FILE__) );
 wp_enqueue_style( 'wpptl-rainbow-styles' );
 }

add_action( 'wp_enqueue_scripts', 'wpptl_add_rainbow_stylesheet' );
?>