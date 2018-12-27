<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Hype
 */

if ( ! function_exists( 'zilla_post_gallery' ) ) :
  /**
   * Print the HTML for galleries
   *
   * @since 1.0
   *
   * @param int $post_id ID of the post
   * @param string $layout Optional layout format
   * @return void
   */
function zilla_post_gallery( $post_id ) {
  $attachments = hype_get_gallery_data( $post_id );

  $transition = get_post_meta( $post_id, '_zilla_hype_gallery_transition', true );
  $transition = $transition ? $transition : 'fade';

  $timeout = get_post_meta( $post_id, '_zilla_hype_gallery_timeout', true );
  $timeout = $timeout ? $timeout : '0';

  $layout = get_post_meta( $post_id, '_zilla_hype_gallery_layout', true );
  $layout = $layout ? $layout : 'slideshow';

  $caption_style = get_post_meta( $post_id, '_zilla_hype_gallery_caption_style', true );
  $caption_style = $caption_style ? $caption_style : 'dark';

  if ( ! empty( $attachments ) ) {

    printf(
      '<div id="zilla-gallery-%1$s"
      class="zilla-gallery %4$s"
      data-gallery-fx="%2$s"
      data-gallery-timeout="%3$s">',
      $post_id,
      $transition,
      $timeout,
      $layout
    );

    foreach ( $attachments as $attachment ) {
      // Check if the image has a title or caption
      $has_caption = ( $attachment['thumb_title'] || $attachment['thumb_caption'] )
        ? null
        : 'no-caption';

      printf(
        '<figure class="zilla-slideshow-slide">
        %1$s
        <figcaption class="zilla-gallery-caption %2$s %5$s">
          <strong class="title">%3$s</strong>
          <span class="description">%4$s</span>
        </figcaption>
      </figure>',
        hype_responsive_image( $attachment ),
        $has_caption,
        $attachment['thumb_title'],
        $attachment['thumb_caption'],
        $caption_style
      );
    }

    echo '</div>';
  }
}
endif;

if ( ! function_exists( 'hype_post_thumbnail' ) ) :
  /**
   * Print the HTML for a responsive featured image
   *
   * @package Hype
   * @since Hype 1.0
   */
  function hype_post_thumbnail( $post_id, $thumb_type = 'full' ) {
    $thumb_data = hype_get_thumb_data( $post_id );
    echo hype_responsive_image( $thumb_data, $thumb_type );
  }
endif;

if ( ! function_exists( 'hype_print_post_meta' ) ) :
/**
 * Prints Meta Data for a post.
 *
 * @return void
 */

function hype_print_post_meta() {
  global $post;

  $post_categories         = wp_get_post_categories( $post->ID );
  $post_categories_content = '';

  foreach ( $post_categories as $c ) {
    $cat      = get_category( $c );
    $cat_link = get_category_link( $c );

    $post_categories_content .= '<a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat->name ) . '</a>';
  }

  $post_comments_content   = '<svg class="post-comment-s-icon"><use xlink:href="#icon-comments-s"></use></svg>';
  $post_comments_count     = $post->comment_count;
  $date                    = get_the_date();

  switch( $post->comment_count ) {
    case 1;
      $post_comments_content .= $post_comments_count . __( ' Kommentar', 'hype' );
      break;
    default;
      $post_comments_content .= $post_comments_count . __( ' Kommentare', 'hype' );
      break;
  }

  $post_comments_content = '<a href="' . get_permalink( $post->ID ) . '#comments">' . $post_comments_content . '</a>';

  $author_id       = get_the_author_meta( 'ID' );
  $author_name     = get_the_author_meta( 'display_name' );

  $author_content  = '<a href="' . get_author_posts_url( $author_id ) . '">' . $author_name . '</a>';
  $author_avatar   = get_avatar( $author_id, 30 );

  printf(
    '<div class="archive-post-meta">
      <div class="archive-post-categories archive-post-meta-block">
        <svg class="icon-folder"><use xlink:href="#icon-folder"></use></svg><span class="by">%3$s</span>%4$s
      </div>
      <div class="archive-post-meta-comments archive-post-meta-block">%5$s</div>
    </div>',
    __( 'von ', 'hype' ),
    $author_content,
    __( 'in ', 'hype' ),
    $post_categories_content,
    $post_comments_content,
    $author_avatar
  );

}

endif;

