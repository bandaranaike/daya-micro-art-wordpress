<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}


/* ADD BODY CLASSES
@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_body_classes')) :
  function fifty50_body_classes($classes)
  {

    $blog_layout = apply_filters('fifty50_blog_layout', get_theme_mod('fifty50_blog_layout', 'center'));


    // Page excerpt class
    if (is_page() && has_excerpt()) {
      $classes[] = 'has-excerpt';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
      $classes[] = 'hfeed';
    }

    if (esc_attr(get_theme_mod('fifty50_sticky_nav', 0))) {
      $classes[] = 'sticky-nav';
    }

    // Blog layout classes
    if ($blog_layout !== 'center' && !is_singular()) {
      $classes[] = $blog_layout . '-blog-layout';
    }

    // Check for post thumbnail
    if (
      is_single() && has_post_thumbnail()
      || is_page() && has_post_thumbnail()
    ) {
      $classes[] = 'has-post-thumbnail';
    } else {
      $classes[] = 'no-post-thumbnail';
    }

    // Check whether we're in the customizer preview
    if (is_customize_preview()) {
      $classes[] = 'customizer-preview';
    }

    return $classes;
  }
endif;
add_filter('body_class', 'fifty50_body_classes');


/* CONVERT HEX to RGBA
@since 1.0.0
   ==================================================== */
