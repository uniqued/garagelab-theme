<?php
/*
 * Template Name: Cover Page
 *
 * @package Hype
 */
global $post;

get_header();

$show_portfolio    = get_post_meta( $post->ID, '_zilla_home_show_portfolio', true );
$show_testimonials = get_post_meta( $post->ID, '_zilla_home_show_testimonials', true );
$show_gallery      = get_post_meta( $post->ID, '_zilla_home_show_gallery', true );
$show_blog         = get_post_meta( $post->ID, '_zilla_home_show_blog', true );
$show_title        = get_option( 'show_title_instead_of_logo', '0' );


if ( function_exists( 'jetpack_the_site_logo' ) && ! $show_title ) {
  $offset = -127;
} else {
  $offset = -100;
}
?>

  <div id="main" data-menu-offset="<?php echo $offset; ?>">
    <div id="posts" class="skrollr-content">
      <?php if ( ! empty( $post->post_content) ) : ?>
        <div class="section home-content">
          <div class="inner-width">

            <?php
            while ( have_posts() ) : the_post() ;

              get_template_part( 'content', 'simple' );

            endwhile ;
            wp_reset_query();
            ?>
          </div><!-- .inner-width -->

        </div><!-- .home-content -->
      <?php endif; ?>
    </div><!-- #posts -->

	<?php 
		if ( 'on' === $show_blog ) {	
			  get_template_part( '/cover/blog' );
		}
	?>	
	
    <?php
        if ( 'on' === $show_portfolio ) {
		  ?>
		  <h2>Projekte aus dem GarageLab</h2> <?php
          get_template_part( '/cover/portfolio' );
        }
    ?>
	 <h2>Unsere nächsten Veranstaltungen</h2>
	 <?php
	 
	 get_template_part( '/cover/veranstaltungen' );
	 ?>
	 
	<?php
        if ( 'on' === $show_testimonials ) {
			get_template_part( '/cover/testimonials' );
        }

        if ( 'on' === $show_gallery ) {
          get_template_part( '/cover/gallery' );
        }
  ?>
    </div><!-- #main -->

<?php get_footer(); ?>