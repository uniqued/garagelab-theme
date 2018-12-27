<?php
global $post;

$show_more_title       = get_theme_mod( 'single_post_show_more_title' );
$show_more_amount      = get_theme_mod( 'single_post_show_more_amount', '5' );
$show_more_button_text = get_theme_mod( 'single_post_show_more_button_text', 'See All Posts' );

if ( get_option( 'page_for_posts' ) ) :
  $home_url = get_permalink( get_option( 'page_for_posts' ) );
else :
  $home_url = home_url();
endif;
?>
<div class="post-all-posts-section section">
  <div class="inner-width-800">
    <?php if ( get_previous_post() ) : ?><h3><?php echo esc_html( $show_more_title ); ?></h3><?php endif; ?>

    <?php
    $args  = array( 'posts_per_page' => $show_more_amount,
                    'post_type'   => 'post' );
    $posts = get_posts( $args );

    $current_post = $post;

    if( get_previous_post() ) : for ( $i = 1; $i <= $show_more_amount ; $i++ ) :

      $post = get_previous_post();
        if( ! empty( $post ) ) :
          setup_postdata( $post ) ;

          $attachment = hype_get_thumb_data( $post->ID );
          $image      = hype_responsive_image( $attachment );
          $date       = get_the_date();
          $no_image   = '';

          if ( NULL === $attachment['thumb_original'] ) :
            $no_image = 'no-image';
          endif;

          $author_id = get_the_author_meta( 'ID' );
          ?>
          <div class="post-all-posts-single <?php echo $no_image; ?>">
            <div class="post-all-posts-single-content">
              <div class="date">
                <?php echo $date; ?>
              </div>
              <h4 class="post-all-posts-single-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
              <div class="post-all-posts-excerpt"><?php echo the_excerpt(); ?></div>
            </div>
            <?php if ( empty( $no_image ) ) : ?>
              <div class="post-all-posts-single-image"><?php echo $image ?></div>
            <?php endif; ?>
          </div>
    <?php
        endif;

    endfor; endif;

    $post = $current_post;
    ?>
  </div>
  <div class="inner-width">
    <div class="post-all-posts-button-container">
      <a href="<?php echo $home_url; ?>" class="button primary-button"><?php echo esc_html( $show_more_button_text ); ?></a>
    </div>
  </div>
</div>