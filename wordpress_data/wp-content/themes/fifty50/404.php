<?php

/**
 * The 404 error template file
 * Whenever a page is gone or not accessible, this page will be displayed.
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
      <h1 class="page-title"><?php esc_html_e('Page not Found', 'fifty50'); ?></h1>
      <div id="page-excerpt"><?php esc_html_e('Unfortunately, it looks like the page you were wanting is missing or has been moved. Perhaps try performing a search?', 'fifty50'); ?></div>
    </div>
  </header><!-- .page-header -->

  <section class="error-404 not-found content-outer">
    <div class="content-inner">
      <div class="page-content">
        <p id="error-icon"><i class="bi bi-emoji-frown"></i></p>

        <?php get_search_form(); ?>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="error-home-link"><i class="bi bi-house-fill"></i> <?php esc_html_e('Back To Home', 'fifty50'); ?></a>
      </div><!-- .page-content -->
    </div>
  </section><!-- .error-404 -->

</main><!-- .site-main -->

<?php get_footer(); ?>