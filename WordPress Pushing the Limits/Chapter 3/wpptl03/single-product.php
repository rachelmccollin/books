<?php
/**
 * The Template for displaying all single posts.
 *
 */

get_header(); ?>

<?php
// display a list of terms by taxonomy
$args = array(
 'public'   => true,
 '_builtin' => false,
 );
$taxonomies = get_taxonomies( $args, 'objects', 'and' );
if ($taxonomies) {
 foreach ($taxonomies as $taxonomy) { 
 echo '<p><strong>' . $taxonomy->labels->name . '</strong>:  '; 
 echo get_the_term_list( '' , $taxonomy->name, '', ', ', '' ); 
 echo '</p>';
 }
}
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'product' ); ?>
				
<?php
//list custom field values for this product
 $fabric_list = get_post_meta( $post->ID, 'Fabric', true );
 $washing_instructions = get_post_meta( $post->ID, 'Washing Instructions', true );
 $origin_country = get_post_meta( $post->ID, 'Country of origin', true );
 if( !empty( $fabric_list ) ){ ?>
  <p><strong>This garment is made from </strong><span class = “metalist fabric”><?php echo $fabric_list; ?> . </span></p><?php
 }
 if( !empty ( $washing_instructions ) ){ ?>
  <p><strong>Washing instructions:</strong><span class = “metalist washing”><?php echo $washing_instructions; ?> . </span></p><?php
 }
 if( !empty( $origin_country ) ){ ?>
  <p><strong>Country of origin:</strong><span class = “metalist country”><?php echo $origin_country; ?> . </span></p><?php
 }
?> 

				<nav class="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. 
			?>

<?php 
if ( !empty ( $fabric_list ) ) { ?>
 <?php
 //display other products with the same custom field value		
 $the_query = new WP_query( 
  array(
   'post__not_in' => array($post->ID),
   'post_type' => 'product',
   'meta_key' => 'Fabric',
   'meta_value' => $fabric_list,
   ) );
 if ( $the_query->have_posts() ) { ?>
 <h3>Other products made from this fabric:</h3>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
   <div class="common-fabric-listing">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
   </div> 
 <?php endwhile;
 }
 wp_reset_postdata(); 
} 
?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>