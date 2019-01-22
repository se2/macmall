// JQuery's Document Ready Function
($ => {
  $(document).ready(function() {
    // Mobile hamburger
    $(".hamburger").click(function() {
      $(this).toggleClass("is-active");
      $("body").toggleClass("overflow-hidden");
      $(".mobile-dropdown").toggleClass("is-active");
    });
    // Mobile sub-menu actions
    $(".mobile-navigation .menu-item-has-children>a").click(function(e) {
      e.preventDefault();
      $(this)
        .parent(".menu-item")
        .toggleClass("is-active");
      $(this)
        .parent(".menu-item")
        .siblings()
        .toggle();
      $(this)
        .parent(".menu-item")
        .find(".sub-menu")
        .toggle();
    });
    // Add mega-menu active class if enable
    $("ul.menu li.menu-item a").hover(
      function() {
        if ($(this).data("mega")) {
          var menuID = $(this).data("mega");
          $(".js-mega-menu").removeClass("js-active");
          $(".mega-menu-" + menuID).addClass("js-active");
        } else {
          $(".js-mega-menu").removeClass("js-active");
        }
      },
      function() {}
    );
    // Remove mega-menu active class when hovering out of .site-header
    $(".site-header").hover(
      function() {},
      function() {
        setTimeout(function() {
          $(".js-mega-menu").removeClass("js-active");
        }, 300);
      }
    );
    // Search toggle icon
    $(".search-toggle").click(function(e) {
      e.preventDefault();
      $(this)
        .find("img")
        .toggleClass("hidden");
      $(".search-form").toggleClass("no-show");
      $(".search-form input[type=search]").focus();
      $(".main-navigation").toggleClass("no-show");
    });
  });
})(jQuery);
