<?php

/**
 * Comment Walker
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Fifty50_Comment_Walker extends Walker_Comment
{

  protected function html5_comment($comment, $depth, $args)
  {
?>
    <li id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : ''); ?>>
      <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <?php
        if (0 != $args['avatar_size'] && get_option('show_avatars'))
          printf('<div class="comment-avatar">%s</div>', get_avatar($comment, $args['avatar_size']));
        ?>
        <div class="entry-comment">
          <header class="comment-header">
            <?php
            printf('<div class="comment-author vcard">%s <span class="says screen-reader-text">%s</span></div>', sprintf('<b class="fn">%s</b>', get_comment_author_link()), esc_html__('says:', 'fifty50'));

            if ('0' == $comment->comment_approved) : ?>
              <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'fifty50'); ?></p>
            <?php endif; ?>
          </header><!-- .comment-header -->

          <footer class="comment-footer">
            <div class="comment-metadata">
              <time class="comment-meta" datetime="<?php comment_time('c'); ?>"><?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'fifty50'), get_comment_date(), get_comment_time()); ?></time>
              <?php edit_comment_link(esc_html__('Edit', 'fifty50'), '<span class="edit-link comment-meta">', '</span>'); ?>
            </div><!-- .comment-metadata -->
            <?php
            comment_reply_link(array_merge($args, array(
              'add_below' => 'div-comment',
              'depth'     => $depth,
              'max_depth' => $args['max_depth'],
              'before'    => '<div class="reply">',
              'after'     => '</div>'
            )));
            ?>
          </footer>

          <div class="comment-content">
            <?php comment_text(); ?>
          </div><!-- .comment-content -->


        </div>
      </article><!-- .comment-body -->
  <?php
  }
}
