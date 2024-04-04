<?php

/**
 * The main template file
 * This is the most generic template file in a WordPress theme. 
 * We modified it for this theme without a loop; exception to getting our blog layout.
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php // Action hook for the blog home page heading area
	do_action('fifty50_blog_home_heading');

	// Action hook for any content placed before posts
	do_action('fifty50_before_posts');

	// Get our blog layout
	fifty50_blog_layouts();

	// Action hook for any content placed after posts
	do_action('fifty50_after_posts');
	?>

</main>

<?php
get_footer();
