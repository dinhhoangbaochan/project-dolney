<?php

class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();

			/**
			 * Elementor loaded.
			 *
			 * Fires when Elementor was fully loaded and instantiated.
			 *
			 * @since 1.0.0
			 */
			// do_action( 'elementor/loaded' );
		}

		// return self::$instance;
		var_dump(self::$instance);
	}
}

if ( ! defined( 'DOLNEY_TESTS' ) ) {
	// In tests we run the instance manually.
	Plugin::instance();
}