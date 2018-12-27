/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  //Colors
  wp.customize('gradient_1', function (value) {
    value.bind(function (to) {
      var gradient_2 = wp.customize.value('gradient_2')();

      $('.site-footer-contact-email, .site-footer-top-button:hover, .home-portfolio-button.second,' +
      ' .second .home-portfolio-project-category').css('color', to);
      $('.fixed .alternate-submenu-back, .site-footer-top, .alternate-nav ul li ul').css('background-color', to);
      $('.secondary-button:hover .right-arrow-icon, .home-portfolio-button.second').css('fill', to);
      $('.site-header-full-menu, .hero-overlay, .home-portfolio-project-desc').css('background', 'linear-gradient('+to+','+ gradient_2+')');
    });
  });

  wp.customize('gradient_2', function (value) {
    value.bind(function (to) {
      var gradient_1 = wp.customize.value('gradient_1')();

      $('.hero .secondary-button:hover .home-portfolio-button:hover').css('color', to);
      $('.home-portfolio-button:hover .right-arrow-icon').css('fill', to);
      $('.site-header-full-menu, .hero-overlay, .home-portfolio-project-desc').css('background', 'linear-gradient('+gradient_1+','+to+')');
    });
  });

  wp.customize('button_color', function (value) {
    value.bind(function (to) {
      var button_color = wp.customize.value('button_color')();

      $('.primary-button').css('background-color', to);
    });
  });

  //Social Icons
  wp.customize('social-dribbble', function (value) {
    value.bind(function (to) {
      $('.social-dribbble').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-dribbble"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-dribbble-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-facebook', function (value) {

    value.bind(function (to) {
      $('.social-facebook').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-facebook"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-facebook-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-google-plus', function (value) {
    value.bind(function (to) {
      $('.social-google-plus').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-google-plus"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-google-plus-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-linkedin', function (value) {
    value.bind(function (to) {
      $('.social-linkedin').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-linkedin"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-linkedin-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-pinterest', function (value) {
    value.bind(function (to) {
      $('.social-pinterest').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-pinterest"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-pinterest-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-twitter', function (value) {
    value.bind(function (to) {
      $('.social-twitter').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-twitter"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-twitter-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-youtube', function (value) {
    value.bind(function (to) {
      $('.social-youtube').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-youtube"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-youtube-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-flickr', function (value) {
    value.bind(function (to) {
      $('.social-flickr').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-flickr"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-flickr-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-instagram', function (value) {
    value.bind(function (to) {
      $('.social-instagram').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-instagram"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-instagram-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-kickstarter', function (value) {
    value.bind(function (to) {
      $('.social-kickstarter').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-kickstarter"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-kickstarter-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-medium', function (value) {
    value.bind(function (to) {
      $('.social-medium').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-medium"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-medium-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-rdio', function (value) {
    value.bind(function (to) {
      $('.social-rdio').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-rdio"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-rdio-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-reddit', function (value) {
    value.bind(function (to) {
      $('.social-reddit').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-reddit"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-reddit-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-rss', function (value) {
    value.bind(function (to) {
      $('.social-rss').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-rss"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-rss-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-spotify', function (value) {
    value.bind(function (to) {
      $('.social-spotify').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-spotify"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-spotify-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-tumblr', function (value) {
    value.bind(function (to) {
      $('.social-tumblr').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-tumblr"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-tumblr-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-vimeo', function (value) {
    value.bind(function (to) {
      $('.social-vimeo').remove();

      if (to != '') {
        $('.social-icons').append('<span class="social-vimeo"><a href="' + to + '" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-vimeo-hype"></use></svg></a></span>')
      }
    });
  });

  wp.customize('social-vine', function (value) {
    value.bind(function (to) {
      $('.social-vine').remove();

      if(to != ''){
        $('.social-icons').append('<span class="social-vine"><a href="'+to+'" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-vine-hype"></use></svg></a></span>')
      }
    });
	
	  wp.customize('social-instagram', function (value) {
    value.bind(function (to) {
      $('.social-instagram').remove();

      if(to != ''){
        $('.social-icons').append('<span class="social-instagram"><a href="'+to+'" target="_blank">' +
        '<svg class="social-icon"><use xlink:href="#icon-instagram-hype"></use></svg></a></span>')
      }
    });
	
  });

  //Header
  wp.customize('always_display_mobile_menu', function (value) {
    value.bind(function (to) {
      if(to===true){
        $('.site-header-inner-menu').css('display', 'block');
        $('.alternate-nav').css('display', 'none');
      }else{
        $('.site-header-inner-menu').css('display', 'none');
        $('.alternate-nav').css('display', 'block');
      }
    });
  });

  //Footer
  wp.customize('top_footer_text', function (value) {
    value.bind(function (to) {
      $('.site-footer-top-left').text(to);
    });
  });

  //Contact Information
})(jQuery);
