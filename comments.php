<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to sassy_nautical_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package sassy_nautical
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sassy_nautical' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation-comment" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'sassy_nautical' ); ?></h1>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use sassy_nautical_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define sassy_nautical_comment() and that will be used instead.
				 * See sassy_nautical_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array( 'callback' => 'sassy_nautical_comment' ) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through
			$prev = get_previous_comments_link(  __( 'Older Comments', 'sassy_nautical' ) );
			$next = get_next_comments_link( __( 'Newer Comments', 'sassy_nautical' ) );
			?>
			<nav id="comment-nav-below" class="navigation-comment" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'sassy_nautical' ); ?></h1>
				<?php if ( $prev ) echo '<div class="nav-previous-comments">' . $prev . '</div>'; ?>
				<?php if ( $next ) echo '<div class="nav-next-comments">' . $next . '</div>'; ?>
			</nav><!-- #comment-nav-below -->
		<?php } // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'sassy_nautical' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
