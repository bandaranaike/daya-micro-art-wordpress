<?php

/**
 * Single - Full Post template
 * The template for displaying all single posts and attachments.
 * We modified this template for this theme without the loop.
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php // Get our full post layout
	fifty50_single_layouts(); ?>

</main><!-- .site-main -->

<?php
get_footer();
