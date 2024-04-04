/**
 * Theme scripts
 * @package Fifty50
 * @since 1.0.0
 */

(function($) {
  "use strict";

  $(document).ready(function($) {
    var $body = $("body");

    // Padding adjustments with the sticky nav active for either menu
    if ($body.hasClass("sticky-nav") && $("#topnav").length) {
      $(".site-content").css("padding-top", $("#topnav").outerHeight());
    }

    $(window).resize(function() {
      if ($body.hasClass("sticky-nav") && $("#topnav").length) {
        $(".site-content").css("padding-top", $("#topnav").outerHeight());
      }
    });

    // Top Navigation
    $("#topnav-toggle").on("click", function(e) {
      e.preventDefault();
      var $btn = $(this),
        $btnSpan = $(".topnav-toggle-text");

      $btn.parent().next().slideToggle(500);

      if ($btnSpan.text() == $btn.attr("data-close-text")) {
        $btnSpan.text($btn.attr("title"));
      } else {
        $btnSpan.text($btn.attr("data-close-text"));
      }
    });

    // Smooth scroll to top
    $("#back-to-top").click(function() {
      $("html, body").scrollTop(0);
      return false;
    });
  });
})(jQuery);
