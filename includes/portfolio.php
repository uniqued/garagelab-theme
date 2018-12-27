<?php

// Prevent archives for the portfolio plugin; will use a custom page template
if ( ! defined( 'TZP_DISABLE_ARCHIVE' ) ) define( 'TZP_DISABLE_ARCHIVE', TRUE );
// Prevent Zilla Portfolio CSS from loading
if ( ! defined( 'TZP_DISABLE_CSS' ) ) define( 'TZP_DISABLE_CSS', TRUE );

// Remove filters on the content that adds portfolio content to the_content output
remove_filter( 'the_content', 'tzp_add_portfolio_post_meta' );
remove_filter( 'the_content', 'tzp_add_portfolio_post_media' );

if ( ! function_exists( 'hype_portfolio_post_ids' ) ) :
/**
 * Get a list of post IDs that belong to a portfolio page.
 *
 * @param   $page_id
 *          The portfolio page ID.
 *
 * @return  array
 *          An array of post IDs, empty if none.
 */
function hype_portfolio_post_ids( $page_id ) {
  $meta = get_post_meta( $page_id, 'hype_portfolio_posts', true );
  return ( is_array( $meta ) )
    ? $meta
    : array();
}
endif;


if ( ! function_exists( 'hype_filter_portfolio_posts' ) ) :
/**
 * Filter out portfolio posts from the index page.
 */
function hype_filter_portfolio_posts( $query ) {
  if ( ! $query->is_home() || ! $query->is_main_query() ) {
    return;
  }

  $query->set( 'meta_query', array(
    array(
      'key'     => 'hype_portfolio_active',
      'value'   => true,
      'compare' => 'NOT EXISTS'
    )
  ));

}
endif;

add_action( 'pre_get_posts', 'hype_filter_portfolio_posts' );

if ( ! function_exists( 'hype_portfolio_has_post' ) ) :
/**
 * Returns true if the portfolio page is linked to the given post.
 *
 * @param   $page_id
 *          The portfolio page ID.
 *
 * @param   $post_id
 *          The post ID.
 *
 * @return  bool
 */
function hype_portfolio_has_post( $page_id, $post_id ) {
  $post_ids = hype_portfolio_post_ids( $page_id );
  return in_array( $post_id, $post_ids );
}
endif;


if ( ! function_exists( 'hype_portfolio_add_post' ) ) :
/**
 * Add a post to a portfolio page.
 *
 * @param   $page_id
 *          The portfolio page ID.
 *
 * @param   $post_id
 *          The post ID.
 */
function hype_portfolio_add_post( $page_id, $post_id ) {
  $post_ids = hype_portfolio_post_ids( $page_id );
  $post_ids[] = $post_id;
  $post_ids = array_unique( $post_ids );

  update_post_meta( $page_id, 'hype_portfolio_posts', $post_ids );
  add_post_meta( $post_id, 'hype_portfolio_active', true, true );
}
endif;


if ( ! function_exists( 'hype_portfolio_remove_post' ) ) :
/**
 * Remove a post from a portfolio page.
 *
 * @param   $page_id
 *          The portfolio page ID.
 *
 * @param   $post_id
 *          The post ID.
 */
function hype_portfolio_remove_post( $page_id, $post_id ) {
  // Remove post_id from page
  $post_ids = hype_portfolio_post_ids( $page_id );
  $key = array_search( $post_id, $post_ids );

  if ( $key !== false ) {
    unset( $post_ids[$key] );
  }

  update_post_meta( $page_id, 'hype_portfolio_posts', $post_ids );

  // Update active flag
  $page_ids = hype_portfolio_page_ids( $post_id );

  if ( empty( $page_ids ) ) {
    delete_post_meta( $post_id, 'hype_portfolio_active' );
  }
}
endif;


if ( ! function_exists( 'hype_portfolio_upgrade' ) ) :
/**
 * Upgrade post_meta table to new portfolio implementation.
 */
