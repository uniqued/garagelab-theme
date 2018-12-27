<?php
/*
 * Template Name: About
 *
 * @package Hype
 */
global $post;

get_header();
?>
  <div id="main">
    <div class="full-width">
      <?php get_template_part( '/about/gallery' ); ?>
    </div>
    <?php if ( ! empty( $post->post_content ) ) : ?>
      <div class="section about-content">
        <div class="inner-width about-inner">
        <?php
          while ( have_posts() ) : the_post() ;

            get_template_part( 'content', 'simple' );

          endwhile ;
          ?>
        </div><!-- .inner-width -->
      </div><!-- .about-content -->
      <div class="section about-our-team">
        <div class="inner-width">
          <?php get_template_part( '/about/our-team' ); ?>
        </div>
      </div>
      <div class="section join-our-team">
        <div class="inner-width-800">
          <?php get_template_part( '/about/join-our-team' ); ?>
        </div>
      </div>
      <div class="section instagram">
        <div class="inner-width">
        <?php if ( is_active_sidebar( 'about-sidebar' ) ) : ?>
	      	<?php dynamic_sidebar( 'about-sidebar' ); ?>
        <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div><!-- #main -->
  </div><!-- #skrollr-body -->
<?php get_footer(); ?>
