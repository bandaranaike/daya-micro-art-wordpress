/**
 * Live-update changed settings in real time in the Customizer preview.
 * @package Fifty50
 * @since 1.0.0
 */

(function($) {
  var api = wp.customize,
    $head = $("head");

  /* HEX to RGBA functions
  ==================================================== */

  function hexToRgba(hex, opacity) {
    var red = parseInt(hex.substring(1, 3), 16),
      green = parseInt(hex.substring(3, 5), 16),
      blue = parseInt(hex.substring(5, 7), 16);

    return "rgba( " + red + ", " + green + ", " + blue + ", " + opacity + " )";
  }

  /* SHOW AND HIDE functions
  ==================================================== */
  function hideElement(element) {
    $(element).css({
      clip: "rect(1px, 1px, 1px, 1px)",
      position: "absolute",
      width: "1px",
      height: "1px",
      overflow: "hidden"
    });
  }

  function showElement(element) {
    $(element).css({
      clip: "auto",
      position: "relative",
      width: "auto",
      height: "auto",
      overflow: "visible"
    });
  }

  /* TEXT PREVIEWS
  ==================================================== */

  // Blog Title
  api("blogname", function(value) {
    value.bind(function(to) {
      $(".site-title a").text(to);
    });
  });

  // Tagline
  api("tagline", function(value) {
    value.bind(function(to) {
      $(".tagline").html(to);
    });
  });

  // Copyright
  api("fifty50_copyright", function(value) {
    value.bind(function(newval) {
      $("#copyright-name").html(newval);
    });
  });

  /* TRANSPARENCY
  ==================================================== */

  // Side Column overlay
  api("fifty50_sidecolumn_overlay", function(value) {
    value.bind(function(to) {
      var style = $("#custom-sidecolumn-overlay-css"),
        css = "opacity: " + parseFloat(to);

      style.remove();
      style = $(
        '<style type="text/css" id="custom-sidecolumn-overlay-css">.sidecolumn:before { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  /* SIZING
  ==================================================== */

  // Logo size
  api("fifty50_sidecolumn_logo_width", function(value) {
    value.bind(function(to) {
      $("#site-branding img.custom-logo").css(
        "max-width",
        parseFloat(to) + "px"
      );
    });
  });

  // Site title size
  api("site_title_font_size", function(value) {
    value.bind(function(to) {
      $("#site-title").css("font-size", parseFloat(to) + "rem");
    });
  });

  // Side column height on mobile
  api("fifty50_sidecolumn_mobile_height", function(value) {
    value.bind(function(to) {
      $(".sidecolumn-inner").css(
        "min-height",
        parseFloat(to) + "vh"
      );
    });
  });
  
  // sidecolumn size
  api("fifty50_sidecolumn_width", function(value) {
    value.bind(function(to) {
      var style = $("#custom-sidecolumn-width-css"),
        css = "width: " + parseFloat(to);

      style.remove();
      style = $(
        '<style type="text/css" id="custom-sidecolumn-width-css">@media (min-width: 992px) { .sidecolumn { ' +
          css +
          "%} }</style>"
      ).appendTo($head);
    });
  });

  /* COLOUR
  ==================================================== */

  // Site title colour
  api("fifty50_site_title_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-site-title-color-css"),
        css = "color: " + to;

      style.remove();
      style = $(
        '<style type="text/css" id="custom-site-title-color-css"> #site-title a { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Site tagline colour
  api("fifty50_tagline_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-tagline-color-css"),
        css = "color: " + to;

      style.remove();
      style = $(
        '<style type="text/css" id="custom-tagline-color-css"> #site-description { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Side column Colors
  api("fifty50_sidecolumn_text_color", function(value) {
    value.bind(function(to) {
      var style = $("#custom-sidecolumn-text-colour-css"),
        css = "color: " + to;

      style.remove();
      style = $(
        '<style type="text/css" id="custom-sidecolumn-text-colour-css"> .sidecolumn, .sidecolumn a { ' +
          css +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Content background
  api("fifty50_content_bg_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-area-background-color-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-area-background-color-css"> body, .site-content, .site-footer, .offcanvas-navigation, .topnav { background-color:' +
          to +
          " }</style>"
      ).appendTo($head);
    });
  });

  // Body text colour
  api("fifty50_content_area_text_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-area-text-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-area-text-colour-css">body { color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Secondary text colour
  api("fifty50_secondary_text_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-secondary-text-color-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-secondary-text-color-css"> .post-tags a, .tagcloud a, .post-cats a, .post-meta, .post-date, .comment-meta, .post-navigation a > .nav-meta, .wp-caption-text, .entry-caption, .form-text { color:' +
          to +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Headings colour
  api("fifty50_headings_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-headings-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-headings-colour-css">h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color:' +
          to +
          " } h1 a:focus,  h2 a:focus,  h3 a:focus,  h4 a:focus,  h5 a:focus,  h6 a:focus, h1 a:hover,  h2 a:hover,  h3 a:hover,  h4 a:hover,  h5 a:hover, h6 a:hover { color:" +
          hexToRgba(to, 0.7) +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Headings line colour
  api("fifty50_heading_line_color", function(value) {
    value.bind(function(to) {
      var style = $("#custom-headings-line-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-headings-line-colour-css"> .entry-header::after { background-color:' +
          to +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Primary menu link colour
  api("fifty50_nav_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-nav-link-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-nav-link-colour-css">.offcanvas-navigation .nav-menu > li > a, .topnav .nav-menu > li > a, .offcanvas-navigation .nav-menu .sub-menu > li > a, .topnav .nav-menu .sub-menu > li > a { color:' +
          to +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Mobile menu line separators
  api("fifty50_mobile_line_separators", function(value) {
    value.bind(function(to) {
      var style = $("#custom-mobile-menu-separators-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-mobile-menu-separators-css">@media (max-width: 991px) { .offcanvas-navigation .nav-menu, .topnav .nav-menu, .offcanvas-navigation .nav-menu li, .topnav .nav-menu li, .offcanvas-navigation .nav-menu .sub-menu, .topnav .nav-menu .sub-menu { border-color:' +
          hexToRgba(to, 0.08) +
          " } .offcanvas-navigation .nav-menu a > span::before, .topnav .nav-menu a > span::before { background-color:" +
          hexToRgba(to, 0.15) +
          " }}  </style>"
      ).appendTo($head);
    });
  });

  // Content links
  api("fifty50_content_links", function(value) {
    value.bind(function(to) {
      var style = $("#custom-content-links-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-content-links-colour-css"> .entry-meta a, .page-content a, .entry-summary a, .entry-content a:not(.wp-block-button__link), .author-content a, .comment-content a, .textwidget a, .comment-navigation a, .pingback .comment-body>a, .comment-meta a, .logged-in-as a, .widget_calendar a, .entry-content .wp-block-calendar tfoot a { color:' +
          to +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Banner caption colour
  api("fifty50_banner_caption", function(value) {
    value.bind(function(to) {
      var style = $("#custom-banner-caption-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-banner-caption-colour-css">#banner-sidebar .wp-caption-text { background-color:' +
          hexToRgba(to, 0.7) +
          " }  </style>"
      ).appendTo($head);
    });
  });

  // Banner caption text colour
  api("fifty50_banner_caption_text_color", function(value) {
    value.bind(function(to) {
      var style = $("#custom-banner-caption-text-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-banner-caption-text-colour-css"> #banner-sidebar .wp-caption-text { color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Primary Colour
  api("fifty50_custom_primary_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-primary-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-primary-colour-css"> :root { --fifty50-colour-primary:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Secondary Colour
  api("fifty50_custom_secondary_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-secondary-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-secondary-colour-css"> :root { --fifty50-colour-secondary:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Tertiary Colour
  api("fifty50_custom_tertiary_colour", function(value) {
    value.bind(function(to) {
      var style = $("#custom-tertiary-colour-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-tertiary-colour-css"> :root { --fifty50-colour-tertiary:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Pagination background
  api("fifty50_pagination_bg", function(value) {
    value.bind(function(to) {
      var style = $("#custom-pagination-background-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-pagination-background-css"> .page-numbers { background-color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  // Pagination numbers
  api("fifty50_pagination_numbers", function(value) {
    value.bind(function(to) {
      var style = $("#custom-pagination-numbers-css");

      style.remove();
      style = $(
        '<style type="text/css" id="custom-pagination-numbers-css"> .page-numbers { color:' +
          to +
          " } </style>"
      ).appendTo($head);
    });
  });

  /* SHOW or HIDE
 ======================= */

  // Hide site title
  wp.customize("fifty50_show_site_title", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        hideElement("#site-title");
      } else {
        showElement("#site-title");
      }
    });
  });

  // Hide site description
  wp.customize("fifty50_show_site_desc", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        hideElement("#site-description");
      } else {
        showElement("#site-description");
      }
    });
  });

  // Hide archiver prefix
  wp.customize("fifty50_hide_prefix_archive", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement(".archive-prefix");
      } else {
        hideElement(".archive-prefix");
      }
    });
  });

  // Hide banner captions
  wp.customize("fifty50_hide_banner_captions", function(value) {
    value.bind(function(newval) {
      if (false === newval) {
        showElement("#banner-sidebar .wp-caption-text");
      } else {
        hideElement("#banner-sidebar .wp-caption-text");
      }
    });
  });
})(jQuery);
