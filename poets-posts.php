<?php
/**
 * Football Poets Posts
 *
 * Plugin Name: Football Poets Posts
 * Description: Creates Metaboxes for Posts on the Football Poets site.
 * Plugin URI:  https://github.com/football-poets/poets-posts
 * Version:     0.2.0a
 * Author:      Christian Wach
 * Author URI:  https://haystack.co.uk
 * Text Domain: poets-posts
 * Domain Path: /languages
 *
 * @package Poets_Posts
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set our version here.
define( 'POETS_POSTS_VERSION', '0.2.0a' );

// Store reference to this file.
if ( ! defined( 'POETS_POSTS_FILE' ) ) {
	define( 'POETS_POSTS_FILE', __FILE__ );
}

// Store URL to this plugin's directory.
if ( ! defined( 'POETS_POSTS_URL' ) ) {
	define( 'POETS_POSTS_URL', plugin_dir_url( POETS_POSTS_FILE ) );
}

// Store PATH to this plugin's directory.
if ( ! defined( 'POETS_POSTS_PATH' ) ) {
	define( 'POETS_POSTS_PATH', plugin_dir_path( POETS_POSTS_FILE ) );
}

/**
 * Football Poets "Posts" Plugin Class.
 *
 * A class that encapsulates plugin functionality.
 *
 * @since 0.1
 */
class Poets_Posts {

	/**
	 * Metaboxes object.
	 *
	 * @since 0.1
	 * @access public
	 * @var Poets_Posts_Metaboxes
	 */
	public $metaboxes;

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		// Initialise when all plugins are loaded.
		add_action( 'plugins_loaded', [ $this, 'initialise' ] );

	}

	/**
	 * Initialises this plugin.
	 *
	 * @since 0.2.0
	 */
	public function initialise() {

		// Only do this once.
		static $done;
		if ( isset( $done ) && true === $done ) {
			return;
		}

		// Bootstrap plugin.
		$this->include_files();
		$this->setup_globals();
		$this->register_hooks();

		/**
		 * Broadcast that this plugin is now loaded.
		 *
		 * @since 0.2.0
		 */
		do_action( 'poets_posts/loaded' );

		// We're done.
		$done = true;

	}

	/**
	 * Include files.
	 *
	 * @since 0.1
	 */
	private function include_files() {

		// Include Metaboxes class.
		include POETS_POSTS_PATH . 'includes/poets-posts-metaboxes.php';

	}

	/**
	 * Set up objects.
	 *
	 * @since 0.1
	 */
	private function setup_globals() {

		// Init Metaboxes object.
		$this->metaboxes = new Poets_Posts_Metaboxes();

	}

	/**
	 * Register WordPress hooks.
	 *
	 * @since 0.1
	 */
	private function register_hooks() {

		// Use translation.
		add_action( 'init', [ $this, 'translation' ] );

	}

	/**
	 * Load translation if present.
	 *
	 * @since 0.1
	 */
	public function translation() {

		// Allow translations to be added.
		// phpcs:ignore WordPress.WP.DeprecatedParameters.Load_plugin_textdomainParam2Found
		load_plugin_textdomain(
			'poets-posts', // Unique name.
			false, // Deprecated argument.
			dirname( plugin_basename( POETS_POSTS_FILE ) ) . '/languages/'
		);

	}

}

/**
 * Plugin reference getter.
 *
 * @since 0.1
 *
 * @return Poets_Posts $plugin The plugin object.
 */
function poets_posts() {

	// Store instance in static variable.
	static $plugin = false;

	// Maybe return instance.
	if ( false === $plugin ) {
		$plugin = new Poets_Posts();
	}

	// --<
	return $plugin;

}

// Bootstrap plugin.
poets_posts();
