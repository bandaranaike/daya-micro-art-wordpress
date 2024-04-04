<?php

/**
 * The template for the bottom sidebar group
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// If no active sidebars - then load nothing
if (
	!is_active_sidebar('bottom1')
	&& !is_active_sidebar('bottom2')
)
	return;
?>

<aside id="bottom-sidebar" class="widget-area content-outer">
	<div class="content-inner">
		<div class="row">

			<?php if (is_active_sidebar('bottom1')) : ?>
				<div id="bottom1" <?php fifty50_bottom_group(); ?>>
					<?php dynamic_sidebar('bottom1'); ?>
				</div>
			<?php endif; ?>

			<?php if (is_active_sidebar('bottom2')) : ?>
				<div id="bottom2" <?php fifty50_bottom_group(); ?>>
					<?php dynamic_sidebar('bottom2'); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</aside>