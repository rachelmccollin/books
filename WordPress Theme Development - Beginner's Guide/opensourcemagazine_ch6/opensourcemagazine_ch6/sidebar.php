<!-- #right sidebar -->
<aside class="sidebar right third">
<?php if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>
	<div class="bdr grd-vt-main rnd shdw-centered">	
		<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
	</div>
<?php endif; ?>
</aside>