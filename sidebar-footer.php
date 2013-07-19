<?php
/**
 * The Footer widget areas.
 *
 * @package sassy_nautical
 */
?>

<?php
	/* The footer widget area is triggered if it
	 * has widgets. So let's check that first.
	 *
	 * If there are no widgets, then let's bail early.
	 */
	if ( ! is_active_sidebar( 'sidebar-1' ) )
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="widgets">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>
</div><!-- #widgets -->