jQuery(document).ready(function ($) {


 // $("#mm-1 .mm-navbar").append("<a href='#' class='mm-navbar__closer' style=''>Menu</a>");

  // Footer scroll to top function
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  $('.scroll-to-top').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 100);
      return false;
  });

  // Focus on top search
   $('#search-block-form input').on('focusin', function () {
          $(this).parents('form').addClass('active');
        });
        $('#search-block-form input').on('focusout', function () {
          $(this).parents('form').removeClass('active');
   });

  // Display Author read more
  $('#showAuthor').click(function () {
  $('#AuthorInfo').toggle();
   return false;
  });


  // Side menu
  $('.mm-navbar .mm-navbar__closer').click(function () {
    e.preventDefault();
    $('html').removeClass('mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening');
    $('#off-canvas').removeClass('mm-menu_opened');
  }); 

  $(window).resize(function() {
    var width = $(document).width();
    if (width >= 976) {
     // console.log( $(this).width() );
        $('html').removeClass('mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening');
	$('#off-canvas').removeClass('mm-menu_opened');

    }
   });

  // Prevent submission of blank search
/*
$('.header_search form').submit(function () {
    // Get the Login Name value and trim it
    var searchWord = $.trim($('input.form-search').val());
    // Check if empty of not
    if (searchWord === '') {
        return false;
    }
});
*/


/* Table of contents */
var ToC =
    "<h2>On this page:</h2>" +
    "<ul>";

var newLine, el, title, link;
$(".accordionList h1").each(function() {
  el = $(this);
  title = el.text();
  link = "#" + el.attr("id");
  newLine =
    "<li>" +
      "<a href='" + link + "'>" +
        title +
      "</a>" +
    "</li>";
  ToC += newLine;
});
ToC +=
   "</ul>";
$(".tableofcontents").prepend(ToC);


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

  //Legacy opening URL's
function popitup(url) {
    newwindow = window.open(url, 'name', 'height=800,width=1050');
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}