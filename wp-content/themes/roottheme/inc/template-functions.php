<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * Creates continue reading text.
 *
 * @since Twenty Twenty-One 1.0
 */
function root_theme_continue_reading_text() {
	$continue_reading = sprintf(
		/* translators: %s: Name of current post. */
		esc_html__( 'Continue reading %s', 'roottheme' ),
		the_title( '<span class="screen-reader-text">', '</span>', false )
	);

	return $continue_reading;
}

/**
 * Creates the continue reading link for excerpt.
 *
 * @since Twenty Twenty-One 1.0
 */
function root_theme_continue_reading_link_excerpt() {
	if ( ! is_admin() ) {
		return '&hellip; <a class="more-link" href="' . esc_url( get_permalink() ) . '">' . root_theme_continue_reading_text() . '</a>';
	}
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'root_theme_continue_reading_link_excerpt' );
