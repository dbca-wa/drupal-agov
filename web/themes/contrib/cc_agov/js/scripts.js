jQuery(document).ready(function ($) {

  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

   $('#search-block-form input').on('focusin', function () {
          $(this).parents('form').addClass('active');
        });
        $('#search-block-form input').on('focusout', function () {
          $(this).parents('form').removeClass('active');
   });



  $('.scroll-to-top').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 100);
      return false;
  });
  

});  


