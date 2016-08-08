<?php
/*
Plugin Name: WordPress Pushing the Limits Chapter 3
Plugin URI: http://rachelmccollin.co.uk/wpptl/chapter3
Description: Plugin containing all of the functions from chapter 3 of the book 'WordPress Pushing the Limits' including registering custom post types and taxonomies and setting up custom fileds and meta boxes
Version: 1.1
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
	This plugin supports Chapter 3 of the book 'WordPress Pushing the Limits' by Rachel McCollin, published by Wiley.
	It includes the following functions, which are described in detail in the book:
		- registering a custom post type
		- creating custom taxonomies
		- creating a custom meta box to input metadata for the custom post type's posts
		- creating a conditional custom field based on another custom field's value.
	For more information and to see the plugin in action, visit http://rachelmccollin.co.uk.
*/
?>
<?php
// register custom post type for products
function wpptl_create_post_type() {
 $labels = array( 
  'name' => __( 'Products' ),
  'singular_name' => __( 'product' ),
  'add_new' => __( 'New product' ),
  'add_new_item' => __( 'Add New product' ),
  'edit_item' => __( 'Edit product' ),
  'new_item' => __( 'New product' ),
  'view_item' => __( 'View product' ),
  'search_items' => __( 'Search products' ),
  'not_found' =>  __( 'No products Found' ),
  'not_found_in_trash' => __( 'No products found in Trash' ),
 );
 $args = array(
  'labels' => $labels,
  'has_archive' => true,
  'public' => true,
  'hierarchical' => true,
  'supports' => array(
  'title', 
  'editor', 
  'excerpt', 
  'custom-fields', 
  'thumbnail',
  'page-attributes'
  ),
  'taxonomies' => array( 'post_tag', 'category'), 
 );
 register_post_type( 'product', $args );
} 
add_action( 'init', 'wpptl_create_post_type' );
?>
<?php
//register custom taxonomies
function wpptl_create_taxonomies() {
 //define labels for the size taxonomy
 $labels = array(
  'name' => __( 'Size', 'wpptl' ),
  'singular_name' => __( 'Size', 'wpptl'  ),
  'search_items' => __( 'Search Sizes', 'wpptl'  ),
  'all_items' => __( 'All Sizes', 'wpptl'  ),
  'parent_item' => __( 'Parent Size', 'wpptl'  ),
  'parent_item_colon' => __( 'Parent Size:', 'wpptl'  ),
  'edit_item'  => __( 'Edit Size', 'wpptl'  ), 
  'update_item' => __( 'Update Size', 'wpptl'  ),
  'add_new_item' => __( 'Add New Size', 'wpptl'  ),
  'new_item_name' => __( 'New Size', 'wpptl'  ),
  'separate_items_with_commas' => __( 'Separate sizes with commas', 'wpptl' ),
  'menu_name' => __( 'Size' ),
 );
 register_taxonomy( 'size', 'product', array(
  'hierarchical' => false,
  'labels' => $labels,
  'query_var' => true,
  'rewrite' => true,
  'show_admin_column' => true,
  ) 
 );
  //define labels for the color taxonomy
  $labels = array(
  'name' => __( 'Color', 'wpptl' ),
  'singular_name' => __( 'Color', 'wpptl'  ),
  'search_items' => __( 'Search Colors', 'wpptl'  ),
  'all_items' => __( 'All Colors', 'wpptl'  ),
  'parent_item' => __( 'Parent Color', 'wpptl'  ),
  'parent_item_colon' => __( 'Parent Color:', 'wpptl'  ),
  'edit_item'  => __( 'Edit Color', 'wpptl'  ), 
  'update_item' => __( 'Update Color', 'wpptl'  ),
  'add_new_item' => __( 'Add New Color', 'wpptl'  ),
  'new_item_name' => __( 'New Color', 'wpptl'  ),
  'separate_items_with_commas' => __( 'Separate colors with commas', 'wpptl' ),
  'menu_name' => __( 'Color' ),
 );
 register_taxonomy( 'color', 'product', array(
  'hierarchical' => false,
  'labels' => $labels,
  'query_var' => true,
  'rewrite' => true,
  'show_admin_column' => true,
  ) 
 );

  //define labels for the department taxonomy
  $labels = array(
  'name' => __( 'Department', 'wpptl' ),
  'singular_name' => __( 'Department', 'wpptl'  ),
  'search_items' => __( 'Search Departments', 'wpptl'  ),
  'all_items' => __( 'All Departments', 'wpptl'  ),
  'parent_item' => __( 'Parent Department', 'wpptl'  ),
  'parent_item_colon' => __( 'Parent Department:', 'wpptl'  ),
  'edit_item'  => __( 'Edit Department', 'wpptl'  ), 
  'update_item' => __( 'Update Department', 'wpptl'  ),
  'add_new_item' => __( 'Add New Department', 'wpptl'  ),
  'new_item_name' => __( 'New Department', 'wpptl'  ),
  'menu_name' => __( 'Department' ),
 );
 register_taxonomy( 'department', 'product', array(
  'hierarchical' => true,
  'labels' => $labels,
  'query_var' => true,
  'rewrite' => true,
  'show_admin_column' => true,
  ) 
 );

  //define labels for the clothingtype taxonomy
  $labels = array(
  'name' => __( 'Clothing Type', 'wpptl' ),
  'singular_name' => __( 'Clothing Type', 'wpptl'  ),
  'search_items' => __( 'Search Clothing Types', 'wpptl'  ),
  'all_items' => __( 'All Clothing Types', 'wpptl'  ),
  'parent_item' => __( 'Parent Department', 'wpptl'  ),
  'parent_item_colon' => __( 'Parent Clothing Type:', 'wpptl'  ),
  'edit_item'  => __( 'Edit Clothing Type', 'wpptl'  ), 
  'update_item' => __( 'Update Clothing Type', 'wpptl'  ),
  'add_new_item' => __( 'Add New Clothing Type', 'wpptl'  ),
  'new_item_name' => __( 'New Clothing Type', 'wpptl'  ),
  'menu_name' => __( 'Clothing Type' ),
 );
 register_taxonomy( 'clothingtype', 'product', array(
  'hierarchical' => true,
  'labels' => $labels,
  'query_var' => true,
  'rewrite' => true,
  'show_admin_column' => true,
  ) 
 );
// end of function to register taxonomies - add any more here
}
add_action( 'init', 'wpptl_create_taxonomies', 0 );

