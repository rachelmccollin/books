<?php
/**
 * The template for displaying Archive pages for products. Adapted form the Twenty Twelve theme.
 *
 */

get_header(); ?>

<?php get_sidebar('left'); ?>
	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php query_posts( 'post_type=product' ); ?>
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">Products:</h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			//$wpptl_taxonomy_query = new WP_Query('post_type=product');
 			//while ($wpptl_taxonomy_query -> have_posts()) : $wpptl_taxonomy_query -> the_post();
		while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;
			wp_reset_query();

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>