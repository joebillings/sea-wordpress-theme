(function ($) {
  wp.customize("blogname", function (value) {
    value.bind(function (newval) {
      $(".logo-container h1 a").html(newval);
      $(".copyright .name").html(newval);
    });
  });

  wp.customize("blogdescription", function (value) {
    value.bind(function (newval) {
      $(".logo-container .tagline").html(newval);
    });
  });

  wp.customize("brand_height", function (value) {
    value.bind(function (newval) {
      $(".nav-brand-image").css("height", newval + "px");
    });
  });

  wp.customize("display_brand_image_only", function (value) {
    value.bind(function (newval) {
      if (newval && wp.customize("nav_brand_image").get()) {
        $(".site-name").addClass("hide-text");
      } else {
        $(".site-name").removeClass("hide-text");
      }
    });
  });

  wp.customize("background_color", function (value) {
    value.bind(function (newval) {
      $("body").css("background-color", newval);
    });
  });
  
  wp.customize("footer_color", function (value) {
    value.bind(function (newval) {
      $(".site-footer").css("background-color", newval);
    });
  });
  
  wp.customize("footer_content_color", function (value) {
    value.bind(function (newval) {
      $(".site-footer").find("a, .socials i, .site-footer-inner").css("color", newval);
    });
  });
  
  wp.customize("accent_color", function (value) {
    value.bind(function (newval) {
      $(".accent-color").css("background-color", newval);
    });
  });

  wp.customize("heading_color", function (value) {
    value.bind(function (newval) {
      $("h1, h2, h3, h4, h5, h6").css("color", newval);
    });
  });

  wp.customize("text_color", function (value) {
    value.bind(function (newval) {
      $("body").css("color", newval);
    });
  });

  wp.customize("link_color", function (value) {
    value.bind(function (newval) {
      $("a").css("color", newval);
    });
  });

})(jQuery);
