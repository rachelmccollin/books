<?php
/*
Plugin Name: WordPress Pushing the Limits Add Role
Plugin URI: http://rachelmccollin.co.uk/wpptl
Description: Plugin demonstrating the process of adding a user role, as covered in Chapter 4 of 'WordPress Pushing the Limits'
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
?>
<?php
// add new user role with defined capability 
function wpptl_add_photo_uploader_role() {
 add_role( 'wpptl_photo_uploader', 'Photo Uploader', 'upload_files' ); 
}
add_action( 'admin_init', 'wpptl_add_photo_uploader_role' );
?>
<?php
// uninstall function to remove the role
function wpptl_remove_role_data() {
 remove_role( 'wpptl_photo_uploader' );
}
// activation function to register the uninstall hook
function wpptl_activate_plugin() {
 register_uninstall_hook( __FILE__,  'wpptl_remove_role_data' );
}
// activation hook for the activation function
register_activation_hook (__FILE__, 'wpptl_activate_plugin' );
?>

