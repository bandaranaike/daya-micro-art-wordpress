<?php

/**
 * Dynamic Inline Styles
 * @package Fifty50
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}


/* RESET CUSTOM STYLES CACHE
 @since 1.0.0
   ==================================================== */
if (!function_exists('reset_inline_style_cache')) :
  function reset_inline_style_cache()
  {
    delete_transient('fifty50_inline_style');
  }
endif;
add_action('customize_save_after', 'reset_inline_style_cache');


/* INLINE STYLE
 @since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_inline_styles')) :
  function fifty50_inline_styles()
  {
    if (is_customize_preview())
      return fifty50_get_inline_style();

    $fifty50_inline_styles = get_transient('fifty50_inline_style');

    if ($fifty50_inline_styles === false) {
      $fifty50_inline_styles = fifty50_get_inline_style();
      set_transient('fifty50_inline_style', $fifty50_inline_styles);
    }

    if (is_singular() && comments_open()) {

      $fifty50_inline_styles .= '
        .comment-list .bypostauthor .fn:after {
          content: "- ' . esc_html__('Author', 'fifty50') . '";
        }';
    }

    return $fifty50_inline_styles;
  }
endif;


/* PRESET INLINE STYLES
 @since 1.0.0
   ====================================================   */
if (!function_exists('fifty50_preset_css')) :
  function fifty50_preset_css()
  {

    $fifty50_presets = get_theme_mod('fifty50_presets');
    if ($fifty50_presets && $fifty50_presets !== 'preset1') {
      echo '<style type="text/css" media="all">
		:root {', fifty50_inline_colour_presets(), '	}
		</style>';
    }
  }
endif;
add_action('wp_head', 'fifty50_preset_css', 12);


/* CUSTOMIZER INLINE STYLES
 @since 1.0.0
   ==================================================== */
