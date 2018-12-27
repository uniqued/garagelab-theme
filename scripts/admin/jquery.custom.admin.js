(function($){

  $(function() {

    //=====================================================
    //! Display post format meta boxes as needed
    //=====================================================

    // Set up our array of post format objects and group trigger
    var postFormats = [
      {
        'id' : 'audio',
        'option' : $('#zilla-metabox-post-audio'),
        'trigger' : $('#post-format-audio')
      },
      {
        'id' : 'video',
        'option' : $('#zilla-metabox-post-video'),
        'trigger' : $('#post-format-video')
      },
      {
        'id' : 'gallery',
        'option' : $('#zilla-metabox-post-gallery'),
        'trigger' : $('#post-format-gallery')
      },
      {
        'id' : 'link',
        'option' : $('#zilla-metabox-post-link'),
        'trigger' : $('#post-format-link')
      },
      {
        'id' : 'quote',
        'option' : $('#zilla-metabox-post-quote'),
        'trigger' : $('#post-format-quote')
      }
    ],
    group = $('#post-formats-select input'),
    page_template = $('#page_template');

    // If format is check, show metabox
    for( var format in postFormats ) {
      if ( postFormats[format].trigger.is(':checked') ) {
        postFormats[format].option.css('display', 'block');
      } else {
        postFormats[format].option.css('display', 'none');
      }
    }

    // New format selected, hide and show metaboxes
    group.change( function() {
      $that = $(this);

      for( var format in postFormats ) {
        if ( $that.val() === postFormats[format].id) {
          postFormats[format].option.css('display', 'block');
        } else {
          postFormats[format].option.css('display', 'none');
        }
      }
    });

    if (page_template.val() !== 'page-cover.php')  {
      $('#zilla-metabox-page-header').css('display', 'none');
    }else{
      $('#zilla-metabox-page-header').css('display', 'block');
    }

    if (page_template.val() !== 'page-cover.php') {
      $('#zilla-metabox-page-options').css('display', 'none');
    }else{
      $('#zilla-metabox-page-options').css('display', 'block');
    }

    if (page_template.val() !== 'template-contact.php') {
      $('#zilla-metabox-page-contact').css('display', 'none');
    }else{
      $('#zilla-metabox-page-contact').css('display', 'block');
    }

    if (page_template.val() !== 'about.php') {
      $('#zilla-metabox-page-about').css('display', 'none');
    }else{
      $('#zilla-metabox-page-about').css('display', 'block');
    }

    page_template.change( function(){
      $that = $(this);
      if ($that.val() !== 'page-cover.php')  {
        $('#zilla-metabox-page-header').css('display', 'none');
      }else{
        $('#zilla-metabox-page-header').css('display', 'block');
      }

      if ($that.val() !== 'page-cover.php') {
        $('#zilla-metabox-page-options').css('display', 'none');
      }else{
        $('#zilla-metabox-page-options').css('display', 'block');
      }

      if ($that.val() !== 'shop.php') {
        $('#zilla-metabox-page-shop').css('display', 'none');
      }else{
        $('#zilla-metabox-page-shop').css('display', 'block');
      }

      if ($that.val() !== 'template-contact.php') {
        $('#zilla-metabox-page-contact').css('display', 'none');
      }else{
        $('#zilla-metabox-page-contact').css('display', 'block');
      }

      if ($that.val() !== 'about.php') {
        $('#zilla-metabox-page-about').css('display', 'none');
      }else{
        $('#zilla-metabox-page-about').css('display', 'block');
      }
    });
  });
})(jQuery);
