<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Hype
 */

get_header();

global $post;

?>

<div id="main" class="has-sidebar">
  <div class="inner-width">
  <?php if ( have_posts() ) : ?>

    <div id="posts">

      <?php while ( have_posts() ) : the_post();

        if( $post->post_type === 'post' ) :
          get_template_part( 'content' );
        endif;

      endwhile;
      ?>

    </div>

  <?php else :

    get_template_part( 'no-results', 'search' );

  endif;
?>
    </div>
  </div><!-- #main -->
</div><!-- #skrollr-content -->

<?php  get_footer(); ?>
