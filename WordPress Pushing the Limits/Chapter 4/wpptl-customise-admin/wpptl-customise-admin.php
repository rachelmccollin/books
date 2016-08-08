<?php
/*
Plugin Name: WordPress Pushing the Limits Customise Admin
Plugin URI: http://rachelmccollin.co.uk/wpptl/chapter4
Description: Plugin containing functions from chapter 4 of the book 'WordPress Pushing the Limits' on user roles and capabilities and customising the WordPress admin.
Version: 1.0
Author: Rachel McCollin
Author URI: http://rachelmccollin.com
License: GPLv2
*/

/*  Copyright 2012  Rachel McCollin  (email : contact@rachelmccollin.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
	This plugin supports Chapter 4 of the book 'WordPress Pushing the Limits' by Rachel McCollin, published by Wiley.
	It includes the following functions, which are described in detail in the book:
		- creating a new user role
		- assigning capabilities to that role
		- adding theme customizer support
		- customising the dashboard
		- adding a theme options page
		- adding additional settings pages.
	For more information and to see the plugin in action, visit http://rachelmccollin.co.uk.
*/
?>
<?php
// add new capability to the Editor role
function wpptl_add_editor_capability() {
 $role = get_role( 'editor' );
 $role->add_cap( 'wpptl_editor_cap' ); 
}
add_action( 'register_activation_hook', 'wpptl_add_editor_capability' );
?>
<?php 
// remove unwanted dashboard widgets for relevant users
function wpptl_remove_dashboard_widgets() {
 $user = wp_get_current_user();
 if ( ! $user->has_cap( 'manage_options' ) ) {
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
  } 
 }
add_action( 'wp_dashboard_setup', 'wpptl_remove_dashboard_widgets' );  
?>
<?php
// Move the 'Right Now' dashboard widget to the right hand side
function wpptl_move_dashboard_widget() {
 $user = wp_get_current_user();
 if ( ! $user->has_cap( 'manage_options' ) ) {
  global $wp_meta_boxes;
  $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
  }
}
add_action( 'wp_dashboard_setup', 'wpptl_move_dashboard_widget' );  
?>
<?php
// add new dashboard widgets
function wpptl_add_dashboard_widgets() {
 wp_add_dashboard_widget( 'wpptl_dashboard_welcome', 'Welcome', 'wpptl_add_welcome_widget' );
 wp_add_dashboard_widget( 'wpptl_dashboard_links', 'Useful Links', 'wpptl_add_links_widget' );
}
function wpptl_add_welcome_widget(){ ?>
 <p>This content management system lets you edit the pages and posts on your website.</p>
 <p>Your site consists of the following content, which you can access via the menu on the left:</p>
 <ul>
  <li>Pages - static pages which you can edit.</li>
  <li>Posts - news or blog articles - you can edit these and add more.</li>
  <li>Media - images and documents which you can upload via the Media menu on the left or within each post or page.</li>
 </ul>
 <p>On each editing screen there are instructions to help you add and edit content.</p>
<?php }
function wpptl_add_links_widget() { ?>
 <p>Some links to resources which will help you manage your site:</p>
 <ul>
  <li><a href="http://wordpress.org">The WordPress Codex</a></li>
  <li><a href="http://easywpguide.com">Easy WP Guide</a></li>
  <li><a href="http://www.wpbeginner.com">WP Beginner</a></li>
 </ul>
<?php }
add_action( 'wp_dashboard_setup', 'wpptl_add_dashboard_widgets' );  
?>
<?php
// add a new logo to the login page
function wpptl_login_logo() { ?>
 <style type="text/css">
  body.login #login h1 a {
   background-image: url( <?php echo plugins_url( 'media/compass-framework.png' , __FILE__ ); ?> );
  }
 </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpptl_login_logo' );
