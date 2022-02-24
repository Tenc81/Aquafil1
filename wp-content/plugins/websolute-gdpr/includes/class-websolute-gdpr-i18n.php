<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.websolute.com
 * @since      1.0.0
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/includes
 * @author     Alessandro Lambertini <alambertini@websolute.it>
 */
class Websolute_Gdpr_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'websolute-gdpr',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
