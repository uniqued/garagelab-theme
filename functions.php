<?php
/**
 * Hype functions and definitions
 *
 * @package Hype
 */

/**
 * Load Zillaframework
 */

//temporary "fix" for bug created by loading svgs through javascript
#todo remove this once wordpress updates
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * include custom nav walker class
 */
require get_template_directory() . '/includes/hype-walker-class-menu.php';

/**
 * Set Post Thumbnail size
 */
set_post_thumbnail_size( 300, 175 );

add_action( 'init', 'hype_google_fonts' );
if ( ! function_exists( 'hype_google_fonts' ) ) :
/**
 * Register Google Fonts
 */
function hype_google_fonts() {
  $protocol = is_ssl() ? 'https' : 'http';

  /* translators: If there are characters in your language that are not supported
    by any of the following fonts, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Baloo font: on or off', 'hype' ) ) {
    wp_register_style( 'hype-baloo', "$protocol://fonts.googleapis.com/css?family=Baloo" );
  }
  wp_enqueue_style( 'hype-baloo' );

  if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'hype' ) ) {
    wp_register_style( 'hype-sourcesanspro', "$protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" );
  }
  wp_enqueue_style( 'hype-sourcesanspro' );

  
}
endif;

add_action( 'after_setup_theme', 'hype_setup' );
if ( ! function_exists( 'hype_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function hype_setup() {

  load_theme_textdomain( 'hype', get_template_directory() . '/languages' );

  add_theme_support( 'automatic-feed-links' );

  /**
   * Enable support for Post Thumbnails on posts and pages
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );

  if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'portfolio', 680, 9999 );
    add_image_size( 'xxl-thumb', 2560, 9999 );
    add_image_size( 'xl-thumb', 1920, 9999 );
    add_image_size( 'l-thumb', 1440, 9999 );
    add_image_size( 'm-thumb', 960, 9999 );
    add_image_size( 's-thumb', 480, 9999 );
  }

  /**
   * This theme uses wp_nav_menu() in two positions.
   */
  register_nav_menus( array(
    'mobile'   => __( 'Mobile Menu', 'hype' ),
    'desktop'  => __( 'Desktop Menu', 'hype')
  ) );

  // Add post formats support
  add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'link', 'quote', 'video' ) );
}
endif; // hype_setup

