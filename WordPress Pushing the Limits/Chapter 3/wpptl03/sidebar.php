<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php  if (is_singular( 'product' )) {
/*$current_featured_image_id = get_post_thumbnail_id( $post->ID );
 $attachment_image_args = array(
  'post_parent' => get_the_ID(),
  'post_type' => 'attachment',
  'post_mime_type' => 'image',
  'exclude' => $current_featured_image_id,
   ) ;
 $attachments = get_posts($attachment_image_args);
  if ($attachments) {
  foreach ($attachments as $attachment) {
   echo wp_get_attachment_image( $attachment->ID, 'thumbnail' );
  }
 } */
echo do_shortcode ('[gallery ids="19,20,22"]');
} 
?>
<?php /* if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #secondary -->
	<?php endif; */?>