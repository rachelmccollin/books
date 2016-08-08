<?php get_header(); ?>

<div id="container2" class="bdr bdr-top">

<div class="content left two-thirds">

<?php if (have_posts()) :?>
	<?php while (have_posts()) : the_post();?> 

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h2 class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title();?></a></h2>

		<div class="entry-content"><!--//post-->
			<?php the_content();?>
		</div><!--//.entry-content-->

		<div class="push"></div>
		
	</article>
<?php endwhile; ?>
<?php else : ?>
       <h2 class="center">Not Found</h2>
       <p class="center">Sorry, but you are looking for something that isn't here.</p>
       <?php get_search_form(); ?>
<?php endif; ?>


<div class="push"></div>
</div><!--content-->

<?php get_sidebar(); ?>

<div class="push"></div>

</div><!--//#container2-->

</div><!--//#container-->
<div id="across">

<?php get_footer(); ?>