if (!function_exists('hex2rgba')) :
  function hex2rgba($color, $opacity = 1, $css = false)
  {
    if (empty($color))
      return;

    $color = str_replace('#', '', $color);

    if (strlen($color) == 6) {
      $r = hexdec($color[0] . $color[1]);
      $g = hexdec($color[2] . $color[3]);
      $b = hexdec($color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
      $r = hexdec($color[0] . $color[0]);
      $g = hexdec($color[1] . $color[1]);
      $b = hexdec($color[2] . $color[2]);
    } else {
      return false;
    }

    $opacity = floatval($opacity);

    if ($css)
      return 'rgba( ' . esc_attr($r) . ', ' . esc_attr($g) . ', ' . esc_attr($b) . ', ' . esc_attr($opacity) . ' )';
    else
      return compact(esc_attr($r), esc_attr($g), esc_attr($b), esc_attr($opacity));
  }
endif;


/* SIDE COLUMN BACKGROUND IMAGE
Set a sidecolumn background image and attributes with the WordPress background function
@since 1.0.0
==================================================== */
if (!function_exists('custom_background_cb')) :
  function custom_background_cb()
  {

    // background is the custom image or the default image
    $background_image_url = set_url_scheme(get_background_image());

    // When using a sidecolumn background colour without an image
    $colour = get_background_color();

    if ($colour === get_theme_support('custom-background', 'default-color')) {
      $colour = false;
    }

    // previewing in the customizer
    if (!$background_image_url && !$colour) {
      if (is_customize_preview()) {
        echo '<style type="text/css" id="custom-background-css"></style>';
      }
      return;
    }

    $style = '';

    if ($colour) {
      $style .= sprintf(
        '
        .sidecolumn {
          background-color: #%s;
        }',
        $colour
      );
    }

    // Background image atrribute default and custom settings
    if ($background_image_url) {

      $position_x = get_theme_mod('background_position_x', get_theme_support('custom-background', 'default-position-x'));
      $position_y = get_theme_mod('background_position_y', get_theme_support('custom-background', 'default-position-y'));

      if (!in_array($position_x, array('left', 'center', 'right'), true)) {
        $position_x = 'left';
      }

      if (!in_array($position_y, array('top', 'center', 'bottom'), true)) {
        $position_y = 'top';
      }

      // Background image size
      $size = get_theme_mod('background_size', get_theme_support('custom-background', 'default-size'));

      if (!in_array($size, array('auto', 'contain', 'cover'), true)) {
        $size = 'auto';
      }

      // Background image repeat
      $repeat = get_theme_mod('background_repeat', get_theme_support('custom-background', 'default-repeat'));

      if (!in_array($repeat, array('repeat-x', 'repeat-y', 'repeat', 'no-repeat'), true)) {
        $repeat = 'repeat';
      }

      // Background attachment scroll
      $attachment = get_theme_mod('background_attachment', get_theme_support('custom-background', 'default-attachment'));

      if ('fixed' !== $attachment) {
        $attachment = 'scroll';
      }

      // Print our styles for the sidecolumn image in the head
      if ($background_image_url) {
        $style .= sprintf(
          '
          .sidecolumn {
            background-image: url( %s );
          }
          .sidecolumn:before {
            display: block;
          }',
          esc_url($background_image_url),

        );
      }

      // Print our sidecolumn background image attributes
      $style .= sprintf(
        '
          .sidecolumn {
            background-position: %s %s;
            background-size: %s;
            background-repeat: %s;
            background-attachment: %s;
          }',
        $position_x,
        $position_y,
        $size,
        $repeat,
        $attachment
      );

      // Add the sidecolumn overlay transparency level to our column
      $fifty50_sidecolumn_overlay = get_theme_mod('fifty50_sidecolumn_overlay', 0.20);

      if (is_numeric($fifty50_sidecolumn_overlay) && $fifty50_sidecolumn_overlay >= 0 && $fifty50_sidecolumn_overlay <= 1) {
        $style .= sprintf(
          '
          .sidecolumn:before {
            opacity: %s;
          }',
          $fifty50_sidecolumn_overlay
        );
      }
    }

    if ($style) {
      printf('<style type="text/css" id="custom-background-css">%s</style>', $style);
    }
  }
endif;


/* MODIFY SEARCH FORM
 @since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_search_form')) :
  function fifty50_search_form($form)
  {
    $form = '
      <form  method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
        <div class="search-wrap input-group">
            <input type="search" class="search-field" placeholder="' . esc_attr_x('Type keywords...', 'placeholder', 'fifty50') . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x('Search for:', '', 'fifty50') . '" />
          <button type="submit" class="button"><i class="bi bi-search"></i></button>
        </div>
			</form>';
    return $form;
  }
endif;
add_filter('get_search_form', 'fifty50_search_form');



/* INSERT FORMATS TO DROP DOWN - CLASSIC EDITOR
 @since 1.0.0
   ==================================================== */
if (!function_exists('insert_formats_to_editor')) :
  function insert_formats_to_editor($init_array)
  {
    // Define the style_formats array
    $style_formats = array(
      // Each array child is a format with it's own settings

      array(
        'title' => esc_html__('Extra Small', 'fifty50'),
        'inline' => 'span',
        'classes' => 'extra-small-text',
        'wrapper' => true
      ),

      array(
        'title' => esc_html__('Small', 'fifty50'),
        'inline' => 'span',
        'classes' => 'small-text',
        'wrapper' => true
      ),
      array(
        'title' => esc_html__('Medium', 'fifty50'),
        'inline' => 'span',
        'classes' => 'medium-text',
        'wrapper' => true
      ),

      array(
        'title' => esc_html__('Large', 'fifty50'),
        'inline' => 'span',
        'classes' => 'large-text',
        'wrapper' => true
      ),
      array(
        'title' => esc_html__('Extra Large', 'fifty50'),
        'inline' => 'span',
        'classes' => 'extra-large-text',
        'wrapper' => true
      ),
      array(
        'title' => esc_html__('Huge', 'fifty50'),
        'inline' => 'span',
        'classes' => 'huge-text',
        'wrapper' => true
      ),
      array(
        'title' => esc_html__('Gigantic', 'fifty50'),
        'block' => 'div',
        'classes' => 'gigantic-text',
        'wrapper' => true
      )
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;
  }
endif;
add_filter('tiny_mce_before_init', 'insert_formats_to_editor');


/* ADD STYLE DROP DOWN TO CLASSIC EDITOR
 @since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_mce_buttons_2')) :
  function fifty50_mce_buttons_2($buttons)
  {
    array_unshift($buttons, 'styleselect');
    return $buttons;
  }
endif;
add_filter('mce_buttons_2', 'fifty50_mce_buttons_2');


/* ARCHIVE TITLE PREFIX
	Styles the archive title prefix with a span
	@since 1.0.0
   ==================================================== */
function fifty50_prefix_archive_title($title)
{

  $regex = apply_filters(
    'fifty50_prefix_the_archive_title_regex',
    array(
      'pattern'     => '/(\A[^\:]+\:)/',
      'replacement' => '<span class="archive-prefix colour">$1</span>',
    )
  );

  if (empty($regex)) {
    return $title;
  }
  return preg_replace($regex['pattern'], $regex['replacement'], $title);
}

add_filter('get_the_archive_title', 'fifty50_prefix_archive_title');

/* ARCHIVE TITLES
	Change how archive titles are displayed
	@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_archive_title')) :
  function fifty50_archive_title($title)
  {

    $archive_prefix = esc_attr(get_theme_mod('fifty50_hide_prefix_archive', 0));

    // If enabled - the prefix archive label is hidden
    if ($archive_prefix) {
      if (is_category()) {
        return single_cat_title('', false);
      } elseif (is_author()) {
        return get_the_author();
      }
    }
    return $title;
  }
endif;
add_filter('get_the_archive_title', 'fifty50_archive_title', 10, 1);



/* MODIFY the COMMENT FORM
 @since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_comment_form_default_fields')) :
  function fifty50_comment_form_default_fields($fields)
  {
    $commenter = wp_get_current_commenter();

    $req      = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    $html_req = ($req ? " required='required'" : '');
    $html5    = 'html5';

    $fields['author'] = '
      <p class="comment-form-author">
        <input id="author" name="author" type="text" placeholder="' . esc_attr__('Name', 'fifty50') . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . $html_req . ' />
      </p>';

    $fields['email'] = '
      <p class="comment-form-email">
        <input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' placeholder="' . esc_attr__('Email', 'fifty50') . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />
      </p>';

    $fields['url'] = '
      <p class="comment-form-url">
        <input id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' placeholder="' . esc_attr__('Website', 'fifty50') . '" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />
      </p>';

    return $fields;
  }
endif;
add_filter('comment_form_default_fields', 'fifty50_comment_form_default_fields', 10, 1);



/* ADD A TITLE TO POSTS MISSING TITLES
	When a post is missing a title, a default title will be used.
	@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_post_title')) {
  function fifty50_post_title($title)
  {
    return '' === $title ? esc_html_x('Untitled', 'Added to posts and pages that are missing titles', 'fifty50') : $title;
  }
}

add_filter('the_title', 'fifty50_post_title');



/* FILTER THE EXCERPT LENGTH
	Customizable excerpt length
	@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_excerpt_length')) {
  function fifty50_excerpt_length($length)
  {

    if (is_admin()) {
      return $length;
    }

    $excerpt_length = esc_attr(get_theme_mod('fifty50_excerpt_length', '25'));
    return $excerpt_length;
  }
}
add_filter('excerpt_length', 'fifty50_excerpt_length', 99);



/* FILTER THE EXCERPT SUFFIX
	Replaces the default [...] with a &hellip; (three dots)
	@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_excerpt_more')) :
  function fifty50_excerpt_more()
  {
    return '&hellip;';
  }
  add_filter('excerpt_more', 'fifty50_excerpt_more');
endif;


/* CREATE A CONTINUE READING LINK FOR EXCERPTS
@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_read_more_link')) :
  function fifty50_read_more_link()
  {
    $fifty50_readmore_text = esc_html(get_theme_mod('fifty50_readmore_text', esc_html__('Continue Reading...', 'fifty50')));
    echo '<p class="more-link-wrapper"><a class="more-link" href="' . esc_url(get_permalink()) . '">' . wp_kses_post($fifty50_readmore_text) . '</a></p>';
  }
endif;


/* MOVE READ MORE LINK OUTSIDE OF PARAGRAPHS
	Move the 'continue reading' link outside of paragraph.
	@since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_move_more_link')) :
  function fifty50_move_more_link()
  {
    $fifty50_readmore_text = esc_html(get_theme_mod('fifty50_readmore_text', esc_html__('Continue Reading...', 'fifty50')));
    return '<p><a class="more-link" href="' . esc_url(get_permalink()) . '">' . wp_kses_post($fifty50_readmore_text) . '</a></p>';
  }
  add_filter('the_content_more_link', 'fifty50_move_more_link');
endif;



/* INLINE COLOUR PRESETS
   ====================================================*/
if (!function_exists('fifty50_inline_colour_presets')) :
  function fifty50_inline_colour_presets()
  {

    $fifty50_presets = get_theme_mod('fifty50_presets', 'preset1');
    switch (esc_attr($fifty50_presets)) {

      case "preset10":
        echo '--fifty50-colour-primary: #b1b7ac;
						--fifty50-colour-secondary: #694f6b;
						--fifty50-colour-tertiary: #626b5a;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset9":
        echo '--fifty50-colour-primary: #a6a574;
						--fifty50-colour-secondary: #a66363;
						--fifty50-colour-tertiary: #314a59;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset8":
        echo '--fifty50-colour-primary: #63a69b;
						--fifty50-colour-secondary: #a77764;
						--fifty50-colour-tertiary: #245950;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset7":
        echo '--fifty50-colour-primary: #8aa764;
						--fifty50-colour-secondary: #a66353;
						--fifty50-colour-tertiary: #593931;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset6":
        echo '--fifty50-colour-primary: #bd9898;
						--fifty50-colour-secondary: #546570;
						--fifty50-colour-tertiary: #704f4f;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset5":
        echo '--fifty50-colour-primary: #b5a684;
						--fifty50-colour-secondary: #374769;
						--fifty50-colour-tertiary: #695d42;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset4":
        echo '--fifty50-colour-primary: #829bb1;
						--fifty50-colour-secondary: #b09e80;
						--fifty50-colour-tertiary: #3f5263;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset3":
        echo '--fifty50-colour-primary: #c7ac3f;
						--fifty50-colour-secondary: #473e17;
						--fifty50-colour-tertiary: #d0c081;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      case "preset2":
        echo '--fifty50-colour-primary: #6d9999;
						--fifty50-colour-secondary: #997d6d;
						--fifty50-colour-tertiary: #2f4d4d;	
						--fifty50-colour-body-bg: #ffffff;';
        break;

      default:
        echo '--fifty50-colour-primary: #d0b875;
						--fifty50-colour-secondary: #7c8963;
						--fifty50-colour-tertiary: #85723d;
						--fifty50-colour-body-bg: #f9f8f6;';
    }
  }
endif;
