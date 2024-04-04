<?php

/**
 * The page content template
 * This is the template that displays page content.
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
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<?php if (has_excerpt() && !is_archive() && !is_search() && !is_404()) : ?>
				<div id="page-excerpt">
					<?php the_excerpt();  ?>
				</div>
			<?php endif; ?>
		</header>

		<?php fifty50_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();
			fifty50_multipage_pagination();
			?>
		</div><!-- .entry-content -->

		<?php
		if (!esc_attr(get_theme_mod('fifty50_hide_edit', 0))) {
			edit_post_link(esc_html('Edit This Page', 'fifty50'), '<p class="post-edit_post_link"><i class="bi bi-pencil-square"></i>', '</p>');
		}
		?>
	</div>
</article><!-- #post-## -->