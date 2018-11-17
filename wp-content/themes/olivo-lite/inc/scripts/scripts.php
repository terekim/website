<?php

	//HTML5 Shiv ==============================================
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.3', true );
	//=================================================================

	//hoverIntent Plugin ==============================================
	wp_enqueue_script( 'hoverIntent' );
	//=================================================================

	//photoSwipe and UI Plugin ========================================
	wp_enqueue_script( 'photoswipe', get_theme_file_uri( '/js/photoswipe.js' ), array(), '4.1.1', true);
	wp_enqueue_script( 'olivo_lite_photo-swipe-default', get_theme_file_uri( '/js/photoswipe-ui-default.js' ), array(), '4.1.1', true);
	//=================================================================

	//Modernizr Plugin ================================================
	wp_enqueue_script( 'olivo_lite_modernizr', get_template_directory_uri() . '/js/modernizr.min.js', '2.8.3', true );
	//=================================================================

	//Pace  ===========================================================
	wp_enqueue_script( 'pace', get_template_directory_uri() . '/js/pace.min.js', array(), '1.0.2', true );
	//=================================================================

	//Color Thief  ===========================================================
	wp_enqueue_script( 'color-thief', get_template_directory_uri() . '/js/color-thief.min.js', array(), '2.0', true );
	//=================================================================

	//niceScroll  ===========================================================
	wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array( 'jquery' ), '2.0', true );
	//=================================================================

	//Imageloaded  ===========================================================
	wp_enqueue_script( 'imagesloaded', true );
	//=================================================================

	//Isotope  ===========================================================
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), '3.0.2', true );
	//=================================================================

	//Packery Mode  ===========================================================
	wp_enqueue_script( 'packery-mode', get_template_directory_uri() . '/js/packery-mode.pkgd.min.js', array(), '2.0.0', true );
	//=================================================================

	//Flickity  ===========================================================
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), '2.0.5', true );
	//=================================================================

	//Bootstrap JS ========================================
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true );
	//=================================================================

	//Comment Reply ===================================================
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//=================================================================



	//Customs Scripts =================================================
	wp_enqueue_script( 'olivo_lite_theme-custom', get_template_directory_uri() . '/js/script.js', array( 'jquery', 'bootstrap' ), '1.0', true );
	$olivo_lite_custom_js = array(
		'admin_ajax' => admin_url( 'admin-ajax.php' ),
		'token' => wp_create_nonce( 'quemalabs-secret' )
	);
	wp_localize_script( 'olivo_lite_theme-custom', 'olivo_lite', $olivo_lite_custom_js );
	//=================================================================


?>
