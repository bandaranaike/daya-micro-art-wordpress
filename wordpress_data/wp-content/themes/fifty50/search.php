<?php

/**
 * The search template file Used to display search content.
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php if (have_posts()) : ?>

		<header class="entry-header content-outer">
			<div class="content-inner">
				<h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'fifty50'), get_search_query()); ?></h1>
			</div>
		</header><!-- .page-header -->

	<?php
		// Start the loop.
		while (have_posts()) : the_post();

			/*
			* Include the Post-Format-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part('template-parts/content', 'search');

		// End the loop.
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination();

	// If no content, include the "No posts found" template.
	else :
		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- .site-main -->

<?php
get_footer();
