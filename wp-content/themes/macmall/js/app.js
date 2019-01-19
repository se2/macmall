// JQuery's Document Ready Function
($ => {
  $(document).ready(function() {
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
        }, 500);
      }
    );
  });
})(jQuery);
