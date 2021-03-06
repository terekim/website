<?php
/**
 * Theme back compat functionality
 *
 * Prevents York Lite from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

/**
 * Prevent switching to York Lite on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function york_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'york_upgrade_notice' );
}
add_action( 'after_switch_theme', 'york_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * this theme on WordPress versions prior to 4.7.
 */
function york_upgrade_notice() {

	/* translators: installed WordPress version */
	$message = sprintf( esc_html__( 'York Lite requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'york-lite' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.7.
 */
function york_customize() {

	wp_die(
		/* translators: installed WordPress version */
		sprintf( esc_html__( 'York Lite requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'york-lite' ), esc_html( $GLOBALS['wp_version'] ) ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'york_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.7.
 */
function york_preview() {

	if ( isset( $_GET['preview'] ) ) {
		/* translators: installed WordPress version */
		wp_die( sprintf( esc_html__( 'York Lite requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'york-lite' ), esc_html( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'york_preview' );
