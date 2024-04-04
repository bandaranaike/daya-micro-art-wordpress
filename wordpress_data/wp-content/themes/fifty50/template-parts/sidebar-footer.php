<?php

/**
 * The template for displaying the footer sidebar
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!is_active_sidebar('footer'))
	return;
// If we get this far, we have widgets. Let do this.
?>


<aside id="footer-sidebar" class="widget-area">
	<div class="row">
		<div class="col">

			<?php dynamic_sidebar('footer'); ?>

		</div>
	</div>
</aside>