// add custom meta box
add_action( 'add_meta_boxes','wpptl_add_meta_boxes' );
function wpptl_add_meta_boxes() {
 add_meta_box(
  'wpptl_fabric_metabox',
  __('Fabric:'),
  'wpptl_create_fabric_metabox',
  'product',
  'normal',
  'high' );
}
function wpptl_create_fabric_metabox( $post ) { ?>
 <form action="" method="post">
  <?php // add nonce for security
  wp_nonce_field( 'wpptl_metabox_nonce', 'wpptl_nonce' );
  //retrive the metadata values if they exist
  $wpptl_fabric = get_post_meta( $post->ID, 'Fabric', true ); ?>
  <label for "wpptl_fabric">What fabric is this garment made from?</label>
  <input type="text" name="wpptl_fabric" value="<?php echo esc_attr( $wpptl_fabric ); ?>" />
 </form>
<?php }

// save the meta box data
add_action( 'save_post','wpptl_save_fabric_meta' );
function wpptl_save_fabric_meta( $post_id ) {
 // if the nonce isn't verified, prevent saving 
 if( !isset( $_POST['wpptl_nonce'] ) || !wp_verify_nonce( $_POST['wpptl_nonce'], 'wpptl_metabox_nonce' ) ) return; 
 if ( isset( $_POST['wpptl_fabric'] ) ) {
  $new_fabric_value = ( $_POST['wpptl_fabric'] );
  update_post_meta( $post_id ,'Fabric' , $new_fabric_value );
}

//add conditional custom field value
add_action( 'save_post', 'wpptl_check_fabric_type' );
function wpptl_check_fabric_type( $post ) {
 $fabrictype = get_post_meta( $post->ID, 'Fabric', true );
 if ($fabrictype = 'Cotton') {
  add_post_meta( $post_id, 'Washing Instructions', 'Wash at 40 degrees Celsius', true );
 }
 }
}
?>