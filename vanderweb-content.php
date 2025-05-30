<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://vander.dk/
 * @since             1.0.0
 * @package           Vanderweb_Content
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Utilities by Vander Web
 * Description:       Add WordPress Utilities.
 * Version:           1.0.1
 * Author:            Ulrik Vander
 * Author URI:        https://vander.dk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vanderweb-content
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
define( 'VANDERWEB_CONTENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vanderweb-bs4-accordion-activator.php
 */
function activate_vanderweb_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vanderweb-content-activator.php';
	Vanderweb_Content_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vanderweb-bs4-accordion-deactivator.php
 */
function deactivate_vanderweb_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vanderweb-content-deactivator.php';
	Vanderweb_Content_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vanderweb_content' );
register_deactivation_hook( __FILE__, 'deactivate_vanderweb_content' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vanderweb-content.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vanderweb_content() {

	$plugin = new Vanderweb_Content();
	$plugin->run();

}
run_vanderweb_content();
