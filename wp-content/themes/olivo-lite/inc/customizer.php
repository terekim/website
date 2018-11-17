<?php
/**
 * Olivo Lite Theme Customizer.
 *
 * @package Olivo Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function olivo_lite_customize_register( $wp_customize ) {


	/**
	 * Control for the PRO buttons
	 */
	class olivo_lite_Pro_Version extends WP_Customize_Control{
		public function render_content()
		{
			$args = array(
				'a' => array(
					'href' => array(),
					'title' => array()
					),
				'br' => array(),
				'em' => array(),
				'strong' => array(),
				);
			echo wp_kses( $this->label, $args );
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';



	/*
    Colors
    ===================================================== */
    	/*
		Featured
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_hero_color', array( 'default' => '#FF3A91', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_hero_color', array(
			'label'        => esc_attr__( 'Featured Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Logo
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_logo_color', array( 'default' => '#222222', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_logo_color', array(
			'label'        => esc_attr__( 'Logo Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Headings
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_headings_color', array( 'default' => '#222222', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_headings_color', array(
			'label'        => esc_attr__( 'Headings Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Text
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_text_color', array( 'default' => '#808080', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_text_color', array(
			'label'        => esc_attr__( 'Text Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Link
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_link_color', array( 'default' => '#FF3A91', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_link_color', array(
			'label'        => esc_attr__( 'Link Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );

		/*
		Footer Background
		------------------------------ */
		$wp_customize->add_setting( 'olivo_lite_footer_background', array( 'default' => '#f7f7f7', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_footer_background', array(
			'label'        => esc_attr__( 'Footer Background Color', 'olivo-lite' ),
			'section'    => 'colors',
		) ) );



	/*
    Portfolio Options
    ===================================================== */
	$wp_customize->add_section( 'olivo_lite_portfolio_options_section', array(
			'title' => esc_attr__( 'Portfolio Options', 'olivo-lite' ),
			'priority' => 160,
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'olivo_lite_portfolio_items_amount', array(
			'type'        => 'number',
			'settings'    => 'olivo_lite_portfolio_items_amount',
			'label'       => esc_attr__( "Number of items", 'olivo-lite' ),
			'description' => esc_attr__( 'Number of items displayed per page.', 'olivo-lite' ),
			'section'     => 'olivo_lite_portfolio_options_section',
			'default'     => 12,
		) );

	}else{
		$wp_customize->add_setting( 'olivo_lite_portfolio_items_amount_info', array( 'default' => '', 'sanitize_callback' => 'olivo_lite_sanitize_text', ) );
		$wp_customize->add_control( new olivo_lite_Display_Text_Control( $wp_customize, 'olivo_lite_portfolio_items_amount_info', array(
			'section' => 'olivo_lite_portfolio_options_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'Please install %1$s Kirki Toolkit %2$s plugin to see more settings.', 'olivo-lite' ), '<a href="' . esc_url( get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) ) .'">', '</a>' ),
		) ) );

	}

	$wp_customize->add_setting( 'olivo_lite_portfolio_infinitescroll_enable', array( 'default' => true, 'sanitize_callback' => 'olivo_lite_sanitize_bool', 'type' => 'theme_mod' ) );
	$wp_customize->add_control( 'olivo_lite_portfolio_infinitescroll_enable', array(
		'section' => 'olivo_lite_portfolio_options_section', // Required, core or custom.
		'label' => esc_attr__( "Load More Button?", 'olivo-lite' ),
		'description' => esc_attr__( 'Select if you want a "Load More" button instead of the default pagination.', 'olivo-lite' ),
		'type'    => 'checkbox',
		'priority' => 80
	) );


    /*
    Site Options
    ===================================================== */

    $wp_customize->add_section( 'olivo_lite_site_options_section', array(
			'title' => esc_attr__( 'Site Options', 'olivo-lite' ),
			'priority' => 140,
	) );

    if ( class_exists( 'Kirki' ) ){

		$animations_options = array(
				'true' => esc_attr__( 'Enable', 'olivo-lite' ),
				'false' => esc_attr__( 'Disable', 'olivo-lite' ),
			);
		$wp_customize->add_setting( 'olivo_lite_site_animations', array( 'default' => 'true', 'sanitize_callback' => 'olivo_lite_sanitize_text', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( 'olivo_lite_site_animations', array(
	        'label'   => esc_attr__( 'Enable/Disable Site Animations', 'olivo-lite' ),
	        'section' => 'olivo_lite_site_options_section',
	        'settings'   => 'olivo_lite_site_animations',
	        'type'       => 'select',
	        'choices'    => $animations_options,
	    ));

	    Kirki::add_field( 'olivo_lite_site_gradient', array(
		    'type'        => 'radio-image',
		    'settings'    => 'olivo_lite_site_gradient',
		    'label'       => esc_attr__( 'Background Gradient', 'olivo-lite' ),
		    'section'     => 'olivo_lite_site_options_section',
		    'default'     => '1',
		    'choices'     => array(
		        '1' => get_template_directory_uri() . '/images/gradient_1.png',
		        '2' => get_template_directory_uri() . '/images/gradient_2.png',
		        '3' => get_template_directory_uri() . '/images/gradient_3.png',
		        '4' => get_template_directory_uri() . '/images/gradient_4.png',
		        '5' => get_template_directory_uri() . '/images/gradient_5.png',
		        '6' => get_template_directory_uri() . '/images/gradient_6.png',
		        '7' => get_template_directory_uri() . '/images/gradient_7.png',
		        '8' => get_template_directory_uri() . '/images/gradient_8.png',
		    ),
		) );

		$wp_customize->add_setting( 'olivo_lite_site_background_color', array( 'default' => '#e08461', 'transport' => 'postMessage', 'sanitize_callback' => 'sanitize_hex_color', 'type' => 'theme_mod' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'olivo_lite_site_background_color', array(
			'label'        => esc_attr__( 'Solid Background Color', 'olivo-lite' ),
			'section'    => 'olivo_lite_site_options_section',
			'priority' => 70
		) ) );

		$wp_customize->add_setting( 'olivo_lite_site_background_enable', array( 'default' => false, 'sanitize_callback' => 'olivo_lite_sanitize_bool', 'type' => 'theme_mod' ) );
	    $wp_customize->add_control( 'olivo_lite_site_background_enable', array(
			'section' => 'olivo_lite_site_options_section', // Required, core or custom.
			'label' => esc_attr__( "Use solid background color?", 'olivo-lite' ),
			'description' => esc_attr__( 'If you do not want a gradient background you can use a solid color.', 'olivo-lite' ),
			'type'    => 'checkbox',
			'priority' => 80
		) );

	}else{
		$wp_customize->add_setting( 'olivo_lite_site_not_kirki', array( 'default' => '', 'sanitize_callback' => 'olivo_lite_sanitize_text', ) );
		$wp_customize->add_control( new olivo_lite_Display_Text_Control( $wp_customize, 'olivo_lite_site_not_kirki', array(
			'section' => 'olivo_lite_site_options_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'To access Site Options make sure you have installed the %1$s Kirki Toolkit %2$s plugin.', 'olivo-lite' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) . '">', '</a>' ),
		) ) );
	}//if Kirki exists






	/*
	Typography
	------------------------------ */
	$wp_customize->add_section( 'olivo_lite_typography_section', array(
		'title' => esc_attr__( 'Typography', 'olivo-lite' ),
	) );

	if ( class_exists( 'Kirki' ) ){

		Kirki::add_field( 'olivo_lite_typography_font_family', array(
		    'type'     => 'select',
		    'settings' => 'olivo_lite_typography_font_family',
		    'label'    => esc_html__( 'Font Family', 'olivo-lite' ),
		    'section'  => 'olivo_lite_typography_section',
		    'default'  => 'Source Sans Pro',
		    'priority' => 20,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'olivo_lite_typography_font_family_headings', array(
		    'type'     => 'select',
		    'settings' => 'olivo_lite_typography_font_family_headings',
		    'label'    => esc_html__( 'Headings Font Family', 'olivo-lite' ),
		    'section'  => 'olivo_lite_typography_section',
		    'default'  => 'Inconsolata',
		    'priority' => 22,
		    'choices'  => Kirki_Fonts::get_font_choices(),
		    'output'   => array(
		        array(
		            'element'  => 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a',
		            'property' => 'font-family',
		        ),
		    ),
		) );

		Kirki::add_field( 'olivo_lite_typography_subsets', array(
		    'type'        => 'multicheck',
		    'settings'    => 'olivo_lite_typography_subsets',
		    'label'       => esc_html__( 'Google-Font subsets', 'olivo-lite' ),
		    'description' => esc_html__( 'The subsets used from Google\'s API.', 'olivo-lite' ),
		    'section'     => 'olivo_lite_typography_section',
		    'default'     => '',
		    'priority'    => 23,
		    'choices'     => Kirki_Fonts::get_google_font_subsets(),
		    'output'      => array(
		        array(
		            'element'  => 'body',
		            'property' => 'font-subset',
		        ),
		    ),
		) );

		Kirki::add_field( 'olivo_lite_typography_font_size', array(
		    'type'      => 'slider',
		    'settings'  => 'olivo_lite_typography_font_size',
		    'label'     => esc_html__( 'Font Size', 'olivo-lite' ),
		    'section'   => 'olivo_lite_typography_section',
		    'default'   => 16,
		    'priority'  => 25,
		    'choices'   => array(
		        'min'   => 7,
		        'max'   => 48,
		        'step'  => 1,
		    ),
		    'output' => array(
		        array(
		            'element'  => 'html',
		            'property' => 'font-size',
		            'units'    => 'px',
		        ),
		    ),
		    'transport' => 'postMessage',
		    'js_vars'   => array(
		        array(
		            'element'  => 'html',
		            'function' => 'css',
		            'property' => 'font-size',
		            'units'    => 'px'
		        ),
		    ),
		) );
	}else{
		$wp_customize->add_setting( 'olivo_lite_typography_not_kirki', array( 'default' => '', 'sanitize_callback' => 'olivo_lite_sanitize_text', ) );
		$wp_customize->add_control( new olivo_lite_Display_Text_Control( $wp_customize, 'olivo_lite_typography_not_kirki', array(
			'section' => 'olivo_lite_typography_section', // Required, core or custom.
			'label' => sprintf( esc_html__( 'To change typography make sure you have installed the %1$s Kirki Toolkit %2$s plugin.', 'olivo-lite' ), '<a href="' . get_admin_url( null, 'themes.php?page=tgmpa-install-plugins' ) . '">', '</a>' ),
		) ) );
	}//if Kirki exists


	

	/*
	PRO Version
	------------------------------ */
	$wp_customize->add_section( 'olivo_lite_pro_section', array(
		'title' => esc_attr__( 'PRO version', 'olivo-lite' ),
		'priority' => 5,
	) );
	$wp_customize->add_setting( 'olivo_lite_probtn', array( 'default' => '', 'sanitize_callback' => 'olivo_lite_sanitize_text', ) );
	$wp_customize->add_control( new olivo_lite_Display_Text_Control( $wp_customize, 'olivo_lite_probtn', array(
		'section' => 'olivo_lite_pro_section', // Required, core or custom.
		'label' => sprintf( esc_html__( 'Check out the PRO version for more features. %1$s View PRO version %2$s', 'olivo-lite' ), '<br><a target="_blank" class="button" href="https://www.quemalabs.com/theme/olivo/" style="margin: 10px auto;">', '</a>' ),
	) ) );









}
add_action( 'customize_register', 'olivo_lite_customize_register' );











/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function olivo_lite_customize_preview_js() {

	wp_register_script( 'olivo_lite_customizer_preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), '20151024', true );
	wp_localize_script( 'olivo_lite_customizer_preview', 'wp_customizer', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'theme_url' => get_template_directory_uri(),
		'site_name' => get_bloginfo( 'name' )
	));
	wp_enqueue_script( 'olivo_lite_customizer_preview' );

}
add_action( 'customize_preview_init', 'olivo_lite_customize_preview_js' );


/**
 * Load scripts on the Customizer not the Previewer (iframe)
 */
function olivo_lite_customize_js() {

	wp_enqueue_script( 'olivo_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-controls' ), '20151024', true );

}
add_action( 'customize_controls_enqueue_scripts', 'olivo_lite_customize_js' );


/**
 * Load Stylesheet on the Customizer not the Previewer (iframe)
 */
function olivo_lite_customize_css() {

	wp_register_style( 'olivo_lite_custom_wp_admin_css', get_template_directory_uri() . '/css/admin-styles.css', false, '1.0.0' );
    wp_enqueue_style( 'olivo_lite_custom_wp_admin_css' );

}
add_action( 'customize_controls_enqueue_scripts', 'olivo_lite_customize_css' );










/*
Sanitize Callbacks
*/

/**
 * Sanitize for post's categories
 */
function olivo_lite_sanitize_categories( $value ) {
    if ( ! array_key_exists( $value, olivo_lite_categories_ar() ) )
        $value = '';
    return $value;
}

/**
 * Sanitize return an non-negative Integer
 */
function olivo_lite_sanitize_integer( $value ) {
    return absint( $value );
}

/**
 * Sanitize return pro version text
 */
function olivo_lite_pro_version( $input ) {
    return $input;
}

/**
 * Sanitize Any
 */
function olivo_lite_sanitize_any( $input ) {
    return $input;
}

/**
 * Sanitize Text
 */
function olivo_lite_sanitize_text( $str ) {
	return sanitize_text_field( $str );
}

/**
 * Sanitize Textarea
 */
function olivo_lite_sanitize_textarea( $text ) {
	return esc_textarea( $text );
}

/**
 * Sanitize URL
 */
function olivo_lite_sanitize_url( $url ) {
	return esc_url( $url );
}

/**
 * Sanitize Boolean
 */
function olivo_lite_sanitize_bool( $string ) {
	return (bool)$string;
}

/**
 * Sanitize Text with html
 */
function olivo_lite_sanitize_text_html( $str ) {
	$args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array()
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	return wp_kses( $str, $args );
}

/**
 * Sanitize array for multicheck
 * http://stackoverflow.com/a/22007205
 */
function olivo_lite_sanitize_multicheck( $values ) {

    $multi_values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $multi_values ) ) ? array_map( 'sanitize_title', $multi_values ) : array();
}

