<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://vander.dk/
 * @since      1.0.0
 *
 * @package    Vanderweb_Content
 * @subpackage Vanderweb_Content/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Vanderweb_Content
 * @subpackage Vanderweb_Content/includes
 * @author     Ulrik Vander <ulrik@vander.dk>
 */
class Vanderweb_Content_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'vanderweb-content',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
