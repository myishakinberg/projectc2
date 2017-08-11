
(function ($) {
    Drupal.behaviors.tsODFW = {
        attach: function (context, settings) {


                mobileMenu: function () {
                    if ($(window).width() < 768) {
                        $('.mobile-menu').once().click(function (event) {
                            $(this).parents('.main--menu').toggleClass('mobile-menu-active');
                        });
                    }
                }

            init: function() {
                this.mobileMenu();
            }

} // attach
};
})(jQuery, Drupal, window);