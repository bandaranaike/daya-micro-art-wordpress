<?php

/**
 * The template for the blog list layout content
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}
?>
<div class="content-outer">
  <div class="content-inner grid-container">
    <article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>


      <?php if (has_post_thumbnail()) : ?>
        <div class="col-lg-12 col-xl-5">
          <?php fifty50_post_thumbnail(); ?>
        </div>
      <?php endif; ?>


      <?php if (!has_post_thumbnail()) : ?>
        <div class="col">
        <?php else : ?>
          <div class="col-lg-12 col-xl-7">
          <?php endif; ?>

          <header class="entry-header d-flex">
            <?php
            echo '<div class="box-date">';
            fifty50_box_meta_date();
            echo '</div><div class="sticky-wrapper">';
            if (is_sticky() && is_home() && !is_paged()) :
              printf('<span class="sticky-badge">%s</span>', get_theme_mod('sticky_post_title') ? esc_html(get_theme_mod('sticky_post_title')) : esc_html__('Featured', 'fifty50'));
            endif;

            the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
            ?>
          </header>

          <div class="entry-content">
            <?php the_excerpt();
            if (!esc_attr(get_theme_mod('fifty50_hide_excerpt_more_link', 0))) {
              fifty50_read_more_link();
            }
            ?>
          </div><!-- .entry-summary -->

    </article><!-- #post-## -->
  </div>
</div>