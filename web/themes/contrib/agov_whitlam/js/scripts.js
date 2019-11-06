jQuery(document).ready(function ($) {

  // Footer scroll to top function
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.skip-link--top').fadeIn();
    } else {
      $('.skip-link--top').fadeOut();
    }
  });

  $('.skip-link--top').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 100);
      return false;
  });


// Smooth scroll 
$('a[href^="#"]').bind('click.smoothscroll',function (e) {
    e.preventDefault();
    var target = this.hash,
        $target = $(target);

    $('html, body').stop().animate( {
      'scrollTop': $target.offset().top-50
    }, 900, 'swing', function () {
      window.location.hash = target;
    } );
  } );


});  

