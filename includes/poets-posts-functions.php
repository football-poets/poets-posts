<?php
/**
 * Football Poets "Posts" Theme functions.
 *
 * Global scope functions that are available to the theme can be found here.
 *
 * @package Poets_Posts
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Display all a Poet's Links.
 *
 * At present, this just means Twitter and Website.
 *
 * @since 0.1.1
 */
function poets_posts_links() {

	// Get twitter.
	$twitter = poets_posts_get_twitter();

	// Get website.
	$website = poets_posts_get_website();

	// If we have either.
	if ( ! empty( $twitter ) || ! empty( $website ) ) {

		// Join with line break.
		$output = implode( '<br>', [ $twitter, $website ] );

		// Show it.
		echo '<p>' . $output . '</p>';

	}

}

/**
 * Display a Poet's Twitter Account.
 *
 * @since 0.1
 */
function poets_posts_twitter() {

	// Show via function below.
	echo poets_posts_get_twitter();

}

/**
 * Get a Poet's Twitter Account.
 *
 * @since 0.1.1
 *
 * @return str The Twitter link.
 */
function poets_posts_get_twitter() {

	// Access globals.
	global $post;

	// Bail if Post isn't valid.
	if ( ! ( $post instanceof WP_Post ) ) {
		return '';
	}

	// Access plugin.
	$poets_posts = poets_posts();

	// Get meta data key.
	$db_key = '_' . $poets_posts->metaboxes->twitter_meta_key;

	// Show link if custom field has a value.
	$existing = get_post_meta( $post->ID, $db_key, true );
	if ( false !== $existing && ! empty( $existing ) ) {
		return '<a href="https://twitter.com/' . $existing . '">https://twitter.com/' . $existing . '</a>';
	}

	// --<
	return '';

}

/**
 * Display a link to a Poet's Website.
 *
 * @since 0.1
 */
function poets_posts_website() {

	// Show via function below.
	echo poets_posts_get_website();

}

/**
 * Get a link to a Poet's Website.
 *
 * @since 0.1.1
 *
 * @return str The Website link.
 */
function poets_posts_get_website() {

	// Access globals.
	global $post;

	// Bail if Post isn't valid.
	if ( ! ( $post instanceof WP_Post ) ) {
		return '';
	}

	// Access plugin.
	$poets_posts = poets_posts();

	// Get meta data key.
	$db_key = '_' . $poets_posts->metaboxes->website_meta_key;

	// Show link if custom field has a value.
	$existing = get_post_meta( $post->ID, $db_key, true );
	if ( false !== $existing && ! empty( $existing ) ) {
		return '<a href="' . $existing . '">' . $existing . '</a>';
	}

}