?>
<?php
// add menu item
function wpptl_setup_theme_options_page() {  
	add_submenu_page( 'themes.php', 'Theme Options', 'Theme Options', 'manage_options', 'theme-options', 'wpptl_theme_options_page_content');
} 
add_action('admin_menu', 'wpptl_setup_theme_options_page');
// function to define content of new admin screen
function wpptl_theme_options_page_content() {
// Check that the user has permission to access the page
 if (!current_user_can( 'manage_options' ) ) {
    wp_die('Sorry, you do not have sufficient permissions to access this page.');
 }
// Page content
echo '<div class="wrap">';
screen_icon();
echo '<h2 >' . __('Theme Options', 'wpptl' ) . '</h2>';
echo '<form method="post" action="options.php">';
do_settings_sections( 'theme-options' );
settings_fields( 'wpptl_theme_options_group' );
submit_button();
echo '</form></div>';
}
//function to register settings and add sections and fields
function wpptl_theme_options_register_setting() {
 add_settings_section( 'wpptl_contact_settings', 'Contact Details', 'wpptl_contact_settings_cb', 'theme-options' );
 add_settings_field( 'wpptl_contact_tel', 'Contact Telephone', 'wpptl_contact_tel_cb', 'theme-options', 'wpptl_contact_settings', array( 'label_for' => 'Contact Telephone Number' ) );
 add_settings_field( 'wpptl_contact_address', 'Address', 'wpptl_contact_address_cb', 'theme-options', 'wpptl_contact_settings', array( 'label_for' => 'Address' ) );
 add_settings_field( 'wpptl_contact_email', 'Email Address', 'wpptl_contact_email_cb', 'theme-options', 'wpptl_contact_settings', array( 'label_for' => 'Email address' ) );
 register_setting( 'wpptl_theme_options_group', 'wpptl_theme_options_tel' );
 register_setting( 'wpptl_theme_options_group', 'wpptl_theme_options_address' );
 register_setting( 'wpptl_theme_options_group', 'wpptl_theme_options_email', 'wpptl_email_option_sanitize' );
}
add_action( 'admin_init', 'wpptl_theme_options_register_setting' );
// callback function for the wpptl_contact_settings section
function wpptl_contact_settings_cb() {
echo __('Enter your contact details as you want them to appear on the site', 'wpptl');
}
// callback function for the wpptl_contact_tel field
function wpptl_contact_tel_cb() {
 $setting = esc_attr( get_option( 'wpptl_theme_options_tel' ) );
 echo "<input type='text' name='wpptl_theme_options_tel' value='$setting' />";
}
// callback function for the wpptl_contact_address field
function wpptl_contact_address_cb() {
 $setting = esc_attr( get_option( 'wpptl_theme_options_address' ) );
 echo "<input type='text' name='wpptl_theme_options_address' value='$setting'></textarea>";
}
// callback function for the wpptl_contact_email field
function wpptl_contact_email_cb() {
 $setting = esc_attr( get_option( 'wpptl_theme_options_email' ) );
 echo "<input type='text' name='wpptl_theme_options_email' value='$setting' />";
}
//callback function to sanitise the email field
function wpptl_email_option_sanitize( $input ) {
 $output = get_option( 'wpptl_theme_options_email' );
 if( is_email( $input ) )
  $output = $input;
 else
  add_settings_error( 'wpptl_theme_options_email', 'invalid-email', 'The text you have entered is not a valid email address. Please try again. ' );
 return $output;
}
?>
<?php
// customise the posts listing screen
function wpptl_remove_pages_column( $columns ) {
 unset($columns['tags']);
 unset($columns['comments']);
 return $columns;
}
add_filter( 'manage_posts_columns', 'wpptl_remove_pages_column' );
add_filter( 'manage_product_posts_columns', 'wpptl_remove_pages_column' );
?>

<?php
// add meta box to post editing screen with help text
function wpptl_add_posts_help_text() {
$user = wp_get_current_user();
 if ( $user->has_cap( 'wpptl_editor_cap' ) ) {
  add_meta_box( 'wpptl_posts_help_text', 'Using this screen', 'wpptl_posts_help_text', 'post', 'normal' );
 }
}
add_action( 'add_meta_boxes', 'wpptl_add_posts_help_text' );
// callback function defining content of meta box
function wpptl_posts_help_text() { ?>
 <p>Use this screen to create new posts and edit existing ones. Some tips:</p>
 <ul>
  <li>After creating your post, you can preview how it will look before saving it by clicking the 'Preview' button</li>
  <li>To save your post, click 'Publish'</li>
  <li>After editing an existing post, click 'Update' to save your changes</li>
 </ul>
<?php }
?>
