<?php

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @see wp_add_inline_style()
 */
function olivo_lite_custom_css() {
	/*
	Colors
	*/
	$heroColor = get_theme_mod( 'olivo_lite_hero_color', '#FF3A91' );
	$headings_color = get_theme_mod( 'olivo_lite_headings_color', '#222222' );
	$text_color = get_theme_mod( 'olivo_lite_text_color', '#777777' );
	$link_color = get_theme_mod( 'olivo_lite_link_color', '#FF3A91' );
	$content_background_color = get_theme_mod( 'olivo_lite_content_background_color', '#FFFFFF' );
	$footer_background = get_theme_mod( 'olivo_lite_footer_background', '#FFFFFF' );
	$site_gradient = get_theme_mod( 'olivo_lite_site_gradient', '1' );
	$site_background_color = get_theme_mod( 'olivo_lite_site_background_color', '#e08461' );
	$logo_color = get_theme_mod( 'olivo_lite_logo_color', '#222222' );

	$colors = array(
		'heroColor'      => $heroColor,
		'headings_color' => $headings_color,
		'text_color'     => $text_color,
		'link_color'     => $link_color,
		'content_background_color'     => $content_background_color,
		'footer_background'     => $footer_background,
		'site_gradient'     => $site_gradient,
		'site_background_color'     => $site_background_color,
		'logo_color'     => $logo_color,

	);

	$custom_css = olivo_lite_get_custom_css( $colors );

	wp_add_inline_style( 'olivo_lite_style', $custom_css );



	/*
	Typography
	*/
	$olivo_lite_typography_font_family = get_theme_mod( 'olivo_lite_typography_font_family', '"Source Sans Pro"' );
	$olivo_lite_typography_font_family_headings = get_theme_mod( 'olivo_lite_typography_font_family_headings', 'Inconsolata' );
	$olivo_lite_typography_subsets = get_theme_mod( 'olivo_lite_typography_subsets', '' );
	$olivo_lite_typography_font_size = get_theme_mod( 'olivo_lite_typography_font_size', '16' );

	$typography = array(
		'font-family' 		   => $olivo_lite_typography_font_family,
		'font-family-headings' => $olivo_lite_typography_font_family_headings,
		'font-size'     	   => $olivo_lite_typography_font_size,
	);

	//Add Google Fonts
	$olivo_lite_font_subset = '';
	if ( is_array( $olivo_lite_typography_subsets ) ) {
		$olivo_lite_font_subset = '&subset=';
		foreach ( $olivo_lite_typography_subsets as $subset ) {
			$olivo_lite_font_subset .= $subset . ',';
		}
		$olivo_lite_font_subset = rtrim( $olivo_lite_font_subset, ',' );
	}

	$olivo_lite_google_font = '//fonts.googleapis.com/css?family=' . $olivo_lite_typography_font_family . ':400,500,700' . $olivo_lite_font_subset;
	wp_enqueue_style( 'olivo_lite_google-font', $olivo_lite_google_font, array(), '1.0', 'all');

	$olivo_lite_google_font_headings = '//fonts.googleapis.com/css?family=' . $olivo_lite_typography_font_family_headings . ':400,700' . $olivo_lite_font_subset;
	wp_enqueue_style( 'olivo_lite_google-font-headings', $olivo_lite_google_font_headings, array(), '1.0', 'all');

	$custom_css = olivo_lite_get_custom_typography_css( $typography );

	wp_add_inline_style( 'olivo_lite_style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'olivo_lite_custom_css' );



/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function olivo_lite_get_custom_css( $colors ) {

	//Default colors
	$colors = wp_parse_args( $colors, array(
		'heroColor'            => '#FF3A91',
		'headings_color'       => '#222222',
		'text_color'           => '#777777',
		'link_color'           => '#FF3A91',
		'content_background_color'           => '#FFFFFF',
		'footer_background'     => '#FFFFFF',
		'site_gradient'     => '1',
		'site_background_color'     => '#e08461',
		'logo_color'     => '#222222',
	) );
	$heroColor_darker = olivo_lite_darken_color( $colors['heroColor'], 1.1 );
	$link_color_darker = olivo_lite_darken_color( $colors['link_color'], 1.2 );
	$heroColor_rgb = olivo_lite_hex2rgb( $colors['heroColor'] );

	$olivo_lite_site_background_enable = get_theme_mod( 'olivo_lite_site_background_enable', false );


	$gradient_array = array(
		'background: rgb(242,188,101);background: -moz-linear-gradient(-45deg,  rgba(242,188,101,1) 0%, rgba(226,40,107,1) 61%, rgba(52,21,65,1) 100%);background: -webkit-linear-gradient(-45deg,  rgba(242,188,101,1) 0%,rgba(226,40,107,1) 61%,rgba(52,21,65,1) 100%);background: linear-gradient(135deg,  rgba(242,188,101,1) 0%,rgba(226,40,107,1) 61%,rgba(52,21,65,1) 100%);',
		'background: rgb(0,55,255);background: -moz-linear-gradient(-45deg,  rgba(0,55,255,1) 0%, rgba(13,219,175,1) 100%);background: -webkit-linear-gradient(-45deg,  rgba(0,55,255,1) 0%,rgba(13,219,175,1) 100%);background: linear-gradient(135deg,  rgba(0,55,255,1) 0%,rgba(13,219,175,1) 100%);',
		'background: rgb(251,218,97);background: -moz-linear-gradient(top,  rgba(251,218,97,1) 0%, rgba(247,107,28,1) 100%);background: -webkit-linear-gradient(top,  rgba(251,218,97,1) 0%,rgba(247,107,28,1) 100%);background: linear-gradient(to bottom,  rgba(251,218,97,1) 0%,rgba(247,107,28,1) 100%);',
		'background: rgb(245,81,95);background: -moz-linear-gradient(top,  rgba(245,81,95,1) 0%, rgba(159,3,27,1) 100%);background: -webkit-linear-gradient(top,  rgba(245,81,95,1) 0%,rgba(159,3,27,1) 100%);background: linear-gradient(to bottom,  rgba(245,81,95,1) 0%,rgba(159,3,27,1) 100%);',
		'background: rgb(17,199,184);background: -moz-linear-gradient(top,  rgba(17,199,184,1) 0%, rgba(26,90,120,1) 100%);background: -webkit-linear-gradient(top,  rgba(17,199,184,1) 0%,rgba(26,90,120,1) 100%);background: linear-gradient(to bottom,  rgba(17,199,184,1) 0%,rgba(26,90,120,1) 100%);',
		'background: rgb(232,93,90);background: -moz-linear-gradient(top,  rgba(232,93,90,1) 0%, rgba(51,0,77,1) 100%);background: -webkit-linear-gradient(top,  rgba(232,93,90,1) 0%,rgba(51,0,77,1) 100%);background: linear-gradient(to bottom,  rgba(232,93,90,1) 0%,rgba(51,0,77,1) 100%);',
		'background: rgb(198,218,123);background: -moz-linear-gradient(top,  rgba(198,218,123,1) 0%, rgba(0,173,123,1) 48%, rgba(0,152,151,1) 100%);background: -webkit-linear-gradient(top,  rgba(198,218,123,1) 0%,rgba(0,173,123,1) 48%,rgba(0,152,151,1) 100%);background: linear-gradient(to bottom,  rgba(198,218,123,1) 0%,rgba(0,173,123,1) 48%,rgba(0,152,151,1) 100%);',
		'background: rgb(0,122,255);background: -moz-linear-gradient(top,  rgba(0,122,255,1) 0%, rgba(87,168,255,1) 100%);background: -webkit-linear-gradient(top,  rgba(0,122,255,1) 0%,rgba(87,168,255,1) 100%);background: linear-gradient(to bottom,  rgba(0,122,255,1) 0%,rgba(87,168,255,1) 100%);',
	);
	$gradient_val = ( intval( $colors['site_gradient'] ) - 1 );
	$gradient_print = $gradient_array[$gradient_val];

	if ( $olivo_lite_site_background_enable ) {
		$gradient_print = 'background-color: ' .$colors['site_background_color'] . ';';
	}

	$css = <<<CSS

	/* Text Color */
	body{
		color: {$colors['text_color']};
		{$gradient_print}
	}
	h1:not(.site-title), h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
	.blog-hype #content .post .entry-header .post-title a:hover{
		color: {$colors['headings_color']};
	}
	/* Link Color */
	a{
		color: {$colors['link_color']};
	}
	a:hover{
		color: {$link_color_darker};
	}



	/*============================================
	// Featured Color
	============================================*/

	/* Background Color */
	.pagination .current,
	.pagination li.active a,
	.section-title::before,
	.ql_primary_btn,
	#jqueryslidemenu ul.nav > li > ul > li a:hover,
	#jqueryslidemenu .navbar-toggle .icon-bar,
	.olivo-home-slider-fullscreen .slider-fullscreen-controls .prevnext-button,
	.pace .pace-progress,
	.woocommerce nav.woocommerce-pagination ul li a:focus, 
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.ql_woo_cart_button:hover,
	.ql_woo_cart_close,
	.woocommerce .woocommerce-MyAccount-navigation ul .woocommerce-MyAccount-navigation-link.is-active a,
	.woocommerce_checkout_btn,
	.post-navigation .nav-next a:hover::before, .post-navigation .nav-previous a:hover::before,
	.woocommerce #main .single_add_to_cart_button,
	.olivo-contact-form input[type='submit'],
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
	.contact-form input[type="submit"],
	.portfolio-load-wrapper .portfolio-load-more,
	.olivo-preloader .olivo-folding-cube .olivo-cube::before,
	#ql_load_more
	{
		background-color: {$colors['heroColor']};
	}

	/* Border Color */
	.pagination li.active a,
	.pagination li.active a:hover,
	.section-title::after,
	.pace .pace-activity,
	.ql_woocommerce_categories ul li.current, .ql_woocommerce_categories ul li:hover,
	.woocommerce_checkout_btn,
	.ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field,
	.touch .ql_woocommerce_categories .ql_product_search:hover .woocommerce-product-search #woocommerce-product-search-field
	.olivo-contact-form input[type='text']:focus,
	.olivo-contact-form input[type='email']:focus,
	.olivo-contact-form textarea:focus
	{
		border-color: {$colors['heroColor']};
	}

	/* Color */
	.pagination li.active a:hover,
	.single .post .entry-footer .metadata ul li a,
	#comments .comment-list .comment.bypostauthor .comment-body,
	#respond input,
	#respond textarea,
	#footer h2, #footer h3, #footer h4,
	.widget_recent_posts ul li h6 a, .widget_popular_posts ul li h6 a,
	.style-title span,
	.ql_filter ul li.active a,
	.ql_filter ul li a:hover,
	.ql_filter .ql_filter_count .current,
	.portfolio-slider .portfolio-item .portfolio-item-title,
	.portfolio-slider .portfolio-slider-controls .prevnext-button,
	.portfolio-multiple-slider .portfolio-item .portfolio-item-title,
	.portfolio-multiple-slider .portfolio-slider-controls .prevnext-button,
	.single-portfolio-container .portfolio-item .portfolio-item-title,
	.ql_cart-btn:hover,
	.ql_cart-btn:focus,
	.ql_woocommerce_categories ul li.current, .ql_woocommerce_categories ul li:hover,
	.ql_woocommerce_categories ul li a:hover,
	.woocommerce #main .products .product .price, .woocommerce-page .products .product .price,
	.woocommerce a.added_to_cart,
	.woocommerce div.product .woocommerce-product-rating,
	.woocommerce #main .price,
	.woocommerce #main .single_variation_wrap .price,
	.woocommerce-cart .cart .cart_item .product_text .amount,
	.ql_woo_cart_close:hover,
	#ql_woo_cart ul.cart_list li .product_text .amount,
	#ql_woo_cart .widget_shopping_cart_content .total,
	.woocommerce_checkout_btn:hover,
	.woocommerce .star-rating,
	.widget .amount,
	.post-navigation .nav-next a,
	.post-navigation .nav-previous a,
	.welcome-section .welcome-title,
	.question,
	.olivo-contact-form .olivo-contact-form-text,
	.olivo-contact-form input[type='text'],
	.olivo-contact-form input[type='email'],
	.olivo-contact-form textarea,
	#jqueryslidemenu ul.nav > li > ul > li.current_page_item > a, 
	#jqueryslidemenu ul.nav > li > ul > li.current_page_parent > a,
	.ql_woocommerce_categories ul li.current a,
	.woocommerce p.stars a,
	.ql_cart-btn .count,
	#jqueryslidemenu ul.nav > li > a:hover,
	.olivo-portfolio-type.single article .metadata a
	{
		color: {$colors['heroColor']};
	}

	/* Fill */
	.entry-header .svg-title li .olivo-vertical-simple .st0,
	.page-header .svg-title li .olivo-vertical-simple .st0,
	.flickity-prev-next-button .arrow,
	.olivo-home-slider .flickity-page-dots .dot .is-selected .olivo-vertical-simple .st0,
	.portfolio-slider .flickity-page-dots .dot.is-selected .olivo-vertical-simple .st0,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .olivo-vertical-simple .st0,
	.olivo-home-slider .flickity-prev-next-button .arrow,
	.olivo-home-slider .flickity-prev-next-button .arrow,
	.olivo-home-slider .flickity-page-dots .dot.is-selected .olivo-vertical-simple .st0
	{
		fill: {$colors['heroColor']};
	}

	/* Stroke */
	.entry-header .svg-title li .olivo-vertical-simple .st1,
	.page-header .svg-title li .olivo-vertical-simple .st1,
	.olivo-vertical path,
	.ql-svg-inline .g-svg,
	#jqueryslidemenu .current_page_item a, #jqueryslidemenu .current_page_parent a,
	.olivo-home-slider .flickity-page-dots .dot .is-selected .olivo-vertical-simple .st1,
	.ql_filter .ql_filter_count .olivo-count-svg path,
	.portfolio-slider .flickity-page-dots .dot.is-selected .olivo-vertical-simple .st1,
	.portfolio-multiple-slider .flickity-page-dots .dot.is-selected .olivo-vertical-simple .st1
	{
		stroke: {$colors['heroColor']};
	}

	/* Darker Background Color */
	.no-touch .ql_primary_btn:hover,
	.no-touch .woocommerce #main .single_add_to_cart_button:hover,
	.no-touch .olivo-contact-form input[type='submit']:hover,
	.no-touch .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.no-touch .woocommerce #payment #place_order:hover, 
	.no-touch .woocommerce-page #payment #place_order:hover,
	.contact-form input[type="submit"]:hover,
	.no-touch .portfolio-load-wrapper .portfolio-load-more:hover,
	.no-touch #ql_load_more:hover,
	.no-touch .contact-form input[type="submit"]:hover
	{
		background-color: {$heroColor_darker};
	}

	/* Faded Background Color */
	.portfolio-container .portfolio-item .portfolio-item-hover,
	.olivo_lite_team_member .olivo_lite_team_hover
	{
		background-color: rgba( {$heroColor_rgb['red']}, {$heroColor_rgb['green']}, {$heroColor_rgb['blue']}, 0.88 );
	}

	/* Footer Background Color */
	#footer
	{
		background-color: {$colors['footer_background']};
	}
	.footer-top ul li
	{
		border-bottom-color: {$colors['footer_background']};
	}

	/* Logo Color */
	.logo_container .ql_logo
	{
		color: {$colors['logo_color']};
	}


CSS;

	return $css;
}


/**
 * Returns CSS for the typography styles.
 *
 * @param array $typography typography.
 * @return string CSS.
 */
function olivo_lite_get_custom_typography_css( $typography  ) {

	//Default colors
	$typography = wp_parse_args( $typography, array(
		'font-family'           => '"Source Sans Pro"',
		'font-family-headings'  => 'Inconsolata',
		'font-size'             => '16',
	) );

	$css = <<<CSS

	/* Typography */
	body{
		font-family: {$typography['font-family']};
		font-size: {$typography['font-size']}px;
	}
	.logo_container .ql_logo,
	.post-navigation .nav-next a span, .post-navigation .nav-previous a span
	{
		font-family: {$typography['font-family']};
	}
	h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	.metadata,
	.pagination a, .pagination span,
	.ql_primary_btn,
	.ql_secundary_btn,
	.ql_woocommerce_categories ul li,
	.sidebar_btn,
	.woocommerce #main .products .product .product_text, .woocommerce-page .products .product .product_text,
	.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
	.woocommerce #main .price,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce-cart .cart .cart_item .product_text .price,
	#jqueryslidemenu ul.nav > li,
	.sub-footer,
	.ql_filter ul li,
	.post-navigation .nav-next a, .post-navigation .nav-previous a,
	.read-more,
	.portfolio-load-wrapper .portfolio-load-more,
	.woocommerce .woocommerce-breadcrumb,
	#main .woocommerce-result-count,
	#ql_load_more,
	.woocommerce #main .single_add_to_cart_button,
	.contact-form input[type="submit"],
	#respond .form-submit #submit-respond,
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce-cart .actions input[type='submit'],
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce #payment #place_order, .woocommerce-page #payment #place_order
	{
		font-family: {$typography['font-family-headings']};
	}

CSS;

	return $css;
}
