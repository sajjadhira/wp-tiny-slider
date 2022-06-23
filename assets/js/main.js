(function ($) {
  $(document).ready(function () {
    var slider = tns({
      container: ".wpts-slider",
      speed: 300,
      autoplayTimeout: 3000,
      items: 1,
      autoplay: true,
      autoHeight: false,
      controls: false,
      nav: false,
      autoplayButtonOutput: false,
    });
  });
})(jQuery);
