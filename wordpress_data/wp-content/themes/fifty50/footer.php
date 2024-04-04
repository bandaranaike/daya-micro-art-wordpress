<?php

/**
 * The template for displaying the footer
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$fifty50_back_to_top_text = esc_attr(get_theme_mod('fifty50_back_to_top_text', esc_html__('Back To Top', 'fifty50')));

?>

<?php // Action hook for any content placed before the bottom sidebar
do_action('fifty50_before_bottom_sidebar');
?>

<?php get_template_part('template-parts/sidebar', 'bottom'); ?>

<?php // Action hook for any content placed after the bottom sidebar
do_action('fifty50_after_bottom_sidebar');
?>

</div><!-- .site-content -->


<footer id="colophon" class="site-footer content-outer">
	<section class="content-inner">

		<?php get_template_part('template-parts/sidebar', 'footer'); ?>

		<?php // Social menu
		if (has_nav_menu('social')) {
			echo ' <nav id="social-menu">';
			wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_class'  => 'social-links d-flex justify-content-center',
					'container' => false,
					'echo' => true,
					'link_before' => '<span class="social-profile-label">',
					'link_after' => '</span>',
					'depth' => 1,
				)
			);
			echo '</nav>';
		}

		// Footer Menu
		if (has_nav_menu('footer')) {
			echo '<nav aria-label="', esc_attr_e('Footer menu', 'fifty50'), '" id="footer-navigation"><ul id="footer-navigation-wrapper" class="d-flex">';

			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'items_wrap'     => '%3$s',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span>',
					'link_after'     => '</span>',
					'fallback_cb'    => false,
				)
			);
			echo '</ul></nav>';
		}
		?>

		<span id="copyright">
			<?php esc_html_e('Copyright &copy;', 'fifty50'); ?>
			<?php echo esc_html(date_i18n(__('Y', 'fifty50'))); ?>
			<span id="copyright-name"><?php echo esc_html(get_theme_mod('fifty50_copyright')); ?></span>.
			<?php esc_html_e('All rights reserved.', 'fifty50'); ?>
		</span>

		<?php if (!esc_attr(get_theme_mod('fifty50_hide_backtotop', 0))) { ?>
			<div id="back-to-top-wrapper">
				<a title="<?php echo wp_kses_post($fifty50_back_to_top_text);  ?>" id="back-to-top">&lsqb; <span><?php echo wp_kses_post($fifty50_back_to_top_text); ?></span> &rsqb;</a>
			</div>
		<?php } ?>

	</section>
</footer>

</div><!-- #page-->

<?php wp_footer(); ?>
</body>

</html>