function hype_portfolio_upgrade() {
  // Already upgraded
  if ( get_theme_mod( 'hype_portfolio_upgrade' ) === true ) {
    return;
  }

  // Get all posts with old meta
  $posts = get_posts( array(
    'posts_per_page'  => -1,
    'post_status'     => 'any',
    'meta_query'      => array(
      array(
        'key'         => 'hype_portfolio_ids',
        'compare'     => 'EXISTS',
      )
    )
  ) );

  // Update posts to new meta
  foreach ( $posts as $post ) {
    $meta = get_post_meta( $post->ID, 'hype_portfolio_ids' );

    if ( ! isset( $meta[0] ) ) {
      continue;
    }

    $ids = $meta[0];

    foreach ( $ids as $id ) {
      hype_portfolio_add_post( $id, $post->ID );
    }

    delete_post_meta( $post->ID, 'hype_portfolio_ids' );
  }

  // Mark that we have upgraded
  set_theme_mod( 'hype_portfolio_upgrade', true );
}
endif;
add_action( 'admin_init', 'hype_portfolio_upgrade' );

if ( ! function_exists( 'hype_set_archive_order' ) ) :
/**
 * Set the order for portfolio type taxonomy archives
 *
 * @param  obj $query the query object
 * @return void
 */
function hype_set_archive_order( $query ) {
  if ( $query->is_tax( 'portfolio-type' ) && $query->is_main_query() ) {
    $query->set( 'orderby', 'menu_order' );
    $query->set( 'order', 'ASC' );
  }
}
endif;
add_action( 'pre_get_posts', 'hype_set_archive_order' );

if ( ! function_exists( 'hype_save_added_portfolio_post_meta' ) ) :
/**
 * Add the new meta fields to the array of values to be saved
 * The 'select' type is not standard and sanitization is added in extras.php - tzp_metabox_sanitize_select()
 *
 * @param  array $array Array of the fields to be sanitized and saved
 * @return array        The updated array
 */
function hype_save_added_portfolio_post_meta( $array ) {
  $array['_zilla_hype_featured_portfolio']    = 'checkbox';
  $array['_zilla_hype_gallery_transition']    = 'select';
  $array['_zilla_hype_gallery_timeout']       = 'select';
  $array['_zilla_hype_gallery_layout']        = 'select';
  $array['_zilla_hype_gallery_caption_style'] = 'select';

  return $array;
}
endif;
add_filter( 'tzp_metabox_fields_save', 'hype_save_added_portfolio_post_meta' );


if ( ! function_exists( 'hype_portfolio_meta' ) ) :
/**
 * Build and echo the portfolio meta information
 *
 * @param  int $post_id The post id
 * @since  1.0
 * @return void
 */
function hype_portfolio_meta( $post_id ) {
  $output = '';

  $url    = get_post_meta( $post_id, '_tzp_portfolio_url', true );
  $date   = get_post_meta( $post_id, '_tzp_portfolio_date', true );
  $client = get_post_meta( $post_id, '_tzp_portfolio_client', true );
  $terms  = get_the_terms( $post_id, 'portfolio-type' );

  if ( $url || $date || $client ) {
    $output .= '<dl class="portfolio-entry-meta">';

    if ( $date ) {
      $output .= sprintf( '<div class="portfolio-meta-icon-block"><dt><svg class="portfolio-meta-icon"><use xlink:href="#icon-calendar"></use></svg></dt> <dd class="portfolio-project-date">%1$s</dd></div>',  esc_html( $date ) );
    }

    if ( $client ) {
      $output .= sprintf( '<div class="portfolio-meta-icon-block"><dt><svg class="portfolio-meta-icon"><use xlink:href="#icon-account-s"></use></svg></dt> <dd class="portfolio-project-client">%1$s</dd></div>', esc_html( $client ) );
    }

    if ( $url ) {
      $output .= sprintf( '<div class="portfolio-meta-icon-block"><dt><dt><svg class="portfolio-meta-icon"><use xlink:href="#icon-globe"></use></svg></dt></dt> <dd><a class="portfolio-project-url" href="%1$s">%1$s</a></dd></div>',  esc_url( $url ) );
    }

    $output .= '</dl>';
  }

  echo $output;
}
endif;


