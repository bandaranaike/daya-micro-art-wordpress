<?php

/**
 * Theme blog layouts: default, list
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


/* BLOG LAYOUT
   ====================================================*/
if (!function_exists('fifty50_blog_layouts')) :
	function fifty50_blog_layouts()
	{

		$blog_layout = apply_filters('fifty50_blog_layout', get_theme_mod('fifty50_blog_layout', 'center'));

		// Start
		if (have_posts()) :

			while (have_posts()) : the_post();
				// Get the post summary							
				get_template_part('template-parts/content', $blog_layout !== 'center' ? $blog_layout : '');
			endwhile;
			// Blog navigation
			fifty50_paging_nav();

		else :
			get_template_part('template-parts/content', 'none');
		endif;
		// End
	}
endif;
