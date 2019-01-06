<?php
/**
 * The Hero.
 *
 * @package Hype
 */

global $post, $current_user;

if ( $post && ! is_404() ) {
  $subtitle           = get_post_meta( $post->ID, '_zilla_subtitle', true );
}

$portfolio_title      = get_theme_mod( 'portfolio_title', 'Portfolio' );
$portfolio_subtitle   = get_theme_mod( 'portfolio_subtitle', '' );

if ( get_post_type() === 'post' ) :
  $post_date = get_the_date();
  $author_id = $post->post_author;
  $author    = get_userdata( $author_id );

  $args                    = array(  'title_li' => __( '', 'hype' ), 'echo' => false, 'style' => 'none' );
  $post_categories         = wp_get_post_categories( $post->ID );
  $post_categories_content = '';

  foreach ( $post_categories as $c ) :
    $cat      = get_category( $c );
    $cat_link = get_category_link( $c );

    $post_categories_content .= '<a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat->name ) . '</a>';
  endforeach;

  $post_comments_content   = '<svg class="post-comment-s-icon"><use xlink:href="#icon-comments-s"></use></svg>';
  $post_comments_count     = $post->comment_count;

  switch( $post->comment_count ) {
    case 1;
      $post_comments_content .= $post_comments_count . __( ' Comment', 'hype' );
      break;
    default;
      $post_comments_content .= $post_comments_count . __( ' Comments', 'hype' );
      break;
  }
  $author_id = get_the_author_meta( 'ID' );
endif;
if ( is_tax( 'portfolio-type' ) ) :
  global $wp_query;
  $term = $wp_query->get_queried_object();
  $tax_title = $term->name;
endif;
?>
<div class="hero">
  <?php if ( is_page_template( 'page-cover.php' ) || is_home() ) : ?>
    <div class="hero-overlay"></div>
  <?php endif; ?>
  <div class="bcg">
    <div class="inner-width">
      <div class="hero-content">
        <?php if ( ! is_home() && ! is_archive() && ! is_search() && get_post_type() === 'post' ) : ?>
          <span class="date"><?php echo $post_date; ?></span>
        <?php endif; ?>
        <?php if ( is_tax( 'portfolio-type' ) ) : ?>
          <h1><?php echo esc_html( $tax_title ); ?></h1>
        <?php elseif ( is_archive() && get_post_type() === 'portfolio' ) : ?>

          <h1><?php echo esc_html( $portfolio_title ); ?></h1>
          <?php if ( ! empty( $portfolio_subtitle ) ) : ?>
            <p class="lead"><?php echo esc_html( $portfolio_subtitle ); ?></p>
          <?php endif; ?>
        <?php elseif ( is_404() ) : ?>
          <h1><?php _e( 'Leider nichts gefunden.' ); ?></h1>
        <?php elseif ( is_search() ) : ?>
          <h1 class="page-title"><?php printf( __( 'Ergebnisse für: %s', 'hype' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php elseif ( is_archive() && get_post_type() === 'post' ) : ?>
          <h1>
            <?php
            if ( is_category() ) :
              _e( 'Category: ', 'hype') . single_cat_title();

            elseif ( is_tag() ) :
              single_tag_title();

            elseif ( is_author() ) :
              /* Queue the first post, that way we know
               * what author we're dealing with (if that is the case).
              */
              the_post();
              printf( __( 'Author: %s', 'hype' ), '<span class="vcard">' . get_the_author() . '</span>' );
              /* Since we called the_post() above, we need to
               * rewind the loop back to the beginning that way
               * we can run the loop properly, in full.
               */
              rewind_posts();

            elseif ( is_day() ) :
              printf( __( 'Day: %s', 'hype' ), '<span>' . get_the_date() . '</span>' );

            elseif ( is_month() ) :
              printf( __( 'Month: %s', 'hype' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

            elseif ( is_year() ) :
              printf( __( 'Year: %s', 'hype' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

            elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
              _e( 'Asides', 'hype' );

            elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
              _e( 'Images', 'hype');

            elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
              _e( 'Videos', 'hype' );

            elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
              _e( 'Quotes', 'hype' );

            elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
              _e( 'Links', 'hype' );

            elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
              _e( 'Galleries', 'hype' );

            else :
              _e( 'Archives', 'hype' );

            endif;
            ?>
          </h1>
        <?php else: ?>
          <h1><?php the_title(); ?></h1>
          <?php if ( ! empty( $subtitle ) ) : ?>
            <h3 class="lead"><?php echo $subtitle; ?></h3>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ( ! is_search() && ! is_home() && ! is_archive() && get_post_type() === 'post' ) : ?>
          <div class="hero-post-meta">
            <div class="hero-post-meta-categories hero-post-meta-block">
              <svg class="icon-folder"><use xlink:href="#icon-folder"></use></svg><span class='by'><?php _e( 'in', 'hype' ); ?> </span><?php echo $post_categories_content; ?>
            </div>
            <a class="hero-post-meta-comments hero-post-meta-block" href="#comments"><?php echo $post_comments_content; ?></a>
          </div>
        <?php endif; ?>

        <?php if ( get_post_type() == 'portfolio' ) : ?>
        <?php if ( is_archive() ) : ?>
        <?php else: ?>
        <?php $categories = get_the_terms( $post->ID, 'portfolio-type' ); ?>
        <?php if ( $categories ) : ?>
        <div class="project-categories hero-project-categories">
          <?php
          foreach ( $categories as $category ) :
            ?>
            <a class="project-category hero-project-category" href="<?php echo get_term_link( $category ); ?>">
              <?php echo esc_html( $category->name ); ?>
            </a>
            <?php
          endforeach;
          ?>
        </div>
        <?php endif; ?><!--if categories -->
        <?php endif; ?><!-- if archive -->
        <?php endif; ?><!-- is portfolio -->
      </div><!-- .hero-content -->
    </div><!-- .inner-width -->
  </div><!-- .bcg -->
</div><!-- .hero -->