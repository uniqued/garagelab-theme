<?php
/**
 * The template part for displaying blog articles on homepage.
 *
 * @package Hype
 *
 */
$blog_link = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url();
?>
<div class="section home-news">
  <div class="inner-width">

    <h2 class="home-title"><?php echo _e( 'Neues aus dem GarageLab', 'hype' ); ?></h2>
    <?php
    $recent_posts = get_posts( array( 'posts_per_page' => 3 ) );
    foreach ( $recent_posts as $post ) : setup_postdata( $post ) ;

      $attachment = hype_get_thumb_data( $post->ID );

      if ( NULL === $attachment['thumb_original'] ) {
        $no_image = 'no-image';
      } else {
        $no_image   = '';
        $image      = hype_responsive_image( $attachment );
      }

      $author_id = get_the_author_meta( 'ID' );
      ?>
      <a class="home-news-block <?php echo $no_image; ?>" href="<?php the_permalink() ?>">
        <?php if ( empty( $no_image ) ) : ?>
          <div class="home-news-thumb"><?php echo $image; ?></div>
        <?php endif; ?>
        <div class="home-news-text">
          <div class="home-news-date"><label><?php echo get_the_date(); ?></label></div>
          <p class="home-news-title"><?php the_title(); ?></p>
		  <div class="home-news-excerpt"><?php the_excerpt(); ?></div>
          <!--div class="home-news-author">
            <span class="home-news-author-image mini-author-image"><?php echo get_avatar( $author_id, 30 ); ?></span><span class="by"><?php _e( 'by ', 'hype' ); ?></span><?php the_author(); ?>
          </div-->
        </div>
      </a>
    <?php
    endforeach ;
    wp_reset_postdata();
    ?>
  </div>
  <div class="inner-width">
    <div class="home-news-button-container">
      <a href="<?php echo $blog_link; ?>" class="button primary-button"><?php _e( 'Alle Neuigkeiten ansehen', 'hype' ); ?></a>
    </div>
  </div>
</div><!-- .home-news -->