if ( ! function_exists( 'hype_print_audio_html' ) ) :
/**
 * Prints the WP Audio Shortcode to output the HTML for audio
 * @param  int $post_id The post ID
 * @return string         The "hmtl" for printing audio elements
 */
function hype_print_audio_html( $post_id ) {
  $output = '<section class="entry-audio section">';

  $posttype = get_post_type( $post_id );

  $keys = array(
    'post' => array(
      'mp3' => '_zilla_audio_mp3',
      'ogg' => '_zilla_audio_ogg'
    ),
    'portfolio' => array(
      'mp3' => '_tzp_audio_file_mp3',
      'ogg' => '_tzp_audio_file_ogg'
    )
  );

  // Build the "shortcode"
  $mp3 = get_post_meta( $post_id, $keys[$posttype]['mp3'], true );
  $ogg = get_post_meta( $post_id, $keys[$posttype]['ogg'], true );
  $attr = array();

  if ( $mp3 ) { $attr['mp3'] = $mp3; }
  if ( $ogg) { $attr['ogg'] = $ogg; }

  if ( $mp3 || $ogg ) {
    $output .= wp_audio_shortcode( $attr );
  }

  $output .= '</section>';

  return $output;
}
endif;


if ( ! function_exists( 'hype_print_video_html' ) ) :
/**
 * Prints the WP Vidio Shortcode to output the HTML for video
 * @param  int $post_id The post ID
 * @return string The "html" for printing video elements
 */
function hype_print_video_html( $post_id ) {
  global $post;
  $output = '';

  $posttype = get_post_type( $post_id );

  $keys = array(
    'post' => array(
      'embed'  => '_zilla_video_embed_code',
      'poster' => '_zilla_video_poster_url',
      'm4v'    => '_zilla_video_m4v',
      'ogv'    => '_zilla_video_ogv',
      'mp4'    => '_zilla_video_mp4'
    ),
    'portfolio' => array(
      'embed'  => '_tzp_video_embed',
      'poster' => '_tzp_video_poster_url',
      'm4v'    => '_tzp_video_file_m4v',
      'ogv'    => '_tzp_video_file_ogv',
      'mp4'    => '_tzp_video_file_mp4'
    )
  );

  $embed = get_post_meta( $post_id, $keys[$posttype]['embed'], true);

  if ( $embed ) {
    // Output the embed code if provided
    $output .= html_entity_decode( esc_html( $embed ) );
  } else {
    // Build the video "shortcode"
    $poster = get_post_meta( $post_id, $keys[$posttype]['poster'], true );
    $m4v = get_post_meta( $post_id, $keys[$posttype]['m4v'], true );
    $ogv = get_post_meta( $post_id, $keys[$posttype]['ogv'], true );
    $mp4 = get_post_meta( $post_id, $keys[$posttype]['mp4'], true );

    $attr = array( 'width' => '2000' );

    if ( $poster ) { $attr['poster'] = $poster; }
    if ( $m4v )    { $attr['m4v'] = $m4v; }
    if ( $ogv )    { $attr['ogv'] = $ogv; }
    if ( $mp4 )    { $attr['mp4'] = $mp4; }

    if ( $poster || $m4v || $ogv || $mp4 ) {
      $output .= wp_video_shortcode( $attr );
    }
  }

  return $output;
}
endif;


if ( ! function_exists('hype_print_post_format_media') ) :
/**
 * Prints the custom field content based on post format that is set
 * @param  int $post_id The post ID
 *
 */
function hype_print_post_format_media( $post_id ) {
  $format    = get_post_format( $post_id );
  $image_ids = get_post_meta( $post_id, '_zilla_image_ids', 'true' );

  switch ( $format ) {
    case 'audio':
      echo hype_print_audio_html( $post_id );
      break;
    case 'video':
      echo hype_print_video_html( $post_id );
      break;
    case 'link':
      $link = get_post_meta( $post_id, '_zilla_link_url', true );
      printf(
        '<p><a href="%1$s" target="_blank">%1$s</a></p>',
        $link
      );
      break;
    case 'quote':
      $quote        = get_post_meta( $post_id, '_zilla_quote_quote', true );
      $quote_author = get_post_meta( $post_id, '_zilla_quote_author', true );
      $quote_desc   = get_post_meta( $post_id, '_zilla_quote_description', true );

      if( ! empty( $quote_author) && ! empty( $quote_desc) ) {
        $quote_author = $quote_author . ',';
      }

      if( ! empty( $quote ) ) {
        printf(
          '<blockquote><p>%1$s<br><cite>%2$s<span class="quote-author-title">%3$s</span></cite></p></blockquote>',
          $quote,
          $quote_author,
          $quote_desc
        );
      }

      break;
    case 'gallery':
        if( "false" !== $image_ids ):
        ?>
        <div class="slick-gallery-container">
          <?php zilla_post_gallery( $post_id ); ?>
        </div>
        <?php
        endif;
      break;
  }
}
endif;

