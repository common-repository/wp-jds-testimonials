<?php
/**
 * Plugin Name: WP JDs Testimonials
 * Plugin URI: https://wordpress.org/plugins/jds-portfolio/
 * Description: WP JDs Testimonials allows you to manage Testimonials listing via wordpress backend.
 * Version: 1.0.1
 * Author: JayDeep Nimavat
 * Author URI: https://profiles.wordpress.org/jaydeep-nimavat
 * Text Domain: wpjdstm
 * Domain Path: languages
 *
 * License: GPLv2 or later
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
if( !defined( 'WP_JDSTM_VERSION' ) ) {
	define( 'WP_JDSTM_VERSION', '1.0.1' ); //version of plugin
}
if( !defined( 'WP_JDSTM_DIR' ) ) {
	define( 'WP_JDSTM_DIR', dirname( __FILE__ ) ); // plugin dir
}
if( !defined( 'WP_JDSTM_BASENAME') ) {
	define( 'WP_JDSTM_BASENAME', basename( WP_JDSTM_DIR ) ); // plugin base name
}
if( !defined( 'WP_JDSTM_ADMIN' ) ) {
	define( 'WP_JDSTM_ADMIN', WP_JDSTM_DIR . '/includes/admin' ); // plugin admin dir
}
if( !defined( 'WP_JDSTM_URL' ) ) {
	define( 'WP_JDSTM_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if( !defined( 'WP_JDSTM_POST_TYPE' ) ) {
	define( 'WP_JDSTM_POST_TYPE', 'wpjdstm_testimonials' ); // custom post type's slug
}
if( !defined( 'WP_JDSTM_META_PREFIX' ) ) {
	define( 'WP_JDSTM_META_PREFIX', '_wpjdstm_' ); // Meta prefix
}

/**
 * Load Text Domain
 * 
 * This gets the plugin ready for translation.
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
function wp_jdstm_plugins_loaded() {
	
	// Set filter for plugin's languages directory
	$wp_jdstm_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wp_jdstm_lang_dir	= apply_filters( 'wp_jdstm_languages_directory', $wp_jdstm_lang_dir );
	
	// Traditional WordPress plugin locale filter
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wpjdstm' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wpjdstm', $locale );
	
	// Setup paths to current locale file
	$mofile_local	= $wp_jdstm_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . WP_JDSTM_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/wp-ntwd-jobs folder
		load_textdomain( 'wpjdstm', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { // Look in local /wp-content/plugins/wp-ntwd-jobs/languages/ folder
		load_textdomain( 'wpjdstm', $mofile_local );
	} else { // Load the default language files
		load_plugin_textdomain( 'wpjdstm', false, $wp_jdstm_lang_dir );
	}
}
add_action( 'plugins_loaded', 'wp_jdstm_plugins_loaded' );

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_jdstm_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
function wp_jdstm_install() {
	
	global $wpdb;

	// call regiater post type function
	wp_jdstm_register_post_types();

	//IMP Call of Function
	//Need to call when custom post type is being used in plugin
	flush_rewrite_rules();
}

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_jdstm_uninstall');

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
function wp_jdstm_uninstall() {
	global $wpdb;
}

/**
 * Global Variables
 * 
 * Declaration of some needed global varibals for plugin
 *
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
global $wp_jdstm_admin;

/**
 * Includes Files
 * 
 * Includes required files for plugin
 *
 * @package WP JDs Testimonials
 * @since 1.0.0
 */
// Post type to handle custom post type
require_once( WP_JDSTM_DIR . '/includes/wp-jdstm-post-types.php' );

// Admin class to handle admin side functionality
require_once( WP_JDSTM_ADMIN . '/class-wp-jdstm-admin.php' );
$wp_jdstm_admin = new Wp_Jdstm_Admin();
$wp_jdstm_admin->add_hooks();