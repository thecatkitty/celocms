/*-----------------------------------------------------------------------------------
/*
/* Main JS
/*
-----------------------------------------------------------------------------------*/  

(function($) {

  /*---------------------------------------------------- */
  /* Preloader
  ------------------------------------------------------ */ 
  $(window).load(function() {

   	// will first fade out the loading animation 
    $("#status").fadeOut("slow"); 

    // will fade out the whole DIV that covers the website. 
    $("#preloader").delay(500).fadeOut("slow").remove();

      
    $('#hero .hero-image img').addClass("animated fadeInUpBig"); 
  }) 

  /*----------------------------------------------------*/
  /* Smooth Scrolling
  ------------------------------------------------------ */
  $('.smoothscroll').on('click', function (e) {
 	
    e.preventDefault();

    var target = this.hash,
        $target = $(target);

    $('html, body').stop().animate({
      'scrollTop': $target.offset().top - 100
    }, 800, 'swing', function () {
      //window.location.hash = target;
    });
  });


  /*----------------------------------------------------*/
  /* Highlight the current section in the navigation bar
  ------------------------------------------------------*/
  var sections = $("section"),
      navigation_links = $("#pagenavbar a");

  sections.waypoint({

    handler: function(event, direction) {

      var active_section;

      active_section = $(this);
      if (direction === "up") active_section = active_section.prev();

      var active_link = $('#pagenavbar a[href="#' + active_section.attr("id") + '"]');

      navigation_links.parent().removeClass("current");
      active_link.parent().addClass("current");

    },
    offset: '35%'
  });


})(jQuery);