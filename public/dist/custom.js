$(document).ready(function(){

  // display perfect height for .titre-block and load Carousel
  // @page Welcome
  //*****************

  $(window).load(function(){

    var logoHeight = $('.logo-block').height();
    var titreHeight = $('.titre-block').height();
    if (titreHeight < logoHeight) {
      $('.titre-block').height(logoHeight);
    }
    else{
      $('.logo-block').height(titreHeight);
    }

    $('.carousel').carousel({
      interval: 4000
    });
  });

  // Add padding if worknav open
  if ($('#work-links').hasClass('active')) {
    var height = $('#work-links').height();
      $('#sidebar_left').css('padding-top', height + 61);
      $('#content').css('padding-top', height);
  }

  //Mobile Nav
  //************************

  // Show and hidfe the mobile navigation
  if ($('#btn-menu').hasClass('closed')) {
    $('#btn-menu').click(function(){
      $('#btn-menu i.fa').toggleClass('fa-bars').toggleClass('fa-times');
      $('.navbar .nav').slideToggle();
    });
  }
  if ($('.nav.navbar-nav.navbar-right').css("display") === "none") {
    $('#btn-menu').click(function(){
    });
  }

  $('.admin-mobile-access').click(function(){
    if ($('.sidebar.left').css('left') === "-150px") {
      $('.sidebar.left').css('left', 0);
      $('.admin-mobile-access .fa').removeClass('fa-arrow-right').addClass('fa-arrow-left');
    }
    else if($('.sidebar.left').css('left') === "0px"){
      $('.sidebar.left').css('left', "-150px");
      $('.admin-mobile-access .fa').removeClass('fa-arrow-left').addClass('fa-arrow-right');
    }
    console.log($('.sidebar.left').css('left'));
  });

  //Side Nav accordion
  //*********************
  $(".accordion-toggle").click(function(){
    if (!$(this).hasClass('menu-open')){
      $(".accordion-toggle.menu-open").removeClass('menu-open');
    $(this).addClass('menu-open');
    }
  });

  // Magnific-Popup initialisation and customisation
  //****************
  if ($('.popup-gallery').length > 0) {
    $('.popup-gallery').magnificPopup({
      delegate: 'a',
      type: 'image',
      tLoading: 'Loading image #%curr%...',
      mainClass: 'mfp-img-mobile',
      fixedContentPos: true,
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1], // Will preload 0 - before current, and 1 after the current image
        tCounter:""
      },
      image: {
        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        titleSrc: function(item) {
          // Check if element has video link
          if (item.el.find('.video').text()) {
            return '<h4>' + item.el.attr('title') + '</h4> <p> <small>' + item.el.find('.caption p').text() + '</small> </p> <a href="' + item.el.find('.video').text() + '" class="btn btn-sm btn-warning" target="_blank"> Voir la video </a>' ;
          }
          else{
            return '<h4>' + item.el.attr('title') + '</h4> <p> <small>' + item.el.find('.caption p').text() + '</small> </p>';
          }
        }
      },
      callbacks: {
        resize: changeImgSize,
        imageLoadComplete:changeImgSize,
        change:changeImgSize
      }

    });

  }
  function changeImgSize(){
              var width = $(window).width;
              var height = $(window).height();
              height = height*60/100;
              var img = this.content.find('img');
              img.css('max-height', height+'px');
              img.css('width', 'auto');
              if (width > 500) {
                img.css('max-width', '500px');
              }else{
                img.css('max-width', width);
              }
          }
  // Masonry initialisation
  //****************
  if ($('.grid').length > 0) {

    // Add and customize captions
    //****************

      $(window).load(function(){
        $('.captionBox a').each(function(){
          var width = $(this).children('img').width();
          $(this).find('.caption').width(width-20);
          $(this).hover(function(){
            $(this).find('.caption').css("opacity", 1);
          }, function(){
            $(this).find('.caption').css("opacity", 0);
          });
        });
      });



    $(window).load(function(){
      var $grid = $('.grid').masonry({
        itemSelector: 'li',
        initLayout: false,
        transitionDuration : 0
      } );

      $grid.masonry();
      var $animation_elements = $('.grid li');
      var $window = $(window);

      // Animate on scroll
      //****************
      var check_if_in_view = function(){
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
          var $element = $(this);
          var element_height = $element.outerHeight();
          var element_top_position = $element.offset().top;
          var element_middle_position = (element_top_position + (element_height/2));

          //check to see if this current container is within viewport
          if (element_middle_position <= window_bottom_position) {
            $element.addClass('in-view');
          }
        });
      };

      $window.on('scroll resize', check_if_in_view);
      $window.trigger('scroll');

    });
  }


  // Init Summernote Plugin
  //*****************
  if ($('.summernote').length > 0) {

    $('.summernote').summernote({
      placeholder: 'write here...',
      height: 255, //set editable area's height
      focus: false, //set focus editable area after Initialize summernote
      toolbar: [
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph' ] ],
        [ 'table', [ 'table' ] ],
        [ 'insert', [ 'link'] ],
        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
      ],
    });
  }


  // Init SelectPicker Plugin
  //*****************
  if ($('.selectpicker').length > 0) {
    $('.selectpicker').selectpicker();
  }

  // Init animation page work
  // @page work
  //******************************
  if ($('.work-box').length > 0) {
    $( window ).load(function() {

        //add animation to the divs
        $('.animated').each(function(){
          var animation = $(this).attr('data-test');

          $('body').addClass('animation-running');
          $(this).addClass(animation);

          $(this).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $('body').removeClass('animation-running');
            $(this).removeClass(animation);
          });
        });

        var titleHeight = [];
        $('.work-box h2').each(function(){
          titleHeight.push($(this).height());
        });
        TitleMaxHeight = Math.max.apply(null, titleHeight);
        if (TitleMaxHeight>33) {
          console.log(TitleMaxHeight);
          $('.work-box').each(function(){
            var nativeHeight = $(this).height();
            $(this).height(nativeHeight - 33 + TitleMaxHeight);
          });
        }


        //apply transformation to the work-box on hover
        $('.work-box').each(function(i){

          // speed in px/s
          var speed = 250;
          var position = 0;
          var totalWidths = $(this).find('.work-img').width();
          var boxWidth = $(this).width();
          var width = - 50 - (totalWidths-boxWidth);
          var cible = $(this).parent().find('.work-img');

          // center the images
          $(this).find('.work-img').css('left', (-(totalWidths-boxWidth)/2));

          var applyTime = function(direction){

            // get the value of the absolute position left
            var position = parseInt( cible.attr("style").replace("left: ", "").replace("px;", ""));

            // calculate the animation's time
            if(direction === "right"){
              time = ((totalWidths-boxWidth) + position) / speed * 1000;
            }
            else if(direction === "left"){
                time = Math.abs(position) / speed * 1000;
            }
          };

          // set the animation moving right
          $(this).find($('.move-right'))
            .mouseover(function(){
              applyTime("right");
              cible.stop().animate({left:width}, {duration : time, easing : 'linear'});
            })
            .mouseout(function(){
              cible.stop();
            });

          // set the animation moving left
          $(this).find($('.move-left'))
            .mouseover(function(){
              applyTime("left");
              cible.stop().animate({left:"50px"}, {duration : time, easing : 'linear'});
            })
            .mouseout(function(){
              cible.stop();
            });
          });

    });// End Window Load
  }

  // set the same height for the "actu" images
  $(window).load(function(){
    $('body').css('min-height', 'auto');
    var heights = [];
    $('.actu-block .img-actu').each(function(){
      heights.push(parseInt($(this).height()));
    });
    var maxHeight = Math.max.apply(Math, heights);
    if (maxHeight < 200) {
      $('.actu-block .img-actu').each(function(){
        $(this).css('height', maxHeight);
      });
    }else{
      $('.actu-block .img-actu').each(function(){
        $(this).css('height', 200);
      });
    }
  });




});

//# sourceMappingURL=custom.js.map
