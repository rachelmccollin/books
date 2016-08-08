<?php
/*
Plugin Name: WordPress Pushing the Limits Gravity Forms Extension Plugin
Plugin URI: http://rachelmccollin.co.uk/wordpress-pushing-the-limits/
Description: Plugin used for demonstration in the book ‘WordPress Pushing the Limits’. This plugin extends Gravity Forms by adding an additional field type. Requires the gravity forms plugin.
Version: 1.0
Author: Rachel McCollin
Author URI: http://rachelmccollin.co.uk
License: GPLv2
*/
?>
<?php
function wpptl_add_date_field($field_groups){
    foreach($field_groups as &$group){
        if($group["name"] == "advanced_fields"){
            $group["fields"][] = array(
            	"class"=>"button",
            	"value" => __("Date (HTML5)", "gravityforms"),
            	"onclick" => "StartAddField('text');"
        	);
            break;
        }
    }
    return $field_groups;
}
add_filter( 'gform_add_field_buttons', 'wpptl_add_date_field' );
?>
<?php
function wpptl_date_field_type($input, $field, $value, $lead_id, $form_id) {
	if ($form_id == 1 && $field["id"] == 1) {
		$content = '<input type="date" class="datepicker">';		
	}
    return $content;
}
add_filter( 'gform_field_content', 'wpptl_date_field_type', 10, 5);
?>