if ( ! function_exists( 'hype_content_nav' ) ) :
 /**
 * Display navigation to next/previous posts when applicable
 */
function hype_content_nav() {
  global $wp_query, $post;

  $no_next            = '';
  $no_prev            = '';

  if ( ! get_next_post_link() ) {
    $no_next = 'no-next';
  }

  if ( ! get_previous_post_link() ) {
    $no_prev = 'no-prev';
  }

  $next_post_link = '<div class="post-pagination-next"><svg class="post-pagination-next-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Nächster', 'hype' ) . '</span></div>';

  $prev_post_link = '<div class="post-pagination-prev"><svg class="post-pagination-prev-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Vorheriger', 'hype' ) . '</span></div>';

  echo '<div class="post-pagination-section section">';
  echo '  <div class="post-pagination-inner ' . $no_next . ' ' . $no_prev .'">';

  if ( get_previous_post() ) {
    previous_post_link( '%link', $prev_post_link );
  } else {
    echo $prev_post_link;
  }

  if ( get_next_post() ) {
    next_post_link( '%link', $next_post_link );
  } else {
    echo $next_post_link;
  }

  echo ' </div>';
  echo '</div>';
}
endif;

if ( ! function_exists( 'hype_get_posts' ) ) :
/**
 * Query used to get posts
 *
 * @return $wp_query
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
function hype_get_posts( $ajax_load = false, $page_number = 0, $sticky = false ) {
  global $wp_query;
  global $post;

  if ( $ajax_load ) {
    $paged = $page_number;
  } elseif ( is_home() ) {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;
  } else {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  }

  $args = array(
    'post_type'              => 'post',
    'order'                  => 'DESC',
    'update_post_meta_cache' => false,
    'paged'                  => $paged,
    'post_status'            => 'publish',
  );

  if ( $sticky ) {
    $sticky_posts     = get_option( 'sticky_posts' );
    $args['post__in'] = $sticky_posts;
  } else {
    $args['ignore_sticky_posts'] = 1;
  }


  if ( ! empty( $_POST ) ) {

    if ( ! empty( $_POST['category'] ) ) {
      $args['cat'] = $_POST['category'];

    } elseif ( ! empty( $_POST['author'] ) ) {
      $args['author'] = $_POST['author'];

    } elseif ( ! empty( $_POST['tag'] ) ) {
      $args['tag'] = $_POST['tag'];

    } elseif ( ! empty( $_POST['date'] ) ) {
      $args['date_query'] = $_POST['date'];

    } elseif ( ! empty( $_POST['tax_query'] ) ) {
      $args['tax_query'] = $_POST['tax_query'];
    }

  } else {

    $date_query = array();

    if ( is_category() ) {
      $args['cat'] = get_query_var( 'cat' );

    } elseif ( is_author() ) {
      $args['author'] = get_the_author_meta( 'ID' );

    } elseif ( is_tag() ) {
      $args['tag'] = get_query_var( 'tag' );

    } elseif ( is_day() ) {
      $date_query['compare'] = '==';
      $date_query['year']    = get_the_date( 'Y' );
      $date_query['month']   = get_the_date( 'n' );
      $date_query['day']     = get_the_date( 'j' );

      $args['date_query']    = $date_query;

    } elseif ( is_month() ) {
      $date_query['compare'] = '==';
      $date_query['year']    = get_the_date( 'Y' );
      $date_query['month']   = get_the_date( 'n' );

      $args['date_query']    = $date_query;

    } elseif ( is_year() ) {
    $date_query['compare'] = '==';
    $date_query['year']    = get_the_date( 'Y' );

    $args['date_query']    = $date_query;

    } elseif ( is_tax( 'post_format' ) ) {
      $post_format = 'post-format-' . get_post_format( $post->ID );


      $args['tax_query'] = array( array(
        'taxonomy' => 'post_format',
        'field'    => 'slug',
        'terms'    => array( $post_format ),
        'operator' => 'IN'
      ) );
    }
  }

  // Set up the custom query
  $wp_query = null;
  $wp_query = new WP_Query($args);
  return $wp_query;
}
endif;

if ( ! function_exists( 'hype_print_posts' ) ) :
  /**
   * Prints the posts
   *
   * @package Hype
   * @since Hype 1.0
   *
   */
