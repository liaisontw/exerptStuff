<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/liaisontw
 * @since      1.0.0
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/includes
 * @author     liason <liaison.tw@gmail.com>
 */
class Excerpt_Stuff_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'excerpt-stuff',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
