<?php
/*
Plugin Name: WordPress Pushing the Limits Widget Plugin
Plugin URI: http://rachelmccollin.co.uk/wordpress-pushing-the-limits/example-plugin
Description: Plugin used for demonstration in the book ‘WordPress Pushing the Limits’. This plugin adds functionality for a ‘Thought for the day’ widget.
Version: 1.0
Author: Rachel McCollin
Author URI: http://rachelmccollin.co.uk
License: GPLv2
*/

class Wpptl_Thoughtfortheday_Widget extends WP_Widget {
 //widget constructor function
 function __construct( 
  $id_base = 'wpptl_tftd_widget', 
  $name = 'Thought for the Day', 
  $widget_options = array(
   'classname' => 'wpptl_tftd_widgetplugin',
   'description' => 'Display your thought for the day using a simple widget.',
  ), 
  $control_options = array() 
  ) {
 parent::WP_Widget( $id_base, $name, $widget_options, $control_options );
}
 
 //function to define the form in the Widgets screen
 function form($instance) { 
  $defaults = array(
   'title' => 'Thought for the Day',
   'thought' => '',
  );
  $title = $instance[ 'title' ];
  $thought = $instance[ 'thought' ]; ?>
  <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><input class="widefat" type ="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" /></p>
  <p><label for="<?php echo $this->get_field_id( 'thought' ); ?>">Your thought:</label><input class="widefat" rows="10" type="text" id="<?php echo $this->get_field_id( 'thought' ); ?>" name="<?php echo $this->get_field_name( 'thought' ); ?>" value="<?php echo esc_attr( $thought ); ?>" /></p>
<?php }

 //function to define the data saved by the widget
 function update( $new_instance, $old_instance ) { 
  $instance = $old_instance;
  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
  $instance[ 'thought' ] = strip_tags( $new_instance[ 'thought' ] );
  return $instance;
 }

 //function to display the widget in the site
 function widget( $args, $instance ) {
  extract($args);
  echo $before_widget;
  $title = apply_filters( 'widget_title', $instance[ 'title' ] );
  $thought = empty( $instance[ 'thought' ] ) ? 'No deep thoughts today, come back tomorrow!' : $instance[ 'thought' ];
  if ( !empty( $title ) ) {
   echo $before_title . $title . $after_title; 
   };
  echo '<p>' . $thought . '</p>';
  echo $after_widget;
 }
}

//function to register the widget
function wpptl_register_thoughtfortheday_widget() { 
	register_widget( 'Wpptl_Thoughtfortheday_Widget' );
}
add_action( 'widgets_init', 'wpptl_register_thoughtfortheday_widget' ); //hooks the registration function to the appropriate WordPress action hook
?>
