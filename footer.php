<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package sassy_nautical
 */
?>

	</div><!-- #main -->
	<span class="infinite-loader"></span>
	<div id="infinite-handle"></div>
<?php
/* This sidebar holds the footer widgets. Arranged in three per row.
*/
	get_sidebar( 'footer' );
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'sassy_nautical_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'sassy_nautical' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'sassy_nautical' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'sassy_nautical' ), 'Sassy Nautical', '<a href="http://jjsfolio.com" rel="designer">J.J. Springer</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
	
</body>
</html>