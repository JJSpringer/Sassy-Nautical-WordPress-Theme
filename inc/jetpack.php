<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package sassy_nautical
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function sassy_nautical_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
		'type' => 'click',
		'footer_widgets' => 'sidebar-1',
		'wrapper'        => true,
		'render'         => false,
		'posts_per_page' => false,
	) );
}
add_action( 'after_setup_theme', 'sassy_nautical_jetpack_setup' );
