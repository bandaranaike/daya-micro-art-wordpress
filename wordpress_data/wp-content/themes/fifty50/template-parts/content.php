<?php

/**
 * The template for displaying blog summaries
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

      // Blog post title    
      the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');

      // Post Entry meta
      fifty50_entry_meta()
      ?>

    </header>

    <?php fifty50_post_thumbnail(); ?>

    <div class="entry-content">
      <?php
      if (esc_attr(get_theme_mod('fifty50_blog_excerpt', 1))) {
        the_excerpt();
        fifty50_read_more_link();
      } else {
        the_content();
      }

      fifty50_multipage_pagination();
      ?>
    </div><!-- .entry-content -->

  </div>
</article><!-- #post-## -->