if ( ! function_exists( 'hype_get_portfolio_posts' ) ) :
/**
 * Query used to get posts for the portfolio pages
 *
 * @return $wp_query
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
function hype_get_portfolio_posts( $ajax_load = false, $page_number = 0, $terms = array() ) {
  global $wp_query;
  global $post;

  // Are we enabling the load more button?
  $portfolio_pagination = get_theme_mod( 'portfolio_pagination' );

  // Set the number of posts per page
  if ( $portfolio_pagination ) {
    $posts_per_page = get_theme_mod( 'portfolios_per_page' );
  } else {
    $posts_per_page = -1;
  }

  if ( is_front_page() ) {
    $posts_per_page = get_post_meta( $post->ID, '_zilla_home_portfolio_amount', true );
  }
  // Set the page number to fetch
  if ( $ajax_load ) {
    $paged = $page_number;
  } else {
    if ( is_front_page() ) {
      $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
    } else {
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    }
  }

  $args = array(
    'post_type'              => 'portfolio',
    'orderby'                => 'menu_order',
    'order'                  => 'ASC',
    'posts_per_page'         => $posts_per_page,
    'update_post_meta_cache' => false,
    'paged'                  => $paged,
    'post_status'            => 'publish'
  );

  if ( ! empty( $terms ) ) {
    $args['tax_query'] = array(
      'relation' => 'AND',
        array(
          'taxonomy' => 'portfolio-type',
          'field' => 'id',
          'terms' => $terms,
          'include_children' => true,
          'operator' => 'IN'
        )
    );
  }

  // Set up the custom query
  $wp_query = null;
  $wp_query = new WP_Query($args);

  return $wp_query;
}
endif;


if ( ! function_exists( 'hype_print_portfolio_grid' ) ) :
/**
 * Prints the posts in the grid of a portfolio page
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
function hype_print_portfolio_grid( $ajax_load = false, $page_number = 0, $terms = array() ) {
  global $post;
  global $wp_query;

  // Are we enabling the load more button?
  $is_front_page        = is_front_page();
  $portfolio_pagination = get_theme_mod( 'portfolio_pagination' );
  $portfolio_cta        = get_theme_mod( 'full_portfolio_cta', 'View Full Portfolio Item' );

  $wp_query             = hype_get_portfolio_posts( $ajax_load, $page_number, $terms );


  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();

      $has_thumbnail = has_post_thumbnail();

      $categories = get_the_terms( $post->ID, 'portfolio-type' );
      ?>
      <div <?php post_class(); ?>>
        <div class="portfolio-project">
          <div class="portfolio-project-desc">
            <h2><?php echo get_the_title(); ?></h2>
            <h5><?php echo get_the_excerpt(); ?></h5>

            <div class="home-single-project-button">
              <a class="button secondary-button portfolio-button"
                 href="<?php echo get_the_permalink(); ?>">
                <?php echo esc_html( $portfolio_cta ); ?>
                <svg class="right-arrow-icon">
                  <use xlink:href="#icon-down-arrow"></use>
                </svg>
              </a>
            </div>
            <?php if ( $categories ) { ?>
              <div class="project-categories portfolio-project-categories">
                <?php
                foreach ( $categories as $category ) {
                  ?>
                  <a class="portfolio-project-category project-category"
                     href="<?php echo get_term_link( $category ); ?>">
                    <?php echo esc_html( $category->name ); ?>
                  </a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
          <div class="portfolio-project-img <?php echo ! $has_thumbnail ? 'no-image' : ''; ?>">
            <?php
              if ( $has_thumbnail ) :
                hype_post_thumbnail( $post->ID, 'portfolio' );
              else : ?>
                <h3><?php the_title(); ?></h3>
              <?php endif; ?>
          </div>
        </div>
      </div>

      <?php
    }

    if ( $is_front_page ) {
      $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
    } else {
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    }

    if ( ! $is_front_page ) {
      // Show the load more button if it's enabled, there's more than one page of posts, and we're not on the last page
      if ( $portfolio_pagination && ( abs( $wp_query->max_num_pages ) > 1 && $paged < abs( $wp_query->max_num_pages ) ) ) {
        $nextpage = intval( $paged ) + 1;
        printf(
          '<div class="portfolio-more-button"><button class="button primary-button btn-load-more" data-nextpage="%1$d">%2$s</button></div>',
          $nextpage,
          __( 'Mehr laden', 'hype' )
        );
      }
    }

    wp_reset_query();

  } else {

    printf( '<p>%s</p>', __( 'You can add items to your portfolio through the Portfolio Posts menu after installing the Zilla Portfolio plugin.', 'hype' ) );

  }
}
endif;


if ( ! function_exists( 'hype_print_portfolio_filters' ) ) :
/**
 * Prints the markup for the portfolio filters
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
function hype_print_portfolio_filters() {
  $terms = get_terms( 'portfolio-type' );
?>
  <?php if ( ! empty( $terms ) ) { ?>
  <div class="portfolio-filters">
      <ul class="filter-terms-list">
      <?php foreach ( $terms as $term ) {
        printf(
          '<li><input type="checkbox" name="%1$s" id="portfolio-type-%1$s" value=".portfolio-type-%1$s"><label for="portfolio-type-%1$s">%2$s</label></li>',
          $term->slug,
          $term->name
        );
      }
      ?>
      </ul>

    <button class="filter-toggle">
      <span class="open"><?php _e( 'Filter Projects', 'hype' ); ?></span>
      <span class="close"><?php _e( 'Hide Filters', 'hype' ); ?></span>
    </button>
  </div>
  <?php } ?>

<?php }
endif;


if ( ! function_exists( 'hype_print_portfolio_permalinks' ) ) :
/**
 * Prints the permalink posts (details) on the portfolio page
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
function hype_print_portfolio_permalinks( $ajax_load = false, $page_number = 0, $terms = array() ) {
  $wp_query = hype_get_portfolio_posts( $ajax_load, $page_number, $terms );

  if ( $wp_query->have_posts() ) {
    while ( $wp_query->have_posts() ) {
      $wp_query->the_post();
      get_template_part( 'content', 'portfolio' );
    }
  }
}
endif;


if ( ! function_exists( 'hype_portfolio_grid_load_more' ) ) :
/**
 * Loads more posts on the homepage
 *
 * @uses: hype_print_portfolio_grid()
 * @uses: hype_print_portfolio_permalinks()
 *
 * @package Hype
 * @since Hype 1.0
 *
 */
