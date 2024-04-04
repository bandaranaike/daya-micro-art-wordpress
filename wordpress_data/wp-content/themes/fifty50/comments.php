<?php

/**
 * Comments template file
 * The template for displaying Comments
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Check if a password is required to continue
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area content-outer">
	<div class="content-inner">
		<?php if (have_comments()) : ?>

			<h3 class="comments-title section-title">
				<?php printf(_nx('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'fifty50'), number_format_i18n(get_comments_number()), get_the_title()); ?>
			</h3>

			<ol class="comment-list">
				<?php
				wp_list_comments(array(
					'walker' => new Fifty50_Comment_Walker(),
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 100,
				));
				?>
			</ol><!-- .comment-list -->

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<nav id="comment-nav-below" class="comment-navigation" role="navigation">
					<div class="nav-links">
						<div class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'fifty50')); ?></div>
						<div class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'fifty50')); ?></div>
					</div>
				</nav><!-- #comment-nav-below -->
			<?php endif; // Check for comment navigation. 
			?>

			<?php if (!comments_open()) : ?>
				<p class="no-comments"><?php esc_html_e('Comments are closed.', 'fifty50'); ?></p>
			<?php endif; ?>

		<?php endif; // have_comments() 
		?>

		<?php
		comment_form(array(
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Comment', 'fifty50') . '" aria-required="true"></textarea></p>',
			'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title section-title">'
		));
		?>
	</div>
</div><!-- #comments -->