<?php

/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site may use a different template.
 *
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	// Start the loop.
	while (have_posts()) : the_post();

		// Include the page content template.
		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	// End the loop.
	endwhile;
	?>

</main><!-- .site-main -->

<?php
get_footer();
