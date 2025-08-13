<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/liaisontw
 * @since      1.0.0
 *
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Excerpt_Stuff
 * @subpackage Excerpt_Stuff/includes
 * @author     liason <liaison.tw@gmail.com>
 */
class Excerpt_Stuff_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option( 'excert_stuff_active', 'yes' );
		add_option( 'excert_stuff_excerpt_text', 'Read More' );
		add_option( 'excert_stuff_excerpt_padding', '0' );
	}

}
