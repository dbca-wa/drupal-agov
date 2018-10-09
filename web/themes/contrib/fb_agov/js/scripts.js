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
  
// External links
   $('a[rel="external"]')
	.click( function() {
	window.open( $(this).attr('href') );
	return false;
   });

});  

function popitup(url) {
newwindow=window.open(url,'name','height=800,width=1050');
if (window.focus) {newwindow.focus()}
return false;
}



