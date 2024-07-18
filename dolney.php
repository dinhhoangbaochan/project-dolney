<?php
/**
 * Plugin Name: Dolney
 * Description: A page builder, or at least what it tries to be.
 * Plugin URL: https://chandinh.com
 * Author: ChanDinh.com
 * Version: 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'DOLNEY_VERSION', '0.0.1' );

define( 'DOLNEY__FILE__', __FILE__ ); // this point to this dolney.php file
define( 'DOLNEY_PLUGIN_BASE', plugin_basename( DOLNEY__FILE__ ) );
define( 'DOLNEY_PATH', plugin_dir_path( DOLNEY__FILE__ ) ); // this returns the path to plugin directory

if ( defined( 'DOLNEY_TESTS' ) && DOLNEY_TESTS ) {
	define( 'DOLNEY_URL', 'file://' . DOLNEY_PATH );
} else {
	define( 'DOLNEY_URL', plugins_url( '/', DOLNEY__FILE__ ) );
}

define( 'DOLNEY_MODULES_PATH', plugin_dir_path( DOLNEY__FILE__ ) . '/modules' );
define( 'DOLNEY_ASSETS_PATH', DOLNEY_PATH . 'assets/' );
define( 'DOLNEY_ASSETS_URL', DOLNEY_URL . 'assets/' );

// Display notice if PHP is lower than 7.4 or WordPress is not 6.0
if ( ! version_compare( PHP_VERSION, '7.4', '>=' ) ) {
	add_action( 'admin_notices', 'DOLNEY_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '6.0', '>=' ) ) {
	add_action( 'admin_notices', 'DOLNEY_fail_wp_version' );
} else {
  // Otherwise, call plugin.php in includes
	require DOLNEY_PATH . 'includes/plugin.php';
}

/**
 * Elementor admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @since 1.0.0
 *
 * @return void
 */
function DOLNEY_fail_php_version() {
	$html_message = sprintf(
		'<div class="error"><h3>%1$s</h3><p>%2$s <a href="https://go.elementor.com/wp-dash-update-php/" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Elementor isn’t running because PHP is outdated.', 'elementor' ),
		sprintf(
			/* translators: %s: PHP version. */
			esc_html__( 'Update to version %s and get back to creating!', 'elementor' ),
			'7.4'
		),
		esc_html__( 'Show me how', 'elementor' )
	);

	echo wp_kses_post( $html_message );
}

/**
 * Elementor admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.5.0
 *
 * @return void
 */
function DOLNEY_fail_wp_version() {
	$html_message = sprintf(
		'<div class="error"><h3>%1$s</h3><p>%2$s <a href="https://go.elementor.com/wp-dash-update-wordpress/" target="_blank">%3$s</a></p></div>',
		esc_html__( 'Elementor isn’t running because WordPress is outdated.', 'elementor' ),
		sprintf(
			/* translators: %s: WordPress version. */
			esc_html__( 'Update to version %s and get back to creating!', 'elementor' ),
			'6.0'
		),
		esc_html__( 'Show me how', 'elementor' )
	);

	echo wp_kses_post( $html_message );
}
