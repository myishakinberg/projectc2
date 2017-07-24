jQuery(document).ready(function($) {
  $(window).load(function() {
    $(".field--name-field-image a.image-popup").magnificPopup({
      type:"image",
      removalDelay: 300,
      mainClass: "mfp-fade",
      gallery: {
        enabled: true, // set to true to enable gallery
      },
      image: {
        titleSrc: function(item) {
          return item.el.closest('.overlay-container').children()[1].title || '';
        }
      }
    });
    //  alert("working");

      $(".field--name-field-blogs iframe").each(function(){
              var src = $(this).attr("src");
          $("<a class='my-links' href='" + src + "'>Links</a>").insertBefore($(this));
          });
      $(".my-links").magnificPopup({
          type:"iframe"

      });

          $(".field--name-field-blogs iframe").magnificPopup({
            type:"iframe",
            src:$(this).attr("src")

        });
    });
});