if (!function_exists('fifty50_get_inline_style')) :
  function fifty50_get_inline_style()
  {
    $css = '';

    // Site title colour
    $fifty50_site_title_colour = get_theme_mod('fifty50_site_title_colour');

    if ($fifty50_site_title_colour && $fifty50_site_title_colour !== '#ffffff') {
      $css .= '
        #site-title a,
		#site-title a:visited {
          color: ' . $fifty50_site_title_colour . ';
        }';
    }

    // Site tagline colour
    $fifty50_tagline_colour = get_theme_mod('fifty50_tagline_colour');

    if ($fifty50_tagline_colour && $fifty50_tagline_colour !== '#ffffff') {
      $css .= '
        #site-description {
          color: ' . $fifty50_tagline_colour . ';
        }';
    }

    // Sidebar logo width
    $fifty50_sidecolumn_logo_width = absint(get_theme_mod('fifty50_sidecolumn_logo_width'));

    if ($fifty50_sidecolumn_logo_width && $fifty50_sidecolumn_logo_width !== '100') {
      $css .= "
        :root {
          --fifty50-logo-size: {$fifty50_sidecolumn_logo_width}px;
        }";
    }

    // Site title font size
    $site_title_font_size = get_theme_mod('site_title_font_size');

    if ($site_title_font_size && $site_title_font_size !== '5') {
      $css .= '
        :root {
          --fifty50-site-title-size: ' . floatval(esc_attr($site_title_font_size)) . 'rem;
        }';
    }


    // Primary colour
    $fifty50_custom_primary_colour = get_theme_mod('fifty50_custom_primary_colour');

    if ($fifty50_custom_primary_colour && $fifty50_custom_primary_colour !== '#d0b875') {
      $css .= "
	  :root {
		  --fifty50-colour-primary: {$fifty50_custom_primary_colour} !important;
        }";
    }

    // Secondary colour
    $fifty50_custom_secondary_colour = get_theme_mod('fifty50_custom_secondary_colour');

    if ($fifty50_custom_secondary_colour && $fifty50_custom_secondary_colour !== '#7c8963') {
      $css .= "
	  :root {
		  --fifty50-colour-secondary: {$fifty50_custom_secondary_colour} !important;
        }";
    }

    // Tertiary colour
    $fifty50_custom_tertiary_colour = get_theme_mod('fifty50_custom_tertiary_colour');

    if ($fifty50_custom_tertiary_colour && $fifty50_custom_tertiary_colour !== '#85723d') {
      $css .= "
	  :root {
		  --fifty50-colour-tertiary: {$fifty50_custom_tertiary_colour} !important;
        }";
    }


    // Content area colors
    $fifty50_content_bg_colour = get_theme_mod('fifty50_content_bg_colour');

    if ($fifty50_content_bg_colour && $fifty50_content_bg_colour !== '#ffffff') {
      $css .= "
        body, .site-content, 
        .site-footer, 
        .offcanvas, 
        .topnav,
        .offcanvas .nav-menu .sub-menu, 
        .offcanvas .nav-menu .children, 
        .topnav .nav-menu .sub-menu, 
        .topnav .nav-menu .children {
          background-color: {$fifty50_content_bg_colour};
        }
		
		@media (max-width: 991px) {
				.offcanvas .nav-menu, .topnav .nav-menu,
				.offcanvas .nav-menu .sub-menu, .topnav .nav-menu .sub-menu {
					background-color: {$fifty50_content_bg_colour};
				}
			}";
    }

    // Body text colour
    $fifty50_content_area_text_colour = get_theme_mod('fifty50_content_area_text_colour');

    if ($fifty50_content_area_text_colour && $fifty50_content_area_text_colour !== '#646464') {
      $css .= '
        body {
          color: ' . $fifty50_content_area_text_colour . ';
        }';
    }

    // Secondary text colour
    $fifty50_secondary_text_colour = get_theme_mod('fifty50_secondary_text_colour');

    if ($fifty50_secondary_text_colour && $fifty50_secondary_text_colour !== '#7c7c7c') {
      $css .= '
        .tags-list a, 
		.tagcloud a, 
		.post-cats a, 
		.post-meta, 
		.post-date, 
		.comment-meta,
		.post-navigation a > .nav-meta, 
		.wp-caption-text, 
		.entry-caption,
		.entry-meta,
		.entry-meta a,
		.entry-meta a:visited,
		.form-text {
          color: ' . $fifty50_secondary_text_colour . ';
        }';
    }

    // Primary menu link colour
    $fifty50_nav_colour = get_theme_mod('fifty50_nav_colour');

    if ($fifty50_nav_colour && $fifty50_nav_colour !== '#555555') {
      $css .= '
        .offcanvas .nav-menu > li > a, 
		.topnav .nav-menu > li > a, 
		.offcanvas .nav-menu .sub-menu > li > a, 
		.topnav .nav-menu .sub-menu > li > a {
          color: ' . $fifty50_nav_colour . ';
        }';
    }

    // Mobile menu  line separators
    $fifty50_mobile_line_separators = get_theme_mod('fifty50_mobile_line_separators');

    if ($fifty50_mobile_line_separators && $fifty50_mobile_line_separators !== '#000000') {
      $css .= '
        @media (max-width: 991px) {
			.offcanvas .nav-menu, 
			.topnav .nav-menu,
			.offcanvas .nav-menu li, 
			.topnav .nav-menu li, 
			.offcanvas .nav-menu .sub-menu, 
			.topnav .nav-menu .sub-menu {
			  border-color: ' . hex2rgba($fifty50_mobile_line_separators, 0.08, true) . '
			}
						
			.offcanvas .nav-menu a > span::before, 
			.topnav .nav-menu a > span::before {
				background-color: ' . hex2rgba($fifty50_mobile_line_separators, 0.15, true) . '
			}
			
		}';
    }

    // Headings colour
    $fifty50_headings_colour = get_theme_mod('fifty50_headings_colour');

    if ($fifty50_headings_colour && $fifty50_headings_colour !== '#333333') {
      $css .= '
        h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
          color: ' . $fifty50_headings_colour . ';
        }
        h1 a:focus,  h2 a:focus,  h3 a:focus,  h4 a:focus,  h5 a:focus,  h6 a:focus, h1 a:hover,  h2 a:hover,  h3 a:hover,  h4 a:hover,  h5 a:hover, h6 a:hover {
          color: ' . hex2rgba($fifty50_headings_colour, 0.7, true) . '
        }';
    }

    // Heading line colour
    $fifty50_heading_line_color = get_theme_mod('fifty50_heading_line_color');

    if ($fifty50_heading_line_color && $fifty50_heading_line_color !== '#cfcfcf') {
      $css .= '
        .entry-header::after {
          background-color: ' . $fifty50_heading_line_color . ';
        }';
    }


    // Content links
    $fifty50_content_links = get_theme_mod('fifty50_content_links');

    if ($fifty50_content_links && $fifty50_content_links !== '#d0b875') {
      $css .= "
		.page-content a, 
		.entry-summary a, 
		.entry-content a:not(.wp-block-button__link), 
		.author-content a, .comment-content a, 
		.textwidget a, 
		.comment-navigation a, 
		.pingback .comment-body>a, 
		.comment-meta a, 
		.logged-in-as a, 
		.widget_calendar a, 
		.entry-content .wp-block-calendar tfoot a {
          color: {$fifty50_content_links} !important;
        }";
    }

    // Banner caption background
    $fifty50_banner_caption = get_theme_mod('fifty50_banner_caption');

    if ($fifty50_banner_caption && $fifty50_banner_caption !== '#000000') {
      $css .= '
        #banner-sidecolumn .wp-caption-text {
          background-color: ' . hex2rgba($fifty50_banner_caption, 0.7, true) . '
        }';
    }

    // Banner caption text
    $fifty50_banner_caption_text_color = get_theme_mod('fifty50_banner_caption_text_color');

    if ($fifty50_banner_caption_text_color && $fifty50_banner_caption_text_color !== '#ffffff') {
      $css .= "
        #banner-sidecolumn .wp-caption-text {
          color: {$fifty50_banner_caption_text_color};
        }";
    }

    // Pagination background
    $fifty50_pagination_bg = get_theme_mod('fifty50_pagination_bg');

    if ($fifty50_pagination_bg && $fifty50_pagination_bg !== '#f2f2f2') {
      $css .= "
        :root {
          --fifty50-pagination-bg: {$fifty50_pagination_bg};
        }";
    }

    // Pagination numbers
    $fifty50_pagination_numbers = get_theme_mod('fifty50_pagination_numbers');

    if ($fifty50_pagination_numbers && $fifty50_pagination_numbers !== '#333333') {
      $css .= "
        :root {
          --fifty50-pagination-text: {$fifty50_pagination_numbers};
        }";
    }

    // Side Column text colour
    $fifty50_sidecolumn_text_color = get_theme_mod('fifty50_sidecolumn_text_color');

    if ($fifty50_sidecolumn_text_color && $fifty50_sidecolumn_text_color !== '#ffffff') {
      $css .= "
        .sidecolumn, .sidecolumn a {
          color: {$fifty50_sidecolumn_text_color};
        }";
    }

    // Hide banner captions
    $fifty50_hide_banner_captions = get_theme_mod('fifty50_hide_banner_captions');

    if ($fifty50_hide_banner_captions && $fifty50_hide_banner_captions !== false) {
      $css .= "
        #banner-sidebar .wp-caption-text {
          display: none;
        }";
    }

    // Side column height on mobile
    $fifty50_sidecolumn_mobile_height = absint(get_theme_mod('fifty50_sidecolumn_mobile_height'));

    if ($fifty50_sidecolumn_mobile_height && $fifty50_sidecolumn_mobile_height !== '45') {
      $css .= "
        .sidecolumn-inner {
			display: flex;
          min-height: {$fifty50_sidecolumn_mobile_height}vh;
        }";
    }
	
	
    // Side column width
    $fifty50_sidecolumn_width = absint(get_theme_mod('fifty50_sidecolumn_width', '40'));

    if ($fifty50_sidecolumn_width) {
      $css .= sprintf(
        '
        @media (min-width: 992px) { 
          .sidecolumn {
            width: %1$d%%;
          }
          .site-content,
		.site-footer {
            margin-left: %1$d%%;
          }

          .sticky-nav .top-nav {
            left: %1$d%%;
          }
          .rtl .site-content,
			.rtl .site-footer {
            margin-right: %1$d%%;
            margin-left: 0;
          }

          .rtl.sticky-nav .top-nav {
            right: %1$d%%;
            left: 0;
          }
        }',
        $fifty50_sidecolumn_width
      );
    }

    $custom_css = get_theme_mod('fifty50_custom_css');

    if ($custom_css) {
      $css .= wp_filter_nohtml_kses($custom_css);
    }

    return $css;
  }
endif;
