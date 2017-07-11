jQuery(document).ready(function($) {
  if ($(".smooth-scroll").length>0) {
    $(window).load(function() {
      $(".smooth-scroll a, a.smooth-scroll").click(function() {
        if (location.pathname.replace(/^\//,"") == this.pathname.replace(/^\//,"") && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $("[name=" + this.hash.slice(1) +"]");
          if (target.length) {
            $("html,body").animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
  }
});
;
jQuery(document).ready(function($) {
  $(".to-top").click(function() {
    $("body,html").animate({scrollTop:0},800);
  });
});
;
