<?php
/**
 * Posts "Legacy Info" metabox template.
 *
 * Handles markup for the display of the "Legacy Info" metabox on Edit Post screens.
 *
 * @package Poets_Posts
 * @since 0.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<!-- assets/templates/metabox-posts.php -->
<p>
	<?php

	echo sprintf(
		/* translators: %d: The original database ID. */
		esc_html__( 'Original database ID: %d', 'poets-posts' ),
		(int) $db_id
	);

	?>
</p>

<p>
	<?php

	echo sprintf(
		/* translators: %s: The original author name. */
		esc_html__( 'Original author name: %s', 'poets-posts' ),
		esc_html( $author_name )
	);

	?>
</p>
