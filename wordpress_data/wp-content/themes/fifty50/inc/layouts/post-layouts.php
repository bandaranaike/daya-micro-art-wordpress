<?php

/**
 * Theme full post layouts
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/* POST LAYOUT
   ====================================================*/
if (!function_exists('fifty50_single_layouts')) :
	function fifty50_single_layouts()
	{

		if (have_posts()) :

			// Start the loop.
			while (have_posts()) : the_post();

				// Action hook for any content placed before the full post
				do_action('fifty50_before_full_post');

				/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
				// Get the post content
				get_template_part('template-parts/content', 'single');

				// Action hook for any content placed after the full post
				do_action('fifty50_after_full_post');

				// Author bio.       
				fifty50_bio_info();

				// Action hook for any content placed after author bio
				do_action('fifty50_after_author_bio');

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;

				// load the post navigation
				echo '<div id="post-navigation-wrapper"><div id="post-navigation-inner">';
				fifty50_post_pagination();
				echo '</div></div>';


			// End the loop.
			endwhile;

		endif;
	}
endif;
