<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
	<?php } // if ( ! empty( $header_image ) ) ?>

 *
 * @package sassy_nautical
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Rework this function to remove WordPress 3.4 support when WordPress 3.6 is released.
 *
 * @uses sassy_nautical_header_style()
 * @uses sassy_nautical_admin_header_style()
 * @uses sassy_nautical_admin_header_image()
 *
 * @package sassy_nautical
 */
function sassy_nautical_custom_header_setup() {
	$args = array(
		'default-image'          => '%s/images/img_anchor.png',
		'default-text-color'     => '000',
		'width'                  => 150,
		'height'                 => 150,
		'flex-height'            => true,
		'wp-head-callback'       => 'sassy_nautical_header_style',
		'admin-head-callback'    => 'sassy_nautical_admin_header_style',
		'admin-preview-callback' => 'sassy_nautical_admin_header_image',
	);

	$args = apply_filters( 'sassy_nautical_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
		
		register_default_headers( array(
			'anchor' => array(
				'url'           => '%s/images/img_anchor.png',
				'thumbnail_url' => '%s/images/img_anchor.png',
				'description'   => _x( 'Anchor', 'header image description', 'sassy_nautical' )
		),
	) );

		
		
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'sassy_nautical_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package sassy_nautical
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'sassy_nautical_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sassy_nautical_custom_header_setup().
 */
function sassy_nautical_header_style() {
	$header_image = get_header_image();
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		<?php
		if ( ! empty( $header_image ) ) :
	?>
		.anchor {
				background: url(<?php header_image(); ?>) no-repeat scroll top;
				background-size: 100%;
				background-position: center;
				width: 10%;
				height: 100px;
				max-width: 100px;
				min-width: 50px;
				margin-top: .5em;
				float:left;
				display: inline-block;
		}
	@media screen and (max-width: 900px) {
			.anchor {
				float: none;
				width: 100px;
				margin: 0 auto;
				display: block;
				}
	}
	<?php
		endif;

		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
<?php
			if ( empty( $header_image ) ) :
	?>
		.anchor .home-link {
			min-height: 0;
			display: none;
		}
	<?php
			endif;

		// If the user has set a custom color for the text use that
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // sassy_nautical_header_style

if ( ! function_exists( 'sassy_nautical_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see sassy_nautical_custom_header_setup().
 */
function sassy_nautical_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
	}
	#headimg h1 {
	color: #416a8b;
	font-size: 3em; 
	font-family: 'Roboto Slab';
	font-weight: 100;
	text-decoration: none;
	display: block;
	vertical-align: bottom;
	}
	#headimg h1 a {
	text-decoration: none;
	}
	#desc {
	color: #6291b6;
	text-transform: uppercase;
	font-size: 1em;
	font-family: 'Roboto Slab';
	font-weight: 300;
	vertical-align: top;
	}
	#headimg img {
	background-size: 100%;
	background-position: center;
	max-width: 100px;
	min-width: 50px;
	vertical-align: middle;
	}
	</style>
<?php
}
endif; // sassy_nautical_admin_header_style

if ( ! function_exists( 'sassy_nautical_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see sassy_nautical_custom_header_setup().
 */
function sassy_nautical_admin_header_image() {
	$style        = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$header_image = get_header_image();
?>
	<div id="headimg">
	<table border="0">
  <tr>
    <td rowspan="2">	
    <?php if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" /></td>
	<?php endif; ?>
    <td>		
    <h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1></td>
  </tr>
  <tr>
    <td><div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div></td>
  </tr>
  </table>
		</div>


<?php
}
endif; // sassy_nautical_admin_header_image
