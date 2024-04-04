<?php

/**
 * The template for displaying the full post content
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-outer'); ?>>
  <div class="content-inner">
    <header class="entry-header">

      <?php
      // Featured or category label
      fifty50_featured_category_badge();

      // Full post title
      the_title('<h1 class="entry-title">', '</h1>');

      // Post Entry meta
      fifty50_entry_meta();
      ?>

    </header>

    <?php // Full post thumbnail
    fifty50_post_thumbnail(); ?>

    <div class="entry-content">
      <?php  // Get our full post content
      the_content();
      fifty50_multipage_pagination();
      ?>
    </div><!-- .entry-content -->

    <?php // Get our post footer
    fifty50_entry_footer(); ?>

  </div>
</article><!-- #post-## -->