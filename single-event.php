<?php
/**
 * The template for displaying single posts.
 *
 * @package Hype
 */

get_header();

global $post;

$show_more_posts    = get_option( 'single_post_show_more_posts' );

?>
  <div id="main">
    <div id="posts">
        <?php if ( has_post_thumbnail() ) :
          get_template_part( 'featured-image' );
        endif ?>
      <div class="section">

          <?php

          while ( have_posts() ) : the_post();

            get_template_part( 'content' );

          endwhile;
          ?>
          <?php get_template_part( 'tags' ); ?>

      </div>

      <?php zilla_comments_before(); ?>
      <?php // If comments are open or we have at least one comment, load up the comment template
      if ( comments_open() || '0' != get_comments_number() )
        comments_template();
      ?>
      <?php zilla_comments_after(); ?>

      <?php hype_content_nav(); ?>
	  <div class="post-all-posts-section section">
  <div class="inner-width-800">
	  <div class="inner-width-800">
		<div class="post-all-posts-button-container">
		<a href="/veranstaltungen" class="button primary-button">Zurück zu den Veranstaltungen</a>
		</div>
	  </div>
	 	</div>
	  </div>

	 
    </div><!-- #posts -->
	 
  <div><!-- #main -->
</div><!-- #skrollr-body -->

<?php get_footer(); ?>