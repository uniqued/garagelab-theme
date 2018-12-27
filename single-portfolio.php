<?php
/**
 * The template for displaying single portfolio items.
 *
 * @package Hype
 */

get_header();

global $post;

$no_next            = '';
$no_prev            = '';
$show_more_projects = get_option( 'single_project_show_more_posts' );
$show_more_title    = get_theme_mod( 'single_project_show_more_title' );
$show_more_amount   = get_theme_mod( 'single_project_show_more_amount', '5' );
$see_all_link       = get_theme_mod( '_single_project_see_all_link', '' );
$show_gallery       = get_post_meta( $post->ID, '_tzp_display_gallery', true );
$show_audio         = get_post_meta( $post->ID, '_tzp_display_audio', true );
$show_video         = get_post_meta( $post->ID, '_tzp_display_video', true );

$args = array( 'post_type'      => 'portfolio',
               'orderby'        => 'menu_order',
               'order'          => 'ASC',
               'posts_per_page' => -1);

$projects  = get_posts( $args );
$prev_link = '';
$next_link = '';
$cur_post  = false;
$count     = 1;

foreach ( $projects as $project ) {

  if( $cur_post ) {
    $next_link = get_permalink( $project->ID );
    $cur_post  = false;
  }


  if( $post->ID === $project->ID ) {
    $cur_post  = true;

    if( 1 !== $count ) {
      $prev_link = get_permalink( $prev_id );
    }
  }

  $prev_id = $project->ID;

  $count++;
}

if ( empty( $next_link ) ) :
  $no_next = 'no-next';
endif;

if ( empty( $prev_link ) ) :
  $no_prev = 'no-prev';
endif;

$args = array(
  'post_type'		=>	'hype-testimonial',
  'meta_query'	=>	array(
    array(
      'name'  => '_zilla_testimonial_portfolio',
      'value'	=>	$post->ID
    )
  )
);

$testimonial_query = new WP_Query( $args );

if( ! empty( $next_link ) ) {
  $next_link = '<a href="' . $next_link . '"><div class="post-pagination-next"><svg class="post-pagination-next-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Nächstes Projekt', 'hype' ) . '</span></div></a>';
} else {
  $next_link = '<div class="post-pagination-next"><svg class="post-pagination-next-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Nächstes Projekt', 'hype' ) . '</span></div>';
}

if( ! empty( $prev_link ) ) {
  $prev_link = '<a href="' . $prev_link . '"><div class="post-pagination-prev"><svg class="post-pagination-prev-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Vorheriges Projekt', 'hype' ) . '</span></div></a>';
} else {
  $prev_link = '<div class="post-pagination-prev"><svg class="post-pagination-prev-icon post-pagination-icon"><use xlink:href="#icon-next_icon"></use></svg>' .
    '<span class="post-pagination-text">' . __( 'Vorheriges Projekt', 'hype' ) . '</span></div>';
}
?>
  <div id="main">
    <div id="posts">

      <?php if ( $show_gallery ) : ?>
        <section class="section portfolio-gallery">
          <div class="inner-width-no-padding">
            <?php get_template_part( '/portfolio/gallery' ); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ( $show_audio ) : ?>
        <section class="section">
          <div class="inner-width">
            <?php get_template_part( '/portfolio/audio' ); ?>
          </div>
        </section>
      <?php endif; ?>

      <?php if ( $show_video ) : ?>
        <section class="section">
          <div class="inner-width">
            <?php get_template_part( '/portfolio/video' ); ?>
          </div>
        </section>
      <?php endif; ?>

      <section class="section portfolio-content">
        <div class="inner-width">
          <?php
          while ( have_posts() ) : the_post();
            the_content();
          endwhile;
          ?>
        </div>
      </section>

      <section class="portfolio-meta">
        <div class="inner-width">
          <?php hype_portfolio_meta( $post->ID ); ?>
        </div>
      </section>
      <?php
      if ( $testimonial_query->have_posts() ) {
        get_template_part( '/portfolio/testimonials' );
      }
      ?>
      <section class="portfolio-post-pagination-section post-pagination-section section">
        <div class="post-pagination-inner <?php echo $no_next.' '.$no_prev; ?>">
          <?php if ( ! empty( $prev_link ) ) { echo $prev_link; } ?>
          <?php if ( ! empty( $next_link ) ) { echo $next_link; } ?>
        </div>
      </section>
      <?php if ( $show_more_projects ) : ?>
        <div class="project-all-projects-section section">
          <div class="inner-width">
            <?php
            $args     = array( 'post_type'      => 'portfolio',
                               'orderby'        => 'menu_order',
                               'order'          => 'ASC',
                               'post_status'    => 'publish',
                               'posts_per_page' => -1
            );

            $projects = get_posts( $args );
            $count    = 1;
            $offset   = 0;

            foreach( $projects as $project ) {
              if( $project->ID === $post->ID ) {
                $offset = $count;
              }
              $count++;
            }

            $args= array( 'posts_per_page' => $show_more_amount,
                          'post_type'   => 'portfolio',
                          'orderby'     => 'menu_order',
                          'order'       => 'ASC',
                          'post_status' => 'publish',
                          'offset'      => $offset
            );
            $projects = get_posts( $args );
            ?>
            <?php if ( ! empty( $projects ) ) : ?><h2><?php echo esc_html( $show_more_title ); ?></h2><?php endif; ?>
            <?php
            foreach ( $projects as $post ) : setup_postdata( $post ) ;
              $attachment = hype_get_thumb_data( $post->ID );
              if ( NULL === $attachment['thumb_original'] ) :
                $no_image = 'no-image';
                $image = esc_html(  $attachment['thumb_alt'] );
              else :
                $no_image   = '';
                $image      = hype_responsive_image( $attachment );
              endif;
              $categories = get_the_terms( $post->ID, 'portfolio-type' );
              ?>
              <div class="project-all-projects-block">
                <div class="project-all-projects-block-img">
                  <div class="project-all-projects-block-thumb"><?php echo $image; ?></div>
                  <div class="project-all-projects-block-overlay <?php echo esc_attr( $no_image ); ?>">
                    <h3 class="project-all-projects-title"><?php the_title(); ?></h3>
                    <a class="project-all-projects-button button secondary-button portfolio-button" href="<?php the_permalink(); ?>">
                      <?php _e( 'Projekt ansehen', 'hype' ); ?>
                    </a>
                    <div class="project-all-projects-categories">
                      <?php
                      if ( $categories ) :
                        foreach ( $categories as $category ) :
                          ?>
                          <a class="project-category project-all-projects-category" href="<?php echo get_term_link( $category ); ?>">
                            <?php echo esc_html( $category->name ); ?>
                          </a>
                          <?php
                        endforeach;
                      endif;
                      ?>
                    </div>
                  </div>

                </div>
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              </div>
              <?php
            endforeach;
            wp_reset_postdata();
            ?>
          </div>
          <div class="inner-width">
            <div class="project-all-projects-button-container lone-button">
              <a href="<?php echo $see_all_link; ?>" class="button primary-button"><?php _e( 'Alle Projekte ansehen', 'hype' ); ?></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div><!-- #posts -->
  </div><!-- #main -->
<?php get_footer(); ?>
