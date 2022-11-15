<?php
/**
 * Plugin Name: Football Poets Posts
 * Plugin URI: http://footballpoets.org
 * Description: Creates Metaboxes for Posts on the Football Poets site.
 * Author: Christian Wach
 * Version: 0.1
 * Author URI: https://haystack.co.uk
 * Text Domain: poets-posts
 * Domain Path: /languages
 *
 * @package Poets_Posts
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set our version here.
define( 'POETS_POSTS_VERSION', '0.1' );

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
	 * @var object $metaboxes The Metaboxes object.
	 */
	public $metaboxes;

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		// Include files.
		$this->include_files();

		// Setup globals.
		$this->setup_globals();

		// Register hooks.
		$this->register_hooks();

	}

	/**
	 * Include files.
	 *
	 * @since 0.1
	 */
	public function include_files() {

		// Include Metaboxes class.
		include_once POETS_POSTS_PATH . 'includes/poets-posts-metaboxes.php';

	}

	/**
	 * Set up objects.
	 *
	 * @since 0.1
	 */
	public function setup_globals() {

		// Init Metaboxes object.
		$this->metaboxes = new Poets_Posts_Metaboxes();

	}

	/**
	 * Register WordPress hooks.
	 *
	 * @since 0.1
	 */
	public function register_hooks() {

		// Use translation.
		add_action( 'plugins_loaded', [ $this, 'translation' ] );

		// Hooks that always need to be present.
		$this->metaboxes->register_hooks();

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

	/**
	 * Perform plugin activation tasks.
	 *
	 * @since 0.1
	 */
	public function activate() {

	}

	/**
	 * Perform plugin deactivation tasks.
	 *
	 * @since 0.1
	 */
	public function deactivate() {

	}

}

/**
 * Plugin reference getter.
 *
 * @since 0.1
 *
 * @return obj $poets_posts The plugin object.
 */
function poets_posts() {
	static $poets_posts;
	if ( ! isset( $poets_posts ) ) {
		$poets_posts = new Poets_Posts();
	}
	return $poets_posts;
}

// Bootstrap plugin.
poets_posts();

// Activation.
register_activation_hook( __FILE__, [ poets_posts(), 'activate' ] );

// Deactivation.
register_deactivation_hook( __FILE__, [ poets_posts(), 'deactivate' ] );
