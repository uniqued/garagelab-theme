<?php
/**
 * The template part for displaying "our team" section" on about template.
 *
 * @package Hype
 *
 */
$title = get_post_meta( $post->ID, '_zilla_about_team_title', true );

if ( $title ) : ?>
  <h2><?php echo esc_html( $title ); ?></h2>
<?php endif; ?>

<?php
$args = array(
  'posts_per_page' => -1,
  'post_type'      => 'hype-team-member'
);

$team_members = get_posts( $args );

if ( $team_members ) :
  foreach( $team_members as $member ) :
    $subtitle = get_post_meta( $member->ID, '_zilla_subtitle', true );
    $facebook = get_post_meta( $member->ID, '_zilla_facebook', true );
    $twitter  = get_post_meta( $member->ID, '_zilla_twitter', true );
    $linkedin = get_post_meta( $member->ID, '_zilla_linkedin', true );

    if ( strlen( $member->post_content ) > 100 ) {
      $content = substr( $member->post_content, 0, 100 ) . '&hellip;';
    } else {
      $content = $member->post_content;
    }

    if ( has_post_thumbnail( $member->ID ) ) {
      $thumb_data = hype_get_thumb_data( $member->ID );
      $image = hype_responsive_image( $thumb_data, 'thumb' );
    }
    ?>
    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
      <div class="flipper">
        <div class="front">
          <?php if ( has_post_thumbnail( $member->ID ) ) :
            echo $image;
          endif; ?>
          <h5><?php echo esc_html( $member->post_title ); ?></h5>
          <div class="marker team-member-subtitle"><?php echo $subtitle; ?></div>
        </div>
        <div class="back">
          <h5><?php echo esc_html( $member->post_title ); ?></h5>
          <div class="marker team-member-subtitle"><?php echo $subtitle; ?></div>
          <p><?php echo esc_html( $content ); ?></p>
          <div class="social">
            <?php if ( $facebook ) : ?>
              <a href="<?php echo esc_url( $facebook ); ?>" target="_blank">
                <svg class="social-icon"><use xlink:href="#icon-facebook-hype"></use></svg>
              </a>
            <?php endif; ?>
            <?php if ( $twitter ) : ?>
              <a href="<?php echo esc_url( $twitter ); ?>" target="_blank">
                <svg class="social-icon"><use xlink:href="#icon-twitter-hype"></use></svg>
              </a>
            <?php endif; ?>
            <?php if ( $linkedin ) : ?>
              <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
                <svg class="social-icon"><use xlink:href="#icon-linkedin-hype"></use></svg>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; wp_reset_query(); ?>
<?php endif;