<?php

/**
 * No Content Template
 * Template part for displaying a message that posts cannot be found
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<header class="page-header content-outer">
	<div class="content-inner">
		<h1 class="page-title"><?php esc_html_e('Nothing Found', 'fifty50'); ?></h1>
	</div>
</header>

<div class="page-content content-outer">
	<div class="content-inner">
		<?php if (is_home() && current_user_can('publish_posts')) : ?>

			<p>
				<?php esc_html_e('Ready to publish your first post?', 'fifty50'); ?> <a class="nav-link" href="<?php echo esc_url(admin_url('post-new.php')); ?>"><?php esc_html_e('Get started here', 'fifty50'); ?></a>.
			</p>

		<?php elseif (is_search()) : ?>

			<p><?php esc_html_e('Unfortunately, nothing matched your search terms. Please try again with different keywords.', 'fifty50'); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e('It seems we cannot find what you were wanting. Perhaps searching can help find what you are looking for?', 'fifty50'); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</div><!-- .page-content -->