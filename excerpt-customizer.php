<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/liaisontw
 * @since             1.0.0
 * @package           Excerpt_Customizer
 *
 * @wordpress-plugin
 * Plugin Name:       Excerpt Customizer
 * Plugin URI:        https://github.com/liaisontw/excerptstuff
 * Description:       ExcerptCustomizer plugin replaces the ellipsis (...) with a 
 *					  custom text string with selected padding. 
 *					  Not compatible with all themes.
 * Version:           1.0.0
 * Author:            liason
 * Author URI:        https://github.com/liaisontw/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       excerpt-customizer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EXCERPT_STUFF_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-excerpt-customizer-activator.php
 */
function activate_excerpt_stuff() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-excerpt-customizer-activator.php';
	Excerpt_Stuff_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-excerpt-customizer-deactivator.php
 */
function deactivate_excerpt_stuff() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-excerpt-customizer-deactivator.php';
	Excerpt_Stuff_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_excerpt_stuff' );
register_deactivation_hook( __FILE__, 'deactivate_excerpt_stuff' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-excerpt-customizer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_excerpt_stuff() {

	$plugin = new Excerpt_Stuff();
	$plugin->run();

}
run_excerpt_stuff();
