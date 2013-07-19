<?php
/**
 * @package sassy_nautical
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sassy_nautical' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

		<?php sassy_nautical_post_meta_footer(); ?>	

</article><!-- #post-## -->
