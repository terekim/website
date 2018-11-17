<?php
/**
 * You probably don't need to touch this file. It requires plugins, but it doesn't install them (the way it's configured)
 * All you need is to activate the plugins from your admin panel, if you want that functionality!
 */

function nikko_recommend_plugins() {

	$template_directory = get_template_directory();

	$plugins = array(


		array(
			'name'     => esc_html__( 'Easy Photography Portfolio', 'minimalist-portfolio' ),
			'slug'     => 'photography-portfolio',
			'required' => false,
		),

	);


	$config = array(
		'domain'       => 'minimalist-portfolio',
		'default_path' => '',
		'parent_slug'  => 'themes.php',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
	);

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'nikko_recommend_plugins' );
