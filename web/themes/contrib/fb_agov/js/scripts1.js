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
  

  $(window).resize(function() {
    var width = $(document).width();
    if (width >= 976) {
     // console.log( $(this).width() );
        $('html').removeClass('mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening');
	$('#off-canvas').removeClass('mm-menu_opened');

    }
   });

 $('.morecontent').hide();
    $('.togglecontent').click(function () {
        // .parent() selects the A tag, .next() selects the P tag
        $(this).parent().next().slideToggle(200);
    });
    $('.morecontent').slideUp(200);

});  

function popitup(url) {
newwindow=window.open(url,'name','height=800,width=1050');
if (window.focus) {newwindow.focus()}
return false;
}