/**
 * Sanitize GPS Latitude and Longitud
 * http://stackoverflow.com/a/22007205
 */
function olivo_lite_sanitize_lat_long( $coords ) {
	if ( preg_match( '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?),[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', $coords ) ) {
	    return $coords;
	} else {
	    return 'error';
	}
}



/**
 * Create the "PRO version" buttons
 */
if ( ! function_exists( 'olivo_lite_pro_btns' ) ){
	function olivo_lite_pro_btns( $args ){

		$wp_customize = $args['wp_customize'];
		$title = $args['title'];
		$label = $args['label'];
		if ( isset( $args['priority'] ) || array_key_exists( 'priority', $args ) ) {
			$priority = $args['priority'];
		}else{
			$priority = 120;
		}
		if ( isset( $args['panel'] ) || array_key_exists( 'panel', $args ) ) {
			$panel = $args['panel'];
		}else{
			$panel = '';
		}

		$section_id = sanitize_title( $title );

		$wp_customize->add_section( $section_id , array(
			'title'       => $title,
			'priority'    => $priority,
			'panel' => $panel,
		) );
		$wp_customize->add_setting( $section_id, array(
			'sanitize_callback' => 'olivo_lite_pro_version'
		) );
		$wp_customize->add_control( new olivo_lite_Pro_Version( $wp_customize, $section_id, array(
	        'section' => $section_id,
	        'label' => $label
		   )
		) );
	}
}//end if function_exists

/**
 * Display Text Control
 * Custom Control to display text
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	class olivo_lite_Display_Text_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() {

	        $wp_kses_args = array(
			    'a' => array(
			        'href' => array(),
			        'title' => array(),
			        'data-section' => array(),
			        'class' => array(),
			        'style' => array(),
			        'target' => array(),
			    ),
			    'br' => array(),
			    'em' => array(),
			    'strong' => array(),
			    'span' => array(),
			);
	        ?>
			<p><?php echo wp_kses( $this->label, $wp_kses_args ); ?></p>
		<?php
		}
	}
}



/*
* AJAX call to retreive an image URI by its ID
*/
add_action( 'wp_ajax_nopriv_olivo_lite_get_image_src', 'olivo_lite_get_image_src' );
add_action( 'wp_ajax_olivo_lite_get_image_src', 'olivo_lite_get_image_src' );

function olivo_lite_get_image_src() {
	if ( isset( $_POST[ 'image_id' ] ) ) {
        $image_id = sanitize_text_field( wp_unslash( $_GET[ 'image_id' ] ) );
    }
	$image = wp_get_attachment_image_src( absint( $image_id ), 'full' );
	$image = $image[0];
	echo wp_kses_post( $image );
	die();
}
