<?php

/**
 * The archive template file
 * Used to display blog archived pages like categories, tags, author posts, etc.
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<header class="page-header content-outer">
		<div class="content-inner">
			<?php
			echo '<div id="archive-heading">';
			if (is_author()) {
				printf('<div class="author-avatar">%s</div>', get_avatar(get_queried_object_id(), 200)); // Original 120 size
			}

			the_archive_title('<h1 class="page-title">', '</h1>');
			the_archive_description('<div class="taxonomy-description">', '</div>');
			echo '</div>';

			// action hook for any content after the archive title and description
			if (!is_category() && !is_author()) {
				do_action('fifty50_after_archive_description');
			}
			?>
		</div>
	</header>

	<?php
	// Action hook for any content placed before posts
	do_action('fifty50_before_posts');

	// Get our blog layout
	fifty50_blog_layouts();

	// Action hook for any content placed after posts
	do_action('fifty50_after_posts');
	?>

</main><!-- .site-main -->

<?php
get_footer();
