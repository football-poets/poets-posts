<?php
/**
 * Football Poets "Posts" Metaboxes class.
 *
 * Handles all Metaboxes for this CPT.
 *
 * @package Poets_Posts
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Football Poets "Posts" Metaboxes Class.
 *
 * A class that encapsulates all Metaboxes for this CPT.
 *
 * @since 0.1
 */
class Poets_Posts_Metaboxes {

	/**
	 * Custom Post Type name.
	 *
	 * @since 0.1
	 * @access public
	 * @var string
	 */
	public $post_type_name = 'post';

	/**
	 * Original database ID meta key.
	 *
	 * @since 0.1
	 * @access public
	 * @var string
	 */
	public $original_id_meta_key = 'poets_poems_original_id';

	/**
	 * Original author name meta key.
	 *
	 * @since 0.1
	 * @access public
	 * @var string
	 */
	public $author_name_meta_key = 'poets_poems_author_name';

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {

		// Register hook callbacks.
		$this->register_hooks();

	}

	/**
	 * Register hook callbacks.
	 *
	 * @since 0.1
	 */
	public function register_hooks() {

		// Add meta boxes.
		add_action( 'add_meta_boxes', [ $this, 'add_meta_boxes' ] );

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Adds meta boxes to admin screens
	 *
	 * @since 0.1
	 */
	public function add_meta_boxes() {

		// Add a meta box for legacy data.
		add_meta_box(
			'poets_poems_legacy',
			__( 'Legacy Info', 'poets-posts' ),
			[ $this, 'metabox_legacy' ],
			$this->post_type_name,
			'side'
		);

	}

	/**
	 * Adds a legacy info metabox to edit screens.
	 *
	 * @since 0.1
	 *
	 * @param WP_Post $post The object for the current post/page.
	 */
	public function metabox_legacy( $post ) {

		// Get value for original ID key.
		$db_id = $this->get_meta( $post, '_' . $this->original_id_meta_key );

		// Get value for original author key.
		$author_name = $this->get_meta( $post, '_' . $this->author_name_meta_key );

		// Use template.
		include POETS_POSTS_PATH . 'assets/templates/metabox-posts.php';

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Utility to simplify metadata retrieval.
	 *
	 * @since 0.1
	 *
	 * @param WP_Post $post The WordPress post object.
	 * @param string  $key The meta key.
	 * @return mixed $data The data that was saved.
	 */
	private function get_meta( $post, $key ) {

		// Init return.
		$data = '';

		// Get value if the custom field already has one.
		$existing = get_post_meta( $post->ID, $key, true );
		if ( false !== $existing ) {
			$data = $existing;
		}

		// --<
		return $data;

	}

	/**
	 * Utility to automate metadata saving.
	 *
	 * @since 0.1
	 *
	 * @param WP_Post $post The WordPress post object.
	 * @param string  $key The meta key.
	 * @param mixed   $data The data to be saved.
	 * @return mixed $data The data that was saved.
	 */
	private function save_meta( $post, $key, $data = '' ) {

		// If the custom field already has a value.
		$existing = get_post_meta( $post->ID, $key, true );
		if ( false !== $existing ) {

			// Update the data.
			update_post_meta( $post->ID, $key, $data );

		} else {

			// Add the data.
			add_post_meta( $post->ID, $key, $data, true );

		}

		// --<
		return $data;

	}

}
