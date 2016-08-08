<?php
/**
 * The template for displaying Archive pages for products. Adapted form the Twenty Twelve theme.
 *
 */

get_header(); ?>


	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title">Products:</h1>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
?>
<div id="product-image-grid post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a class="image-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
			<a class="product-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</div><!-- #product-image-grid -->
	<?php
			endwhile;

			twentytwelve_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_footer(); ?>