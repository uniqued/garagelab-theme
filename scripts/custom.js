/*
    Custom js for Hype
    1.0.0
 */

(function($){

  // instantiate other JS
  //new TZ();

  // add redraw plugin for use on css transitions of ajax loaded content
  $.fn.redraw = function(){
    return $(this).each(function(){
      this.clientHeight;
    });
  };

  $(function() {

    var Core = {

      initialized: false,
      vh: $(window).height(),
      vw: $(window).width(),

      initialize: function () {
        // Bail if already initialized
        if (this.initialized) { return; }
        this.initialized = true;

        this.build();
        this.events();
        this.content_margin();
        $(".hype-loader").fadeOut("slow");
      },

      scroll: function () {
        this.fixed_header();
      },

      resize: function () {
        this.resize_portfolio_section();
        this.resize_contact_block();
        this.fixed_header();
        this.content_margin();
      },

      build: function () {
        this.testimonial_slider();
        this.post_slider();
        this.resize_portfolio_section();
        this.resize_contact_block();
        this.skrollr_init();
        this.object_fit_init();
        this.about_gallery_init();
        this.portfolioLoadMore();
        this.postLoadMore();
        this.fixed_header();
      },

      events: function () {
        var self                        = this;
        var $inner_menu                 = $('.site-header-inner-menu');
        var $inner_top                  = $('.site-header-inner-top');
        var $home_inner_top             = $('.home .site-header-inner-top');
        var $full_menu_inner            = $('.site-header-full-menu-inner');
        var $full_menu                  = $('.site-header-full-menu');
        var $header                     = $('header');
        var $footer                     = $('.site-footer');
        var $alternate_nav_has_children = $('.alternate-nav > div > ul > .menu-item-has-children');
        var $alternate_nav              = $('.alternate-nav');
        var $main                       = $('#main');
        var $window                     = $(window);
        var $cancel_comment             = $('#cancel-comment');
        var $comment                    = $('#comment');
        var $body                       = $('body');
        var $archive_cat_container      = $('.archive-category-container');
        var $respond                    = $('#respond');

        $(window).resize(function () {
          self.vh = $(window).height();
          self.vw = $(window).width();
        });

        $inner_menu.click(function() {
          var header_height = $inner_top.outerHeight() + $full_menu_inner.outerHeight();

          if(header_height >= $window.height()) {
            $full_menu.toggleClass('overflow-hidden');
            if ($window.width() <= '768') {
              $('.site-header-full-menu').height('100vh');
            }
          }

          $(this).toggleClass('active');
          $header.toggleClass('menu-open');
          $full_menu.toggleClass('closed');
          $(this).find('> .menu-open, > .menu-closed').toggleClass('hidden');
          $main.toggleClass('hidden');
          $footer.toggleClass('hidden');
          if($window.width() > '768') {
            $body.toggleClass('overflow-hidden');
          }
        });

        // Home menu bar

        $cancel_comment.click(function(e){
          e.preventDefault();
          $comment.val('');
          $('#comments > .inner-width h1').after($respond)
        });

        $archive_cat_container.click(function(){
          $(this).toggleClass('open');
        });
      },

      fixed_header: function() {
        var $content   = $('#main');
        var $inner_top = $('.site-header-inner-top');
        var $body      = $('body');
        var $logo      = $('.site-header-inner-logo');
        var $menu_text = $('.site-header-menu-text');
        var $menu_icon = $('.site-header-menu-icon');

        var header_height = $inner_top.height();

        if($body.hasClass('admin-bar')) {
          header_height = header_height + 32;
        }

        if($content.offset().top < header_height && ! $inner_top.hasClass('fixed')){
          var content_offset = $content.offset().top + header_height;
        } else {
          var content_offset = $content.offset().top;
        }

        var scroll = content_offset - $(document).scrollTop();

        if(scroll < header_height) {
          $inner_top.addClass('fixed');
			 $('.site-header-inner-logo').removeClass('hidden');
		     $('.site-header-inner-logo-invert').addClass('hidden')
          $menu_text.addClass('fixed');
          $menu_icon.addClass('fixed');
        }else if($(document).scrollTop() == 0){
          $inner_top.removeClass( 'fixed' );
		 if($(document.body).hasClass('page-template-page-cover') || $(document.body).hasClass('blog') ||  $(document.body).hasClass('page-template-page-with-hero')) {
			 $('.site-header-inner-logo').addClass('hidden');
		     $('.site-header-inner-logo-invert').removeClass('hidden')
		  }	 else {
			    $('.site-header-inner-logo').removeClass('hidden');
		  $('.site-header-inner-logo-invert').addClass('hidden')
		  }
          $menu_text.removeClass('fixed');
          $menu_icon.removeClass('fixed');
        }
      },

      content_margin: function() {
        var $site_header  = $('.site-header-inner');
        var $type_page    = $('.type-page');
        var $hero_content = $('.hero-content');
        var margin        = $site_header.height();
        var $hero_content_full = $('.hero-content-full');

        $type_page.css('margin-top', margin + 50);
        $hero_content.css('padding-top', margin + 50); // 100 is to give padding beneath the header
        if($(window).width() <= 768) {
          $hero_content_full.css('padding-top', margin + 70);
        }
      },

      post_slider: function() {

        $('.slick-gallery-container').each(function(){
          if($(this).find('.zilla-gallery').children().length > 1) {
            $(this).prepend(
              '<div class="slick-prev"><svg class="slick-prev-icon"><use xlink:href="#icon-down-arrow"></use></svg></div>' +
              '<div class="slick-next"><svg class="slick-next-icon"><use xlink:href="#icon-down-arrow"></use></svg></div>');
          }
        });

        $('.zilla-gallery').slick({
          'arrows' : false
        });

        $('.slick-gallery-container .slick-prev').click(function(){
          $('.zilla-gallery').slick('slickPrev');
        });

        $('.slick-gallery-container .slick-next').click(function(){
          $('.zilla-gallery').slick('slickNext');
        });
      },

      testimonial_slider: function() {
        $('.testimonials-inner').slick({
          'arrows' : false
        });

        $('.testimonials .slick-prev').click(function(){
            $('.testimonials-inner').slick('slickPrev');
        });

        $('.testimonials .slick-next').click(function(){
          $('.testimonials-inner').slick('slickNext');
        });
      },
      // way to do this with css?
      resize_portfolio_section: function() {
        var $portfolio_project = $('.portfolio-project');
        var $window            = $(window);
        var $window_width      = $window.width();

        $portfolio_project.each(function() {
          if($window_width > 890) {
            var width = $window_width/2;
            $(this).find('.portfolio-project-desc').css('height', width);
            $(this).find('.portfolio-project-img').css('height', width);
            $(this).find('.portfolio-project-desc').css('min-height', 0);
          }else{
            var width = $window_width;
            $(this).find('.portfolio-project-desc').css('min-height', width);
            $(this).find('.portfolio-project-desc').css('height', 'auto');
            $(this).find('.portfolio-project-img').css('height', width);
          }
        });
      },

      resize_contact_block: function() {
        var $window        = $(window);

        if($window.width() > 1000) {
          var width = $window.width()/2;
          $('.contact-block').css('height', width);
          $('.contact-block-form').css('height', 'auto');
          $('.contact-block-form').css('min-height', width);
        } else {
          var width = $window.width();
          $('.contact-block').css('height', 'auto');
          $('.contact-block-map').css('height', width);
          $('.contact-block-img').css('height', width);
        }
      },
      /**
       * initialize Skrollr
       */
      skrollr_init: function() {

        var $window         = $(window);
        var $home_inner_top = $('.home .site-header-inner-top');

        if ($window.width() > 1024) {
          var s = skrollr.init({
            forceHeight: false,
            mobileDeceleration: 0.004
          });

          skrollr.menu.init(s, {
            animate: true,
            easing: 'sqrt'
          });

          $('body').imagesLoaded(function() {
            s.refresh();
          });
        }
      },

      /**
       * Destroy Skrollr
       */
      skrollr_destroy: function(){
        var $window = $(window);

          if ($window.width() <= 1023) {
            skrollr.init().destroy();
          }
      },

      /**
       * Enable Object Fit
       */
      object_fit_init: function(){
        objectFit.polyfill({
          selector: 'picture > img',
          fittype: 'cover',
          disableCrossDomain: 'true'
        });
      },

      /**
       * Enable About Gallery
       */
      about_gallery_init: function(){
        $('#about-gallery').justifiedGallery({
          'lastRow'      : 'justify',
          'rowHeight'    : 160,
          'maxRowHeight' : 200
        });
      },

      postLoadMore: function () {
        $(document).on('click', '.btn-load-more-post', function () {
          var $button        = $(this);
          var $button_parent = $button.parent();
          var pageNumber     = $button.data('nextpage');
          var $hype_loader   = $('.hype-loader');

          $button.remove();

          $button_parent.append('<div class="load-more ball-pulse"><div></div><div></div><div></div></div>');

          $.ajax({
            url: hype.ajaxurl,
            type: 'post',
            data: {
              action: 'hype_posts_load_more',
              page: pageNumber,
              is_home: hype.isHome,
              is_archive: hype.isArchive,
              is_single: hype.isSingle,
              is_search: hype.isSearch,
              has_post_thumbnail: hype.hasPostThumbnail,
              is_sticky: hype.isSticky,
              category: hype.category,
              author: hype.author,
              tag: hype.tag,
              date: hype.date_query,
              tax_query: hype.tax_query
            },
            success: function(html) {

              $button_parent.remove();

              var $html = $(html);

              // Append the new items to the container
              $('.archive-posts').append($html).find('video,audio').mediaelementplayer();

              // Relayout the isotope grid with the new items
              if( $.fn.isotope ) {
                var $container = $('.gallery-inner').imagesLoaded( function() {
                  var $newElems = $('.new');
                  $container.isotope('insert', $newElems);
                  $newElems.removeClass('new');
                });
              }

              $('.zilla-gallery').slick({
                'arrows' : false
              });
            }
          });
        });
      },

      portfolioLoadMore: function () {
        $(document).on('click', '.btn-load-more', function () {
          var $button    = $(this);
          var pageNumber = $button.data('nextpage');
          var $button_parent = $button.parent();

          $button.remove();

          $button_parent.append('<div class="load-more ball-pulse"><div></div><div></div><div></div></div>');

          /*
           * Fetch the next set of posts using
           * frame_portfolio_load_more() and append them
           * to the recent section
           */
          $.ajax({
            url: hype.ajaxurl,
            type: 'post',
            data: {
              action: 'hype_portfolio_grid_load_more',
              page: pageNumber
            },
            success: function(html) {

              $button_parent.remove();

              var $html = $(html),
                $gridItems = $html.filter('.grid-items').html()

              $button.parent().remove();

              // Append the new items to the container
              $('.portfolio-inner')
                .append($gridItems);

              // Relayout the isotope grid with the new items
              if( $.fn.isotope ) {
                var $container = $('.gallery-inner').imagesLoaded( function() {
                  var $newElems = $('.new');
                  $container.isotope('insert', $newElems);
                  $newElems.removeClass('new');
                });
              }

              Core.resize_portfolio_section();
            }
          });
        });
      }
    };

    $(window).resize(function() {
      Core.resize();
    });

    $(window).scroll(function() {
      Core.scroll();
    });

    Core.initialize();
  });

})(jQuery);