add_action( 'wp_ajax_nopriv_hype_portfolio_grid_load_more', 'hype_portfolio_grid_load_more' );
add_action( 'wp_ajax_hype_portfolio_grid_load_more', 'hype_portfolio_grid_load_more' );
function hype_portfolio_grid_load_more() {
  // Which page to load? Data passed from jquery.custom.js
  $page_number = intval( $_POST['page'] ); ?>
  <div class="grid-items">
    <?php hype_print_portfolio_grid( true, $page_number ); ?>
  </div>
  <div class="permalink-items">
    <?php hype_print_portfolio_permalinks( true, $page_number ); ?>
  </div>
  <?php die();
}
endif;

add_filter( 'tzp_metabox_fields_save', 'hype_add_portfolio_meta_box_fields' );
if ( ! function_exists( 'hype_add_portfolio_meta_box_fields' ) ) :
/**
 * Adds fields to the save logic of Zilla Portfolio meta boxes
 *
 */
function hype_add_portfolio_meta_box_fields( $fields ) {
  $fields['_tzp_audio_title']    = 'text';
  $fields['_tzp_audio_subtitle'] = 'text';

  return $fields;
}
endif;

/**
 * Sanitize Text fields before saving
 * @param  string $field The text field to be sanitized
 * @return string $field Sanitized URL string
 */
function tzp_metabox_sanitize_text( $field ) {
  return sanitize_text_field( $field );
}
add_filter( 'tzp_metabox_save_text', 'tzp_metabox_sanitize_text' );