function hype_print_posts( $ajax_load = false, $page_number = 0, $terms = array() ) {
  global $wp_query;
  global $post;

  $num_sticky = count( get_option( 'sticky_posts' ) );

  // Set the page number to fetch
  if ( $ajax_load ) {
    $paged = $page_number;
  } elseif ( is_home() && 0 !== $num_sticky ) {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 0;
  } else {
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  }

  if ( 0 !== $num_sticky && ! $ajax_load && is_home() ) {
    $wp_query = hype_get_posts( false, 0, true );

    echo '<div class="sticky-posts">';

    while ( $wp_query->have_posts() ) : $wp_query->the_post();

      get_template_part( 'content', 'excerpt' );

    endwhile;

    echo '</div>';

    wp_reset_query();
  }


  $wp_query = hype_get_posts( true, $page_number, $terms );

  while ( $wp_query->have_posts() ) : $wp_query->the_post();

    get_template_part( 'content', 'excerpt' );

  endwhile;

  // Show the load more button if it's enabled, there's more than one page of posts, and we're not on the last page
  if ( $wp_query->max_num_pages > 1 && $paged < $wp_query->max_num_pages ) {

    $nextpage = intval( $paged ) + 1;

    printf(
      '<div class="post-more-button"><button class="button primary-button btn-load-more-post" data-nextpage="%1$d">%2$s</button></div>',
      $nextpage,
      __( 'Mehr laden', 'hype' )
    );
  }

  wp_reset_postdata();
}
endif;

if ( ! function_exists( 'hype_posts_load_more' ) ) :
  /**
   * Loads more posts on the homepage
   *
   * @uses: hype_print_posts()
   *
   * @package Hype
   * @since Hype 1.0
   *
   */
  function hype_posts_load_more() {
    global $post;
    // Which page to load? Data passed from jquery.custom.js
    $page_number = intval( $_POST['page'] );
    ?>

    <div class="grid-items">
      <?php hype_print_posts( true, $page_number ); ?>
    </div>
    <?php die();
  }
endif;

if ( ! function_exists( 'hype_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function hype_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;

  if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) { ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <div class="comment-body">
      <?php _e( 'Pingback:', 'hype' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'hype' ), '<span class="edit-link">', '</span>' ); ?>
    </div>

  <?php } else { ?>

  <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
      <div class="comment-meta">
        <div class="comment-author vcard">
          <?php if ( 0 != $args['avatar_size'] ) {
            echo get_avatar( $comment, $args['avatar_size'] );
          } ?>
        </div>
        <!-- .comment-author -->
      </div>
      <!-- .comment-meta -->

      <div class="comment-content">
        <header class="comment-metadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php printf( __( '%s', 'hype' ), sprintf( '<span class="fn comment-author">%s</span>', get_comment_author_link() ) ); ?>
            <time datetime="<?php comment_time( 'c' ); ?>" class="comment-date">
              <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'hype' ), get_comment_date(), get_comment_time() ); ?>
            </time>
          </a>
          <?php edit_comment_link( __( 'Edit', 'hype' ), '<span class="edit-link">', '</span>' ); ?>
        </header>
        <!-- .comment-metadata -->

        <?php if ( '0' == $comment->comment_approved ) { ?>
          <p
            class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'hype' ); ?></p>
        <?php } ?>

        <div class="comment-content"><?php comment_text(); ?></div>

        <div class="reply">
          <?php echo get_comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID ); ?>
        </div>
        <!-- .reply -->

      </div>
      <!-- .comment-content -->

    </article>
    <!-- .comment-body -->

    <?php
  }
}
endif; // ends check for hype_comment()

add_action( 'wp_ajax_nopriv_hype_posts_load_more', 'hype_posts_load_more' );
add_action( 'wp_ajax_hype_posts_load_more', 'hype_posts_load_more' );