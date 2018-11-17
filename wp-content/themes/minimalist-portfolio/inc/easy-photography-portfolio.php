<?php


function minimalist_portfolio_epp_add_support() {
	add_theme_support('easy-photography-portfolio');
}
add_action('after_setup_theme', 'minimalist_portfolio_epp_add_support');

/**
 * Change the attached sizes to Hamilton sizes
 */
function minimalist_portfolio_epp_thumb_size( $sizes ) {

	$sizes['thumb'] = 'hamilton_preview-image';

	return $sizes;
}

add_filter( 'phort/archive/masonry-hovercard/attached_sizes', 'minimalist_portfolio_epp_thumb_size' );
add_filter( 'phort/single/masonry/attached_sizes', 'minimalist_portfolio_epp_thumb_size' );


add_filter( 'phort_get_class', function ( $class ) {
	if ( ! in_array( 'PP_Description', $class ) ) {
		return $class;
	}

	if ( strlen( get_the_content() ) < 280 ) {
		$class[] = 'fade-block';
	}

	return $class;
} );