add_action( 'wp_enqueue_scripts', 'hype_scripts', 100 );
if ( ! function_exists( 'hype_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
function hype_scripts() {

  wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/scripts/skrollr.js' );
  wp_enqueue_script( 'skrollr-menu', get_template_directory_uri() . '/scripts/skrollr.menu.min.js' );

  wp_enqueue_script( 'images_loaded', get_template_directory_uri() . '/scripts/imagesloaded.pkgd.min.js', array( 'jquery' )  );

  wp_enqueue_script( 'jquery_validate', get_template_directory_uri() . '/scripts/jquery.validate.min.js' );

  wp_enqueue_script( 'justified_gallery', get_template_directory_uri() . '/scripts/jquery.justifiedGallery.min.js' );

  wp_enqueue_script( 'picture_fill', get_template_directory_uri() . '/scripts/picturefill.min.js', '', '2.3.1', true );

  wp_enqueue_script( 'object_fit', get_template_directory_uri() . '/scripts/polyfill.object-fit.min.js', '', '0.4.1', true );

  wp_enqueue_script( 'slick', get_template_directory_uri() . '/scripts/slick.min.js', '', '1.5.0', true );

  wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/scripts/modernizr.custom.33210.js', '', '2.8.3', false );


  wp_register_script( 'sprites' , get_template_directory_uri() . '/scripts/sprites.js', '' , '1.0.0', true );
  wp_enqueue_script( 'sprites' );

  $js_url = ( is_ssl() ) ? 'https://v0.wordpress.com/js/videopress.js' : 'http://s0.videopress.com/js/videopress.js';
  wp_enqueue_script( 'videopress', $js_url, array( 'swfobject' ), '1.09' );

  $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );

  wp_localize_script( 'sprites', 'sprites_object', $translation_array );

  wp_enqueue_style( 'custom-css-php', admin_url( 'admin-ajax.php' ) . '?action=hype_dynamic_css' );

  wp_enqueue_style( 'object_fit', get_template_directory_uri() . '/styles/polyfill.object-fit.css' );

  wp_enqueue_style( 'justified_gallery', get_template_directory_uri() . '/styles/justifiedGallery.min.css' );

  wp_enqueue_style( 'hype_style', get_template_directory_uri() . '/style.css' );

  /* loads the javascript required for threaded comments --- */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
}
endif;

add_action( 'wp_enqueue_scripts', 'custom_script' );
if ( ! function_exists( 'custom_script' ) ) :
/**
 * Enqueue custom script
 */
function custom_script() {
  global $post;

  wp_enqueue_script( 'hype_script', get_template_directory_uri() . '/scripts/custom.js', '', '1.0.0', true );

  $date_query = array();
  $args       = array(
    'ajaxurl'          => admin_url( 'admin-ajax.php' ),
    'isHome'           => is_home(),
    'isArchive'        => is_archive(),
    'isSingle'         => is_single(),
    'isSearch'         => is_search(),
    'hasPostThumbnail' => has_post_thumbnail(),
    'isSticky'         => is_sticky(),
  );

  if ( is_category() ) {
    $args['category'] = get_query_var( 'cat' );

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

  wp_localize_script( 'hype_script', 'hype', $args );
}
endif;

add_action('wp_ajax_hype_dynamic_css', 'hype_dynamic_css');
add_action('wp_ajax_nopriv_hype_dynamic_css', 'hype_dynamic_css');
if ( ! function_exists( 'hype_dynamic_css' ) ) :
/**
 * Load Customizer CSS
 */
function hype_dynamic_css () {

  require( get_template_directory() . '/styles/custom_style.php' );
  exit;
}
endif;
add_action( 'admin_enqueue_scripts', 'hype_admin_scripts' );
if ( ! function_exists( 'hype_admin_scripts' ) ) :
/**
 * Enqueue scripts and styles
 */
function hype_admin_scripts() {

  wp_enqueue_style( 'hype_admin_style', get_template_directory_uri() . '/admin.css', false, '1.0.0' );

  wp_register_script( 'hype-admin', get_template_directory_uri() . '/scripts/admin/jquery.custom.admin.js', 'jquery' );
  wp_enqueue_script( 'hype-admin' );
}
endif;

add_action( 'after_setup_theme', 'hype_jetpack_logo' );
if ( ! function_exists( 'hype_jetpack_logo' ) ) :
/**
 * Use jetpack logo functionality
 */
function hype_jetpack_logo() {

  add_theme_support( 'site-logo', array(
    'size' => 'medium',
  ) );
}
endif;

add_filter( 'the_content', 'hype_filter_ptags_on_images' );
if ( ! function_exists( 'hype_filter_ptags_on_images' ) ) :
/**
 * Remove p tags from images, this ensures padding is not added to images.
 * https://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
 */
function hype_filter_ptags_on_images( $content ) {
  $content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3' , $content );
  return preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
}
endif;

add_filter( 'excerpt_more', 'hype_new_excerpt' );
if ( ! function_exists( 'hype_new_excerpt' ) ) :
/**
 * @param $more
 * @return string
 */
function hype_new_excerpt( $more ) {
  global $post;
  return '...';
}
endif;

add_action( 'widgets_init', 'hype_register_sidebars' );
if ( ! function_exists( 'hype_register_sidebars' ) ) :
/**
 *
 * Registers sidebars
 */
function hype_register_sidebars () {
  $args = array(
    'name'          => __( 'About Sidebar', 'hype' ),
    'id'            => 'about-sidebar',
    'description'   => 'Sidebar to show at the bottom of about page.',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="widgettitle">',
    'after_title'   => '</h5>'
  );

  register_sidebar( $args );

  $args = array(
    'name'          => __( 'Portfolio Sidebar', 'hype' ),
    'id'            => 'portfolio-sidebar',
    'description'   => 'Sidebar to show at the bottom of portfolio page.',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="widgettitle">',
    'after_title'   => '</h5>'
  );

  register_sidebar( $args );
  
  
  $args = array(
    'name'          => __( 'Footermeta Sidebar', 'hype' ),
    'id'            => 'footermeta-sidebar',
    'description'   => 'Sidebar to show the footer menu page.',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="widgettitle">',
    'after_title'   => '</h5>'
  );

  register_sidebar( $args );
    $args = array(
    'name'          => __( 'Footerintern Sidebar', 'hype' ),
    'id'            => 'footerintern-sidebar',
    'description'   => 'Sidebar to show the footer menu page.',
    'class'         => '',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="widgettitle">',
    'after_title'   => '</h5>'
  );

  register_sidebar( $args );
}


endif;


add_filter( 'the_content_more_link', 'hype_remove_more_jump_link' );
if ( ! function_exists( 'hype_remove_more_jump_link' ) ) :
/**
 *
 * https://wordpress.org/support/topic/theme-lightword-how-to-remove-more-tag-on-read-more
 * Remove more jump link
 */
function hype_remove_more_jump_link( $link ) {

  $offset = strpos( $link, '#more-' );
  if ( $offset ) {
    $end = strpos( $link, '"', $offset );
  }
  if ( $end ) {
    $link = substr_replace( $link, '', $offset, $end-$offset );
  }

  return $link;
}
endif;

if ( ! function_exists( 'hype_hex_to_rgba' ) ) :
/**
 *
 * https://wordpress.org/support/topic/theme-lightword-how-to-remove-more-tag-on-read-more
 * Remove more jump link
 */
function hype_hex_to_rgba( $color, $opacity = false ) {

  $default = 'rgb(0,0,0)';

  //Return default if no color provided
  if ( empty( $color ) ) {
    return $default;
  }

  //Sanitize $color if "#" is provided
  if ( $color[0] == '#' ) {
    $color = substr( $color, 1 );
  }

  //Check if color has 6 or 3 characters and get values
  if ( strlen( $color ) == 6 ) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }

  //Convert hexadec to rgb
  $rgb =  array_map( 'hexdec', $hex );

  //Check if opacity is set(rgba or rgb)
  if ( $opacity ){
    if (abs( $opacity) > 1 )
      $opacity = 1.0;
    $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity. ')';
  } else {
    $output = 'rgb(' . implode( ",", $rgb ) . ')';
  }

  //Return rgb(a) color string
  return $output;
}
endif;

add_action( 'pre_get_posts', 'hype_offset_homepage' );

if ( ! function_exists( 'hype_offset_homepage' ) ) :
/**
 *
 * http://wordpress.stackexchange.com/questions/155758/have-different-number-of-posts-on-first-page
 * Offset to account for sticky posts(mostly needed so ajax loads the right posts after the first page)
 */
function hype_offset_homepage( $query ) {

  $ppp            = get_option( 'posts_per_page' );
  $num_sticky     = count( get_option( 'sticky_posts' ) );
  $sticky         = false;

  if( 0 !== $num_sticky ) {
    if ( ! empty( $_POST ) && isset( $_POST['is_home'] ) ) {
      $is_home = $_POST['is_home'];
    } else {
      $is_home = $query->is_home();
    }

    if ( $query->get('post__in') === get_option( 'sticky_posts' ) ) {
      $sticky = true;
    }

    if ( 0 == intval( $query->get( 'posts_per_page' ) ) &&
      ( 'post' == $query->get( 'post_type' )  && 'attachment' != $query->get( 'post_type' ) &&
        ( $is_home && empty( $query->query_vars['date_query'] ) ) && ! $sticky ) ) {

      $query->set( 'post_status', 'publish' );
      $query->set( 'ignore_sticky_posts', '1' );

      if ( $num_sticky < $ppp ) {
        $posts_page_one = $ppp - $num_sticky;
      } else {
        $posts_page_one = 1;
      }

      if ( empty( $_POST ) ) {
        $query->set( 'posts_per_page', $posts_page_one );
      } else {
        $offset = $posts_page_one + ( ( $query->query_vars['paged'] - 1 ) * $ppp );
        $query->set( 'posts_per_page', $ppp );
        $query->set( 'offset', $offset );
      }
    }
  }
}
endif;

add_filter( 'found_posts','hype_homepage_offset_pagination', 10, 2 );

if ( ! function_exists( 'hype_homepage_offset_pagination' ) ) :
/**
 *
 * Offset pagination
 */

function hype_homepage_offset_pagination( $found_posts, $query ) {
  $sticky     = false;
  $num_sticky = count( get_option( 'sticky_posts' ) );

  if( 0 !== $num_sticky ) {
    if ( $query->get( 'post__in' ) === get_option( 'sticky_posts' ) ) {
      $sticky = true;
    }

   if ( ! empty( $_POST ) && isset( $_POST['is_home'] ) ) {
      $is_home = $_POST['is_home'];
    } else {
      $is_home = $query->is_home();
    }

    if ( $is_home && isset( $query->query['post_type'] ) &&  'post' == $query->query['post_type'] ) {
      $ppp = get_option( 'posts_per_page' );

      if ( $num_sticky < $ppp ) {
        $posts_page_one = $ppp - $num_sticky;
      } else {
        $posts_page_one = 1;
      }

      if ( ! $sticky && $is_home  && $query->query_vars['paged'] != 0) {
        $found_posts = $found_posts - $posts_page_one;
      }
    }
  }

  return $found_posts;
}
endif;

add_filter('pre_get_posts','hype_only_search_posts');

if ( ! function_exists( 'hype_only_search_posts' ) ) :
/**
 *
 * Only search through posts
 */
function hype_only_search_posts( $query )
{
  if  ($query->is_search )
  {
    $query->set('post_type', 'post');
  }
  return $query;
}
endif;


require get_template_directory() . '/includes/init.php';
require get_template_directory() . '/framework/init.php';

define( 'TZP_SLUG', 'projekte' );
define( 'TZP_TAX_SLUG', 'projekt-typ' ); 