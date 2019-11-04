<?php
/**
 * The plugins creates a shortcode for display posts in carousel.
 *
 * @link              https://github.com/vishakha070/posts-carousel
 * @since             1.0.0
 * @package           Posts_Carousel
 *
 * @wordpress-plugin
 * Plugin Name:       Posts Carousel
 * Plugin URI:        https://github.com/vishakha070/posts-carousel
 * Description:       This plugin creates shortcode for display posts carousel.(eg: [my-carousel] or [my-carousel cat="3,4"])
 * Version:           1.0.0
 * Author:            Vishakha Gupta
 * Author URI:        https://profiles.wordpress.org/vishakha07/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       posts-carousel
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
define( 'POSTS_CAROUSEL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-posts-carousel-activator.php
 */
function activate_posts_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-posts-carousel-activator.php';
	Posts_Carousel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-posts-carousel-deactivator.php
 */
function deactivate_posts_carousel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-posts-carousel-deactivator.php';
	Posts_Carousel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_posts_carousel' );
register_deactivation_hook( __FILE__, 'deactivate_posts_carousel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-posts-carousel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_posts_carousel() {

	$plugin = new Posts_Carousel();
	$plugin->run();

}
run_posts_carousel();
