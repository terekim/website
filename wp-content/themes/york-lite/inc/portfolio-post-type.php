<?php
/**
 * Filters for the Portfolio Post Type plugin.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package York Lite
 * @author  Rich Tabor of ThemeBeans <hello@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 */

/**
 * Enables block editor support for the Portfolio Post Type plugin.
 *
 * @param array $args Existing arguments.
 *
 * @return array Amended arguments.
 */
function york_portfolioposttype_plugin_args( array $args ) {

	$args['show_in_rest'] = true;

	return $args;
}
add_action( 'portfolioposttype_args', 'york_portfolioposttype_plugin_args' );
